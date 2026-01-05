<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class MeusTestesCest
{
    public function acessoMeusTestesComoPaciente(FunctionalTester $I)
    {
        // login como paciente (user_id = 6, ajusta se necessário)
        $I->amLoggedInAs(6);

        // ir para a página "Meus Testes"
        $I->amOnPage(['/meus-testes/index']);

        // verificar que a página carregou
        $I->seeResponseCodeIs(200);

        // verificar texto típico da página
        $I->see('Meus Testes');

        // garantir que não é erro 403
        $I->dontSee('Forbidden');
    }
}
