<?php


namespace App\Models;


use App\Observers\ModelObserver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AbstractModel extends Model
{
    /** @var string[] @inheritdoc  */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /** @var Collection 一時キャッシュ */
    private static Collection $_cacheData;
    private static bool $_isSetCacheData = false;

    /** @var string Observer に登録するクラス */
    protected static string $_observerClass = ModelObserver::class;

    /**
     * @override クラス初期化処理
     */
    protected static function boot()
    {
        parent::boot();

        // Observer 登録
        static::observe(static::$_observerClass);
    }

    /**
     * 全レコード取得（キャッシュあり）
     *
     * @return Collection
     */
    public static function gets(): Collection
    {
        if (!static::$_isSetCacheData) {
            static::$_cacheData = static::getsByDb()->keyBy((new static)->getKey());
            static::$_isSetCacheData = true;
        }

        return static::$_cacheData;
    }

    /**
     * 全レコード取得（DBから）
     *
     * @return Collection
     */
    public static function getsByDb(): Collection
    {
        return static::get();
    }

    /**
     * 一時キャッシュクリア
     */
    public static function clearCacheData()
    {
        static::$_isSetCacheData = false;
    }

    /**
     * テーブル名取得
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return (new static)->getTable();
    }

}
