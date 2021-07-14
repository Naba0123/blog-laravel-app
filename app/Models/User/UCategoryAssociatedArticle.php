<?php

namespace App\Models\User;

use App\Models\AbstractModel;

class UCategoryAssociatedArticle extends AbstractModel
{
    protected $table = 'u_category_associated_articles';

    protected $fillable = ['u_article_id', 'c_category_id'];
}
