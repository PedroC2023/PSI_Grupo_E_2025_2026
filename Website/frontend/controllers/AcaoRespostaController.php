<?php
namespace frontend\controllers;

use Yii;
use common\models\AcaoResposta;
use common\models\Evento;
use common\models\Pessoa;
use yii\web\Controller;
use yii\filters\AccessControl;

class AcaoRespostaController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
<<<<<<< HEAD
                        'allow' => true,
                        'roles' => ['manageEvents'], // colaboradores
                    ],
=======
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['createAcaoResposta'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['viewAcaoResposta'],
                    ],

>>>>>>> main
                ],
            ],
        ];
    }

    public function actionIndex($eventoId)
    {
        $acoes = AcaoResposta::find()
            ->where(['id_evento' => $eventoId])
            ->all();

        return $this->render('index', [
            'acoes' => $acoes,
        ]);
    }

    public function actionCreate($eventoId)
    {
        $model = new AcaoResposta();
        $model->id_evento = $eventoId;

        $pessoa = Pessoa::findOne(['id_user' => Yii::$app->user->id]);
        if (!$pessoa) {
            throw new ForbiddenHttpException('Pessoa não encontrada.');
        }

        $model->id_pessoa = $pessoa->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'eventoId' => $eventoId]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }
}
