<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chapter
 * 
 * @property int $ChapterID
 * @property int|null $StoryID
 * @property int|null $ChapterNumber
 * @property string $Title
 * @property string $Content
 * @property Carbon|null $Created_at
 * @property Carbon|null $Updated_at
 *
 * @package App\Models
 */
class Chapter extends Model
{
	protected $table = 'chapter';
	protected $primaryKey = 'ChapterID';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ChapterID' => 'int',
		'StoryID' => 'int',
		'ChapterNumber' => 'int',
		'Created_at' => 'datetime',
		'Updated_at' => 'datetime'
	];

	protected $fillable = [
		'StoryID',
		'ChapterNumber',
		'Title',
		'Content',
		'Created_at',
		'Updated_at'
	];
}
