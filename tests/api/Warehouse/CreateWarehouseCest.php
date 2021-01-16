<?php

class CreateWarehouseCest
{
    // tests
    public function CreateWarehouseViaAPI(\ApiTester $I)
    {
        $I->amHttpAuthenticated('service_user', '123456');
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPost('/warehouses', [
            'name' => 'Hiper Bodega',
            'location' => 'Bogota',
            ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(["success" => true]);
    }
}
