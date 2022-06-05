<?php

namespace model\lottery\rewards_pool;

use CalendarLocales;
use Carbon\Carbon;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class JsonOutput extends TextOutput
{
    /**
     * @inheritDoc
     */
    public function formatText(RewardsResults $rewards): string
    {
        $results = $rewards->getResults();
        $json = "{";
        foreach ($results as $index => $reward) {
            $json .= '"' . $index . '":"' . $reward . '", ';
        }

        $year = Carbon::now()->format('Y');

        return $json . '"month":"' . CalendarLocales::getCurrentMonthName() . '","year":"' . $year . '"}';
    }
}
