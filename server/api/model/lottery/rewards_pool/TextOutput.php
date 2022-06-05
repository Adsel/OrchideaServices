<?php

namespace model\lottery\rewards_pool;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 * @desc      Base decorator
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class TextOutput
{
    protected TextFormat $outputFormat;

    /**
     * TextOutput decorator.
     *
     * @param TextFormat $format
     */
    public function __construct(TextFormat $format)
    {
        $this->outputFormat = $format;
    }

    /**
     * Decorator delegates all work to a wrapped component.
     *
     * @param RewardsResults $rewards
     * @return string
     */
    public function formatText(RewardsResults $rewards): string
    {
        return $this->outputFormat->formatOutput($rewards);
    }
}
