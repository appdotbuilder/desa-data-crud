<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DemografiPenduduk
 *
 * @property int $id
 * @property int $desa_id
 * @property string $kk
 * @property string $nik
 * @property string $nama
 * @property string $jenis_kelamin
 * @property \Illuminate\Support\Carbon $tanggal_lahir
 * @property string $alamat
 * @property string $pendidikan_terakhir
 * @property string $agama
 * @property string $pekerjaan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Desa $desa
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|DemografiPenduduk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DemografiPenduduk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DemografiPenduduk query()
 * @method static \Illuminate\Database\Eloquent\Builder|DemografiPenduduk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DemografiPenduduk whereNama($value)
 * @method static \Database\Factories\DemografiPendudukFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class DemografiPenduduk extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'demografi_penduduk';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'kk',
        'nik',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'pendidikan_terakhir',
        'agama',
        'pekerjaan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the desa that owns the demographic data.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}