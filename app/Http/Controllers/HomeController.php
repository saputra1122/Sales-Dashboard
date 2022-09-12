<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RuangKerja\RuangKerjaController;
use App\Models\GlobalModel;
use App\Models\HeaderReportTargetModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        if (!$request->input('link') && $request->input('link') != 'share') {
            $this->middleware('auth');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reqData = $this->liveData();

        $data['page'] = GlobalModel::nav_menus(0);
        $data['header'] = $reqData['header'];
        $data['content'] = $reqData['content'];

        return view('home', $data);
    }

    public function live()
    {
        $reqData = $this->liveData();

        $data['header'] = $reqData['header'];
        $data['content'] = $reqData['content'];
        $data['header2'] = $reqData['header2'];
        $data['content2'] = $reqData['content2'];
        return view('live.report_target', $data);
    }

    public function liveClient()
    {
        $reqData = $this->liveData();

        $data['header'] = $reqData['header'];
        $data['content'] = $reqData['content'];
        $data['header2'] = $reqData['header2'];
        $data['content2'] = $reqData['content2'];
        return response()->json($data);
    }

    public function liveData()
    {
        $header = (object)[
            'id' => null,
            'created_at' => date('d-M-Y'),
        ];
        $content = [];

        try {
            $header = HeaderReportTargetModel::where(['dashboard_id' => 1, 'live' => 1])->first() ?? $header;
            $content = (new RuangKerjaController)->content(['h_report_target_id' => $header->id], false);
            // =====================
            $header2 = HeaderReportTargetModel::where(['dashboard_id' => 2, 'live' => 1])->first() ?? $header;
            $content2 = (new RuangKerjaController)->content(['h_report_target_id' => $header2->id], false, 2);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $data['header'] = $header;
        $data['content'] = $content;
        $data['header2'] = $header2;
        $data['content2'] = $content2;

        return $data;
    }
}
