<?php

namespace App\Http\Controllers\HeaderReportTarget;

use App\Http\Controllers\Controller;
use App\Models\HeaderReportTargetModel;
use App\Models\ReportTarget2Model;
use App\Models\ReportTargetModel;
use Illuminate\Http\Request;

class ReportTargetController extends Controller
{
    //
    public function create(Request $request)
    {
        $obj = $request->data;
        // Get first add or not
        $firstAdd = HeaderReportTargetModel::where(['id' => $obj[0]['h_report_target_id']])->first();
        // Delete
        ReportTargetModel::where('h_report_target_id', $obj[0]['h_report_target_id'])->delete();
        // Perbandingan
        $data_previouse = HeaderReportTargetModel::where('created_at', '<', $firstAdd->created_at)->orderBy('id', 'desc')->first();
        if ($data_previouse != null) {
            $data_previouse = ReportTargetModel::where(['h_report_target_id' => $data_previouse->id])->get();
            $no = 0;
            foreach ($data_previouse as $val) {
                $obj[$no]['indicator'] = $this->indicator($obj[$no]['value'], $val->value);
                $obj[$no]['indicator_ar'] = $this->indicator($obj[$no]['value_ar'], $val->value_ar);
                $no++;
            }
        }
        // And Add
        $create = collect($obj)->each(function ($val) use ($firstAdd) {
            ReportTargetModel::create($val);
        });
        return response()->json($create);
    }

    public function create2(Request $request)
    {
        $obj = $request->data;
        // Delete
        ReportTarget2Model::where('h_report_target_id', $obj[0]['h_report_target_id'])->delete();
        // And Add
        $create = collect($obj)->each(function ($val) {
            ReportTarget2Model::create($val);
        });
        return response()->json($create);
    }

    public function indicator($valNex, $valPrev)
    {
        if ($valNex > $valPrev) {
            $indi = 1; //Up
        } else if ($valNex < $valPrev) {
            $indi = 2; //Down
        } else {
            $indi = null;
        }

        return $indi;
    }
}
