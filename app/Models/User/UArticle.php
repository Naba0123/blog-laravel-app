<?php

namespace App\Models\User;

use App\Models\AbstractModel;
use App\Models\Common\CCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

class UArticle extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'u_articles';

    /**
     * @return Collection
     */
    public function getCategoriesAttribute(): Collection
    {
        return CCategory::gets()->whereIn('id', $this->associated_category_ids);
    }

    /**
     * @return array
     */
    public function getAssociatedCategoryIdsAttribute(): array
    {
        return UCategoryAssociatedArticle::gets()->where('u_article_id', $this->id)->pluck('c_category_id')->all();
    }

}
