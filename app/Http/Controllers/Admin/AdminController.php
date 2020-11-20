<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Events\LoginEvent;
use App\Model\Log;
use Illuminate\Support\Facades\DB;
use Zhuzhichao\IpLocationZh\Ip;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    //
    public function welcome(){
        //返回添加页面
        //折线图访问量统计

        //圆饼图数据库表统计
        $usercount=DB::table('User')->count();
        $patientcount=DB::table('Patient')->count();
        $drugstcount=DB::table('Drugst')->count();
        $webcount=DB::table('log')->count();
        return view('welcome',compact('usercount','patientcount','drugstcount','webcount'));
    }
    public function login(){
        //跳转后台登陆
        return view('admin.login');
    }
    //后台系统登录验证
    public function captcha(Request $request)
    {
        if (Input::method() == 'POST')
        {
            //具体规则
            $this->validate($request, [
                'username' => 'required|min:4|max:10',
                'password' => 'required|min:6|max:16',
                //'code'=>'min:4'
            ]);
            $input = $request->all();
            //dd($input['username']);
            //dd($input);
            $User=User::where('username','=',$input['username'])->first();
           // /$User=User::where('username','=',$input['username'])->first();

            if(!$User)
            {
                return redirect('admin/login')->with('errors','账号不存在或密码错误');
            }
            else
            {
                if ($input['password'] !=$User->password)
                {
                    return redirect('admin/login')->with('errors', '账号不存在或密码错误');
                }
                session()->flush();
                $accountInfo= session()->put('User',$User);
                //Cookie::queue('cookie', $User->id, 60);//如果不适用上面的use Cookie,这里可以直接调用 \Cookie
                ///登录日志记录
                $User=User::find(session()->get('User')->id);
            $admin_id=$User->username;
            //dd($admin_id);
            $time=Carbon::now();
            //dd($time);
            $ip=$request->getClientIp();
            //dd($ip);
            $ipd=Ip::find($ip);
             $url= $request->path();
            // dd($ipd);
            $address=$ipd[0].'/'.$ipd[1].'/'.$ipd[2];
            //dd($address);
            DB::table('log')->insert(['admin_id'=>$admin_id,'time'=>$time,'ip'=>$ip,'address'=>$address,'url'=>$url]);


                return redirect('admin/index');
                //return view('admin.index');

            }

        }
    }


    //跳转日志
    public function log(Request $request){
        $input=$request->all();
        $log=Log::orderBy('id','asc')
            ->where(function($query) use($request){
                $startdate=$request['startdate'];
                $enddate=$request['enddate'];
                $admin_id=$request['admin_id'];
                if(!empty($startdate)&&!empty($enddate)){
                    $query->whereBetween('time',[$startdate,$enddate]);
                }
                if (!empty($admin_id)){
                    $query->where('admin_id','like','%'.$admin_id.'%');
                }

            })->paginate($request->input('num')?$request->input('num'):10);
        return view('admin.log',compact('log','request'));
    }


    //跳转首页
    public function index(){
        return view('admin.index');
    }

    //退出登录
    public function logout(){
        session()->flush();
        return view('admin.login');
    }
    //没有权限对应的页面对应的跳转
    public function  noaccess(){
        return view('admin/errors/noaccess');
    }
}
