<?php

class CreateUserCest
{
    // tests
    public function createUserViaAPI(\ApiTester $I)
    {
        $I->amHttpAuthenticated('service_user', '123456');
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPost('/register', [
            'name' => 'Pedro',
            'email' => 'Pedro@gmail.com',
          'password' => '123456',
          'c_password' => '123456',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(["success" => true]);
    }
}
