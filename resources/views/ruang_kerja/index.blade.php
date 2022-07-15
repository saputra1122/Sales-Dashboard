@extends('layouts.app_template')
@section('content')
<div class="row row-deck row-cards">
    <div class="col-md-2">
        <div class="card shadow-none border-0 rounded-10" style="background: none !important;">
            <div class="card-body px-0">
                <div class="d-flex align-items-center">
                    <div class="input-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="On-Going">
                        <span class="input-icon-addon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="15" cy="15" r="4"></circle>
                                <path d="M18.5 18.5l2.5 2.5"></path>
                                <path d="M4 6h16"></path>
                                <path d="M4 12h4"></path>
                                <path d="M4 18h4"></path>
                            </svg>
                        </span>
                        <input type="text" value="" class="form-control rounded-10" placeholder="Search">
                    </div>
                    <div class="ms-3">
                        <span onclick="collectionAdd()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h2 m-0 cursor-pointer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="9" y1="12" x2="15" y2="12"></line>
                                <line x1="12" y1="9" x2="12" y2="15"></line>
                                <path d="M4 6v-1a1 1 0 0 1 1 -1h1m5 0h2m5 0h1a1 1 0 0 1 1 1v1m0 5v2m0 5v1a1 1 0 0 1 -1 1h-1m-5 0h-2m-5 0h-1a1 1 0 0 1 -1 -1v-1m0 -5v-2m0 -5"></path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="pt-3" id="list-collection">
                    @foreach($collection as $val)
                    <div class="px-2 py-2 d-flex hover-shadow-primary align-items-center" onclick="window.open('{{ $val->url }}', '_self')">
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="9 6 15 12 9 18"></polyline>
                            </svg>
                        </span>
                        <span class="fw-bold">
                            {{ $val->created_at }}
                        </span>
                        @if($val->live == 1)
                        <span class="status-dot status-red status-dot-animated ms-3"></span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card shadow-none border-0" style="background: none !important;">
            <div class="card-body px-0 ps-lg-3">
                <div class="mb-3 d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 icon-tabler icon-tabler-box-multiple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="7" y="3" width="14" height="14" rx="2"></rect>
                            <path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2"></path>
                        </svg>
                        <h2 class="m-0">{{ $header->created_at }}</h2>
                        <span class="status status-red ms-3" id="live-span" style="display: <?= $header->live == 1 ? 'block' : 'none' ?>;">
                            <span class="status-dot status-dot-animated"></span>
                            Live
                        </span>
                    </div>
                    <div>
                        <span class="btn bg-blue-lt me-3" onclick="headerOnsave()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                <polyline points="7 9 12 4 17 9"></polyline>
                                <line x1="12" y1="4" x2="12" y2="16"></line>
                            </svg>
                            Save
                        </span>
                        <span class="btn bg-red-lt" onclick="headerOnShow()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 icon-tabler icon-tabler-presentation-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 12v-4"></path>
                                <path d="M15 12v-2"></path>
                                <path d="M12 12v-1"></path>
                                <path d="M3 4h18"></path>
                                <path d="M4 4v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-10"></path>
                                <path d="M12 16v4"></path>
                                <path d="M9 20h6"></path>
                            </svg>
                            Show
                        </span>
                    </div>
                </div>
                <div class="card">
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
                                    <td class="{{ $val->position > 0 ? 'ps-3' : 'fw-bold' }}" data-type="text" data-editing="false" data-column="operating" onclick="contentRowClick(this)">{!! $val->operating !!}</td>
                                    <td class="text-end" data-type="currency" data-editing="true" data-column="target" onclick="contentRowClick(this)">{{ App\Models\GlobalModel::currencyFormatter($val->target) }}</td>
                                    <td class="text-end" data-type="currency" data-editing="true" data-column="value" onclick="contentRowClick(this)">{{ App\Models\GlobalModel::currencyFormatter($val->value) }}</td>
                                    <td class="text-center" data-type="percen" data-editing="false" onclick="contentRowClick(this)">{{ $val->target > 0 ? round(($val->value / $val->target) * 100) : 0 }}%</td>
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
    </div>
</div>
@endsection
@push('script')
<!-- Collection -->
<script>
    // Data
    let _collection = <?= json_encode($collection) ?>;
    // Data View Element
    let _collectionList = '#list-collection';
    // AddButton
    const collectionAdd = () => {
        let id = _collection.length > 0 ? (_collection[0].id + 1) : 1;
        let obj = {
            title: "New Report",
            live: false,
        };


        collectionCreate(obj);
    }

    const collectionDraw = (array) => {
        let view = '';
        $(_collectionList).empty();
        $.each(array, function(i, row) {
            let statusLive = row.live == 1 ? '<span class="status-dot status-red status-dot-animated ms-3"></span>' : '';
            view += '<div class="px-2 py-2 d-flex hover-shadow-primary align-items-center" onclick="window.open(\'' + row.url + '\', \'' + '_self' + '\')">' +
                '<span class="me-2">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' +
                '<polyline points="9 6 15 12 9 18"></polyline>' +
                '</svg>' +
                '</span>' +
                '<span class="fw-bold">' +
                row.created_at +
                '</span>' +
                statusLive +
                '</div>';
        });

        $(_collectionList).html(view);
    }

    const collectionCreate = (data) => {
        uploadDataServer({
            url: url + '/header_report_target/create',
            data: data,
            onSuccess: function(response) {
                console.log(response);
                _collection.unshift(response);
                collectionDraw(_collection);
            }
        });
    }
</script>
@endpush
@push('script')
<!-- Content -->
<script>
    // Data
    let _content = <?= json_encode($content->result) ?>;
    // Data View element
    let _contentTableList = '#content-table-list';
    // Row On Click
    const contentRowClick = (event) => {
        // get atribut data in row
        let periusValue = $(event).html();
        let dataColumn = $(event).data('column');
        let cellEditing = $(event).data('editing');
        let typeData = $(event).data('type');

        let inputView = '<input type="text" class="form-control p-0 border-0 shadow-none w-100" name="example-text-input" onblur="contentOnBlurInput(this, \'' + dataColumn + '\', \'' + typeData + '\')">';

        if (periusValue != inputView && cellEditing) {
            $(event).html(inputView);
            $('input[name=example-text-input]').val(setTypeDataToArray(typeData, periusValue));
            $('input[name=example-text-input]').focus();
            $('input[name=example-text-input]').keypress(function(event) {
                if (event.key === 'Enter') {
                    contentOnBlurInput(this, dataColumn, typeData, true);
                }
            });
        }
    };

    const contentOnBlurInput = (event, dataColumn, type = 'text', next = false) => {
        // Get TR parent from td
        let value = $(event).val() == '' ? 0 : $(event).val();
        let parent = $(event).parent();

        // Set array
        let id = parent.parent().data('id'); //get ID
        let dataIndex = _content.findIndex((x) => x.id == id);
        _content[dataIndex][dataColumn] = setTypeDataToArray(type, value);

        // Set View
        parent.html(setTypeData(type, value)); //Set Value
        contentDrawRows(id);


        try {
            if (next) {
                contentRowClick($(_contentTableList + ' tr[data-id="' + _content[dataIndex + 1].id + '"] td[data-column="' + dataColumn + '"]'));
            }
        } catch (error) {}

    }

    const contentDrawRows = (id) => {
        // Get data in array
        let data = _content.find((x) => x.id == id);
        // Set position and idx
        let position = data.position > 0 ? 'ps-3' : 'fw-bold';
        let idx = data.target > 0 ? Math.round((data.value / data.target) * 100) : 0;
        idx = idx + '%';
        // Set view to variable
        let view = '<td class="' + position + '" data-type="text" data-editing="false" data-column="operating" onclick="contentRowClick(this)">' + data.operating + '</td>' +
            '<td class="text-end" data-type="currency" data-editing="true" data-column="target" onclick="contentRowClick(this)">' + currencyFormatter(data.target) + '</td>' +
            '<td class="text-end" data-type="currency" data-editing="true" data-column="value" onclick="contentRowClick(this)">' + currencyFormatter(data.value) + '</td>' +
            '<td class="text-center" data-type="percen" data-editing="false">' + idx + '</td>';
        // Set view to show
        $(_contentTableList + ' tr[data-id="' + id + '"]').html(view);
        // update total
        contentCountTotal()
    }

    const contentCountTotal = () => {
        let target = 0;
        let value = 0;
        let idx = 0;

        $.each(_content, function(i, row) {
            if (row.position == 0) {
                target += row.target;
                value += row.value;
            }

        });

        idx = target > 0 ? Math.round((value / target) * 100) : 0;
        idx = idx + '%';

        $(_contentTableList + ' tfoot tr th[data-column="target"]').html(currencyFormatter(target));
        $(_contentTableList + ' tfoot tr th[data-column="value"]').html(currencyFormatter(value));
        $(_contentTableList + ' tfoot tr th[data-column="idx"]').html(idx);
    }
</script>
@endpush
@push('script')
<!-- Header -->
<script>
    // Data
    let _header = <?= json_encode($header) ?>;
    // Function on save data
    const createData = () => {
        let data = [];
        $.each(_content, function(i, row) {
            data.push({
                h_report_target_id: _header.id,
                ...row,
            });
        });

        return data;
    }

    const headerOnsave = () => {
        let data = createData();
        uploadDataServer({
            url: url + '/report_target/create',
            data: {
                data: data,
            },
            onSuccess: function(response) {
                console.log(response);
            }
        });
    }

    const headerOnShow = () => {
        let data = updateLiveCollection();
        uploadDataServer({
            url: url + '/header_report_target/live',
            data: data,
            onSuccess: function(response) {
                console.log(response);
            }
        });
    }

    const updateLiveCollection = () => {
        let collection = _collection.find((x) => x.id == _header.id);
        let data = [];
        $.each(_collection, function(i, row) {
            if (row.id == collection.id) {
                _collection[i].live = 1;
                data = _collection[i];
            } else {
                _collection[i].live = 0;
            }
        });

        $('#live-span').show();
        collectionDraw(_collection);
        return data;
    }
</script>
@endpush