<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function subTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id');
    }


    /**
     * @return BelongsTo
     */
    public function assignee(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'assignee_id');
    }
}
