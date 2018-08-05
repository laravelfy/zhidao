<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Question;

class CreateQuesitonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Question::class;
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->index()->comment = '提问人id';
            $table->string('title', 255)->comment = '问题标题';
            $table->text('content')->nullable(true)->comment = '问题内容';
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
