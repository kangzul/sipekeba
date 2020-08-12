var containerID = $("#main-container");
var timer;
var xhr = null;
if (base_url.slice(-1) != '/') {
    base_url = base_url + "/";
}

$(document).on('focus', '.dtpicker', function () {
    var tp = $(this);
    if (tp.data().datepicker) {
        return true;
    }
    tp.datepicker({ autoclose: true, format: "dd-mm-yyyy" });
    tp.data().datepicker.show();
}).on('submit', '.submitForm', function (e) {
    e.preventDefault();
    var btn = $(this).find("button:submit");
    var link = $(this).attr("action");
    var formID = $(this).attr("id")
    var goTo = $(this).data("redirect");
    var redirect = goTo == undefined ? false : goTo;
    if (link != "") {
        if (xhr) {
            xhr.abort();
        }
        xhr = $.ajax({
            url: generateLink(link, 'save'),
            type: 'POST',
            dataType: 'json',
            data: $("#" + formID).serialize(),
            beforeSend: function () {
                btn.prop('disabled', true);
            },
            complete: function () {
                btn.prop('disabled', false);
            },
            success: function (result) {
                if (redirect) {
                    render_page(redirect, result);
                } else {
                    if (result) {
                        if (result.icon == 'success') {
                            $("#" + formID).trigger("reset");
                        }
                        Swal.fire(result);
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                let params = {
                    'icon': 'error',
                    'title': textStatus,
                    'text': errorThrown
                }
                Swal.fire(params);
            }
        })
    }
}).on("keyup", ".select2", function () {
    window.clearTimeout(timer);
    var action = $(this).data("action");
    var containerList = $(this).data("list");
    var keyword = $(this).val();
    if (keyword != "") {
        timer = setTimeout(() => {
            select2(keyword, action, containerList);
        }, 375);
    } else {
        $("#" + containerList).html("");
    }
}).on("focusout", ".select2", function () {
    var containerList = $(this).data("list");
    setTimeout(() => {
        $("#" + containerList).html("");
    }, 375);
}).on("focus", ".select2", function () {
    var action = $(this).data("action");
    var containerList = $(this).data("list");
    var keyword = $(this).val();
    if (keyword != "") {
        setTimeout(() => {
            select2(keyword, action, containerList);
        }, 375);
    }
}).on("click", ".kembali", function () {
    goPrevPage()
})

function select2(keyword, link, containerList) {
    $.post(generateLink(link, 'search'), { keyword: keyword }, function (result) {
        $("#" + containerList).html(result);
    })
}

function goPrevPage() {
    $.post(generateLink("prev-page", "main"), function (result) {
        render_page(result);
    })
}

function render_page(link, notification = false) {
    if (link != "") {
        url = generateLink(link, 'main')
        $.post(url, { 'ajax': true }, function (result) {
            if (result == '') {
                location.reload();
            } else {
                $("html").removeClass('nav-open')
                if (notification) {
                    Swal.fire(notification)
                }
                containerID.html(result);
            }
        }).fail(function (xhr, status, error) {
            let params = {
                'icon': 'error',
                'title': status,
                'text': error
            }
            Swal.fire(params);
        })
    }
}

function makedt(tableID, url, additional = false) {
    let options = {
        "ordering": false,
        "stateSave": true,
        "language": {
            "search": "Pencarian"
        },
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": generateLink(url, "table"),
            "type": "post"
        }
    };
    if (additional) {
        $.each(additional, function (ind, val) {
            options[ind] = val
        })
    }
    $('#' + tableID).addClass("table table-condensed table-striped")
        .css('width', '100%').DataTable(options);
}


function generateLink(link, utama = "api") {
    var url = "";
    if (link.split("/").length > 1) {
        url = base_url + link;
    } else {
        url = base_url + utama + "/" + link;
    }
    return url;
}

function setWaktu() {
    let months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    let myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
    let date = new Date();
    setTimeout("setWaktu()", 1000);
    let day = date.getDate();
    let month = date.getMonth();
    let thisDay = myDays[date.getDay()];
    let yy = date.getYear();
    let hours = roundUp(date.getHours())
    let minutes = roundUp(date.getMinutes())
    let seconds = roundUp(date.getSeconds())
    let year = (yy < 1000) ? yy + 1900 : yy;
    let tanggalan = thisDay + ', ' + day + ' ' + months[month] + ' ' + year + ' | ' + hours + ' : ' + minutes + ' : ' + seconds;
    $("#sekarang").html(tanggalan);
}

function roundUp(value) {
    return value < 10 ? "0" + value : value
}

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}


setWaktu()