<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Art;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;
use app\admin\library\Backend;

class Console extends Backend
{
	public function __construct(){

		parent::__construct();
	}

    public function index()
    {	
    	  
    	return view() ;

    }

    
}
