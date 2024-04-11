<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'member',
        'type',
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }

    // Project.php

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function getEmployeeNamesAttribute()
    {
        $employeeIds = json_decode($this->member);
        $employees = Employee::whereIn('id', $employeeIds)->pluck('name')->toArray();
        return $employees;
    }
}
