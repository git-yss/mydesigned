<?php

namespace App\Http\Controllers\Admin;


use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    //获取授权界面
    public function auth($id){
        $user=User::find($id);
        $role=Role::get();
        //获取当前角色权限列表

        $own_role=$user->role;
       // dd($own_role);
        //角色拥有权限的id
        $own_role1=[];
        foreach ($own_role as $v){
            $own_role1[]=$v->id;
        }
        //dd($own_permi1);
        //$own_permi1=[];
        //dd($own_permi);
        return view('admin.auth',compact('user','role','own_role1'));
    }


    //处理授权的方法
    public function doAuth(Request $request)
    {

        $input = $request->except('_token');
        //dd($input);
        //删除当前角色已有的权限
        DB::table('user_role')->where('user_id',$input['user_id'])->delete();

        //添加新授权的权限
        if (!empty($input['role_id'])) {
            foreach ($input['role_id'] as $val) {
                DB::table('user_role')->insert(['user_id' => $input['user_id'], 'role_Id' => $val]);
            }

        }
        return redirect('admin/user');
    }
    /**
     * Display a listing of the resource.
     *获取用户列表
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {
        //获取请求提交的参数
        $input=$request->all();
        $user=User::orderBy('id','asc')
                ->where(function($query) use($request){
                    $username=$request['username'];
                    $tel=$request['tel'];
                    if (!empty($username)){
                        $query->where('username','like','%'.$username.'%');
                    }
                    if (!empty($tel)){
                        $query->where('tel','like','%'.$tel.'%');
                    }
        })->paginate($request->input('num')?$request->input('num'):8);

       // $paginate=User::paginate(8);

        return view('admin.userlist',compact('user','request'));
    }

    /**
     * Show the form for creating a new resource.
     *返回用户添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.add');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
       //dd($input);
        $rules = [
            'tel'=>'bail|required|unique:user',
            'username' => 'bail|required|unique:user',
            'password'=>'bail||min:6|max:16|required',
            'email' => 'bail|required|email',


        ];
        //分离验证组件 中文处理
        $validator = $this->getValidationFactory()->make($input,$rules );

        if ($validator->fails()) {
            return response()->json(array(
                'status' => 1,
                'message' => $validator->getMessageBag()->first(),
            ));
        }

        $res = User::create(['tel'=>$request['tel'],'username'=>$request['username'],'email'=>$request['email'],'password'=>Crypt::encrypt($request['password'])]);
        //dd($res);
        if($res){
            $data = [
                'status' => 0,
                'message' => '添加成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => '添加失败，可能是用户重复'
            ];
        }
        return $data;
        }



    /**
     * Display the specified resource.
     *显示一条用户记录
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *返回修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $user=User::find($id);
        return view('admin.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *执行修改操作
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *执行删除操作
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       $user=User::find($id);
       $res=$user->delete();
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
    public function delAll(Request $request)
    {
        //
        $input=$request->input('ids');

        $res=User::destroy($input);

        if ($res){
            $data = [
                'status' => 0,
                'message' => '删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => '删除失败'
            ];
        }
        return $data;
    }
}
