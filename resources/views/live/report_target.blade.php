@extends('layouts.app_template', ['nav' => false])
@section('content')
<div class="card card-md full_screen font-responsive p-4">
    <div class="card-body p-0">
        <h1>HKMU - Target {{ Carbon\Carbon::make($header->created_at)->format('d-M-Y') }}</h1>
        <div class="card border-0">
            <div class="table-responsive">
                <table class="table-custom" id="content-table-list">
                    <thead class="">
                        <tr>
                            <th rowspan="3">Operating Company</th>
                            <th colspan="3">Secondary</th>
                        </tr>
                        <tr>
                            <th rowspan="2" width="20%">Target</th>
                            <th>Actual</th>
                            <th rowspan="2" width="10%">IDX</th>
                        </tr>
                        <tr>
                            <th width="20%">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($content->result as $val)
                        <tr class="hover-shadow-primary cursor-text" data-id="{{ $val->id }}">
                            <td class="{{ $val->position > 0 ? 'ps-4' : 'fw-bold' }}">{!! $val->operating !!}</td>
                            <td class="text-end">{{ App\Models\GlobalModel::currencyFormatter($val->target) }}</td>
                            <td class="text-end">{{ App\Models\GlobalModel::currencyFormatter($val->value) }}</td>
                            <td class="text-center">{{ $val->target > 0 ? round(($val->value / $val->target) * 100) : 100 }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                Total
                            </th>
                            <th class="text-end" data-column="target">{{ App\Models\GlobalModel::currencyFormatter($content->total->target) }}</th>
                            <th class="text-end" data-column="value">{{ App\Models\GlobalModel::currencyFormatter($content->total->value) }}</th>
                            <th class="text-center" data-column="idx">{{ $content->total->idx }}%</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    let _contentTableList = '#content-table-list';
    $(document).ready(function() {
        setInterval(function() {
            realtimeData();
        }, 5000);
    });

    const realtimeData = () => {
        realtimeServer({
            url: url + '/live_client',
            onSuccess: function(response) {
                console.log(response);
                drawContent(response['content']['result']);
                contentCountTotal(response['content']['result']);
            }
        });
    }

    const drawContent = (array) => {
        let view = '';
        $(_contentTableList + " tbody").empty();
        $.each(array, function(i, data) {
            let position = data.position > 0 ? 'ps-4' : 'fw-bold';
            let idx = data.target > 0 ? Math.round((data.value / data.target) * 100) : 100;
            idx = idx + '%';
            view += '<tr class="hover-shadow-primary cursor-text" data-id="' + data.id + '">' +
                '<td class="' + position + '" data-type="text" data-editing="false" data-column="operating" onclick="contentRowClick(this)">' + data.operating + '</td>' +
                '<td class="text-end" data-type="currency" data-editing="true" data-column="target" onclick="contentRowClick(this)">' + currencyFormatter(data.target) + '</td>' +
                '<td class="text-end" data-type="currency" data-editing="true" data-column="value" onclick="contentRowClick(this)">' + currencyFormatter(data.value) + '</td>' +
                '<td class="text-center" data-type="percen" data-editing="false">' + idx + '</td>' +
                '</tr>';
        });

        $(_contentTableList + " tbody").html(view);
    }

    const contentCountTotal = (array) => {
        let target = 0;
        let value = 0;
        let idx = 0;

        $.each(array, function(i, row) {
            if (row.position == 0) {
                target += row.target;
                value += row.value;
            }
        });

        idx = target > 0 ? Math.round((value / target) * 100) : 100;
        idx = idx + '%';

        $(_contentTableList + ' tfoot tr th[data-column="target"]').html(currencyFormatter(target));
        $(_contentTableList + ' tfoot tr th[data-column="value"]').html(currencyFormatter(value));
        $(_contentTableList + ' tfoot tr th[data-column="idx"]').html(idx);
    }
</script>
@endpush