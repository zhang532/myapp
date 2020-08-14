<?php
declare (strict_types = 1);

namespace app\admin\controller\Auth;
use think\facade\Request;
use think\facade\Session;
use app\admin\library\Backend;

class Role extends Backend
{
	public function __construct(){

		parent::__construct();
	}

    public function index()
    {	
    	return view();    
    }

     public function show()
    {	
    	return view() ;

    }
}
