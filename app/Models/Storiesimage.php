<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Storiesimage
 * 
 * @property int $ImageID
 * @property int|null $StoryID
 * @property string $ImageURL
 *
 * @package App\Models
 */
class Storiesimage extends Model
{
	protected $table = 'storiesimage';
	protected $primaryKey = 'ImageID';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ImageID' => 'int',
		'StoryID' => 'int'
	];

	protected $fillable = [
		'StoryID',
		'ImageURL'
	];
}
