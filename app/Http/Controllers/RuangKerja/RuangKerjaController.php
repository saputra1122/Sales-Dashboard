<?php

namespace App\Http\Controllers\RuangKerja;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HeaderReportTarget\HeaderReportTargetController;
use App\Models\GlobalModel;
use App\Models\HeaderReportTargetModel;
use App\Models\ReportTarget2Model;
use App\Models\ReportTargetModel;
use App\Models\Template2Model;
use App\Models\TemplateModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Double;

class RuangKerjaController extends Controller
{
    public function index(Request $request)
    {
        $dashboard_id = $request['dashboard_id'] ?? 1;
        $data['page'] = GlobalModel::nav_menus(1);
        $data['collection'] = $this->collection($dashboard_id);

        $header = array_search($request->h_report_target_id, array_column($data['collection'], 'id'));
        $header = $header ? $data['collection'][$header] : $data['collection'][0];

        $data['header'] = $header;
        $data['dashboard_id'] = $dashboard_id;
        $data['content'] = $this->content(['h_report_target_id' => $header->id], true, $dashboard_id);

        return view('ruang_kerja.index', $data);
    }

    public function collection($dashboard_id)
    {
        $headerReportTarget = HeaderReportTargetModel::where(['dashboard_id' => $dashboard_id])->orderBy('id', 'desc')->get();

        if ($headerReportTarget->count() == 0) {
            $data = [
                'dashboard_id' => $dashboard_id,
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
                'dashboard_id' => $val->dashboard_id,
                'title' => $val->title,
                'created_at' => Carbon::make($val->created_at)->format('d-M-Y'),
                'live' => $val->live,
                'url' => route('ruang_kerja', ['dashboard_id' => $val->dashboard_id, 'h_report_target_id' => $val->id]),
            ];
        }

        return $result;
    }

    public function content($data, $template = true, $dashboard_id = 1)
    {
        if ($dashboard_id == 1) {
            $content = ReportTargetModel::where($data)->get();
        } else {
            $content = ReportTarget2Model::where($data)->get();
        }
        if ($content->count() == 0 && $template) {
            if ($dashboard_id == 1) {
                $content = TemplateModel::all();
            } else {
                $content = Template2Model::all();
            }
        }

        $result = $this->resultData($content, $dashboard_id);

        $data = (object)[
            'result' => $result,
        ];

        return $data;
    }

    public function resultData($content, $dashboard_id)
    {
        $result = [];

        if ($dashboard_id == 1) {
            foreach ($content as $val) {
                $result[] = (object)[
                    'id' => $val->id,
                    'operating' => $val->operating,
                    'target' => (float) $val->target,
                    'value' => (float) $val->value,
                    'indicator' => (int) $val->indicator,
                    'target_ar' => (float) $val->target_ar,
                    'value_ar' => (float) $val->value_ar,
                    'indicator_ar' => (int) $val->indicator_ar,
                    'disable' => $val->disable,
                    'position' => $val->position,
                    'last_update' => Carbon::make($val->created_at)->format('H:i:s'),
                    'created_at' => $val->created_at,
                    'updated_at' => $val->updated_at,
                ];
            }
        } else {
            foreach ($content as $val) {
                $result[] = (object)[
                    'id' => $val->id,
                    'operating' => $val->operating,
                    'early_production' => (float) $val->early_production,
                    'extrud' => (float) $val->extrud,
                    'send' => (float) $val->send,
                    'before_send' => (float) $val->before_send,
                    'before_production' => (float) $val->before_production,
                    'disable' => (int) $val->disable,
                    'position' => $val->position,
                    'last_update' => Carbon::make($val->created_at)->format('H:i:s'),
                    'created_at' => $val->created_at,
                    'updated_at' => $val->updated_at,
                ];
            }
        }

        return $result;
    }
}
