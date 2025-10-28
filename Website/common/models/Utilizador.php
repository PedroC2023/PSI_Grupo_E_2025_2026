<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $password_hash
 * @property string $telefone
 * @property string $data_registo
 * @property int $id_role
 */
class Utilizador extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'password_hash', 'telefone', 'data_registo', 'id_role'], 'required'],
            [['data_registo'], 'safe'],
            [['id_role'], 'integer'],
            [['nome', 'password_hash'], 'string', 'max' => 256],
            [['email'], 'string', 'max' => 100],
            [['telefone'], 'string', 'max' => 9],
            [['id_role'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'telefone' => 'Telefone',
            'data_registo' => 'Data Registo',
            'id_role' => 'Id Role',
        ];
    }

}
