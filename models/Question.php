<?php namespace Ips\Quiz\Models;

use Model;

/**
 * Question Model
 */
class Question extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'quiz_questions';

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
    public $hasOne = [ ];
    public $hasMany = [
        'answers' => ['Ips\Quiz\Models\Answer']
    ];
    public $belongsTo = [
        'quiz' => ['Ips\Quiz\Models\Quiz']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
	    'question_image'  => ['System\Models\File']
    ];
    public $attachMany = [];


    public function getImageListAttribute()
	{
		$model = $this->find($this->id);

		if( $model->question_image == null )
		{
			return '';
		}

		return '<img src="' . $model->question_image->getThumb(50, 50, 'crop') . '" />';
	}

	/**
	 * Allows filtering for specifc questions
	 *
	 * @param  \Illuminate\Query\Builder $query QueryBuilder
	 * @param  array $categories                List of category ids
	 *
	 * @return \Illuminate\Query\Builder              QueryBuilder
	 */
	public function scopeFilterQuiz($query, $quiz)
	{
		return $query->whereHas('quiz', function ($q) use ($quiz) {
			$q->whereIn('id', $quiz);
		});
	}
    public function beforeSave()
    {

    }
}