<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "colaboracao_evento".
 *
 * @property int $id
 * @property int $id_evento
 * @property int $id_pessoa
 */
class ColaboracaoEvento extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colaboracao_evento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_evento', 'id_pessoa'], 'required'],
            [['id_evento', 'id_pessoa'], 'integer'],
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
        ];
    }

}
