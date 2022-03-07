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


use Illuminate\Support\Facades\Cookie;

class QuizResult
{

	/**
	 * QuizResult constructor.
	 */
	public function __construct()
	{
	}

	public function result( $quiz )
	{
		if( isset( $_COOKIE['quiz'] ) )
		{
			$result = json_decode( $_COOKIE['quiz'], true );

			if( isset( $result[$quiz->id] ) )
			{
				$result = $result[$quiz->id];

				if( count( $result ) == $quiz->questions->count() )
				{
					foreach( $quiz->questions as $question )
					{
						if( isset( $result[$question->id]) )
						{
							dd(111);
						}
					}
				}
			}
		}

		return [
			'error' => 'Wystąpił błąd podczas generowania quizu'
		];
	}
}