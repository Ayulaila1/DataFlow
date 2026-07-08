<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel
     */
    protected $table = 'users';

    /**
     * Primary Key
     */
    protected $primaryKey = 'iduser';

    /**
     * Auto Increment
     */
    public $incrementing = true;

    /**
     * Tipe Primary Key
     */
    protected $keyType = 'int';

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Hidden Attribute
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Attribute Casting
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}