<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use common\models\TesteLaboratorial;

class MeusTestesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['viewMyTestes'], // PERMISSÃO, não role
                    ],
                ],
            ],
        ];
    }

    // LISTA DE TESTES DO PACIENTE
    public function actionIndex()
    {
        $pessoa = Yii::$app->user->identity->pessoa;

        if (!$pessoa) {
            throw new ForbiddenHttpException('Pessoa não encontrada.');
        }

        $testes = TesteLaboratorial::find()
            ->where(['id_pessoa' => $pessoa->id])
            ->orderBy(['data_realizacao' => SORT_DESC])
            ->all();

        foreach ($testes as $teste) {
            $teste->updateEstadoSeNecessario();
        }

        return $this->render('index', [
            'testes' => $testes
        ]);
    }

    // PACIENTE ESCOLHE LABORATÓRIO
    public function actionEscolherLaboratorio($id)
    {
        $model = TesteLaboratorial::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        if ($model->estado !== 'pendente') {
            throw new ForbiddenHttpException('Este teste já não pode ser marcado.');
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->estado = 'marcado';

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('escolher-laboratorio', [
            'model' => $model
        ]);
    }
}
