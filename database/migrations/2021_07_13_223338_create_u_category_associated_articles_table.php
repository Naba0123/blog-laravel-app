<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUCategoryAssociatedArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_category_associated_article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('u_article_id');
            $table->unsignedBigInteger('c_category_id');
            $table->timestamps();

            $table->unique(['u_article_id', 'c_category_id'], 'unq1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_category_associated_article');
    }
}
