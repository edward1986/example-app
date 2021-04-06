<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $appends = [
        'active_task',
        'highest_priority',
        'medium_priority',
        'lowest_priority',
    ];
    protected $fillable = [
        'name',
        'description',
        'priority',
    ];
    public function active_task()
    {
        return $this->count();
    }
    public function highest_priority()
    {
        return $this->where('priority',  1)->count();
    }
    public function medium_priority()
    {
        return $this->where('priority',  2)->count();
    }
    public function lowest_priority()
    {
        return $this->where('priority',  3)->count();
    }

    public function getActiveTaskAttribute()
    {
        return $this->active_task();
    }
    public function getHighestPriorityAttribute()
    {
        return $this->highest_priority();
    }
    public function getMediumPriorityAttribute()
    {
        return $this->medium_priority();
    }
    public function getLowestPriorityAttribute()
    {
        return $this->lowest_priority();
    }
}
