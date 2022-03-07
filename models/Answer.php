<?php namespace Ips\Quiz\Models;

use Model;

/**
 * Answer Model
 */
class Answer extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'quiz_answers';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'question' => ['Ips\Quiz\Models\Question']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
	public $attachOne = [
		'answer_image'  => ['System\Models\File']
	];
    public $attachMany = [];
	public function getImageListAttribute()
	{
		$model = $this->find($this->id);

		if( $model->answer_image == null )
		{
			return '';
		}

		return '<img src="' . $model->answer_image->getThumb(50, 50, 'crop') . '" />';
	}
	/**
	 * Allows filtering for specifc questions
	 *
	 * @param  \Illuminate\Query\Builder $query QueryBuilder
	 * @param  array $categories                List of category ids
	 *
	 * @return \Illuminate\Query\Builder              QueryBuilder
	 */
	public function scopeFilterQuestions($query, $questions)
	{
		return $query->whereHas('question', function ($q) use ($questions) {
			$q->whereIn('id', $questions);
		});
	}
    public function beforeSave()
    {

    }
}