<?php
if (!function_exists('datetime_id')) {
    function datetime_id($datetime)
    {
        // formate date : YYYY-MM-DD HH:II:SS
        $yyyy = substr($datetime, 0, 4);
        $mm = substr($datetime, 5, 2);
        $dd = substr($datetime, 8, 2);
        $time = substr($datetime, 11, 8);
        $bulan = array(
            '',
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        );

        if ($mm == 0 || is_numeric($mm) == false) {
            return null;
        } elseif ($mm <= 12) {
            return $dd . " " . $bulan[(int) $mm] . " " . $yyyy . " " . $time;
        } else {
            return null;
        }
    }
}

if (!function_exists('datetime_short_id')) {
    function datetime_short_id($datetime)
    {
        // formate date : YYYY-MM-DD HH:II:SS
        $yyyy = substr($datetime, 0, 4);
        $mm = substr($datetime, 5, 2);
        $dd = substr($datetime, 8, 2);
        $time = substr($datetime, 11, 8);
        $bulan = array(
            '',
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agt',
            'Sep',
            'Okt',
            'Nov',
            'Des',
        );

        if ($mm == 0 || is_numeric($mm) == false) {
            return null;
        } elseif ($mm <= 12) {
            return $dd . " " . $bulan[(int) $mm] . " " . $yyyy . " " . $time;
        } else {
            return null;
        }
    }
}
if (!function_exists('month_id')) {
    function month_id($datetime)
    {
        // formate date : YYYY-MM-DD HH:II:SS
        $yyyy = substr($datetime, 0, 4);
        $mm = substr($datetime, 5, 2);
        $bulan = array(
            '',
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agt',
            'Sep',
            'Okt',
            'Nov',
            'Des',
        );

        if ($mm == 0 || is_numeric($mm) == false) {
            return null;
        } elseif ($mm <= 12) {
            return  $bulan[(int) $mm] . " " . $yyyy;
        } else {
            return null;
        }
    }
}

if (!function_exists('dateconvert')) {
    function dateconvert($date)
    {
        if (!empty($date)) {
            $date_id = explode('-', $date);
            return $date_id[2] . '-' . $date_id[1] . '-' . $date_id[0];
        } else {
            return null;
        }
    }
}

if (!function_exists('selisihmenit')) {
    function selisihmenit($datetimestart, $datetimeend)
    {
        if (!empty($datetimestart) || !empty($datetimestart)) {
            $awal  = strtotime($datetimestart); //waktu awal

            $akhir = strtotime($datetimeend); //waktu akhir

            $diff  = $akhir - $awal;

            $jam   = floor($diff / (60 * 60));

            $menit = $diff - $jam * (60 * 60);

            return ($jam * 60) + floor($menit / 60);
        } else {
            return 0;
        }
    }
}
if (!function_exists('selisihwaktu')) {
    function selisihwaktu($datetimestart, $datetimeend)
    {
        if (!empty($datetimestart) || !empty($datetimestart)) {
            $awal  = strtotime($datetimestart); //waktu awal

            $akhir = strtotime($datetimeend); //waktu akhir

            $diff  = $akhir - $awal;
            $jam   = floor($diff / (60 * 60));

            $menit = $diff - $jam * (60 * 60);

            return $jam .  ' Jam, ' . floor($menit / 60) . ' Menit';
        } else {
            return 0;
        }
    }
}

if (!function_exists('selisihhari')) {
    function selisihhari($datestart, $dateend)
    {
        if (!empty($datestart) || !empty($dateend)) {
            $tgl1 = new DateTime($datestart);
            $tgl2 = new DateTime($dateend);
            $d = $tgl2->diff($tgl1)->days + 1;
            return $d;
        } else {
            return 0;
        }
    }
}



if (!function_exists('dateadd')) {
    function dateadd($currdate, $days = 1)
    {
        if (!empty($currdate)) {
            //to a given date.
            $date = new DateTime($currdate);

            $interval = new DateInterval("P{$days}D");

            //Add the DateInterval object to our DateTime object.
            $date->add($interval);

            //Print out the result.
            return $date->format("Y-m-d");
        } else {
            return 0;
        }
    }
}

if (!function_exists('hitung_umur')) {
    function hitung_umur($param, $param2 = null, $format = 'Ymd')
    {
        $date1 = new DateTime(date('Y-m-d', strtotime($param)));
        if (empty($param2)) {
            $date2 = new DateTime(date('Y-m-d'));
        } else {
            $date2 = new DateTime(date($param2));
        }

        $interval = $date1->diff($date2);
        if ($format == 'num') {
            return $interval->y . "," . $interval->m . "," . $interval->d;
        } elseif ($format == 'Ymd') {
            return $interval->y . " Tahun " . $interval->m . " Bulan " . $interval->d . " Hari ";
        } elseif ($format == 'Ym') {
            return $interval->y . " Tahun " . $interval->m . " Bulan ";
        } elseif ($format == 'Y') {
            return $interval->y;
        } else {
            return $interval->y . " Tahun " . $interval->m . " Bulan " . $interval->d . " Hari ";
        }
    }
}

/* 
 * Created by Pudyasto Adi Wibowo
 * Email : pawdev.id@gmail.com
 * pudyasto.wibowo@gmail.com
 */
