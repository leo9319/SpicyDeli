<?php

class ViewSingleProductCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function ViewProductViaAPI(ApiTester $I) {
        $I->sendGet('/products/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id' => 'integer',
            'name' => 'string',
            'sku' => 'string',
            'price' => 'string',
            'categories' => 'array|null',
        ]);
    }
}
