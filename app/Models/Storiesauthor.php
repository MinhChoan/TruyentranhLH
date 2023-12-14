<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Storiesauthor
 * 
 * @property int $StoryID
 * @property int $AuthorID
 *
 * @package App\Models
 */
class Storiesauthor extends Model
{
	protected $table = 'storiesauthor';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'StoryID' => 'int',
		'AuthorID' => 'int'
	];
}
