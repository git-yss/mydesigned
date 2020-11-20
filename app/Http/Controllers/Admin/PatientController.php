<?php

namespace App\Http\Controllers\Admin;

use App\Model\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *获取药品列表
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //获取请求提交的参数
        $input=$request->all();
        $patient=Patient::orderBy('id','asc')
            ->where(function($query) use($request){
                $startdate=$request['startdate'];
                $enddate=$request['enddate'];
                $pid=$request['pid'];
                $pname=$request['pname'];
               if(!empty($startdate)&&!empty($enddate)){
                    $query->whereBetween('pdate',[$startdate,$enddate]);
                }
                if (!empty($pid)){
                    $query->where('pid','like','%'.$pid.'%');
                }
                if (!empty($pname)){
                    $query->where('pname','like','%'.$pname.'%');
                }

            })->paginate($request->input('num')?$request->input('num'):10);


        return view('admin.patient.patientlist',compact('patient','request'));
    }

    /**
     * Show the form for creating a new resource.
     *返回用户添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *执行添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        $input = $request->all();
//        //dd($input);
//        $rules = [
//            'ptel'=>'bail|required|unique:patient',
//            'pid' => 'bail|required|unique:patient',
//            'pname'=>'bail|required',
//            'page' => 'bail|required',
//            'padress' => 'bail|required',
//            'psex' => 'bail|required',
//            'pdate' => 'bail|required',
//
//        ];
//        //分离验证组件 中文处理
//        $validator = $this->getValidationFactory()->make($input,$rules );
//
//        if ($validator->fails()) {
//            return response()->json(array(
//                'status' => 1,
//                'message' => $validator->getMessageBag()->first(),
//            ));
//        }
//
//        $res = Patient::create($input);
//        //dd($res);
//        if($res){
//            $data = [
//                'status' => 0,
//                'message' => '添加成功'
//            ];
//        }else{
//            $data = [
//                'status' => 1,
//                'message' => '添加失败，可能是用户重复'
//            ];
//        }
//        return $data;
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

        $patient=Patient::find($id);
        return view('admin.patient.edit',compact('patient'));
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
        $patient=Patient::find($id);
        $pname=$request->input('pname');
       //dd($patient);
        $ptel=$request->input('ptel');
        $page=$request->input('page');
        //dd($page);
        $psex=$request->input('psex');
       // dd($psex);
        $padress=$request->input('padress');
        $date=$request->input('pdate');
        $pid=$request->input('pid');

        $patient->pname=$pname;
        $patient->ptel=$ptel;
        $patient->page=$page;
        $patient->psex=$psex;
        $patient->padress=$padress;
        $patient->pdate=$date;
        $patient->pid=$pid;

        $res= $patient->save();
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
//        //
//        $patient=Patient::find($id);
//        $res=$patient->delete();
//        if ($res){
//            $data = [
//                'status' => 0,
//                'message' => '修改成功'
//            ];
//        }else{
//            $data = [
//                'status' => 1,
//                'message' => '修改失败'
//            ];
//        }
//        return $data;
    }
    public function delAll(Request $request)
    {
        //
       $input=$request->input('ids');

        $res=Patient::destroy($input);

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
