<?php

namespace common\models;
use yii\db\ActiveRecord;

class Especialidade extends ActiveRecord
{
    public static function tableName()
    {
        return 'especialidade';
    }

    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['descricao'], 'string'],
            [['nome'], 'string', 'max' => 100],
        ];
    }

    public function getEventos()
    {
        return $this->hasMany(Evento::class, ['id_especialidade' => 'id']);
    }
}
