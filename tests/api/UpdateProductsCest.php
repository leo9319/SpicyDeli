<?php

class UpdateProductsCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function ViewProductViaAPI(ApiTester $I) {
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPut('/products/1', [
            'name' => 'Updated Product',
            'category' => 'China',
            'sku' => 'FISH999ABGH7',
            'price' => 20.49
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"product updated"');
    }
}
