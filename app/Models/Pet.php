<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    protected $fillable = [
        'nama', 
        'tanggal_lahir', 
        'warna_tanda', 
        'jenis_kelamin',
    ];

    public function jenisKelamin()
    {
        return match ($this->jenis_kelamin) {
            'L' => 'Jantan',
            'M' => 'Betina',
            default => 'Tidak Diketahui',
        };
    }

    public function pemilik()   
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    
}
