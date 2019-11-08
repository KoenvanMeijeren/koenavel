<?php
declare(strict_types=1);


namespace App\Services\Helpers;

use Cake\Chronos\Chronos;
use IntlDateFormatter;

final class DateTime
{
    /**
     * The datetime to be converted.
     *
     * @var string
     */
    private $datetime;

    /**
     * The locale datetime to convert the given datetime to.
     *
     * @var string
     */
    private $locale;

    public function __construct(Chronos $datetime, string $locale = 'nl_NL')
    {
        $this->datetime = $datetime->toDateTimeString();
        $this->locale = $locale;
    }

    /**
     * Convert the datetime to datetime.
     *
     * @return string
     */
    public function toDateTime(): string
    {
        $fmt = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::FULL,
            IntlDateFormatter::SHORT
        );

        return $fmt->format(strtotime($this->datetime));
    }

    /**
     * Convert the datetime to date.
     *
     * @return string
     */
    public function toDate(): string
    {
        $fmt = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE
        );

        return $fmt->format(strtotime($this->datetime));
    }

    /**
     * Convert the datetime to time.
     *
     * @return string
     */
    public function toTime(): string
    {
        $fmt = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::NONE,
            IntlDateFormatter::SHORT
        );

        return $fmt->format(strtotime($this->datetime));
    }
}
