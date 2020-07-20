<?php
namespace app\backend\model;

use think\Model;

class Category extends Model
{
	public function arts()
    {
        return $this->hasMany(Art::class,'category_id','id');
    }
}