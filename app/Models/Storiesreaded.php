<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Storiesreaded
 * 
 * @property int $ReadedID
 * @property int|null $UserID
 * @property int|null $StoryID
 * @property Carbon|null $ReadDate
 *
 * @package App\Models
 */
class Storiesreaded extends Model
{
	protected $table = 'storiesreaded';
	protected $primaryKey = 'ReadedID';
	public $timestamps = false;

	protected $casts = [
		'UserID' => 'int',
		'StoryID' => 'int',
		'ReadDate' => 'datetime'
	];

	protected $fillable = [
		'UserID',
		'StoryID',
		'ReadDate'
	];
}
