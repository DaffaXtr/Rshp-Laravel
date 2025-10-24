<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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
        return $this->hasOne(Role::class, 'iduser', 'iduser');
    }
}
