<?php

namespace model\lottery\notification;

use SplObserver;
use SplSubject;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class EmailNotificationObserver implements SplObserver
{
    /**
     * Handle e-mail notification event
     *
     * @param SplSubject $subject
     * @return void
     */
    public function update(SplSubject $subject): void
    {
        if (count($subject->getResults()) > 0) {
            echo "\n [Email Notification] SMTP Server is not configured on local instance. \n";
        }
    }
}
