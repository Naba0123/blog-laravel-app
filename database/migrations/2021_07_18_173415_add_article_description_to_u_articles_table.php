<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArticleDescriptionToUArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_articles', function (Blueprint $table) {
            $table->string('description')->after('title');
            $table->dropUnique('u_articles_title_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_articles', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->unique('title');
        });
    }
}
