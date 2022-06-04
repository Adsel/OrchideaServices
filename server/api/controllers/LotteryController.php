<?php

use model\Lottery;
use Carbon\Carbon;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class LotteryController
{
    private $MONTHS = [
        'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
        'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'
    ];

    public function getTimer()
    {
        $LOTTERY = [
            'day' => 25,
            'hour' => 21,
            'minute' => 0,
            'second' => 0
        ];

        $currentDate = [];
        $currentDate['year'] = intval(date("Y"));
        $currentDate['month'] = intval(date("m")) - 1;
        $currentDate['day'] = intval(date("d"));
        $currentDate['hour'] = intval(date("H"));
        $currentDate['minute'] = intval(date("i"));
        $currentDate['second'] = intval(date("s"));

        $destinationDate = [];
        $destinationDate['year'] = intval(date("Y"));

        if (
            $currentDate['day'] > $LOTTERY['day'] ||
            $currentDate['day'] == $LOTTERY['day'] && $currentDate['hour'] >= $LOTTERY['hour'] &&
            $currentDate['minute'] >= $LOTTERY['minute'] && $currentDate['second'] >= $LOTTERY['second']
        ) {
            $destinationDate['month'] = intval(date("m"));
            $destinationDate['TEMPFLAG'] = true;
        } else {
            $destinationDate['month'] = intval(date("m")) - 1;
            $destinationDate['TEMPFLAG'] = false;
        }

        $destinationDate['day'] = $LOTTERY['day'];
        $destinationDate['hour'] = $LOTTERY['hour'];
        $destinationDate['minute'] = $LOTTERY['minute'];
        $destinationDate['second'] = $LOTTERY['second'];

        return JsonResponse::makeResponse([
            'currentDatetime' => $currentDate,
            'destinationDatetime' => $destinationDate
        ]);
    }

    public function getLastResult()
    {
        $result = LotteryResult::orderBy('result_id', 'desc')
            ->first();

        if (!$result) {
            throw new Exception('Brak rezultatu');
        }

        return JsonResponse::makeResponse(['result' => [
            'date' => $result->datetime,
            'rewards' => $result->rewards
        ]]);
    }

    public function getNicknames()
    {
        $nicknames = [];
        $month = '';
        $year = '';
        $nicknamesFilePath = $_ENV['NICKNAMES_FILE_PATH'] . '/nicknames.txt';
        $string = file_get_contents($nicknamesFilePath);

        $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(json_decode($string, TRUE, 512, JSON_UNESCAPED_UNICODE)),
            RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
            if (!is_array($val)) {
                if ($key == 'month') {
                    $month = $val;
                } else if ($key == 'year') {
                    $year = $val;
                } else {
                    $nicknames[$key] = $val;
                }
            }
        }

        $result = LotteryResult::orderBy('result_id', 'desc')
            ->first();
        if (!$result) {
            throw new Exception('Brak rezultatu');
        }

        $lastLoterryMonth = date("m", strtotime($result->datetime));
        $loterryMonth = intval(strtolower($lastLoterryMonth)) - 1;

        $resultData = [
            'month' => $month,
            'year' => $year
        ];

        if (strtolower($month) == strtolower($this->MONTHS[$loterryMonth])) {
            $resultData['nicknames'] = $nicknames;
        }

        return JsonResponse::makeResponse($resultData);
    }

    /**
     * Rand lottery rewards and publish it
     *
     * @return void
     */
    public function randLottery()
    {
        header('Content-Type: application/json; charset=utf-8');

        Lottery::prepareRewardPool();
        $rewardsInPool = (clone Lottery::$rewardsInPool)->getRewardsFromPool();
        $rewards = [];

        $ticketsCount = Singleton::getConfiguration()->getTicketCount();
        for ($i = 1; $i <= $ticketsCount; $i++) {
            $rewards[$i] = Lottery::REWARD_NAME_EMPTY;
        }

        $N = count($rewardsInPool);

        for ($o = 0; $o < $N; $o++) {
            do {
                $randedIndex = rand(1, $ticketsCount);
            } while ($rewards[$randedIndex] !== Lottery::REWARD_NAME_EMPTY);

            $rewards[$randedIndex] = $rewardsInPool[$o];
        }

        $json = "{";
        for ($z = 1; $z <= $ticketsCount; $z++) {
            $json .= '"' . $z . '":"' . $rewards[$z] . '", ';
        }

        $json .= '"month":"' . CalendarLocales::getCurrentMonthName() . '","year":"' . date("Y") . '"}';
        $result = new LotteryResult();
        $result->datetime = Carbon::now();
        $result->rewards = $json;
        // TODO:
        echo $json;
        //exit();
        //$result->save();
    }
}
