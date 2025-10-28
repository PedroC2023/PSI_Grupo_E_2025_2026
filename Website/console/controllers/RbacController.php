<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Permissões
        $manageRoles = $auth->createPermission('manageRoles');
        $manageRoles->description = 'Gerir roles';
        $auth->add($manageRoles);

        $manageEvents = $auth->createPermission('manageEvents');
        $manageEvents->description = 'Gerir eventos';
        $auth->add($manageEvents);

        $viewEvents = $auth->createPermission('viewEvents');
        $viewEvents->description = 'Visualizar eventos';
        $auth->add($viewEvents);

        $participateEvents = $auth->createPermission('participateEvents');
        $participateEvents->description = 'Participar em eventos';
        $auth->add($participateEvents);

        // Roles
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manageRoles);
        $auth->addChild($admin, $manageEvents);

        $colaborador = $auth->createRole('colaborador');
        $auth->add($colaborador);
        $auth->addChild($colaborador, $manageEvents);

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