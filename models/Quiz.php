<?php namespace Ips\Quiz\Models;

use Model;

/**
 * Quiz Model
 */
class Quiz extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'quiz_quizzes';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [ 'questions' => ['Ips\Quiz\Models\Question'] ];
    public $belongsTo = [];
    public $belongsToMany = [
	    'post' => [
		    'RainLab\Blog\Models\Post',
		    'table' => 'quiz_quizzes_posts'
	    ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];


	public function questions()
	{
		return $this->hasMany('Ips\Quiz\Models\Question' )->orderBy('id', 'ASC' );
	}
    public function beforeSave()
    {
    }
}