<?php

namespace App\Http\Controllers\Home;

use App\Model\Medicalr;
use App\Model\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function record(Request $request){
        $input=$request->all();
//        $id=Patient::where('pid',$request['id'])->first()->id;
        // dd($input);
        foreach ($input as $k=> $v){
            foreach ($v as $val){
           // dd($val);
            Medicalr::where('id', '=',$val)->update(['active'=>"未标记"]);
        }}
        $data = [
            'status' => 0,
            'message' => '取消添加成功',
        ];
        return $data;
    }
    public function index(Request $request)
    {
        //
        $medicalr=DB::table('medicalr')
            ->join('patient',function ($join){
                $join->on('medicalr.patient_id','=','patient.id')
                    ->where('medicalr.active','=','已标记');
            })
            ->select('patient.*','medicalr.*')
            ->orderBy('medicalr.pdate','desc')
            ->where(function($query) use($request) {
                $patient_name = $request['pname'];
                $zhusu = $request['zhusu'];
                $zyzd = $request['zyzd'];
                $xyzd = $request['xyzd'];
                $zzzf = $request['zzzf'];
                if (!empty($patient_name)) {
                    $query->where('patient.pname', 'like', '%' . $patient_name .'%');
                }
                if (!empty($zhusu)) {
                    $query->where('medicalr.zhusu', 'like', '%' . $zhusu . '%');
                }
                if (!empty($zyzd)) {
                    $query->where('medicalr.zyzd', 'like', '%' . $zyzd . '%');
                }
                if (!empty($xyzd)) {
                    $query->where('medicalr.xyzd', 'like', '%' . $xyzd . '%');
                }
                if (!empty($zzzf)) {
                    $query->where('medicalr.zzzf', 'like', '%' . $zzzf . '%');
                }
            })
            ->paginate(10);

        return view('home.record.recordlist',compact('medicalr','request'));
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
        //
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
        $medicalr=Medicalr::find($id);
        // dd($medicalr);
        $patient_id=$medicalr->patient_id;
        $patient=Patient::find($patient_id);
        return view('home.record.showbl',compact('medicalr','patient'));
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
