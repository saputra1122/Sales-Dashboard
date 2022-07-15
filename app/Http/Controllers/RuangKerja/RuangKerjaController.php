<?php

namespace App\Http\Controllers\RuangKerja;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HeaderReportTarget\HeaderReportTargetController;
use App\Models\GlobalModel;
use App\Models\HeaderReportTargetModel;
use App\Models\ReportTargetModel;
use App\Models\TemplateModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RuangKerjaController extends Controller
{
    public function index(Request $request)
    {
        $data['page'] = GlobalModel::nav_menus(1);
        $data['collection'] = $this->collection();

        $header = array_search($request->h_report_target_id, array_column($data['collection'], 'id'));
        $header = $header ? $data['collection'][$header] : $data['collection'][0];

        $data['header'] = $header;
        $data['content'] = $this->content(['h_report_target_id' => $header->id]);

        return view('ruang_kerja.index', $data);
    }

    public function collection()
    {
        $headerReportTarget = HeaderReportTargetModel::orderBy('id', 'desc')->get();

        if ($headerReportTarget->count() == 0) {
            $data = [
                'title' => "New Report",
                'live' => 0,
            ];
            $create = (new HeaderReportTargetController)->create(new Request($data));
            $headerReportTarget[] = $create->original;
        }

        $result = [];
        foreach ($headerReportTarget as $val) {
            $result[] = (object)[
                'id' => $val->id,
                'title' => $val->title,
                'created_at' => Carbon::make($val->created_at)->format('d-M-Y'),
                'live' => $val->live,
                'url' => route('ruang_kerja', ['h_report_target_id' => $val->id]),
            ];
        }

        return $result;
    }

    public function content($data, $template = true)
    {
        $content = ReportTargetModel::where($data)->get();
        if ($content->count() == 0 && $template) {
            $content = TemplateModel::all();
        }

        $result = [];
        $target = 0;
        $value = 0;
        $idx = 0;

        foreach ($content as $val) {
            $result[] = (object)[
                'id' => $val->id,
                'operating' => $val->operating,
                'target' => $val->target,
                'value' => $val->value,
                'position' => $val->position
            ];

            if ($val->position == 0) {
                $target += $val->target;
                $value += $val->value;
            }
        }

        $idx = $target > 0 ? round(($value / $target) * 100) : 0;

        $total = (object)[
            'target' => $target,
            'value' => $value,
            'idx' => $idx,
        ];

        $data = (object)[
            'result' => $result,
            'total' => $total
        ];

        return $data;
    }
}
