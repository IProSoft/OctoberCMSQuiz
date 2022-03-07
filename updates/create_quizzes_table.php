<?php namespace Ips\Quiz\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateQuizzesTable extends Migration
{

    public function up()
    {
        Schema::create('mossadal_quiz_quizzes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('name_html');
            $table->text('description');
            $table->text('description_html');
            $table->text('comment');
            $table->text('comment_html');

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mossadal_quiz_quizzes');
    }

}
