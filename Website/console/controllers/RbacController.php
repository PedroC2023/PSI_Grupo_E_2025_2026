<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // PERMISSÕES
        $manageRoles = $auth->createPermission('manageRoles');
        $auth->add($manageRoles);

        $manageEvents = $auth->createPermission('manageEvents');
        $auth->add($manageEvents);

        $viewEvents = $auth->createPermission('viewEvents');
        $auth->add($viewEvents);

        $participateEvents = $auth->createPermission('participateEvents');
        $auth->add($participateEvents);

        $manageLaboratorios = $auth->createPermission('manageLaboratorios');
        $auth->add($manageLaboratorios);

        $manageTipoAcao = $auth->createPermission('manageTipoAcao');
        $manageTipoAcao->description = 'Gerir tipos de ação';
        $auth->add($manageTipoAcao);

        $viewMyParticipations = $auth->createPermission('viewMyParticipations');
        $auth->add($viewMyParticipations);

        $createAcaoResposta = $auth->createPermission('createAcaoResposta');
        $auth->add($createAcaoResposta);

        $viewAcaoResposta = $auth->createPermission('viewAcaoResposta');
        $auth->add($viewAcaoResposta);

        $manageTestes = $auth->createPermission('manageTestes');
        $auth->add($manageTestes);

        $viewMyTestes = $auth->createPermission('viewMyTestes');
        $auth->add($viewMyTestes);



        // ROLES
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manageRoles);
        $auth->addChild($admin, $manageEvents);
        $auth->addChild($admin, $viewEvents);
        $auth->addChild($admin, $participateEvents);
        $auth->addChild($admin, $manageLaboratorios);
        $auth->addChild($admin, $manageTipoAcao);        
        $auth->addChild($admin, $manageTestes);
        $auth->addChild($admin, $viewMyTestes);
        $auth->addChild($admin, $viewMyParticipations);


        $colaborador = $auth->createRole('colaborador');
        $auth->add($colaborador);
        $auth->addChild($colaborador, $manageEvents);
        $auth->addChild($colaborador, $viewEvents);
        // $auth->addChild($colaborador, $participateEvents);
        $auth->addChild($colaborador, $createAcaoResposta);
        $auth->addChild($colaborador, $viewAcaoResposta);
        $auth->addChild($colaborador, $manageTestes);
        $auth->addChild($colaborador, $viewMyTestes);
        // opcional:
        // $auth->addChild($colaborador, $manageLaboratorios);

        $paciente = $auth->createRole('paciente');
        $auth->add($paciente);
        $auth->addChild($paciente, $viewEvents);
        $auth->addChild($paciente, $participateEvents);
        $auth->addChild($paciente, $viewMyParticipations);
        $auth->addChild($paciente, $viewMyTestes);

        $visitante = $auth->createRole('visitante');
        $auth->add($visitante);
        $auth->addChild($visitante, $viewEvents);

        // ======================
        // ATRIBUIR ROLES A UTILIZADORES
        // ======================

        // user_id = 1 → admin
        $auth->assign($admin, 1);

        // exemplos (ajusta aos IDs reais)
        $auth->assign($colaborador, 5);
        $auth->assign($paciente, 6);

        
        echo "RBAC inicializado com sucesso!\n";
    }
}

