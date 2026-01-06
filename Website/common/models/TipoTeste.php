<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipo_teste".
 *
 * @property int $id
 * @property string $descricao
 */
class TipoTeste extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_teste';
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

}
