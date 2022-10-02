<?php

class DeleteProductsCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function ViewProductViaAPI(ApiTester $I) {
        $I->sendDelete('/products/1');
        $I->seeResponseCodeIs(204);
    }
}
