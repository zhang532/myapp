<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Art;
use think\facade\Request;
use think\facade\Session;
use app\admin\library\Auth;

class Console extends Auth
{
	public function __construct(){

		parent::__construct();
	}

    public function index()
    {	
    	  
    	return view() ;

    }

    
}
