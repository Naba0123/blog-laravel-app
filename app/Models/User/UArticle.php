<?php

namespace App\Models\User;

use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class UArticle extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'u_articles';
}
