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
    public function __construct()
    {
        $this->middleware('auth');
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
        return view('live.report_target', $data);
    }

    public function liveClient()
    {
        $reqData = $this->liveData();

        $data['header'] = $reqData['header'];
        $data['content'] = $reqData['content'];
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
            $header = HeaderReportTargetModel::where('live', 1)->first() ?? $header;
            $content = (new RuangKerjaController)->content(['h_report_target_id' => $header->id], false);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $data['header'] = $header;
        $data['content'] = $content;

        return $data;
    }
}
