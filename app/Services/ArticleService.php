<?php


namespace App\Services;


use App\Models\Common\CCategory;
use App\Models\User\UArticle;
use App\Models\User\UCategoryAssociatedArticle;
use App\User;
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
     * @param int $articleId
     * @param string $title
     * @param string $description
     * @param array $categoryIds
     * @param string $body
     * @param bool $isPublish
     * @return UArticle
     */
    public function saveArticle(int $articleId, string $title, string $description, array $categoryIds, string $body, bool $isPublish): UArticle
    {
        // 記事保存
        /** @var UArticle $article */
        $article =  UArticle::findOrNew($articleId);
        $article->fill([
            'title' => $title,
            'description' => $description,
            'body' => $body,
            'is_publish' => $isPublish
        ])->save();

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
     * @param UArticle $article
     * @param User|null $user
     * @return bool
     */
    public function canViewArticle(UArticle $article, ?User $user): bool
    {
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

}
