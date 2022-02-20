<?php

class AdminLog
{
    const ADMIN_LOG_STATUS_ADMIN_LOGIN = 'ADMIN_LOGIN';
    const ADMIN_LOG_STATUS_CHANGE_ACHIEVEMENTS_STATUS = 'CHANGED_ACHIEVEMENTS';

    /**
     * Log admin action
     *
     * @param int $adminId
     * @param string $actionType
     * @param object $actionData
     * @return void
     */
    public static function logAction(int $adminId, string $actionType, object $actionData): void
    {
        $logDB = new AdministratorLog();
        $logDB->administrator_id = $adminId;
        $logDB->action_type = $actionType;
        $logDB->action_data = json_encode($actionData);
        $logDB->administrator_ip = self::getIPAddress();
        $logDB->save();
    }

    /**
     * Get Client's IP address
     *
     * @return string
     */
    public static function getIPAddress(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //whether ip is from the share internet
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //whether ip is from the proxy
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        //whether ip is from the remote address
        return $_SERVER['REMOTE_ADDR'];
    }
}
