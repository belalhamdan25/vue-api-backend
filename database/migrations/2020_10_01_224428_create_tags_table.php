<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('portfolio_tag', function (Blueprint $table) {
            $table->integer('tag_id');
            $table->integer('portfolio_id');
            $table->primary(['portfolio_id','tag_id']);
        });
        Schema::create('project_tag', function (Blueprint $table) {
            $table->integer('tag_id');
            $table->integer('project_id');
            $table->primary(['project_id','tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('portfolio_tag');
        Schema::dropIfExists('project_tag');
    }
}
