<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dokter extends Model
{
    use HasFactory;
    public $primaryKey = 'id_dokter';
    protected $fillable = [
        'nama', 'no_str', 'id_department', 'email', 'no_telpon', 'jk', 'tanggal_lahir', 'alamat', 'foto'
    ];

    
    static function getDokter(){
        return DB::table('dokters', 'dokters.id_dokter');
        // $myreturn = DB::table('dokters')
        // ->join('departments','dokters.id_dokter','=','departments.id_department');
        // return $myreturn;
    }
}
