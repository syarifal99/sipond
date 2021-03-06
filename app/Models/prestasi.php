<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class prestasi
 * @package App\Models
 * @version February 3, 2020, 2:22 pm UTC
 *
 * @property integer id_prestasi
 * @property string no_induk
 * @property string tgl_prestasi
 * @property string jenis_prestasi
 * @property string catatan
 */
class prestasi extends Model
{
    

    public $table = 'prestasi';
    public $primaryKey = 'id_prestasi';

    public $timestamps = false;


    public $fillable = [
        'id_prestasi',
        'no_induk',
        'tgl_prestasi',
        'jenis_prestasi_id',
        'catatan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_prestasi' => 'integer',
        'no_induk' => 'string',
        'tgl_prestasi' => 'string',
        'jenis_prestasi_id' => 'integer',
        'catatan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

        'no_induk' => 'required',
        'tgl_prestasi' => 'required',
        'jenis_prestasi_id' => 'required',
        'catatan' => 'required'
    ];

    public function bio_siswa()
    {
        return $this->hasOne(BioSiswa::class, 'no_induk', 'no_induk');
    }

    public function jenis_prestasi()
    {
        return $this->hasOne(JenisPrestasi::class, 'id', 'jenis_prestasi_id');
    }
}
