"""
Skrip ekstraksi 5 gambar base64 dari prototipe HTML BocahLabs
ke public/images/logo.png dan public/images/packages/<slug>.webp
"""

import base64
import io
import re
from pathlib import Path

ROOT_DIR = Path(__file__).resolve().parent.parent
HTML_PATH = ROOT_DIR / "bocahlabs_website_development_service.html"
LOGO_OUT = ROOT_DIR / "public" / "images" / "logo.png"
PACKAGES_DIR = ROOT_DIR / "public" / "images" / "packages"


def save_image(raw_bytes: bytes, mime_ext: str, target_path: Path, prefer_webp: bool = False) -> Path:
    target_path.parent.mkdir(parents=True, exist_ok=True)

    # Jika target .webp dan sumbernya sudah webp, simpan langsung
    if prefer_webp and mime_ext == "webp":
        target_path.write_bytes(raw_bytes)
        return target_path

    # Jika perlu konversi ke webp, coba gunakan Pillow jika terpasang
    if prefer_webp and mime_ext != "webp":
        try:
            from PIL import Image

            with Image.open(io.BytesIO(raw_bytes)) as img:
                img.save(target_path, format="WEBP", quality=90)
            return target_path
        except ImportError:
            # Fallback: simpan dengan ekstensi asli jika Pillow belum terpasang
            fallback_path = target_path.with_suffix(f".{mime_ext}")
            fallback_path.write_bytes(raw_bytes)
            print(f"  [Info] Pillow belum terpasang, disimpan sebagai {fallback_path.name}")
            return fallback_path

    target_path.write_bytes(raw_bytes)
    return target_path


def main() -> None:
    if not HTML_PATH.exists():
        raise FileNotFoundError(f"File prototipe tidak ditemukan di: {HTML_PATH}")

    html = HTML_PATH.read_text(encoding="utf-8")

    # 1. Ekstrak logo dari <header>
    header_match = re.search(r"<header\b.*?</header>", html, flags=re.DOTALL)
    if not header_match:
        raise RuntimeError("Tag <header> tidak ditemukan di file HTML.")

    logo_match = re.search(
        r'data:image/(png|jpeg|jpg|webp);base64,([A-Za-z0-9+/=]+)',
        header_match.group(0),
    )
    if not logo_match:
        raise RuntimeError("Gambar base64 logo tidak ditemukan di dalam <header>.")

    logo_ext, logo_b64 = logo_match.group(1), logo_match.group(2)
    logo_saved = save_image(base64.b64decode(logo_b64), logo_ext, LOGO_OUT, prefer_webp=False)
    print(f"[OK] Logo diekstrak ({logo_ext}): {logo_saved.relative_to(ROOT_DIR)} ({logo_saved.stat().st_size:,} bytes)")

    # 2. Ekstrak 4 gambar paket dari blok const PACKAGES berdasarkan id
    pkg_block_match = re.search(r"const PACKAGES\s*=\s*\[(.*?)\];", html, flags=re.DOTALL)
    if not pkg_block_match:
        raise RuntimeError("Blok const PACKAGES tidak ditemukan di file HTML.")

    pkg_pattern = re.compile(
        r"id:\s*'([a-z0-9-]+)'\s*,\s*tier:.*?image:\s*'data:image/(png|jpeg|jpg|webp);base64,([A-Za-z0-9+/=]+)'",
        flags=re.DOTALL,
    )
    matches = pkg_pattern.findall(pkg_block_match.group(1))
    if len(matches) != 4:
        raise RuntimeError(f"Diharapkan 4 gambar paket, ditemukan {len(matches)}.")

    for slug, ext, b64_data in matches:
        out_path = PACKAGES_DIR / f"{slug}.webp"
        saved = save_image(base64.b64decode(b64_data), ext, out_path, prefer_webp=True)
        print(f"[OK] Paket '{slug}' diekstrak ({ext}): {saved.relative_to(ROOT_DIR)} ({saved.stat().st_size:,} bytes)")

    print("\nSelesai! Semua 5 gambar berhasil diekstrak ke public/images/.")


if __name__ == "__main__":
    main()