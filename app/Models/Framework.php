<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CategoryScope; // グローバルスコープ
use App\Events\AccessDetection; // イベントクラスをuse
// use App\Events\Slack;

class Framework extends Model
{
    // 登録を許可するフィールド
    protected $fillable = ['name', 'category'];

    protected $attributes = [
        'category' => 'PHP',
    ];

    protected $dispatchesEvents = [
        // データ取得時に発火
        'retrieved' => AccessDetection::class,
        //'saved' => Slack::class,
    ];

    // グローバルスコープ
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CategoryScope);
    }

    /**
     * categoryが「PHP」を含むものとするクエリスコープ
     * @param $query
     * @return mixed
     */
    public function scopeCategoryInPhp($query)
    {
        return $query->orWhereIn('category', ['PHP']);
    }

    /**
     * categoryが「Python」を含むものとするクエリスコープ
     * @param $query
     * @return mixed
     */
    public function scopeCategoryInPython($query)
    {
        return $query->orWhereIn('category', ['Python']);
    }

    /**
     * 任意のカテゴリを含むものとするクエリスコープ
     * @param $query
     * @param array $types
     * @return mixed
     */
    public function scopeCategoryInSomething($query, array $types)
    {
        return $query->orWhereIn('category', $types);
    }
}
