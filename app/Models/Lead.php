<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    public const STATUS_BARU = 'baru';
    public const STATUS_DIHUBUNGI = 'dihubungi';
    public const STATUS_DEAL = 'deal';
    public const STATUS_BATAL = 'batal';

    /**
     * Daftar opsi status lead untuk validasi dan filter panel admin.
     *
     * @return array<string, string>
     */
    public static function statusOptions(): array
    {
        return [
            self::STATUS_BARU => 'Baru',
            self::STATUS_DIHUBUNGI => 'Dihubungi',
            self::STATUS_DEAL => 'Deal',
            self::STATUS_BATAL => 'Batal',
        ];
    }

    protected $fillable = [
        'brand_name',
        'package_id',
        'addon_ids',
        'lang',
        'message',
        'ip_address',
        'user_agent',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'addon_ids' => 'array',
        ];
    }

    /**
     * Relasi: lead memilih satu paket layanan.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}