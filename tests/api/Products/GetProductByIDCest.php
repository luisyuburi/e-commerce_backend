<?php

class GetProductByIDCest
{
    // tests
    public function GetProductByIDViaAPI(\ApiTester $I)
    {
        $I->amHttpAuthenticated('service_user', '123456');
        $I->sendGet('/products/1');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(["success" => true]);
    }
}
