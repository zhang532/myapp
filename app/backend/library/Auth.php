<?php
namespace app\admin\library;

use think\facade\Request;
use think\facade\Session;
/**
* 后台基类控制
*/
class Auth 
{
	
	function __construct()
	{
		echo "<header>用户:".session('admin.username')."<a href=".url('user/loginout').">退出</a></header>";
	}
}