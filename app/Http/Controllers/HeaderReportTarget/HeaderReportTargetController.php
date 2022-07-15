<?php

namespace App\Http\Controllers\HeaderReportTarget;

use App\Http\Controllers\Controller;
use App\Models\HeaderReportTargetModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HeaderReportTargetController extends Controller
{
    public function create(Request $request)
    {
        $obj = [
            'title' => $request->title,
            'live' => 0,
        ];

        $create = HeaderReportTargetModel::create($obj);
        $create = (object)[
            'id' => $create->id,
            'title' => $create->title,
            'live' => $create->live,
            'created_at' => Carbon::make($create->created_at)->format('d-M-Y'),
            'url' => route('ruang_kerja', ['h_report_target_id' => $create->id]),

        ];
        return response()->json($create);
    }

    public function live(Request $request)
    {
        $where = ['id' => $request->id];

        HeaderReportTargetModel::where('id', '!=', $request->id)->update(['live' => 0]);
        $update = HeaderReportTargetModel::where($where)->update(['live' => 1]);
        return response()->json($update);
    }
}
