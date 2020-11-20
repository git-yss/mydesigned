<?php

namespace App\Http\Controllers\Home;

use App\Model\Drugst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DrugstkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
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

            })->paginate(15);

        return view('home.drugst.drugstlist',compact('drugst','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home.drugst.drugadd');
    }

    /**
     * Store a newly created resource in storage.
     *
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
        //dd($id);
        $drugst=Drugst::find($id);
        return view('home.drugst.drugedit',compact('drugst'));
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
