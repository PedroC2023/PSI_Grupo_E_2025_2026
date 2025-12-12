<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acao_resposta".
 *
 * @property int $id
 * @property int $id_evento
 * @property int $id_pessoa
 * @property int $id_tipo_acao
 * @property string|null $resposta
 * @property string|null $data_acao
 */
class AcaoResposta extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acao_resposta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resposta'], 'default', 'value' => null],
            [['id_evento', 'id_pessoa', 'id_tipo_acao'], 'required'],
            [['id_evento', 'id_pessoa', 'id_tipo_acao'], 'integer'],
            [['resposta'], 'string'],
            [['data_acao'], 'safe'],
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
            'id_pessoa' => 'Id Pessoa',
            'id_tipo_acao' => 'Id Tipo Acao',
            'resposta' => 'Resposta',
            'data_acao' => 'Data Acao',
        ];
    }

}
