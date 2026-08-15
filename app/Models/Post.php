<?php

namespace App\Models;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model implements Feedable
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

    public function getLinkAttribute()
    {
        return route('posts.show', $this);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->description ?? '')
            ->updated($this->updated_at)
            ->link(route('posts.show', $this->id))
            ->authorName($this->user->name ?? 'Unknown');
    }

    public static function all($columns = ['*'])
    {
        return static::query()->get(is_array($columns) ? $columns : func_get_args())
            ->where('published', 1)
            ->sortByDesc('created_at');
    }


    public static function getFeedItems()
    {
        return static::all();
    }

    public static function getVolume()
    {
        // number of years since the first post
        $firstPost = static::oldest()->first();
        if (!$firstPost) {
            return 1;
        }
        return now()->year - $firstPost->created_at->year + 1;
    }

    public static function getIssue()
    {
        // number of posts this year
        return static::whereYear('created_at', now()->year)
            ->where('published', 1)
            ->count();
    }

}


