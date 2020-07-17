/* 
 * ***************************************************************
 * Script : 
 * Version : 
 * Date :
 * Author : Pudyasto Adi W.
 * Email : mr.pudyasto@gmail.com
 * Description : 
 * ***************************************************************
 */
$(document).ready(function () {
    getData();
});

setInterval(function () {
    var tgl = moment();
    tgl.locale('id');
    var tanggal = tgl.format('DD MMMM YYYY, H:mm:ss');
    $(".date-time").html(tanggal);
}, 1000);


$("input:text").focus(function () {
    $(this).select();
});

set_controls();

$('#form-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var action_url = button.data('action-url');
    var post_id = button.data('post-id');
    var width = button.data('width');
    if (width) {
        $(".modal-dialog").css("min-width", width);
    }
    if (action_url !== undefined) {
        $.ajax({
            type: "GET",
            url: base_url(action_url),
            data: { "id": post_id },
            beforeSend: function () {
                $("#form-modal-content").html("");
            },
            success: function (resp) {
                $("#form-modal-content").html(resp);
                set_controls();
            },
            error: function (event, textStatus, errorThrown) {
                if (event.responseJSON.exception) {
                    toast('Kesalahan', event.responseJSON.exception, 'error');
                } else {
                    toast('Kesalahan', errorThrown, 'error');
                }
            }
        });
        var modal = $(this);
        modal.find('.modal-title').text(title);
    }
});

$('#form-modal').on('hidden.bs.modal', function () {
    $(".modal-dialog").css("max-width", "");
    $("#form-modal-content").html("");
});

$('#form-modal').on('shown.bs.modal', function () {
    // $('.chosen-select', this).chosen('destroy').chosen({
    //     no_results_text: "Maaf, data tidak ditemukan!"
    // });
    set_controls();
});

function set_controls() {
    $(".money").blur(function (e) {
        var v = $(this).val();
        var n = numeral(v).format('0,0');
        $(this).val(n);
    });

    $(".money").focus(function (e) {
        var v = $(this).val();
        var n = numeral(v).value();
        $(this).val(n);
    });

    $(".percent").blur(function (e) {
        var v = $(this).val();
        var n = numeral(v).format('0,0.00');
        $(this).val(n);
    });

    $(".percent").focus(function (e) {
        var v = $(this).val();
        var n = numeral(v).value();
        $(this).val(n);
    });

    $(".inch").blur(function (e) {
        var v = $(this).val();
        var n = numeral(v).format('0,0.00');
        $(this).val(n);
    });

    $(".inch").focus(function (e) {
        var v = $(this).val();
        var n = numeral(v).value();
        $(this).val(n);
    });

    $('.calendar').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    });
}

function resetNumeral() {
    $(".money").val(numeral($(".money").val()).value());
    $(".percent").val(numeral($(".money").val()).value());
    $(".inch").val(numeral($(".money").val()).value());
}

function base_url(param) {
    // window.location.origin
    var base_url = public_url + "/" + param;
    return base_url;
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function getData() {
    $.ajax({
        type: "GET",
        url: base_url('home/getData'),
        data: { "requesy": true },
        beforeSend: function () {

        },
        success: function (resp) {
            if (isJson(resp)) {
                var obj = jQuery.parseJSON(resp);
                $(".full_name").html(obj.full_name);
                $(".birth_year").html(obj.birth_year);
                $(".birth").html(obj.birth);
                $(".phone").html(obj.phone);
                $(".email").html(obj.email);

                $(".linkedin").html(obj.linkedin);
                $(".instagram").html(obj.instagram);
                $(".facebook").html(obj.facebook);
                $(".twitter").html(obj.twitter);

                $(".quotes").html(obj.quotes);
                $(".about_me").html(obj.about_me);
                $(".photo-profile").attr("src", obj.photo);
            }
        },
        error: function (event, textStatus, errorThrown) {
            toast(textStatus, errorThrown, 'error');
        }
    });
}

function toast(message, title, typemessage) {
    if (!typemessage) {
        typemessage = "info";
    }
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr[typemessage](title, message);
}

function data_terbilang(bilangan) {
    if (bilangan === "" || Number(bilangan) <= 0 || bilangan === undefined || isNaN(bilangan)) {
        return "Nol Rupiah";
    }

    bilangan = String(bilangan);
    var angka = new Array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
    var kata = new Array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
    var tingkat = new Array('', 'Ribu', 'Juta', 'Milyar', 'Triliun');

    var panjang_bilangan = bilangan.length;

    /* pengujian panjang bilangan */
    if (panjang_bilangan > 15) {
        kaLimat = "Diluar Batas";
        return kaLimat;
    }

    /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
    for (i = 1; i <= panjang_bilangan; i++) {
        angka[i] = bilangan.substr(-(i), 1);
    }

    i = 1;
    j = 0;
    kaLimat = "";


    /* mulai proses iterasi terhadap array angka */
    while (i <= panjang_bilangan) {

        subkaLimat = "";
        kata1 = "";
        kata2 = "";
        kata3 = "";

        /* untuk Ratusan */
        if (angka[i + 2] != "0") {
            if (angka[i + 2] == "1") {
                kata1 = "Seratus";
            } else {
                kata1 = kata[angka[i + 2]] + " Ratus";
            }
        }

        /* untuk Puluhan atau Belasan */
        if (angka[i + 1] != "0") {
            if (angka[i + 1] == "1") {
                if (angka[i] == "0") {
                    kata2 = "Sepuluh";
                } else if (angka[i] == "1") {
                    kata2 = "Sebelas";
                } else {
                    kata2 = kata[angka[i]] + " Belas";
                }
            } else {
                kata2 = kata[angka[i + 1]] + " Puluh";
            }
        }

        /* untuk Satuan */
        if (angka[i] != "0") {
            if (angka[i + 1] != "1") {
                kata3 = kata[angka[i]];
            }
        }

        /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
        if ((angka[i] != "0") || (angka[i + 1] != "0") || (angka[i + 2] != "0")) {
            subkaLimat = kata1 + " " + kata2 + " " + kata3 + " " + tingkat[j] + " ";
        }

        /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
        kaLimat = subkaLimat + kaLimat;
        i = i + 3;
        j = j + 1;

    }

    /* mengganti Satu Ribu jadi Seribu jika diperlukan */
    if ((angka[5] == "0") && (angka[6] == "0")) {
        kaLimat = kaLimat.replace("Satu Ribu", "Seribu");
    }

    return kaLimat + "Rupiah";
}

function set_date(tahun, bulan, hari) {
    var tahun_awal = tahun;
    var bulan_awal = bulan;
    var hari_awal = hari;
    if (Number(bulan) >= 12) {
        tahun = (Number(bulan) / 12).toFixed(0);
        bulan = Number(bulan) - 12;
    }
    var d = new Date();

    if (Number(tahun) > d.getFullYear()) {
        tahun = 0;
    }

    if (!(bulan)) {
        bulan = d.getMonth() + 1;
    } else if (Number(bulan) === 0 && isNaN(bulan) === false) {
        bulan = d.getMonth() + 1;
    } else if (Number(bulan) > 0 && isNaN(bulan) === false) {
        bulan = ((d.getMonth() + 1) - Number(bulan));
    } else if (Number(bulan) > 12 && isNaN(bulan) === false) {
        bulan = 12;
    } else {
        bulan = 12;
    }

    if (bulan === 0) {
        bulan = Number(bulan_awal);
    } else if (bulan < 0) {
        bulan = (Number(bulan_awal) + bulan) + 1;
        tahun = Number(tahun) + 1;
    }

    if (!(hari)) {
        hari = d.getDate();
    } else if (Number(hari) === 0 && isNaN(bulan) === false) {
        hari = d.getDate();
    } else if (Number(hari) > 0 && isNaN(bulan) === false) {
        hari = d.getDate() - Number(hari);
    } else if (Number(hari) > 31 && isNaN(bulan) === false) {
        hari = 31;
    } else {
        hari = 31;
    }

    if (hari === 0) {
        hari = Number(hari_awal);
    } else if (hari < 0) {
        hari = Number(hari_awal) + hari;
        bulan = Number(bulan) + 1;
    }


    var res = d.setFullYear(d.getFullYear() - Number(tahun));
    var newyear = new Date(res);
    var resdate = zero_fill(Number(hari), "00") + "-" + zero_fill(Number(bulan), "00") + "-" + zero_fill(newyear.getFullYear(), "0000");
    //    console.log(resdate);
    return resdate;
}

function zero_fill(number, pad) {
    var str = "" + number;
    var res = pad.substring(0, pad.length - str.length) + "" + str;
    return res;
}

var substringMatcher = function (strs) {
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function (i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};

// load a locale
numeral.register('locale', 'id', {
    delimiters: {
        thousands: ',',
        decimal: '.'
    },
    abbreviations: {
        thousand: 'k',
        million: 'm',
        billion: 'b',
        trillion: 't'
    },
    ordinal: function (number) {
        return number === 1 ? 'Rp.' : '-';
    },
    currency: {
        symbol: 'Rp.'
    }
});

// switch between locales
numeral.locale('id');

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getRandomColorRGB() {
    var code1 = Math.floor(Math.random() * 256);
    var code2 = Math.floor(Math.random() * 256);
    var code3 = Math.floor(Math.random() * 256);
    var color = 'rgb(' + code1 + ',' + code2 + ',' + code3 + ')';
    return color;
}

var bulan = ["Nama Bulan", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var bulan_short = ["Nama Bulan", "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Agt", "Sept", "Oct", "Nov", "Dec"];

function tgl_id_short(param) {
    if (param === null || param === "") {
        return "";
    }
    var yyyy = param.substring(0, 4);
    var mm = param.substring(5, 7);
    var dd = param.substring(8, 10);
    var hh = param.substring(10, 20);
    return dd + " " + bulan_short[Number(mm)] + " " + yyyy + " " + hh;
}

function tgl_id_long(param) {
    if (param === null || param === "") {
        return "";
    }
    var yyyy = param.substring(0, 4);
    var mm = param.substring(5, 7);
    var dd = param.substring(8, 10);
    var hh = param.substring(10, 20);
    return dd + " " + bulan[Number(mm)] + " " + yyyy + " " + hh;
}

function month_id_long(param) {
    if (param === null || param === "") {
        return "";
    }
    var yyyy = param.substring(3, 7);
    var mm = param.substring(0, 2);
    return bulan[Number(mm)] + " " + yyyy;
}

function month_year_id_long(param) {
    if (param === null || param === "") {
        return "";
    }
    var yyyy = param.substring(0, 4);
    var mm = param.substring(5, 7);
    return bulan[Number(mm)] + " " + yyyy;
}

function money_id(param) {
    if (param < 0) {
        return "(" + numeral(Math.abs(param.toString())).format('0,0') + ")";
    } else {
        return numeral(param).format('0,0');
    }
}

function formatResult(data) {
    if (data.loading) {
        return data.text;
    }

    var $container = $(
        "<div class='clearfix'>" +
        "<div>" + data.text + "</div>" +
        "</div>"
    );

    return $container;
}

function formatSelection(data) {
    return data.text;
}

function disabled() {
    $(".btn").attr("disabled", true);
}

function enabled() {
    $(".btn").attr("disabled", false);
}