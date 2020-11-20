<?php

namespace App\Http\Controllers\Admin;

use App\Model\Drugst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DrugstController extends Controller
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
        $drugst=Drugst::orderBy('id','asc')
            ->where(function($query) use($request){
                $dsym=$request['dsym'];
                if (!empty($dsym)){
                    $query->where('dsym','like','%'.$dsym.'%');
                }

            })->paginate($request->input('num')?$request->input('num'):8);


        return view('admin.drugst.drugstlist',compact('drugst','request'));
    }

    /**
     * Show the form for creating a new resource.
     *返回用户添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.drugst.add');
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
            'dsym'=>'bail|required|unique:drugst',
            'jiage' => 'bail|required',
            'kucun'=>'bail|required',


        ];
        //分离验证组件 中文处理
        $validator = $this->getValidationFactory()->make($input,$rules );

        if ($validator->fails()) {
            return response()->json(array(
                'status' => 1,
                'message' => $validator->getMessageBag()->first(),
            ));
        }

        $res = Drugst::create($input);
        //dd($res);
        if($res){
            $data = [
                'status' => 0,
                'message' => '添加成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => '添加失败，可能是药物重复'
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

        $drugst=Drugst::find($id);
        return view('admin.drugst.edit',compact('drugst'));
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
        $drugst=Drugst::find($id);
        $dsym=$request->input('dsym');
        $dsgx=$request->input('dsgx');
        $dsyw=$request->input('dsyw');
        $dsyx=$request->input('dsyx');
        $dsgj=$request->input('dsgj');
        $kucun=$request->input('kucun');
        $jiage=$request->input('jiage');

        $drugst->dsym=$dsym;
        $drugst->dsgx=$dsgx;
        $drugst->dsyw=$dsyw;
        $drugst->dsyx=$dsyx;
        $drugst->dsgj=$dsgj;
        $drugst->kucun=$kucun;
        $drugst->jiage=$jiage;

        $res= $drugst->save();
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
        $drugst=Drugst::find($id);
        $res=$drugst->delete();
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

        $res=Drugst::destroy($input);

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
