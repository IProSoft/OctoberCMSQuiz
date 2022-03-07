<?php namespace Ips\Quiz;

use Backend;
use Controller;
use Ips\Quiz\Classes\QuizFilter;
use System\Classes\PluginBase;
use RainLab\Blog\Controllers\Posts as PostsController;
use RainLab\Blog\Models\Post as PostModel;

/**
 * Quiz Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Quiz',
            'description' => 'Quiz plugin',
            'author'      => 'IPS',
            'icon'        => 'icon-key'
        ];
    }

    public function registerComponents()
    {
        return [
            '\Ips\Quiz\Components\Quiz' => 'quiz',
            '\Ips\Quiz\Components\Quizlist' => 'quizlist',
            '\Ips\Quiz\Components\Question' => 'question'
        ];
    }

	public function boot(){
		PostModel::extend(function($model){
			$model->belongsToMany['quiz'] = [
				'Ips\Quiz\Models\Quiz',
				'table'    => 'quiz_quizzes_posts',
				'key'      => 'post_id',
				'otherKey' => 'quiz_id'
			];
		});

		PostsController::extendFormFields(function($form, $model){

			if(!$model instanceof PostModel) return;
			if (!$model->exists) return;

			$form->addSecondaryTabFields([
				'quiz' => [
					'label' => 'Quiz',
					'tab' => 'Quizy',
					'type' => 'relation'
				]
			]);
		});
	}
	/**
	 *
	 *
	 * @return array
	 */
	public function registerMarkupTags()
	{
		$quiz = new QuizFilter;

		return [
			'functions' => [
				'quiz'    => [ $quiz, 'parse' ]
			]
		];
	}
    public function registerNavigation()
    {
        return [
            'quiz' => [
                'label' => 'Quiz',
                'url' => Backend::url('ips/quiz/quiz'),
                'icon' => 'icon-key',
                'order' => 500,

                'sideMenu' => [
                    'quizzes' => [
                        'label' => 'Quizy',
                        'icon' => 'icon-copy',
                        'url' => Backend::url('ips/quiz/quiz')
                    ],
                    'questions' => [
                        'label' => 'Pytania',
                        'icon' => 'icon-question',
                        'url' => Backend::url('ips/quiz/question')
                    ],
                    'answers' => [
                        'label' => 'Odpowiedzi',
                        'icon' => 'icon-check-square-o',
                        'url' => Backend::url('ips/quiz/answer')
                    ]
                ]
            ]
        ];
    }
}
