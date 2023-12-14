<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $CategoryID
 * @property string $CategoryName
 *
 * @package App\Models
 */
class Category extends Model
{
	
	protected $table = 'category';
	protected $primaryKey = 'CategoryID';
	public $timestamps = false;

	protected $fillable = [
		'CategoryName'
	];

	public function stories()
	{
		return $this->belongsToMany(Story::class, 'storiescategory', 'CategoryID', 'StoryID');
	}

}
