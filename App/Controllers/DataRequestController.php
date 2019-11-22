<?php
declare(strict_types=1);


namespace App\Controllers;


class DataRequestController
{
    public function json(): string
    {
        return json_encode([
            'draw' => 1,
            'recordsTotal' => 57,
            'recordsFiltered' => 57,
            'data' => [
                [
                    "Angelica",
                    "Ramos",
                    "System Architect",
                    "London",
                    "9th Oct 09",
                    "$2,875"
                ],
                [
                    "Ashton",
                    "Cox",
                    "Technical Author",
                    "San Francisco",
                    "12th Jan 09",
                    "$4,800"
                ]
            ]
        ]);
    }
}
