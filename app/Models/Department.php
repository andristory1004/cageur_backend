<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory;
    public $primaryKey = 'idDepartment';
    protected $fillable = [
        'namaDepartment', 'image'
    ];


    static function getDepartment()
    {
        return DB::table('departments', 'departments.idDepartment');
    }
}
