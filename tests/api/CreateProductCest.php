<?php

use \Codeception\Util\HttpCode;

class CreateProductCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function createProductViaAPI(ApiTester $I) {
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPost('/products', [
            'name' => 'Sik Sik Wat 3',
            'category' => 'Ethiopia, Beef, Chili pepper',
            'sku' => 'DISH999ABCD3',
            'price' => 17.49
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"product created"');
    }
}
