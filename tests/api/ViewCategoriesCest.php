<?php

class ViewCategoriesCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function ViewCategoryViaAPI(ApiTester $I) {
        $I->sendGet('/categories');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id' => 'integer',
            'name' => 'string',
            'products' => 'array|null',
        ]);
    }
}
