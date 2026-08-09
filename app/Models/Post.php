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

    public static function create(): Post
    {
        // create a new post with default values
        $post = new self();
        $post->title = 'New Post';
        $post->content = json_encode([
            [
                "type" => "heading",
                "value" => "Post #" . (self::newest() + 1),
                "level" => 1
            ],
            [
                "type" => "paragraph",
                "value" => "This is the content of the new post."
            ]
        ]);
        $post->user_id = auth()->id();
        $post->published = 0;
        $post->save();
        return $post;
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
