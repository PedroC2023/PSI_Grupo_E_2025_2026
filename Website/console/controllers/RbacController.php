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

        // ROLES
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manageRoles);
        $auth->addChild($admin, $manageEvents);
        $auth->addChild($admin, $viewEvents);
        $auth->addChild($admin, $participateEvents);
        $auth->addChild($admin, $manageLaboratorios);

        $colaborador = $auth->createRole('colaborador');
        $auth->add($colaborador);
        $auth->addChild($colaborador, $manageEvents);
        $auth->addChild($colaborador, $viewEvents);
        $auth->addChild($colaborador, $participateEvents);
        // opcional:
        // $auth->addChild($colaborador, $manageLaboratorios);

        $paciente = $auth->createRole('paciente');
        $auth->add($paciente);
        $auth->addChild($paciente, $viewEvents);
        $auth->addChild($paciente, $participateEvents);

        $visitante = $auth->createRole('visitante');
        $auth->add($visitante);
        $auth->addChild($visitante, $viewEvents);

        echo "RBAC inicializado com sucesso!\n";
    }
}

