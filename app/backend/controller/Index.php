<?php
declare (strict_types = 1);

namespace app\backend\controller;
use app\backend\model\Category;
use app\backend\model\Art;
class Index 
{
    public function index()
    {	
    	session('admin.username','aaa');
    	dump(session('admin'));
    	$category=new Category;
		$list=$category->with('arts')->select()->toArray();  
		// $art=new art;
		// $list=$art->with('category')->select()->toArray();  
		dump($list);      

    }
}
