<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $primaryKey = 'employee_code';
    public function getEmployeeCodeAttribute()
    {
        // Format the employee code as "EMP-XXXX"
        return  str_pad($this->attributes['employee_code'], 4, '0', STR_PAD_LEFT);
    }
}
