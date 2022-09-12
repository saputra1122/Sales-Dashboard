@extends('layouts.app_template')
@section('content')
<x-navigation.ruang-kerja-nav :navId="$dashboard_id" />
@if($dashboard_id == 1)
<x-table-ruang-Kerja.v1 :collection="$collection" :header="$header" :content="$content" :dashboardId="$dashboard_id" />
@endif
@if($dashboard_id == 2)
<x-table-ruang-Kerja.v2 :collection="$collection" :header="$header" :content="$content" :dashboardId="$dashboard_id" />
@endif
@endsection