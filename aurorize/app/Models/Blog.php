<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
		'title',
		'description',
		'image',
		'slug'
	];

	protected $dates = ['deleted_at'];

	public function getImageUrlAttribute()
	{
		return $this->attributes['image'] != null ? Helper::assets(config('constant.blog_url') . $this->attributes['image']) : Helper::assets('app-assets/images/default.png');
	}
}
