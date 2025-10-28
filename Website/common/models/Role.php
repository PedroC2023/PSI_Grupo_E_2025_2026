<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property int $nome_role
 * @property string $descricao
 */
class Role extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_role', 'descricao'], 'required'],
            [['nome_role'], 'integer'],
            [['descricao'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_role' => 'Nome Role',
            'descricao' => 'Descricao',
        ];
    }

}
