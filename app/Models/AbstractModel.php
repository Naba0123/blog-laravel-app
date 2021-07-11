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

        // 変数初期化
        static::$_cacheData = new Collection();
    }

    /**
     * 全レコード取得（キャッシュあり）
     *
     * @return Collection
     */
    public static function gets(): Collection
    {
        if (!isset(static::$_cacheData[static::class])) {
            static::$_cacheData[static::class] = static::get()->keyBy((new static)->getKey());
        }

        return static::$_cacheData[static::class];
    }

    /**
     * 一時キャッシュクリア
     */
    public static function clearCacheData()
    {
        unset(static::$_cacheData[static::class]);
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
