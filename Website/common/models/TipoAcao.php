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
            [['descricao','nome'], 'required'],
            [['descricao','nome'], 'string', 'max' => 150],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
            'nome' => 'Nome',
        ];
    }

    public function getAcoes()
    {
        return $this->hasMany(AcaoResposta::class, ['id_tipo_acao' => 'id']);
    }
}
