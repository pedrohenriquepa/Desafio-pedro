<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avelar extends Model
{
    use HasFactory;

    protected $table='dados';
    protected $primaryKey='id';
    protected $fillable = ['nome','idade','cep','cidade','estado','rua','bairro','correo','anexo','anexo'];

    public $timestamps=false;

}
