<?php
/**
 * Commercial Script
 *
 * Copyright (c) IPROSOFT
 * Licensed under the Commercial License
 * https://iprosoft.pro/ips-license/	
 *
 * Project home: http://iprosoft.pro
 *
 * Version:  1.0
 */

namespace Ips\Quiz\Classes;


use Illuminate\Support\Facades\Input;
use Ips\Quiz\Models\Quiz;

class QuizFilter
{

	private $post;
	private $controller;

	public function parse( $controller, $post, $content )
	{
		$this->post       = $post;
		$this->controller = $controller;

		return preg_replace_callback( "@{{quiz_([0-9]+)}}@ius", [ $this, 'replace' ], $content );
	}

	public function replace( $matches )
	{
		list( $replace, $id ) = $matches;

		$quiz = $this->post->quiz->keyBy( 'id' )->get( $id );

		if ( $quiz )
		{
			$args = [
				'post_id'      => $this->post->id,
				'quiz'         => $quiz,
				'question_num' => (int) Input::get( 'question', 1 ),
				'count'        => is_object( $quiz->questions ) ? $quiz->questions->count() : 0,
				'questions'    => [],
				'comment'      => $quiz->comment,
				'is_result'    => (bool)Input::get( 'result', false )
			];

			foreach ( $quiz->questions as $question )
			{
				$answers = [];
				foreach( $question->answers as $answer )
				{
					if( $answer->correct )
					{
						$answers[] = $answer->id;
					}
				}

				$args['questions'][ $question->id ] = [
					'question' => $question,
					'answers' => $answers
				];
			}

			$quiz = $this->controller->renderPartial( 'quiz/default.htm', array_merge( $args, [
				'question' => $quiz->questions->get( $args['question_num'] - 1 ),
				'json'     => json_encode( $args )
			] ) );
		}

		return $quiz;
	}

	public function search( $name )
	{
		return [
			'quizess' => Quiz::where( 'name', 'LIKE', $name . '%' )->get()->toArray()
		];
	}
}