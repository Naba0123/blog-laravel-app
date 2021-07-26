<?php


namespace App\Services;


use App\Models\Common\CCategory;
use App\Models\User\UArticle;
use App\Models\User\UCategoryAssociatedArticle;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ArticleService extends AbstractService
{
    /**
     * すべての記事を取得
     *
     * @param bool $includeDraft
     * @return Collection
     */
    public function getArticles(bool $includeDraft = false): Collection
    {
        $articles = UArticle::gets();
        if (!$includeDraft) {
            $articles = $articles->where('is_publish', true);
        }
        return $articles;
    }

    /**
     * 記事を取得
     *
     * @param $articleId
     * @return UArticle
     */
    public function getArticle(int $articleId): UArticle
    {
        return UArticle::findOrFail($articleId);
    }

    /**
     * 特定の記事IDの一つ前の記事を取得
     *
     * @param int $currentArticleId
     * @return UArticle|null
     */
    public function getPreviousArticle(int $currentArticleId): ?UArticle
    {
        return $this->getArticles()->where('id', '<', $currentArticleId)->sortKeysDesc()->first();
    }

    /**
     * 特定の記事IDの次の記事を取得
     *
     * @param int $currentArticleId
     * @return UArticle|null
     */
    public function getNextArticle(int $currentArticleId): ?UArticle
    {
        return $this->getArticles()->where('id', '>', $currentArticleId)->sortKeys()->first();
    }

    /**
     * 記事を保存する
     *
     * @param array $params
     * @param array $categoryIds
     * @return UArticle
     */
    public function saveArticle(array $params, array $categoryIds): UArticle
    {
        // 記事保存
        /** @var UArticle $article */
        $article =  UArticle::findOrNew($params['article_id']);

        $params['is_publish'] = (($params['is_publish'] ?? null) === 'on');
        if (array_key_exists('created_at', $params)) {
            $params['created_at'] = new Carbon($params['created_at']);
        }
        if (array_key_exists('updated_at', $params)) {
            $params['updated_at'] = new Carbon($params['updated_at']);
        }


        $article->fill($params)->save();

        // カテゴリー紐付け保存
        $this->saveCategoryAssociatedArticle($article->id, $categoryIds);

        return $article;
    }

    /**
     * 記事の削除
     *
     * @param int $articleId
     */
    public function deleteArticle(int $articleId)
    {
        $article = UArticle::findOrfail($articleId);

        $article->delete();
    }

    /**
     * 対象のユーザーが記事を読むことができるかどうかのチェック
     *
     * @param int $articleId
     * @param User|null $user
     * @return bool
     */
    public function canViewArticle(int $articleId, ?User $user): bool
    {
        $article = $this->getArticle($articleId);

        if ($article->is_publish) {
            return true;
        }
        // 今はログインしていればプレビューが可能
        return !is_null($user);
    }

    /**
     * すべてのカテゴリーを取得
     *
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return CCategory::gets();
    }

    /**
     * カテゴリー取得
     *
     * @param int $categoryId
     * @return CCategory
     */
    public function getCategory(int $categoryId): CCategory
    {
        return CCategory::findOrFail($categoryId);
    }

    /**
     * @param int $categoryId
     * @param string $name
     * @return CCategory
     */
    public function saveCategory(int $categoryId, string $name): CCategory
    {
        /** @var CCategory $category */
        $category = CCategory::findOrNew($categoryId);
        $category->fill(['id' => $categoryId, 'name' => $name])->save();

        return $category;
    }

    /**
     * カテゴリー削除
     *
     * @param int $categoryId
     */
    public function deleteCategory(int $categoryId)
    {
        $category = CCategory::findOrFail($categoryId);
        $category->delete();

        // 記事との紐付け削除
        UCategoryAssociatedArticle::where('c_category_id', $categoryId)->delete();
    }

    /**
     * @param int $articleId
     * @param array $categoryIds
     */
    public function saveCategoryAssociatedArticle(int $articleId, array $categoryIds)
    {
        UCategoryAssociatedArticle::where('u_article_id', $articleId)->delete();

        if (count($categoryIds) > 0) {
            $inserts = array_map(function($categoryId) use ($articleId) {
                return [
                    'u_article_id' => $articleId,
                    'c_category_id' => $categoryId,
                    'created_at' => carbon_now(),
                    'updated_at' => carbon_now(),
                ];
            }, $categoryIds);
            UCategoryAssociatedArticle::insert($inserts);
        }
    }

    /**
     * @param int $articleId
     * @return Collection
     */
    public function getRelatedArticles(int $articleId): Collection
    {
        $article = $this->getArticle($articleId);
        $categoryIds = $article->associated_category_ids;

        $articleIds = UCategoryAssociatedArticle::whereIn('c_category_id', $categoryIds)
            ->where('u_article_id', '!=', $articleId)->pluck('u_article_id')->all();

        $articles = $this->getArticles()->whereIn('id', $articleIds);

        $randomRelatedNum = config('blog.article.related_article_num');
        if ($articles->count() > $randomRelatedNum) {
            dd($randomRelatedNum);
            return $articles->random($randomRelatedNum);
        }
        return $articles;
    }

}
