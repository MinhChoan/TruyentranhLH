<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Storiescategory
 * 
 * @property int $StoryID
 * @property int $CategoryID
 *
 * @package App\Models
 */
class Storiescategory extends Model
{
	protected $table = 'storiescategory';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'StoryID' => 'int',
		'CategoryID' => 'int'
	];
}
