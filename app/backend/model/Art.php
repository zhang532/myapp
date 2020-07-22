<?php
namespace app\admin\model;

use think\Model;

class Art extends Model
{
	  public function category()
    {
        return $this->belongsTo(Category::class);
    }
}