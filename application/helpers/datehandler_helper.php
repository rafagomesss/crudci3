<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('nowDateTime')) {
    function nowDateTime(
        string $date = 'now',
        string $timeZone = 'America/Sao_Paulo',
        string $format = 'Y-m-d H:i:s'
    ): string {
        return (new DateTime(
                $date,
                (new DateTimeZone($timeZone))
            )
        )->format($format);
    }
}
