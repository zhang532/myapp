<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Art;
use think\facade\Request;
use think\facade\Session;
use app\admin\library\Backend;

class Index extends Backend
{
	public function __construct(){

		parent::__construct();
	}

    public function index()
    {	
    	return redirect((string)url('/console/index'));    
    }

     public function show()
    {	
    	return view() ;

    }
}
