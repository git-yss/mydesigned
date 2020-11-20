<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use Carbon\Carbon;//时间
use Illuminate\Support\Facades\DB;
use Zhuzhichao\IpLocationZh\Ip;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class Loginlog
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        $User= session::has('key');
//dd($User);
//        if (!$User)  {
//            session()->put('User',$User);
//            $User=User::find(session()->get('User')->id);
//            $admin_id=$User->username;
//            //dd($admin_id);
//            $time=Carbon::now();
//            //dd($time);
//            $ip=$request->getClientIp();
//            //dd($ip);
//            $ipd=Ip::find($ip);
//            // dd($ipd);
//            $address=$ipd[0].'/'.$ipd[1].'/'.$ipd[2];
//            //dd($address);
//            DB::table('log')->insert(['admin_id'=>$admin_id,'time'=>$time,'ip'=>$ip,'address'=>$address,]);
//        } else{
//            return $next($request);
//        }

    }

}
