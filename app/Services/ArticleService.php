<?php


namespace App\Services;


use App\Exceptions\CriticalException;
use App\Models\Common\CCategory;
use App\Models\User\UArticle;
use Illuminate\Database\Eloquent\Collection;

class ArticleService extends AbstractService
{
    /**
     * すべての記事を取得
     *
     * @return Collection
     */
    public function getArticles(): Collection
    {
        return UArticle::gets();
    }

    /**
     * 記事を取得
     *
     * @param $id
     * @return UArticle
     */
    public function getArticle(int $id): UArticle
    {
        return UArticle::find($id);
    }

    /**
     * 記事を保存する
     *
     * @param int|null $id
     * @param string $title
     * @param string $body
     */
    public function saveArticle(int $id, string $title, string $body): UArticle
    {
        if ($id > 0) {
            $article = $this->getArticle($id);
        } else {
            $article = new UArticle();
        }
        $article->title = $title;
        $article->body = $body;

        $article->save();

        return $article;
    }

    /**
     * 記事の削除
     *
     * @param int $id
     * @throws CriticalException
     */
    public function deleteArticle(int $id)
    {
        $article = $this->getArticle($id);
        if (is_null($article)) {
            throw new CriticalException('Unknown UArticle Id');
        }

        $article->delete();
    }

    /**
     * すべてのカテゴリーを取得
     *
     * @return mixed
     */
    public function getCategories()
    {
        return CCategory::gets();
    }

}
