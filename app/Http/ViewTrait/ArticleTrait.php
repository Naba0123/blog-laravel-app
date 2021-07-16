<?php


namespace App\Http\ViewTrait;


use App\Models\User\UArticle;

trait ArticleTrait
{
    /**
     * 記事遷移ボタンのフォーマッター
     *
     * @param UArticle|null $article
     * @return array
     */
    public function formatNavigationLink(?UArticle $article): array
    {
        if (is_null($article)) {
            return [];
        }
        return [
            'url' => route('blog.article.detail', ['article_id' => $article->id]),
            'name' => $article->title,
            'body' => omit_markdown_str($article->body),
        ];
    }
}
