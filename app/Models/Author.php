<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Author
 * 
 * @property int $AuthorID
 * @property string $AuthorName
 *
 * @package App\Models
 */
class Author extends Model
{
	protected $table = 'author';
	protected $primaryKey = 'AuthorID';
	public $timestamps = false;

	protected $fillable = [
		'AuthorName'
	];
}
