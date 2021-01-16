<?php

class UpdateProductCest
{
    // tests
    public function updateProductViaAPI(\ApiTester $I)
    {
        $I->amHttpAuthenticated('service_user', '123456');
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPatch('/products/1', [
            'name' => 'Mouse Logitech',
            'stock' => '5',
            'price' => '15',
          'shortDesc' => 'Mouse Logitech Nuevo',
          'description' => 'Mouse Logitech ergonomico',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(["success" => true]);
    }
}
