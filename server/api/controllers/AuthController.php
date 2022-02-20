<?php

class AuthController extends ApiController
{
    const EXCEPTION_MESSAGE_MISSING_DATA = 'Proszę wypełnić wszystkie pola!';
    const EXCEPTION_MESSAGE_ADMINISTRATOR_NOT_AUTHORIZED = 'Błędne dane logowania!';
    const EXCEPTION_MESSAGE_ADMINISTRATOR_NOT_FOUND = 'Brak administratora o podanym loginie!';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Login administrator to admin panel
     *
     * @return string
     * @throws Exception
     */
    public function loginAdministrator(): string
    {
        if (!$this->bodyData->login || !$this->bodyData->password) {
            throw new Exception(self::EXCEPTION_MESSAGE_MISSING_DATA);
        }

        $login = $this->bodyData->login;
        $password = $this->bodyData->password;
        $administratorDB = Administrator::where('login', $login)->first();

        if (!$administratorDB) {
            throw new Exception(self::EXCEPTION_MESSAGE_ADMINISTRATOR_NOT_FOUND);
        }

        if (!password_verify($password, $administratorDB->password)) {
            throw new Exception(self::EXCEPTION_MESSAGE_ADMINISTRATOR_NOT_AUTHORIZED);
        }

        $adminId = $administratorDB->administrator_id;
        $tokenDB = AdministratorToken::where('admin_id', $adminId)->first();

        $tokenExpired = true;
        if ($tokenDB) {
            $tokenExpired = !AuthModel::isAuthTokenValid($tokenDB->expiration_at);
        }

        if (!$tokenDB) {
            $tokenDB = new AdministratorToken();
            $tokenDB->admin_id = $adminId;
            $tokenDB->expiration_at = AuthModel::getAuthTokenExpirationDate();
            $tokenDB->token = AuthModel::generateAuthToken();
            $tokenDB->save();
        } else if ($tokenExpired) {
            $tokenDB->expiration_at = AuthModel::getAuthTokenExpirationDate();
            $tokenDB->token = AuthModel::generateAuthToken();
            $tokenDB->save();
        }

        AdminLog::logAction($adminId, AdminLog::ADMIN_LOG_STATUS_ADMIN_LOGIN, (object)[]);

        return JsonResponse::makeResponse([
            'status' => true,
            'admin' => (object)[
                'visible_name' => $administratorDB->visible_name,
                'administrator_id' => $administratorDB->administrator_id,
            ],
            'token' => $tokenDB
        ]);
    }
}
