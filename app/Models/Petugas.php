<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use Notifiable;

    protected $table = 'petugas'; // tabel petugas
    protected $fillable = ['nama','email','password','no_hp','status'];
    protected $hidden = ['password','remember_token'];
}