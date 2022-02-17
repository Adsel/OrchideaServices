<?php

class AchievementController extends ApiController
{
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

    public function changeAchievementsStatuses()
    {
        if (!$this->bodyData->profile_id || !$this->bodyData->achievements) {
            throw new Exception('Nie znaleziono osiągnięcia dla gracza');
        }

        $profileId = $this->bodyData->profile_id;
        $achievements = $this->bodyData->achievements;

        $doneAchievements = [];
        foreach ($achievements as $achievement) {
            $achievementId = $achievement->achievement_id;
            $status = $achievement->done;
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
                $doneAchievements[] = $doneAchievement;
            } else {
                $newDoneAchievement = new AchievementDone();
                $newDoneAchievement->achievement_id = $achievementId;
                $newDoneAchievement->player_id = $profileId;
                $newDoneAchievement->accepted_at = $status ? self::getCurrentTimestamp() : null;
                $newDoneAchievement->save();
                $doneAchievements[] = $newDoneAchievement;
            }
        }

        return JsonResponse::makeResponse([
            'achievements' => $doneAchievements
        ]);
    }
}
