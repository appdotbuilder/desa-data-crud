<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Umkm
 *
 * @property int $id
 * @property int $desa_id
 * @property string $jenis_umkm
 * @property float|null $lokasi_x
 * @property float|null $lokasi_y
 * @property string $pemilik
 * @property string|null $foto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Desa $desa
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm query()
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereJenisUmkm($value)
 * @method static \Database\Factories\UmkmFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Umkm extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'umkm';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'jenis_umkm',
        'lokasi_x',
        'lokasi_y',
        'pemilik',
        'foto',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'lokasi_x' => 'decimal:6',
        'lokasi_y' => 'decimal:6',
    ];

    /**
     * Get the desa that owns the UMKM.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}