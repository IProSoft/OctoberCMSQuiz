<?php namespace Ips\Quiz\Components;

use Cms\Classes\ComponentBase;
use Ips\Quiz\models\Quiz as QuizModel;

class Quiz extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Quiz Component',
            'description' => 'Insert a quiz into a page'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

   public function quiz()
    {
        return QuizModel::find($this->property('id'));
    }

}