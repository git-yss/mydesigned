<?php

namespace App\Http\Controllers\Home;

use App\Model\Drugst;
use App\Model\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Medicalr;
use function Sodium\compare;

class TcmformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */
    //查询药品数据是否存在，和是否库存还足够。
    public function drugstpd(Request $request)
    {
        $input = $request->all();
        //dd($input);
        foreach($input as $i){
            //获取所有数组的一个字段成一个新数组
            $arr1 = array_column($i, 'count');
            $arr2 = array_column($i, 'name');
           // dd($arr2[1]);
            $l=count($i);//判断药物种类数量
            $list=[];
           for($i=0;$i<$l;$i++) {
                if ($input = Drugst::where('dsym', '=', $arr2[$i])->exists()) {
                   $drugt= Drugst::where('dsym', '=', $arr2[$i])->first();
                   $kucun=$drugt->kucun;
                  // dd($kucun);
                    if (($arr1[$i]) > $kucun) {
                        $data = [
                            'status' => 1,
                            'message' => $arr2[$i] . '库存不足！',
                            'dsym' => $arr2[$i] ,
                            'number' => $arr1[$i],
                        ];
                        $list[$i]=$data;
                    } else {
                        $sy=$kucun-$arr1[$i];//剩余库存
                        //dd($sy);
                        Drugst::where('dsym', '=', $arr2[$i])->update(['kucun'=>$sy]);
                        $data = [
                            'status' => 0,
//                            'message' => $arr2[$i].'库存还剩'.$sy
                             'message' => $arr2[$i].'库存还剩'.$sy,
                           'dsym' => $arr2[$i],
                            'number' => $arr1[$i],
                        ];
                        $list[$i]=$data;
                    }
                } else {
                    $data = [
                        'status' => 1,
                        'message' => '药房没有' . $arr2[$i],
                        'dsym' => $arr2[$i],
                        'number' => $arr1[$i],
                    ];
                    $list[$i]=$data;
               }
            }
        }
              return $list;
    }
    //查询身份证号是否存在，若存在自动把个人信息填充完，若不存在继续接下来的保存操作
    public function chaxun(Request $request){
        $input = $request->all();
        //dd($id);
        //$input = Patient::where('pid', '=',$id)->exists();
        //dd($input);
        if (Patient::where('pid', '=', $request['p_idnumber'])->exists()) {
            // 有记录
            //dd(1111);
            $info=Patient::where('pid', '=', $request['p_idnumber'])->first();

            return $info;
            // return view('home.patient.patientadd',compact('info','request'));
            // return redirect('home.dmmessage.'.$patient);
        }
    }
    public function index(Request $request)
    {

        //$drugst=Drugst::all();
        //dd($drugst);

        return view('home.patient.patientadd');
        //return res;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //隐藏id若是存在即判断为有当前库里有当前患者，所以只需存储他的病历即可
//       $a=$request['p_id'];
//        dd($a);隐藏的患者id
        if($request['p_id']){
            $bres = Medicalr::create(['pdate'=>$request['p_ctime'],'zhusu'=>$request['p_chcom'],
                'xbs'=>$request['p_hpi'],'jws'=>$request['p_pmh'],'gms'=>$request['p_allergy'],
                'st'=>$request['p_tonfur'],'mx'=>$request['p_pulse'],'bzfx'=>$request['p_dialetype'],
                'zs'=>$request['p_cercate'],'qm'=>$request['p_dockername'],'zzzf'=>$request['p_rule'],
                'ywzc'=>$request['p_drugs'],'zyzd'=>$request['p_zdiagnosis'],'xyzd'=>$request['p_xdiagnosis'],'patient_id'=>$request['p_id'],'active'=>'未标记']);

            if($bres){
                $data = [
                    'status' => 0,
                    'message' => '添加成功',
                    'p_id'=>$request['p_id']
                ];
            }else{
                $data = [
                    'status' => 1,
                    'message' => '添加失败'
                ];
            }
            return $data;
        }else{
            //dd($input);
            $ares = Patient::create(['ptel'=>$request['p_phone'],'pname'=>$request['p_name'],
                'psex'=>$request['p_sex'],'page'=>$request['p_age'],'pdate'=>$request['p_birthday'],
                'pid'=>$request['p_idnumber'],'padress'=>$request['p_address']]);
            //获取新患者的id
           $id= Patient::where('pid','=',$request['p_idnumber'])->first()->id;
 //dd($id);
            $bres = Medicalr::create(['pdate'=>$request['p_ctime'],'zhusu'=>$request['p_chcom'],
                'xbs'=>$request['p_hpi'],'jws'=>$request['p_pmh'],'gms'=>$request['p_allergy'],
                'st'=>$request['p_tonfur'],'mx'=>$request['p_pulse'],'bzfx'=>$request['p_dialetype'],
                'zs'=>$request['p_cercate'],'qm'=>$request['p_dockername'],'zzzf'=>$request['p_rule'],
                'ywzc'=>$request['p_drugs'],'zyzd'=>$request['p_zdiagnosis'],'xyzd'=>$request['p_xdiagnosis'],'patient_id'=>$id,'active'=>'未标记']);
            if($ares&&$bres){
                $data = [
                    'status' => 0,
                    'message' => '添加成功'
                ];
            }else{
                $data = [
                    'status' => 1,
                    'message' => '添加失败'
                ];
            }
            return $data;

        }

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
    }
}
