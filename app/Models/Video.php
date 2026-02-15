<?php

namespace App\Models;

use App\Enums\VideoStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'thumbnail',
        'video_url',
        'file_size',
        'duration',
        'status',
        'is_new',
        'format',
        'upload_at',
        'views',
        'resolution',
        'description',
        'creator_id',
    ];

    protected $casts = [
        'isNew'  => 'boolean',
        'status' => VideoStatus::class,
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
