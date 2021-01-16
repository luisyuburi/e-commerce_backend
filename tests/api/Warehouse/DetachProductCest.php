<?php

class DetachProductCest
{
    // tests
    public function DetachProductViaAPI(\ApiTester $I)
    {
        $I->amHttpAuthenticated('service_user', '123456');
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPost('/warehouses/detach', [
            'productid' => '1',
            'warehouseid' => "1"
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(["success" => true]);
    }
}
