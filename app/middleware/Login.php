<?php
declare (strict_types = 1);

namespace app\middleware;
use think\facade\Session;
use think\facade\Request;
class Login
{
    protected $LoginUrl='/admin/user/login';

    protected $home='/admin/';
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next){
        if (!Session::has('admin') && !stristr(Request::url(),'/admin/user/') ) {
            
             return redirect($this->LoginUrl); #去登陆

        }elseif(Session::has('admin') && $this->LoginUrl == $request->url()){
            return redirect($this->home); #去登陆
        }

        return $next($request); #正常通过

    }
}

