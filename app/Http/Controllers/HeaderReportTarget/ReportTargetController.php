<?php

namespace App\Http\Controllers\HeaderReportTarget;

use App\Http\Controllers\Controller;
use App\Models\ReportTargetModel;
use Illuminate\Http\Request;

class ReportTargetController extends Controller
{
    //
    public function create(Request $request)
    {
        $obj = $request->data;
        // First Delete if exist
        ReportTargetModel::where(['h_report_target_id' => $obj[0]['h_report_target_id']])->delete();
        // And Add
        $create = collect($obj)->each(function ($val) {
            ReportTargetModel::create($val);
        });
        return response()->json($create);
    }
}
