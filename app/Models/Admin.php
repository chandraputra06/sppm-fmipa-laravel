<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // penting kalau mau dipakai sebagai guard auth
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
