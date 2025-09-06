<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Desa
 *
 * @property int $id
 * @property int $kecamatan_id
 * @property string $nama
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kecamatan $kecamatan
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Desa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereNama($value)

 * 
 * @mixin \Eloquent
 */
class Desa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kecamatan_id',
        'nama',
        'keterangan',
    ];

    /**
     * Get the kecamatan that owns the desa.
     */
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Get the demographic data for the desa.
     */
    public function demografi(): HasMany
    {
        return $this->hasMany(DemografiPenduduk::class);
    }

    /**
     * Get the UMKM data for the desa.
     */
    public function umkm(): HasMany
    {
        return $this->hasMany(Umkm::class);
    }
}