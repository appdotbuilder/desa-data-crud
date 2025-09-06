<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Kecamatan
 *
 * @property int $id
 * @property int $kabupaten_id
 * @property string $nama
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kabupaten $kabupaten
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Desa> $desas
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereNama($value)

 * 
 * @mixin \Eloquent
 */
class Kecamatan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kabupaten_id',
        'nama',
        'keterangan',
    ];

    /**
     * Get the kabupaten that owns the kecamatan.
     */
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    /**
     * Get the desas for the kecamatan.
     */
    public function desas(): HasMany
    {
        return $this->hasMany(Desa::class);
    }
}