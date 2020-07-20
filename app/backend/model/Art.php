<?php
namespace app\backend\model;

use think\Model;

class Art extends Model
{
	  public function category()
    {
        return $this->belongsTo(Category::class);
    }
}