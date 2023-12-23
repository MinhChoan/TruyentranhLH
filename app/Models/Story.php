<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Story
 * 
 * @property int $StoryID
 * @property string $Title
 * @property string $Content
 * @property int|null $CategoryID
 * @property int|null $AuthorID
 * @property string|null $StoriesCover
 * @property string|null $DifferentName
 * @property int|null $Views
 * @property int|null $Likes
 * @property int|null $Bookmark
 * @property int|null $UploadedBy
 * @property Carbon|null $Created_at
 * @property Carbon|null $Updated_at
 *
 * @package App\Models
 */
class Story extends Model
{
	protected $table = 'stories';
	protected $primaryKey = 'StoryID';
	public $timestamps = false;

	protected $casts = [
		'CategoryID' => 'int',
		'AuthorID' => 'int',
		'Views' => 'int',
		'Likes' => 'int',
		'Bookmark' => 'int',
		'UploadedBy' => 'int',
		'Created_at' => 'datetime',
		'Updated_at' => 'datetime'
	];

	protected $fillable = [
		'Title',
		'Content',
		'CategoryID',
		'AuthorID',
		'StoriesCover',
		'DifferentName',
		'Views',
		'Likes',
		'Bookmark',
		'UploadedBy',
		'Created_at',
		'Updated_at',
		'Status'
	];

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'storiescategory', 'StoryID', 'CategoryID');
	}

	public function authors()
	{
		return $this->belongsToMany(Author::class, 'storiesauthor', 'StoryID', 'AuthorID');
	}

	public function chapters()
	{
		return $this->hasMany(Chapter::class, 'StoryID');
	}
	public function images()
    {
        return $this->hasMany(StoriesImage::class, 'StoryID', 'StoryID');
    }

	public function scopeSearchByTitle(Builder $query, string $keyword)
    {
        return $query->where('Title', 'LIKE', '%' . $keyword . '%');
    }
}
