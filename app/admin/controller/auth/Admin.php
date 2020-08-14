<?php
declare (strict_types = 1);

namespace app\admin\controller\auth;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;
use app\admin\library\Backend;
use app\admin\model\AuthRule;
use app\common\library\Tree;

class Admin extends Backend
{
	public function __construct(){

        parent::__construct();
        // View::layout(false);
        
	}

    public function index()
    {	
        
        $data=AuthRule::where('status',1)->select()->toArray();
        // $data=AuthRule::select()->toArray();
        $menu=Tree::getTreeMenu($data);
        View::assign(['menu'=>$menu]);
        // html_entity_decode()
        // htmlspecialchars_decode()
        return view();    
    }

     public function add()
    {	
    	return view() ;

    }
    public function edit($ids=null)
    {	
    	return view() ;

    }

    public function del($ids = '')
    {	
    	return view() ;

    }
}
