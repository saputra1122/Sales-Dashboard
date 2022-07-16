const difference_in_days = (date1, date2) => {
    date1 = new Date(date1);
    date2 = new Date(date2);

    let diff = new Date(date2 - date1);
    let days = diff / 1000 / 60 / 60 / 24;

    return Math.floor(days);
};

// =========================================================================================================
// Picker date
const lite_picker = () => {
    let picker = new Litepicker({
        element: document.getElementById("datepicker-icon"),
        buttonText: {
            previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
            nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
        },
    });

    return picker;
};
// =========================================================================================================
// =========================================================================================================
// Open Modal
const open_modal = (target, onFucus) => {
    $(target).modal("show");
    setTimeout(function () {
        if (onFucus) {
            $(onFucus).focus();
        }
    }, 500);
};
// =========================================================================================================
// For Toast and sweetalert
const swal_loader = (message) => {
    $(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            onOpen: function () {
                swal.showLoading();
            },
        });

        Toast.fire({
            icon: false,
            background: '#fff',
            title: message,
        })
    });
}

const close_swal = (notif_status = true, message = 'Success', icon = 'success') => {
    setTimeout(function () {
        Swal.close()

        if (notif_status) {
            notif(message, icon);
        }
    }, 1000)
}

// Function for array
// ==================================
const arrayRemoveDuplicates = (array, key) => {
    var newArray = [];
    var lookupObject = {};

    for (var i in array) {
        lookupObject[array[i][key]] = array[i];
    }

    for (i in lookupObject) {
        newArray.push(lookupObject[i]);
    }
    return newArray;
}

const arrayGroupByKey = (array, key) => {
    return array
        .reduce((hash, obj) => {
            if (obj[key] === undefined) return hash;
            return Object.assign(hash, {
                [obj[key]]: (hash[obj[key]] || []).concat(obj)
            })
        }, {})
}
// ==================================

const notif = (message = '', icon = false) => {
    $(function () {
        'use strict';
        resetToastPosition();
        $.toast({
            heading: 'Notifikasi',
            text: message,
            showHideTransition: 'plain',
            position: 'top-right',
            icon: icon,
            stack: false,
            loader: false,
            loaderBg: '#57c7d4',
        })
    });
}

const resetToastPosition = () => {
    $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
    $(".jq-toast-wrap").css({
        "top": "",
        "left": "",
        "bottom": "",
        "right": ""
    }); //to remove previous position style
}

// Funtion untuk megubah warna pada icon microfon di modal task_list
// =========================================================================================================
const toggle_icon_color = (element, class_add, class_remove) => {
    $(element).addClass(class_add);
    $(element).removeClass(class_remove);
}

// Formatter and type data set
const setTypeData = (type, value) => {
    if (type == 'text') {
        value = value.toString();
    }

    if (type == 'number') {
        value = parseIntCus(value);
    }

    if (type == 'currency') {
        value = currencyFormatter(value);
    }

    if (type == 'percen') {
        value = parseInt(value) + '%';
    }

    return value;
}

const setTypeDataToArray = (type, value) => {
    if (type == 'text') {
        value = value.toString();
    }

    if (type == 'number') {
        value = parseIntCus(value);
    }

    if (type == 'currency') {
        value = parseIntCus(value);
    }

    if (type == 'percen') {
        value = parseIntCus(value);
    }

    return value == NaN ? 0 : value;
}

const parseIntCus = (value) => {
    value = value == '' ? 0 : Number(value.replace(/[^0-9.-]+/g, ""));
    return value;
}

const setTypeToInput = (type) => {
    if (type == 'text') {
        type = 'text';
    }

    if (type == 'number') {
        type = 'number';
    }

    if (type == 'currency') {
        type = 'number';
    }

    if (type == 'percen') {
        type = 'number';
    }

    return type;
}

const currencyFormatter = (number) => {
    return $.number(number, 2);
}

const dateFormatter = (date = new Date()) => {
    let month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'];
    date = firstZero(date.getDate()) + '-' + month[date.getMonth()] + '-' + date.getFullYear();

    return date;
}

const firstZero = (value) => {
    return value < 10 ? '0' + value : value;
}

// Comunicate to server
const uploadDataServer = ({ url = '', type = 'post', data = [], onSuccess }) => {
    $.ajax({
        url: url,
        type: type,
        dataType: 'json',
        data: data,
        headers: {
            'X-CSRF-TOKEN': token,
        },
        beforeSend: function () {
            swal_loader('Sedang unggah data...');
        },
        success: function (data) {
            close_swal(true, 'Berhasil unggah data', 'success');
            onSuccess(data);
        },
        error: function (error) {
            close_swal(true, 'Terjadi kesalahan saat unggah data', 'error');
            console.log(error);
        }
    });
}

const realtimeServer = ({ url = '', type = 'get', data = [], onSuccess }) => {
    $.ajax({
        url: url,
        type: type,
        dataType: 'json',
        data: data,
        headers: {
            'X-CSRF-TOKEN': token,
        },
        success: function (data) {
            onSuccess(data);
        },
        error: function (error) {
            close_swal(true, 'Terjadi kesalahan saat unggah data', 'error');
            console.log(error);
        }
    });
}

const deleteDataServer = ({ url = '', type = 'post', data = [], onSuccess }) => {
    $.ajax({
        url: url,
        type: type,
        dataType: 'json',
        data: data,
        headers: {
            'X-CSRF-TOKEN': token,
        },
        beforeSend: function () {
            swal_loader('Sedang hapus data...');
        },
        success: function (data) {
            close_swal(true, 'Berhasil hapus data', 'success');
            setTimeout(function () {
                onSuccess(data);
            }, 2500);
        },
        error: function (error) {
            close_swal(true, 'Terjadi kesalahan saat hapus data', 'error');
            console.log(error);
        }
    });
}

const logout_app = () => {
    let parent_modal = '#modal-logout';
    $(parent_modal).modal('show');

    $(parent_modal + ' #btn-logout-execute').attr('onclick', 'execute_logout()');
}

const execute_logout = () => {
    $.ajax({
        url: url + '/logout',
        type: 'post',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': token,
        },
        beforeSend: function () {
            swal_loader('Logout app...');
        },
        success: function (data) {
            location.reload();
        },
        error: function (error) {
            close_swal(true, 'Failed logout app..', 'error');
        }
    });
}
