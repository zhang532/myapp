<?php
namespace app\admin\library;

use think\facade\Request;
use think\facade\Session;
use think\facade\View;
use app\common\library\Auth;
use app\admin\model\AuthRule;
use app\common\library\Tree;
/**
* 后台基类控制
*/
class Backend extends Auth
{
	
	use \app\admin\library\traits\Backend ;
	protected $config;
	protected $layouts;
	public function __construct()
	{
		parent::__construct();
		//模板引擎
		$this->layouts = $this->layouts(true);	
		//加载自定义配置到页面
		$this->config  = $this->config();
		//加载菜单
		$this->menu	   = $this->menu();
	}

	//模板引擎
	public function layouts($value){
		if(false == $value){
			return	View::layout(false);
		}
		return	View::layout('Layouts/container');
	}
	//加载自定义配置到页面
	public function config(){
		$arr=[
			'controller_name'=>strtolower(Request::controller()),
			'action_name'	 =>strtolower(Request::action()),
			'url'			 =>$this->request->url()
		];
		
		return View::assign(['config'=>$arr]);

	}

	//加载菜单
	public function menu(){
		
        $data=AuthRule::where('status',1)->select()->toArray( );
        $basemenu=Tree::getTreeMenu($data);

		return View::assign(['basemenu'=>$basemenu]);
      
	}
}