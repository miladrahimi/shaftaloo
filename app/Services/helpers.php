<?php

use App\Models\User;
use Carbon\Carbon;

/**
 * Convert G date to Jalali date
 *
 * @param Carbon $datetime
 * @param string $format
 * @param bool $fixNumbers
 * @return string
 */
function jDate(Carbon $datetime, $format = 'yyyy/MM/dd @ HH:mm:ss', $fixNumbers = true): string
{
    $formatter = new IntlDateFormatter(
        "fa_IR@calendar=persian",
        IntlDateFormatter::FULL,
        IntlDateFormatter::FULL,
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL,
        $format
    );

    $result = $formatter->format($datetime);

    return $fixNumbers ? fixNumbers($result) : $result;
}

/**
 * Convert Jalali date to G date
 *
 * @param $datetime
 * @param string $format
 * @return string
 */
function gDate($datetime, $format = 'yyyy-MM-dd HH:mm:ss'): string
{
    $cal = IntlCalendar::createInstance('Asia/Tehran', 'fa_IR@calendar=persian');
    $cal->setFirstDayOfWeek($cal::DOW_SATURDAY);
    $cal->set(
        intval(substr($datetime, 0, 4)),
        intval(substr($datetime, 5, 2)) - 1,
        intval(substr($datetime, 8, 2)),
        intval(substr($datetime, 11, 2)),
        intval(substr($datetime, 14, 2)),
        intval(substr($datetime, 17, 2)),
    );

    $formatter = new IntlDateFormatter(
        'en_US@calendar=gregorian',
        IntlDateFormatter::FULL,
        IntlDateFormatter::FULL,
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL,
        $format
    );

    return $formatter->format($cal->getTime() / 1000);
}

/**
 * Convert Arabic/Persian numbers to English numbers
 *
 * @param string $string
 * @return string
 */
function fixNumbers(string $string): string
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
    $num = range(0, 9);

    $convertedPersianNums = str_replace($persian, $num, $string);

    return str_replace($arabic, $num, $convertedPersianNums);
}

/**
 * Append hash to the given file
 *
 * @param string $url
 * @return string
 */
function fh(string $url): string
{
    return $url . '?h=' . md5_file(public_path(parse_url($url)['path']));
}

/**
 * @param int $length
 * @return string
 */
function str_random(int $length): string
{
    return \Illuminate\Support\Str::random($length);
}

/**
 * @param int $balance
 * @return string
 */
function balance_color(int $balance)
{
    if ($balance > 0) {
        return 'success';
    } elseif ($balance < 0) {
        return 'warning';
    } else {
        return 'light';
    }
}
