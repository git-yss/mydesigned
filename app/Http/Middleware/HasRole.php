<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use App\Model\Role;
use App\Model\Permission;
class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //死方法
//        $User=User::find(session()->get('User')->id);
//
//      if ($User->username=='admin'&&$User->password=="811570083"){
//          return $next($request);
//      }else{
//          return redirect('noaccess');
//          //return redirect('admin/login')->with('errors','此账号权限不够，无法登陆后台管理界面，请联系管理员');
//      }


        //1.获取当前请求的路由  对应控制器的方法名  "App\Http\Controllers\Admin\AdminController@welcome"
//        $route=\Route::current()->getActionName();
//        //echo $route;
//        //dd($route);
//        //获取当前用户权限组
//        $User=User::find(session()->get('User')->id);
//        //获取当前用户的角色
//        //dd($User);
//        $roles=$User->role;
//        //dd($roles);
//        //根据用户拥有的角色找到对应的权限
//        //存放权限对应的perurl 就是权限列表
//        $arr1=[];
//        foreach ($roles as $v)
//        {
//            $permi=$v->permission;
//            foreach ($permi as $perm){
//                $arr1[]=$perm->perurl;
//            }
//        }
////去重权限
//        $arr1=array_unique($arr1);
//
//        if(in_array($route,$arr1))
//        {
//            return $next($request);
//
//        }else{
//            return redirect('noaccess');
//            //return redirect('admin/login')->with('errors','此账号权限不够，无法登陆后台管理界面，请联系管理员');
//        }

        //直接查询seesion中用户的角色，是管理员就进来。
        $U=User::find(session()->get('User'));
        if (isset($U)){
            $User=User::find(session()->get('User')->id);
            $roles=$User->role;

            $arr1=[];
            foreach ($roles as $v)
            {
                $arr1[]=$v->id;
            }
            // dd($arr1);
            if(in_array("2",$arr1)){
                return $next($request);
            }else{
                return redirect('noaccess');
            }
        }else{
            return redirect('admin/login')->with('errors','用户信息已销毁，请重新登陆，不要搞这些东西！');
        }

        //获取当前用户的角色
        //$User=User::find(session()->get('User'));
      //  dd($User);

   }
}
