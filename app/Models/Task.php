<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'repetition',
        'task_group_id',
        'user_id',
        'last_completed',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function taskGroup(): BelongsTo
    {
        return $this->belongsTo(TaskGroup::class);
    }
}
