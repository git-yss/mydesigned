<?php

namespace App\Http\Controllers\Home;

use App\Model\Medicalr;
use App\Model\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //标记病历加入医案库
public function record(Request $request){
    $input=$request->all();
   // dd($id);
    if($request['active']=='已标记'){
        Medicalr::where('id', '=',$request['id'] )->update(['active'=>"未标记"]);
        $data = [
            'status' => 0,
            'message' => '取消添加成功',
        ];
        return $data;
    }
    if($request['active']=='未标记')
    {
        Medicalr::where('id', '=',$request['id'] )->update(['active'=>"已标记"]);
        $data = [
            'status' => 0,
            'message' => '添加医案库成功',

        ];
        return $data;
    }
}

    public function index(Request $request)
    {
        //
        $input=$request->all();

        $medicalr=DB::table('medicalr')
            ->join('patient','medicalr.patient_id','patient.id')
            ->select('patient.*','medicalr.*')
            ->orderBy('medicalr.pdate','desc')
            ->where(function($query) use($request) {
                $startdate = $request['startdate'];
                $enddate = $request['enddate'];
                $patient_name = $request['pname'];
                $patient_id = $request['pid'];
                if (!empty($startdate) && !empty($enddate)) {
                    $query->whereBetween('medicalr.pdate', [$startdate, $enddate]);
                }
                if (!empty($patient_name)) {
                    $query->where('patient.pname', 'like', '%' . $patient_name . '%');
                }
                if (!empty($patient_id)) {
                    $query->where('patient.pid', 'like', '%' . $patient_id . '%');
                }
            })
            ->paginate(10);

        return view('home.file.filelist',compact('medicalr','request'));
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
        return view('home.file.showbl',compact('medicalr','patient'));
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
