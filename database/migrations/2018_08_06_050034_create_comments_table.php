<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string("commentable_type", 60);
            $table->integer("commentable_id");
            $table->integer('user_id')->index()->comment = '评论人ID';
            $table->text('content')->nullable(true)->comment = '评论内容';
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->index(["commentable_type", "commentable_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
