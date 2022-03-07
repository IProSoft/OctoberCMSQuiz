<?php namespace Ips\Quiz\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateQuestionsTable extends Migration
{

    public function up()
    {
        Schema::create('mossadal_quiz_questions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('name_html')->nullable();
            $table->text('comment')->nullable();
            $table->text('comment_html')->nullable();
            $table->integer('sort_order')->default(0);

            $table->integer('quiz_id')->unsigned()->index();


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mossadal_quiz_questions');
    }

}
