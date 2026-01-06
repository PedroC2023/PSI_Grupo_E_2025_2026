<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function homepageWorks(FunctionalTester $I)
    {
        $I->amOnPage(['/site/index']);
        $I->see('Plataforma');
    }
}