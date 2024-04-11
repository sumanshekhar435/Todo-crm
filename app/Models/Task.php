<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'employee_id',
        'project_id',
        'module_id',
        'sub_module_id',
        'start_date',
        'end_date',
        'type',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function subModule()
    {
        return $this->belongsTo(SubModule::class, 'sub_module_id', 'id');
    }
}
