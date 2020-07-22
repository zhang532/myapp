<?php
declare (strict_types = 1);

namespace app\backend\controller;
use app\backend\model\Category;
use app\backend\model\Art;
use think\facade\Request;
use think\facade\Session;
use app\backend\library\Auth;

class Index extends Auth
{
	public function __construct(){

		parent::__construct();
	
	}

    public function index()
    {	
    	$User= new User;
    	$category=new Category;
		$list=$category->with('arts')->select()->toArray();  
		// $art=new art;
		// $list=$art->with('category')->select()->toArray();  
		// dump($list);      
    	return view() ;

    }

     public function show()
    {	
    	echo "555";

    }
}
