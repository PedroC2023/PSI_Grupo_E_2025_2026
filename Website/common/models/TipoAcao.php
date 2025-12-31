<?php

namespace common\models;

use yii\db\ActiveRecord;

class TipoAcao extends ActiveRecord
{
    public static function tableName()
    {
        return 'tipo_acao';
    }

    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 150],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
        ];
    }

    public function getAcoes()
    {
        return $this->hasMany(AcaoResposta::class, ['id_tipo_acao' => 'id']);
    }
}
