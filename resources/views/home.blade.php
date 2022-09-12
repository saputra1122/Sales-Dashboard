@extends('layouts.app_template')
@section('content')
<div class="row row-deck row-cards">
    <div class="col-md-8">
        <div class="card card-md rounded-20">
            <div class="card-body p-0">
                <div class="card rounded-20 border-0">
                    <div class="table-responsive rounded-20">
                        <table class="table-custom" id="content-table-list">
                            <thead class="">
                                <tr>
                                    <th colspan="7" class="text-end">Time Gone : {{ round((Carbon\Carbon::make($header->created_at)->format('d') / Carbon\Carbon::make(Carbon\Carbon::now()->endOfMonth()->toDateString())->format('d')) * 100) }}%</th>
                                </tr>
                                <tr>
                                    <th>Operating Company</th>
                                    <th width="10%">Target</th>
                                    <th width="10%">Actual</th>
                                    <th width="10%">IDX</th>
                                    <th width="10%">Target AR</th>
                                    <th width="10%">Actual AR Up To {{ Carbon\Carbon::make($header->created_at)->isoFormat('MMM YY') }}</th>
                                    <th>IDX</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($content->result as $val)
                                <?php if ($val->position >= 0) : ?>
                                    <?php if ($val->disable != 1) : ?>
                                        <tr class="hover-shadow-primary cursor-text" data-id="{{ $val->id }}">
                                            <td class="{{ $val->position > 0 ? 'ps-3' : 'fw-bold' }}">{!! $val->operating !!}</td>
                                            <td class="text-end {{ $val->position == 0 ? 'fw-bold' : '' }}">{{ $val->target > 0 ? App\Models\GlobalModel::currencyFormatter($val->target) : '-' }}</td>
                                            <td class="text-end {{ $val->position == 0 ? 'fw-bold' : '' }}">{{ $val->value > 0 ? App\Models\GlobalModel::currencyFormatter($val->value) : '-' }}</td>
                                            <td class="text-center {{ $val->position == 0 ? 'fw-bold' : '' }}">{{ $val->target > 0 ? round(($val->value / $val->target) * 100) . '%' : '-' }}</td>
                                            <td class="text-end {{ $val->position == 0 ? 'fw-bold' : '' }}">{{ $val->target_ar > 0 ? App\Models\GlobalModel::currencyFormatter($val->target_ar) : '-' }}</td>
                                            <td class="text-end {{ $val->position == 0 ? 'fw-bold' : '' }}">{{ $val->value_ar > 0 ? App\Models\GlobalModel::currencyFormatter($val->value_ar) : '-' }}</td>
                                            <td class="text-center {{ $val->position == 0 ? 'fw-bold' : '' }}">{{ $val->target_ar ?? 0 > 0 ? round(($val->value_ar / $val->target_ar) * 100) . '%' : '-' }}</td>
                                        </tr>
                                    <?php else : ?>
                                        <tr class="hover-shadow-primary cursor-text" data-id="{{ $val->id }}">
                                            <td class="{{ $val->position > 0 ? 'ps-4' : 'fw-bold' }}" colspan="7">{!! $val->operating !!}</td>
                                        </tr>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if ($val->position < 0) : ?>
                                    <tr class="hover-shadow-primary cursor-text bg-dark-lt" data-id="{{ $val->id }}">
                                        <th class="text-start" data-type="text" data-column="operating">{!! $val->operating !!}</th>
                                        <th class="text-end" data-type="currency" data-column="target">{{ App\Models\GlobalModel::currencyFormatter($val->target) }}</th>
                                        <th class="text-end" data-type="currency" data-column="value">{{ App\Models\GlobalModel::currencyFormatter($val->value) }}</th>
                                        <th class="text-center" data-type="percen" data-column="idx">{{ $val->target > 0 ? round(($val->value / $val->target) * 100) : 0 }}%</th>
                                        <th class="text-end" data-type="currency" data-column="target_ar">{{ App\Models\GlobalModel::currencyFormatter($val->target_ar ?? 0) }}</th>
                                        <th class="text-end" data-type="currency" data-column="value_ar">{{ App\Models\GlobalModel::currencyFormatter($val->value_ar ?? 0) }}</th>
                                        <th class="text-center" data-type="percen" data-column="idx_ar">{{ $val->target_ar ?? 0 > 0 ? round(($val->value_ar / $val->target_ar) * 100) : 0 }}%</th>
                                    </tr>
                                <?php endif ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 px-4 d-inline">
        <div>
            <span class="status status-red">
                <span class="status-dot status-dot-animated"></span>
                Live
            </span>
        </div>
        <div class="fw-bold h2 mt-4">
            Data Monitoring Live Public
        </div>
        <div class="small text-muted d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 icon-tabler icon-tabler-live-photo" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="12" cy="12" r="1"></circle>
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="15.9" y1="20.11" x2="15.9" y2="20.12"></line>
                <line x1="19.04" y1="17.61" x2="19.04" y2="17.62"></line>
                <line x1="20.77" y1="14" x2="20.77" y2="14.01"></line>
                <line x1="20.77" y1="10" x2="20.77" y2="10.01"></line>
                <line x1="19.04" y1="6.39" x2="19.04" y2="6.4"></line>
                <line x1="15.9" y1="3.89" x2="15.9" y2="3.9"></line>
                <line x1="12" y1="3" x2="12" y2="3.01"></line>
                <line x1="8.1" y1="3.89" x2="8.1" y2="3.9"></line>
                <line x1="4.96" y1="6.39" x2="4.96" y2="6.4"></line>
                <line x1="3.23" y1="10" x2="3.23" y2="10.01"></line>
                <line x1="3.23" y1="14" x2="3.23" y2="14.01"></line>
                <line x1="4.96" y1="17.61" x2="4.96" y2="17.62"></line>
                <line x1="8.1" y1="20.11" x2="8.1" y2="20.12"></line>
                <line x1="12" y1="21" x2="12" y2="21.01"></line>
            </svg>
            {{ Carbon\Carbon::make($header->created_at)->format('d-M-Y') }}
        </div>
        <div class="d-flex align-items-center mt-3">
            <span class="btn rounded-10 me-2" onclick="window.open('<?= route('live') ?>', '_target')">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart-rate-monitor" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="3" y="4" width="18" height="12" rx="1"></rect>
                    <path d="M7 20h10"></path>
                    <path d="M9 16v4"></path>
                    <path d="M15 16v4"></path>
                    <path d="M7 10h2l2 3l2 -6l1 3h3"></path>
                </svg>
                Open Live
            </span>
            <span class="btn rounded-10" onclick="copyLink('<?= route('live', ['link' => 'share']) ?>')">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5"></path>
                    <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5"></path>
                </svg>
                Copy Link
            </span>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function copyLink(copyText) {
        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText);
        notif('Copied');
    }
</script>
@endpush