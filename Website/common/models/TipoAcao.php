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
<<<<<<< HEAD
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 150],
=======
            [['descricao','nome'], 'required'],
            [['descricao','nome'], 'string', 'max' => 150],
>>>>>>> main
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
<<<<<<< HEAD
=======
            'nome' => 'Nome',
>>>>>>> main
        ];
    }

    public function getAcoes()
    {
        return $this->hasMany(AcaoResposta::class, ['id_tipo_acao' => 'id']);
    }
}
