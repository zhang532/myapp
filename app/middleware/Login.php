<?php
declare (strict_types = 1);

namespace app\middleware;
use think\facade\Session;
use think\facade\Request;
class Login
{
    protected $LoginUrl='/backend/user/login';

    protected $Redirect='/backend/';
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next){
        if (!Session::has('admin') && !stristr(Request::url(),'/backend/user/') ) {
            
             return redirect($this->LoginUrl); #去登陆

        }elseif(Session::has('admin') && $this->LoginUrl == $request->url()){
            return redirect($this->Redirect); #去登陆
        }

        return $next($request); #正常通过

    }
}

