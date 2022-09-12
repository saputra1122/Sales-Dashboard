<div class="card card-md font-responsive px-4 py-3 shadow-none border-0">
    <div class="card-body p-0">
        <div class="d-flex align-items-center mb-2">
            <img src="{{ asset('assets/pus_dist/img/logo.png') }}" alt="logo" style="width: 2%;" class="me-2">
            <h1 class="font-responsive">HKMU GROUP MONITORING DASHBOARD - MTD <span class="date-header-2">{{ strtoupper(Carbon\Carbon::make($header->created_at)->format('d-M-Y')) }}</span></h1>
            <span class="status status-red ms-3" id="live-span" style="display: block;">
                <span class="status-dot status-dot-animated"></span>
                Live
            </span>
            <button class="switch-icon switch-icon-slide-right ms-auto" data-bs-toggle="switch-icon" onclick="toggleFullScreen(document.body)">
                <span class="switch-icon-a text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-maximize" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <polyline points="16 4 20 4 20 8"></polyline>
                        <line x1="14" y1="10" x2="20" y2="4"></line>
                        <polyline points="8 20 4 20 4 16"></polyline>
                        <line x1="4" y1="20" x2="10" y2="14"></line>
                        <polyline points="16 20 20 20 20 16"></polyline>
                        <line x1="14" y1="14" x2="20" y2="20"></line>
                        <polyline points="8 4 4 4 4 8"></polyline>
                        <line x1="4" y1="4" x2="10" y2="10"></line>
                    </svg>
                </span>
                <span class="switch-icon-b text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-minimize" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <polyline points="5 9 9 9 9 5"></polyline>
                        <line x1="3" y1="3" x2="9" y2="9"></line>
                        <polyline points="5 15 9 15 9 19"></polyline>
                        <line x1="3" y1="21" x2="9" y2="15"></line>
                        <polyline points="19 9 15 9 15 5"></polyline>
                        <line x1="15" y1="9" x2="21" y2="3"></line>
                        <polyline points="19 15 15 15 15 19"></polyline>
                        <line x1="15" y1="15" x2="21" y2="21"></line>
                    </svg>
                </span>
            </button>
        </div>
        <div class="card border-0">
            <div class="table-responsive">
                <table class="table-custom" id="content-table-list-2">
                    <thead class="">
                        <tr class="bg-orange-lt-cs">
                            <th class="text-start">Last Update : <span class="last-updated2">{{ strtoupper(Carbon\Carbon::make($content->result[0]->updated_at ?? '00:00:00')->format('H:i:s')) }}</span></th>
                            <th colspan="6" class="text-end text-uppercase text-center">Primary</th>
                        </tr>
                        <tr class="bg-orange-lt-cs">
                            <th>OPERATING COMPANY</th>
                            <th width="10%">BELUM PRODUKSI AWAL</th>
                            <th width="11%">EXTRUD</th>
                            <th width="10%">KIRIM</th>
                            <th width="10%">BELUM KIRIM</th>
                            <th width="11%">BELUM PRODUKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($content->result as $val)
                        @if($val->position != 3)
                        <tr class="hover-shadow-primary cursor-text @if($val->disable < 0) bg-dark-lt fw-bolder @endif" data-id="{{ $val->id }}">
                            <td style="padding-left: <?= (($val->position * 10) + 10) ?>px;">{!! $val->operating !!}</td>
                            <td class="text-end">{{ $val->early_production > 0 ? App\Models\GlobalModel::currencyFormatter($val->early_production) : '-' }}</td>
                            <td class="text-end">{{ $val->extrud > 0 ? App\Models\GlobalModel::currencyFormatter($val->extrud) : '-' }}</td>
                            <td class="text-end">{{ $val->send > 0 ? App\Models\GlobalModel::currencyFormatter($val->send) : '-' }}</td>
                            <td class="text-end">{{ $val->before_send > 0 ? App\Models\GlobalModel::currencyFormatter($val->before_send) : '-' }}</td>
                            <td class="text-end">{{ $val->before_production > 0 ? App\Models\GlobalModel::currencyFormatter($val->before_production) : '-' }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End HTML -->
<!-- Script Js -->
@push('script')
<script>
    let _contentTableList2 = '#content-table-list-2';
    const responseContent2 = (response) => {
        // Set header
        $('.date-header-2').html('<span class="text-uppercase">' + dateFormat(response['header2'].created_at) + '</span>');
        $('.last-updated2').html('<span class="text-uppercase">' + response['content2']['result'][0].last_update + '</span>');
        drawContent2(response['content2']['result']);
    }

    const drawContent2 = (array) => {
        let view = '';
        $(_contentTableList2 + " tbody").empty();
        $.each(array, function(i, data) {
            let position = (data.position * 10) + 10;
            let disable = data.disable < 0 ? 'bg-dark-lt fw-bolder' : '';
            // Set view to variable
            if (data.position != 3) {
                view += '<tr class="hover-shadow-primary cursor-text ' + disable + '" data-id="' + data.id + '">' +
                    '<td style="padding-left: ' + position + 'px;">' + data.operating + '</td>' +
                    '<td class="text-end">' + (data.early_production > 0 ? currencyFormatter(data.early_production) : '-') + '</td>' +
                    '<td class="text-end">' + (data.extrud > 0 ? currencyFormatter(data.extrud) : '-') + '</td>' +
                    '<td class="text-end">' + (data.send > 0 ? currencyFormatter(data.send) : '-') + '</td>' +
                    '<td class="text-end">' + (data.before_send > 0 ? currencyFormatter(data.before_send) : '-') + '</td>' +
                    '<td class="text-end">' + (data.before_production > 0 ? currencyFormatter(data.before_production) : '-') + '</td>' +
                    '</tr>';
            }
        });

        $(_contentTableList2 + " tbody").html(view);
    }
</script>
@endpush