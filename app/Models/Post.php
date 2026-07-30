<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /**
     * @var int|mixed|string|null
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'published',
    ];




    // content is of type json
    public static function newest()
    {
        return self::latest()->first()->id;
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
