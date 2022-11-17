<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Task extends Model
{
    use HasFactory, UUID;

    const NOT_STARTED = "NOT_STARTED";
    const IN_PROGRESS = "IN_PROGRESS";
    const READY_FOR_TEST = "READY_FOR_TEST";
    const COMPLETED = "COMPLETED";

    protected $fillable = [
        'title',
        'description',
        'status',
        'project_id',
        'user_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
