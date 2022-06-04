<?php

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class CalendarLocales {
    public static function getCurrentMonthName(): string {
        $monthS = '';
        $mon = (string) date("m");
        switch ($mon) {
            case 1:
                $monthS = "Styczeń";
                break;
            case 2:
                $monthS = "Luty";
                break;
            case 3:
                $monthS = "Marzec";
                break;
            case 4:
                $monthS = "Kwiecień";
                break;
            case 5:
                $monthS = "Maj";
                break;
            case 6:
                $monthS = "Czerwiec";
                break;
            case 7:
                $monthS = "Lipiec";
                break;
            case 8:
                $monthS = "Sierpień";
                break;
            case 9:
                $monthS = "Wrzesień";
                break;
            case 10:
                $monthS = "Październik";
                break;
            case 11:
                $monthS = "Listopad";
                break;
            case 12:
                $monthS = "Grudzień";
                break;
        }

        return $monthS;
    }
}
