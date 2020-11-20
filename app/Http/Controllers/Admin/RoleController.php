<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    //获取授权界面
    public function auth($id){
        $role=Role::find($id);
        $permi=Permission::get();
        //获取当前角色权限列表

        $own_permi=$role->permission;
       //dd($own_permi);
        //角色拥有权限的id
        $own_permi1=[];
        foreach ($own_permi as $v){
            $own_permi1[]=$v->id;
        }
       //dd($own_permi1);
       //$own_permi1=[];
        //dd($own_permi);
     return view('admin.role.auth',compact('role','permi','own_permi1'));
    }


    //处理授权的方法
    public function doAuth(Request $request)
    {

        $input = $request->except('_token');
        //dd($input);
        //删除当前角色已有的权限
        DB::table('role_permission')->where('role_id',$input['role_id'])->delete();

        //添加新授权的权限
        if (!empty($input['permission_id'])) {
        foreach ($input['permission_id'] as $val) {
            DB::table('role_Permission')->insert(['role_id' => $input['role_id'], 'permission_Id' => $val]);
         }

        }
        return redirect('admin/role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $role=Role::get();
        return view('admin.role.rolelist',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $res = Role::create($input);
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=Role::find($id);
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

        $res=Role::destroy($input);

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
