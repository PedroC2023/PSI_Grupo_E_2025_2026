<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descricao
 * @property string $data_inicio
 * @property string $data_fim
 * @property string $tipo_evento
 * @property string $status
 * @property int $id_utilizador
 * @property string $pais
 * @property string $regiao
 * @property string $cidade
 * @property string $endereco
 */
class Evento extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descricao', 'data_inicio', 'data_fim', 'tipo_evento', 'status', 'id_utilizador', 'pais', 'regiao', 'cidade', 'endereco'], 'required'],
            [['data_inicio', 'data_fim'], 'safe'],
            [['id_utilizador'], 'integer'],
            [['titulo', 'descricao', 'tipo_evento', 'status', 'pais', 'regiao', 'cidade', 'endereco'], 'string', 'max' => 256],
            [['id_utilizador'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descricao' => 'Descricao',
            'data_inicio' => 'Data Inicio',
            'data_fim' => 'Data Fim',
            'tipo_evento' => 'Tipo Evento',
            'status' => 'Status',
            'id_utilizador' => 'Id Utilizador',
            'pais' => 'Pais',
            'regiao' => 'Regiao',
            'cidade' => 'Cidade',
            'endereco' => 'Endereco',
        ];
    }
    // Proteger os controllers com RBAC
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['viewEvents'],
                    ],
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['manageEvents'],
                    ],
                ],
            ],
        ];
    }


}
