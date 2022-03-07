<?php namespace Ips\Quiz\Components;

use Cms\Classes\ComponentBase;
use Ips\Quiz\models\Quiz as QuizModel;
use Ips\Quiz\models\Answer as AnswerModel;

class Question extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'question Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function question()
    {
        $id = $this->property('id');

        $question_id = $this->property('question');

        $quiz = QuizModel::find($id);
        $questions = $quiz->questions;

        if ($question_id == 'random') {
            $q_id = rand(0, count($questions)-1);
        }
        else $q_id = $question_id-1;

        $q = $questions[$q_id];
        return $q;
    }

    public function next()
    {
        $id = $this->property('id');
        $question_id = $this->property('question');

        $quiz = QuizModel::find($id);
        $questions = $quiz->questions;

        if ($question_id == 'random') return 'random';

        if (count($questions) > $question_id) return $question_id + 1;
    }

    public function onRender()
    {
        $this->page['id'] = $this->property('id');
    }

    // AJAX handler to grade question

    public function onGrade()
    {
        $answer_id = post('answer');
        $answer = AnswerModel::find($answer_id);

        $this->page['correct'] = $answer->correct;
        $this->page['answer_comment'] = $answer->comment_html;

        return [
            'answer_comment' => $answer->comment_html,
            'answer_correct' => $answer->correct
        ];
    }
}