<?php

namespace App\Http\Controllers\Home;

use App\Model\Drugst;
use App\Model\Patient;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Zhuzhichao\IpLocationZh\Ip;

class HomeController extends Controller
{
    //
    //前台系统登录验证
    public function captcha(Request $request)
    {


        if (Input::method() == 'POST')
        {
            $input = $request->except('_token');

            //具体规则
            $rules=[
                'username' => 'min:4|max:10',
                'password' => 'min:6|max:16',
                'code'=>'required|captcha',
            ];
            $msg=[
                'code.captcha'=>'验证码不一致'
            ];
            //分离验证组件 中文处理
            $validator = Validator::make($input,$rules,$msg );

            if ($validator->fails()) {
                return redirect('/')
                    ->withErrors($validator)
                    ->withInput();

            }
            // dd($input['username']);
            $User=User::where('username','=',$input['username'])->first();
            //dd($User);
            if(!$User)
            {
                return redirect('/')->with('errors','账号不存在或密码错误');
            }
            else
            {
                if ($input['password'] != $User->password)
                {
                    return redirect('/')->with('errors', '账号不存在或密码错误');
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
                return redirect('home/index');
            }

        }
    }
    //跳转首页
    public function index(){
        return view('home.index');
    }
    //查询药物
    public function querydrug(Request $request){
        $drugst=Drugst::orderBy('id','asc')
            ->where(function($query) use($request){
                $dsym=$request['dsym'];
                $dsgx=$request['dsgx'];
                $dsgj=$request['dsgj'];
                if (!empty($dsym)){
                    $query->where('dsym','like','%'.$dsym.'%');
                }
                if (!empty($dsgx)){
                    $query->where('dsgx','like','%'.$dsgx.'%');
                }
                if (!empty($dsgj)){
                    $query->where('dsgj','like','%'.$dsgj.'%');
                }

            })->paginate(5);

        //$drugst=Drugst::all();
        //dd($drugst);
        return view('home.patient.druglist',compact('drugst','request'));
    }
    //退出登录
    public function logout(){
        session()->flush();
        return view('home.login');
    }
public function info(){
        return view('home.info');
}
    public function update(Request $request, $id)
    {
        //
        $user=User::find($id);
        $username=$request->input('username');
        $tel=$request->input('tel');
        $password=$request->input('password');
        $email=$request->input('email');
        $user->username=$username;
        $user->tel=$tel;
        $user->password=$password;
        $user->email=$email;
        $res= $user->save();
        if ($res){
            $data = [
                'status' => 0,
                'message' => '修改成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => '修改失败'
            ];
        }
        return $data;

    }

}
