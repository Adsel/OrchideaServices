<?php


class AchievementController {
    public function getAvailableAchievements() {
        $mainAchievements = MainAchievement::all();
        $additionalAchievements = AdditionalAchievement::all();

        return JsonResponse::makeResponse([
            'achievements' => [
                'main' => $mainAchievements,
                'additional' => $additionalAchievements
            ]
        ]);
    }

    public function getPlayerAchievements($profileId) {
        $isPlayer = false;

        $player = Player::where('nickname', $profileId)
            ->first();
        if ($player) {
            $isPlayer = true;
            $profileId = $player->profile_id;
        }

        $mainPlayerAchievements = [];
        $mainAchievements = DoneMainAchievement::where('player', $profileId)
            ->get();

        if ($mainAchievements) {
             foreach ($mainAchievements as $mainAchievement) {
                 $mainAchievementDto = [];
                 $mainAchievementDto['date'] = $mainAchievement->date;
                 $mainAchievementDto['achievement_id'] = $mainAchievement->achievement_id;
                 $mainPlayerAchievements[] = (object) $mainAchievementDto;
             }
        }
        $additionalPlayerAchievements = [];
        $additionalAchievements = DoneAdditionalAchievement::where('player', $profileId)
            ->get();

        if ($additionalAchievements) {
            foreach ($additionalAchievements as $additionalAchievement) {
                $additionalAchievementDto = [];
                $additionalAchievementDto['date'] = $additionalAchievement->date;
                $additionalAchievementDto['achievement_name'] = $additionalAchievement->achievement_name;
                $additionalPlayerAchievements[] = (object) $additionalAchievementDto;
            }
        }

        return JsonResponse::makeResponse([
            'isSavedPlayer' => $isPlayer,
            'achievements' => [
                'main' => $mainPlayerAchievements,
                'additional' => $additionalPlayerAchievements
            ]
        ]);
    }
}
