<?php

namespace App\Service;

use App\Entity\Don;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;

class Helper
{
    /**
     * @return array
     * @throws Exception
     */
    public static function getYears(): array
    {
        $years = [];
        $begin = new DateTime();
        $begin = $begin->modify('-1 year');
        $end = new DateTime();
        $end = $end->modify('+5 year');
        $interval = new DateInterval('P1Y');
        $daterange = new DatePeriod($begin, $interval, $end);
        foreach ($daterange as $date) {
            $years[$date->format('Y')] = $date->format('Y');
        }

        return $years;
    }

    /**
     * @return array
     */
    public static function monthsList(): array
    {
        $months = [
            ['id' => 1, 'name' => 'Janvier'],
            ['id' => 2, 'name' => 'Février'],
            ['id' => 3, 'name' => 'Mars'],
            ['id' => 4, 'name' => 'Avril'],
            ['id' => 5, 'name' => 'Mai'],
            ['id' => 6, 'name' => 'Juin'],
            ['id' => 7, 'name' => 'Juillet'],
            ['id' => 8, 'name' => 'Août'],
            ['id' => 9, 'name' => 'Septembre'],
            ['id' => 10, 'name' => 'Octobre'],
            ['id' => 11, 'name' => 'Novembre'],
            ['id' => 12, 'name' => 'Décembre'],
        ];
        return $months;
    }
}
