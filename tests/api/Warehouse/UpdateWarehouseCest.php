<?php

class UpdateWarehouseCest
{
    // tests
    public function updateWarehouseViaAPI(\ApiTester $I)
    {
        $I->amHttpAuthenticated('service_user', '123456');
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPatch('/warehouses/1', [
            'name' => 'Hiper Bodegon #13',
            'location' => 'Medellin',

        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(["success" => true]);
    }
}
