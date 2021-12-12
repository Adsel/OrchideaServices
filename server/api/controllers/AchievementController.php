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
            $doneActivitiesDB = AchievementDone::where('achievement_id', $achievement->achievement_id)
                ->where('accepted_at', '<>', null);

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

    private function getCurrentTimestamp()
    {
        return date("Y-m-d H:i:s");
    }

    public function changeAchievementStatus()
    {
        if (!$this->bodyData->profile_id || !$this->bodyData->achievement_id || $this->bodyData->status === null) {
            throw new Exception('Nie znaleziono osiągnięcia dla gracza');
        }

        $profileId = $this->bodyData->profile_id;
        $achievementId = $this->bodyData->achievement_id;
        $status = $this->bodyData->status;

        $doneAchievement = AchievementDone::where('achievement_id', $achievementId)
            ->where('player_id', $profileId)
            ->first();

        if (!$status && !$doneAchievement) {
            throw new Exception('Nie można oznaczyć niezakończonego osiągnięcia jako niezakończone');
        }

        if ($doneAchievement) {
            if (!$status) {
                $doneAchievement->accepted_at = null;
            } else {
                $doneAchievement->accepted_at = self::getCurrentTimestamp();
            }
            $doneAchievement->save();

        } else {
            $newDoneAchievement = new AchievementDone();
            $newDoneAchievement->achievement_id = $achievementId;
            $newDoneAchievement->player_id = $profileId;
            $newDoneAchievement->accepted_at = $status ? self::getCurrentTimestamp() : null;
            $newDoneAchievement->save();
        }

        return JsonResponse::makeResponse([
            'achievement' => $doneAchievement ?: $newDoneAchievement
        ]);
    }
}
