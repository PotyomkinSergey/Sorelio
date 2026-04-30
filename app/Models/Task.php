<?php
declare(strict_types=1);
namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    public $fillable = [
        'deadline_at',
        'description',
        'status',
        'title',
    ];

    public function isDone():bool
    {
        return $this->status == TaskStatusEnum::DONE->value;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($post) {
            $post->user_id = Auth::id();
        });
    }
}
