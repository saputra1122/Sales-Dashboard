<div class="card card-md font-responsive px-4 py-3 shadow-none border-0">
    <div class="card-body p-0">
        <div class="d-flex align-items-center mb-2">
            <img src="{{ asset('assets/pus_dist/img/logo.png') }}" alt="logo" style="width: 2%;" class="me-2">
            <h1 class="font-responsive">HKMU GROUP MONITORING DASHBOARD - MTD <span class="date-header">{{ strtoupper(Carbon\Carbon::make($header->created_at)->format('d-M-Y')) }}</span></h1>
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
                <table class="table-custom" id="content-table-list">
                    <thead class="">
                        <tr class="bg-orange-lt-cs">
                            <th colspan="7" class="text-end">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        Last Update : <span class="last-updated">{{ strtoupper(Carbon\Carbon::make($content->result[0]->updated_at ?? '00:00:00')->format('H:i:s')) }}</span>
                                    </div>
                                    <div>
                                        TIME GONE : <span class="time-gone-data">{{ round((Carbon\Carbon::make($header->created_at)->format('d') / Carbon\Carbon::make(Carbon\Carbon::parse($header->created_at)->endOfMonth()->toDateString())->format('d')) * 100) }}</span>%
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="bg-orange-lt-cs">
                            <th rowspan="2">OPERATING COMPANY</th>
                            <th colspan="6" class="text-center">SECONDARY</th>
                        </tr>
                        <tr class="bg-orange-lt-cs">
                            <th width="10%">TARGET</th>
                            <th width="11%">ACTUAL</th>
                            <th width="10%">IDX</th>
                            <th width="10%" class="bg-orange-cs">TARGET AR</th>
                            <th width="11%" class="bg-orange-cs text-uppercase">ACTUAL AR UP TO {{ Carbon\Carbon::make($header->created_at)->isoFormat('MMM YY') }}</th>
                            <th class="bg-orange-cs">IDX</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($content->result as $val)
                        <?php if ($val->position >= 0) : ?>
                            <?php if ($val->disable != 1) : ?>
                                <tr class="hover-shadow-primary cursor-text" data-id="{{ $val->id }}">
                                    <td class="{{ $val->position > 0 ? 'ps-4' : 'fw-bolder bg-dark-lt' }}">{!! $val->operating !!}</td>
                                    <td class="text-end {{ $val->position == 0 ? 'fw-bolder bg-dark-lt' : '' }}">{{ $val->target > 0 ? App\Models\GlobalModel::currencyFormatter($val->target) : '-' }}</td>
                                    <td class="text-end {{ $val->position == 0 ? 'fw-bolder bg-dark-lt' : '' }}">
                                        @if($val->indicator == '1')
                                        <span class="text-teal float-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="18" y1="11" x2="12" y2="5"></line>
                                                <line x1="6" y1="11" x2="12" y2="5"></line>
                                            </svg>
                                        </span>
                                        @endif @if($val->indicator == '2')
                                        <span class="text-danger float-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="18" y1="13" x2="12" y2="19"></line>
                                                <line x1="6" y1="13" x2="12" y2="19"></line>
                                            </svg>
                                        </span>
                                        @endif
                                        {{ $val->value > 0 ? App\Models\GlobalModel::currencyFormatter($val->value) : '-' }}
                                    </td>
                                    <td class="text-center {{ $val->position == 0 ? 'fw-bolder bg-dark-lt' : '' }}">
                                        <span class="position-absolute">{{ $val->target > 0 && round(($val->value / $val->target) * 100) > 0 ? round(($val->value / $val->target) * 100) . '%' : '-' }}</span>
                                        <div class="progress-col">
                                            <div class="progress-bar-col" style="width: <?= App\Models\GlobalModel::count_percent($val->value, $val->target) ?>">
                                                <span>.</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end {{ $val->position == 0 ? 'fw-bolder' : '' }} bg-success-lt-cs">{{ $val->target_ar > 0 ? App\Models\GlobalModel::currencyFormatter($val->target_ar) : '-' }}</td>
                                    <td class="text-end {{ $val->position == 0 ? 'fw-bolder' : '' }} bg-success-lt-cs">
                                        @if($val->indicator_ar == '1')
                                        <span class="text-teal float-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="18" y1="11" x2="12" y2="5"></line>
                                                <line x1="6" y1="11" x2="12" y2="5"></line>
                                            </svg>
                                        </span>
                                        @endif @if($val->indicator_ar == '2')
                                        <span class="text-danger float-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="18" y1="13" x2="12" y2="19"></line>
                                                <line x1="6" y1="13" x2="12" y2="19"></line>
                                            </svg>
                                        </span>
                                        @endif
                                        {{ $val->value_ar > 0 ? App\Models\GlobalModel::currencyFormatter($val->value_ar) : '-' }}
                                    </td>
                                    <td class="text-center {{ $val->position == 0 ? 'fw-bolder' : '' }} bg-success-lt-cs">
                                        <span class="position-absolute">{{ $val->target_ar > 0 && round(($val->value_ar / $val->target_ar) * 100) > 0 ? round(($val->value_ar / $val->target_ar) * 100) . '%' : '-' }}</span>
                                        <div class="progress-col">
                                            <div class="progress-bar-col" style="width: <?= App\Models\GlobalModel::count_percent($val->value_ar, $val->target_ar) ?>">
                                                <span>.</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php else : ?>
                                <tr class="hover-shadow-primary cursor-text" data-id="{{ $val->id }}">
                                    <td class="{{ $val->position > 0 ? 'ps-4' : 'fw-bolder' }}" colspan="7">{!! $val->operating !!}</td>
                                </tr>
                            <?php endif ?>
                        <?php endif ?>
                        <?php if ($val->position < 0) : ?>
                            <tr class="hover-shadow-primary cursor-text bg-orange-lt-cs" data-id="{{ $val->id }}">
                                <th class="text-start">{!! $val->operating !!}</th>
                                <th class="text-end">{{ App\Models\GlobalModel::currencyFormatter($val->target) }}</th>
                                <th class="text-end">
                                    @if($val->indicator == '1')
                                    <span class="text-teal float-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="18" y1="11" x2="12" y2="5"></line>
                                            <line x1="6" y1="11" x2="12" y2="5"></line>
                                        </svg>
                                    </span>
                                    @endif @if($val->indicator == '2')
                                    <span class="text-danger float-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="18" y1="13" x2="12" y2="19"></line>
                                            <line x1="6" y1="13" x2="12" y2="19"></line>
                                        </svg>
                                    </span>
                                    @endif
                                    {{ App\Models\GlobalModel::currencyFormatter($val->value) }}
                                </th>
                                <th class="text-center">
                                    <span class="position-absolute">{{ App\Models\GlobalModel::count_percent($val->value, $val->target) != '0%' ? App\Models\GlobalModel::count_percent($val->value, $val->target) : '-' }}</span>
                                    <div class="progress-col">
                                        <div class="progress-bar-col" style="width: <?= App\Models\GlobalModel::count_percent($val->value, $val->target) ?>">
                                            <span>.</span>
                                        </div>
                                    </div>
                                </th>
                                <th class="text-end">{{ App\Models\GlobalModel::currencyFormatter($val->target_ar ?? 0) }}</th>
                                <th class="text-end">
                                    @if($val->indicator_ar == '1')
                                    <span class="text-teal float-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="18" y1="11" x2="12" y2="5"></line>
                                            <line x1="6" y1="11" x2="12" y2="5"></line>
                                        </svg>
                                    </span>
                                    @endif @if($val->indicator_ar == '2')
                                    <span class="text-danger float-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="18" y1="13" x2="12" y2="19"></line>
                                            <line x1="6" y1="13" x2="12" y2="19"></line>
                                        </svg>
                                    </span>
                                    @endif
                                    {{ App\Models\GlobalModel::currencyFormatter($val->value_ar ?? 0) }}
                                </th>
                                <th class="text-center">
                                    <span class="position-absolute">{{ App\Models\GlobalModel::count_percent($val->value_ar, $val->target_ar) != '0%' ? App\Models\GlobalModel::count_percent($val->value_ar, $val->target_ar) : '-' }}</span>
                                    <div class="progress-col">
                                        <div class="progress-bar-col" style="width: <?= App\Models\GlobalModel::count_percent($val->value_ar, $val->target_ar) ?>">
                                            <span>.</span>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        <?php endif ?>
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
    let _contentTableList = '#content-table-list';
    const responseContent = (response) => {
        var date = new Date(),
            y = date.getFullYear(),
            m = date.getMonth();
        var day = new Date(response['header'].created_at).getDate();
        var lastDay = new Date(y, m + 1, 0).getDate();
        // console.log(response);
        // Set header
        $('.date-header').html('<span class="text-uppercase">' + dateFormat(response['header'].created_at) + '</span>');
        $('.last-updated').html('<span class="text-uppercase">' + response['content']['result'][0].last_update + '</span>');
        $('.time-gone-data').html(Math.round((day / lastDay) * 100));
        drawContent(response['content']['result']);
    }

    const drawContent = (array) => {
        let view = '';
        $(_contentTableList + " tbody").empty();
        $.each(array, function(i, data) {
            let position = data.position > 0 ? 'ps-4' : 'fw-bolder';
            let bg_cell = data.position > 0 ? '' : 'bg-dark-lt';
            let parentPosition = data.position == 0 ? 'fw-bolder bg-dark-lt' : '';
            let idx = data.target > 0 && Math.round((data.value / data.target) * 100) > 0 ? Math.round((data.value / data.target) * 100) + '%' : '-';
            let idx_ar = data.target_ar > 0 && Math.round((data.value_ar / data.target_ar) * 100) > 0 ? Math.round((data.value_ar / data.target_ar) * 100) + '%' : '-';


            if (data.position >= 0) {
                if (data.disable != 1) {
                    view += '<tr class="hover-shadow-primary cursor-text" data-id="' + data.id + '">' +
                        '<td class="' + position + ' ' + bg_cell + '">' + data.operating + '</td>' +
                        '<td class="text-end ' + parentPosition + '">' + (data.target > 0 ? currencyFormatter(data.target) : '-') + '</td>' +
                        '<td class="text-end ' + parentPosition + '">' + indicator_view(data.indicator) + ' ' + (data.value > 0 ? currencyFormatter(data.value) : '-') + '</td>' +
                        '<td class="text-center ' + parentPosition + '">' +
                        '<span class="position-absolute">' + idx + '</span>' +
                        '<div class="progress-col">' +
                        '<div class="progress-bar-col" style="width: ' + count_percent(data.value, data.target) + '">' +
                        '<span>.</span>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td class="text-end ' + parentPosition + ' bg-success-lt-cs">' + (data.target_ar > 0 ? currencyFormatter(data.target_ar) : '-') + '</td>' +
                        '<td class="text-end ' + parentPosition + ' bg-success-lt-cs">' + indicator_view(data.indicator_ar) + ' ' + (data.value_ar > 0 ? currencyFormatter(data.value_ar) : '-') + '</td>' +
                        '<td class="text-center ' + parentPosition + ' bg-success-lt-cs">' +
                        '<span class="position-absolute">' + idx_ar + '</span>' +
                        '<div class="progress-col">' +
                        '<div class="progress-bar-col" style="width: ' + count_percent(data.value_ar, data.target_ar) + '">' +
                        '<span>.</span>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';
                } else {
                    view += '<tr class="hover-shadow-primary cursor-text" data-id="' + data.id + '">' +
                        '<td class="' + (data.position > 0 ? 'ps-4' : 'fw-bolder') + '" colspan="7">' + data.operating + '</td>' +
                        '</tr>';
                }
            }

            if (data.position < 0) {
                view += '<tr class="hover-shadow-primary bg-orange-lt-cs cursor-text" data-id="' + data.id + '">' +
                    '<th class="text-start">' + data.operating + '</th>' +
                    '<th class="text-end">' + currencyFormatter(data.target) + '</th>' +
                    '<th class="text-end">' + ' ' + indicator_view(data.indicator) + currencyFormatter(data.value) + '</th>' +
                    '<th class="text-center">' +
                    '<span class="position-absolute">' + idx + '</span>' +
                    '<div class="progress-col">' +
                    '<div class="progress-bar-col" style="width: ' + count_percent(data.value, data.target) + '">' +
                    '<span>.</span>' +
                    '</div>' +
                    '</div>' +
                    '</th>' +
                    '<th class="text-end">' + currencyFormatter(data.target_ar) + '</th>' +
                    '<th class="text-end">' + ' ' + indicator_view(data.indicator_ar) + currencyFormatter(data.value_ar) + '</th>' +
                    '<th class="text-center">' +
                    '<span class="position-absolute">' + idx_ar + '</span>' +
                    '<div class="progress-col">' +
                    '<div class="progress-bar-col" style="width: ' + count_percent(data.value_ar, data.target_ar) + '">' +
                    '<span>.</span>' +
                    '</div>' +
                    '</div>' +
                    '</th>' +
                    '</tr>';
            }
        });

        $(_contentTableList + " tbody").html(view);
    }

    const indicator_view = (indicator) => {
        let view = '';
        if (indicator == 1) {
            view = '<span class="text-teal float-start">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' +
                '<line x1="12" y1="5" x2="12" y2="19"></line>' +
                '<line x1="18" y1="11" x2="12" y2="5"></line>' +
                '<line x1="6" y1="11" x2="12" y2="5"></line>' +
                '</svg>' +
                '</span>';
        }

        if (indicator == 2) {
            view = '<span class="text-danger float-start">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="py-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' +
                '<line x1="12" y1="5" x2="12" y2="19"></line>' +
                '<line x1="18" y1="13" x2="12" y2="19"></line>' +
                '<line x1="6" y1="13" x2="12" y2="19"></line>' +
                '</svg>' +
                '</span>';
        }

        return view;
    }
</script>
@endpush