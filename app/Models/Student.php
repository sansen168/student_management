<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'stu_name', // This matches your form and validation
        'gender',
        'age',
        'major',          
        'major_price',      
        'enrollment_date',
        'phone',
        'address',
        'image',
    ];
    use HasFactory;
}