<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "especialidade".
 *
 * @property int $id
 * @property string $descricao
 */
class Especialidade extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especialidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao','nome'], 'required'],
            [['descricao','nome'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'nome' => 'Nome',
        ];
    }
    public function getEventos()
    {
        return $this->hasMany(Evento::class, ['id_especialidade' => 'id']);
    }


}
