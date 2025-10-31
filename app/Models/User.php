<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; // <-- Diperlukan oleh Auth Guard
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; // <-- Trait untuk mengimplementasikan method yang diperlukan
use App\Models\Pemilik; // <-- Tambah impor untuk relasi pemilik()
use App\Models\RoleUser; // <-- Tambah impor untuk relasi roleUser()

class User extends Model implements Authenticatable // <-- Implementasikan Interface Authenticatable
{
    use AuthenticatableTrait; // <-- Gunakan Trait

    protected $table = 'user'; 
    protected $primaryKey = 'iduser'; 
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser'); 
    }

    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }
}
