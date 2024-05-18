<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeartData extends Model
{
    use HasFactory;

    protected $table = 'heart'; // Pastikan nama tabel benar

    protected $fillable = [
        'age', 
        'gender', 
        'impulse', 
        'pressurehight', 
        'pressurelow', 
        'glucose', 
        'kcm', 
        'troponin', 
        'class',
    ];
}
