<?php

namespace App\Models\Common;

use App\Models\AbstractModel;
use App\Models\User\UArticle;
use App\Models\User\UCategoryAssociatedArticle;
use Illuminate\Database\Eloquent\Collection;

class CCategory extends AbstractModel
{
    protected $table = 'c_categories';

    protected $fillable = ['id', 'name'];

    /**
     * @return Collection
     */
    public function getArticlesAttribute(): Collection
    {
        $articleIds = UCategoryAssociatedArticle::gets()->where('c_category_id', $this->id)->pluck('u_article_id')->all();
        return UArticle::gets()->whereIn('id', $articleIds);
    }
}
