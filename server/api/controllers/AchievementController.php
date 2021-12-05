<?php

class AchievementController
{
    private $bodyData;

    public function __construct()
    {
        // TODO:
        // split into controller
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Token');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE');

        $json = file_get_contents('php://input');
        $this->bodyData = !!$json ? (json_decode($json)->data) : [];
    }

    public function getAvailableAchievements()
    {
        return JsonResponse::makeResponse([
            'achievements' => Achievement::with('achievementType')->get()
        ]);
    }

    public function getFilteredAchievements()
    {
        $allAchievements = Achievement::with('achievementType')->get();

        $mappedAchievements = [];
        foreach ($allAchievements as $achievement) {
            $doneActivitiesDB = AchievementDone::where('achievement_id', $achievement->achievement_id);

            if (!!$this->bodyData->profile_id) {
                $enteredProfileId = $this->bodyData->profile_id;
                $doneActivitiesDB = $doneActivitiesDB->where('player_id', $enteredProfileId);
            }

            $doneActivities = $doneActivitiesDB->count();
            $achievement->done = $doneActivities > 0;
            $mappedAchievements[] = $achievement;
        }

        return JsonResponse::makeResponse([
            'achievements' => $mappedAchievements
        ]);
    }
}
