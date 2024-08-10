<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombres', 'apellidos', 'fecha_nacimiento', 'cuit',
        'domicilio', 'telefono_celular', 'email'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];
}
