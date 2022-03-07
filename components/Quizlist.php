<?php namespace Ips\Quiz\Components;

use Cms\Classes\ComponentBase;
use Ips\Quiz\models\Quiz;

class Quizlist extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'quizlist Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function quizzes()
    {
        return Quiz::all();
    }
}