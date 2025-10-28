<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "participacao_evento".
 *
 * @property int $id
 * @property int $id_evento
 * @property int $id_utilizador
 * @property int $data_participacao
 * @property int $status_participacao
 */
class ParticipacaoEvento extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'participacao_evento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_evento', 'id_utilizador', 'data_participacao', 'status_participacao'], 'required'],
            [['id_evento', 'id_utilizador', 'data_participacao', 'status_participacao'], 'integer'],
            [['id_evento'], 'unique'],
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
            'id_evento' => 'Id Evento',
            'id_utilizador' => 'Id Utilizador',
            'data_participacao' => 'Data Participacao',
            'status_participacao' => 'Status Participacao',
        ];
    }

}
