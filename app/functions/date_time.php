<?php

declare(strict_types=1);

/**
 * Check if the given date is a correct type.
 *
 * @param string $date   the date to be checked
 * @param string $format the format of the date
 *
 * @return bool
 */
function validateDate(string $date, string $format = 'Y-m-d'): bool
{
    $d = DateTime::createFromFormat($format, $date);

    return $d && $d->format($format) === $date;
}

/**
 * Parse the given datetime into readable html.
 *
 * @param string $datetime the data to be parsed
 *
 * @return string
 */
function parseToDate(string $datetime): string
{
    $fmt = new IntlDateFormatter(
        'nl_NL',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE
    );

    return $fmt->format(strtotime($datetime));
}

/**
 * Parse the given datetime into readable html.
 *
 * @param string $datetime the data to be parsed
 *
 * @return string
 */
function parseToTime(string $datetime): string
{
    $fmt = new IntlDateFormatter(
        'nl_NL',
        IntlDateFormatter::NONE,
        IntlDateFormatter::SHORT
    );

    return $fmt->format(strtotime($datetime));
}

/**
 * Parse the given datetime into input html.
 *
 * @param string $datetime the data to be parsed
 *
 * @return string
 */
function parseToInput(string $datetime): string
{
    $newDatetime = strtotime($datetime);

    return strftime('%d-%m-%Y %T', (int) $newDatetime);
}

/**
 * Parse the given datetime into date input html.
 *
 * @param string $datetime the data to be parsed
 *
 * @return string
 */
function parseToDateInput(string $datetime): string
{
    $newDatetime = strtotime($datetime);

    return strftime('%d-%m-%Y', (int) $newDatetime);
}

/**
 * Parse the given datetime into input html.
 *
 * @param string $datetime the data to be parsed
 *
 * @return string
 */
function parseToTimeInput(string $datetime): string
{
    $newDatetime = strtotime($datetime);

    return strftime('%R', (int) $newDatetime);
}
