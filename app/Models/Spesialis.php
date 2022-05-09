<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Spesialis extends Model
{
    use HasFactory;

    public $primaryKey = 'idSpesialis';
    protected $filLable =[
        'namaSpesialis', 'image'
    ];

    static function getSpesialis(){
        return DB::table('spesialis', 'spesialis.idSpesialis');
    }
}
