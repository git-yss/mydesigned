<?php

namespace App\Http\Controllers\Admin;
use App\Model\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permission = Permission::get();
        return view('admin.permission.permissionlist', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.permission.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $res = Permission::create($input);
        //dd($res);
        if ($res) {
            $data = [
                'status' => 0,
                'message' => '添加成功'
            ];
        } else {
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $permission=Permission::find($id);
        return view('admin.permission.edit',compact('permission'));
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
        $permission=Permission::find($id);
        $pername=$request->input('pername');
        $perurl=$request->input('perurl');

        $permission->pername=$pername;
        $permission->perurl=$perurl;
        $res= $permission->save();
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
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $permission = Permission::find($id);
        $res = $permission->delete();
        if ($res) {
            $data = [
                'status' => 0,
                'message' => '修改成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '修改失败'
            ];
        }
        return $data;
    }
    public function delAll(Request $request){
      $input = $request->input('ids');
      //dd($input);
      $res = Permission::destroy($input);

      if ($res) {
        $data = [
            'status' => 0,
            'message' => '删除成功'
        ];
      } else {
        $data = [
            'status' => 1,
            'message' => '删除失败'
        ];
      }
        return $data;
    }

}
