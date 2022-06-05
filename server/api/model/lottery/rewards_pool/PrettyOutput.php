<?php

namespace model\lottery\rewards_pool;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class PrettyOutput extends TextOutput
{
    /**
     * @inheritDoc
     */
    public function formatText(RewardsResults $rewards): string
    {
        $results = $rewards->getResults();
        $rewardsCount = count($results);

        $output = '[Lottery results]' . "\n";
        $output .= 'Rewards in pool:' . "\n";

        foreach ($results as $index => $reward) {
            $output .= '   > ' . $reward;

            if ($index !== $rewardsCount - 1) {
                $output .= ',';
            }

            $output .= "\n";
        }

        $output .= 'Pool generated at: ' . $rewards->getGeneratedAt() . "\n";

        return $output;
    }
}
