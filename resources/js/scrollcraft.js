/**
 * Scroll-Craft Engine untuk BocahLabs
 * Menggerakkan progres scroll (--sc-p), reveal anti-macet, progress rail,
 * parallax hero, lateral pan galeri, dan efek depth kursor secara ringan (rAF).
 */

export function initScrollCraft() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const progressBar = document.getElementById('sc-scroll-progress');
    const revealEls = Array.from(document.querySelectorAll('[data-sc-reveal]'));
    const scrubEls = Array.from(document.querySelectorAll('[data-sc-scrub]'));

    if (prefersReducedMotion) {
        revealEls.forEach((el) => el.classList.add('is-visible'));
        scrubEls.forEach((el) => el.style.setProperty('--sc-p', '1'));
        return;
    }

    // 1. IntersectionObserver dengan threshold rendah agar selalu responsif
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.05, rootMargin: '0px 0px -10px 0px' }
    );

    revealEls.forEach((el) => revealObserver.observe(el));

    // 2. Scroll Scrub Loop + fallback anti-macet untuk reveal
    let ticking = false;

    const updateScrollMetrics = () => {
        ticking = false;
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const globalProgress = docHeight > 0 ? Math.min(Math.max(scrollTop / docHeight, 0), 1) : 0;

        if (progressBar) {
            progressBar.style.transform = `scaleX(${globalProgress})`;
        }

        const vh = window.innerHeight;

        // Jaminan anti-macet: setiap elemen yang sudah masuk 95% tinggi layar pasti muncul
        revealEls.forEach((el) => {
            if (!el.classList.contains('is-visible')) {
                const r = el.getBoundingClientRect();
                if (r.top < vh * 0.95 && r.bottom > 0) {
                    el.classList.add('is-visible');
                    revealObserver.unobserve(el);
                }
            }
        });

        scrubEls.forEach((el) => {
            const rect = el.getBoundingClientRect();
            const raw = (vh - rect.top) / (vh + rect.height * 0.65);
            const progress = Math.min(Math.max(raw, 0), 1);
            el.style.setProperty('--sc-p', progress.toFixed(4));

            if (el.dataset.scScrub === 'process') {
                const steps = el.querySelectorAll('[data-sc-step]');
                steps.forEach((step, idx) => {
                    const threshold = (idx + 0.5) / steps.length;
                    step.classList.toggle('is-step-active', progress >= threshold * 0.85);
                });
            }
        });
    };

    const onScroll = () => {
        if (!ticking) {
            ticking = true;
            window.requestAnimationFrame(updateScrollMetrics);
        }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll, { passive: true });
    updateScrollMetrics();

    // 3. Pointer Depth 3D halus pada kartu Hero & Cursor Glow pada CTA (khusus desktop)
    const isPointerFine = window.matchMedia('(pointer: fine)').matches;
    if (isPointerFine) {
        const tiltCard = document.querySelector('[data-sc-tilt]');
        if (tiltCard) {
            tiltCard.addEventListener('mousemove', (e) => {
                const rect = tiltCard.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                tiltCard.style.transform = `perspective(1000px) rotateX(${(-y * 5).toFixed(2)}deg) rotateY(${(x * 6).toFixed(2)}deg)`;
            });
            tiltCard.addEventListener('mouseleave', () => {
                tiltCard.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
            });
        }

        const glowCta = document.querySelector('[data-sc-glow]');
        if (glowCta) {
            glowCta.addEventListener('mousemove', (e) => {
                const rect = glowCta.getBoundingClientRect();
                glowCta.style.setProperty('--gx', `${e.clientX - rect.left}px`);
                glowCta.style.setProperty('--gy', `${e.clientY - rect.top}px`);
            });
        }
    }
}