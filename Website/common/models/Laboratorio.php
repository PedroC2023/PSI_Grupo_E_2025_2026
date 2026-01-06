<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "laboratorio".
 *
 * @property int $id
 * @property string $nome
 * @property string $referencia
 * @property string $contacto
 * @property string $email
 */
class Laboratorio extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'laboratorio';
    }

    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 150],
            [['referencia'], 'string', 'max' => 100],
            [['contacto'], 'string', 'max' => 50],
            [['email'], 'email'],
        ];
    }

    public function getTestes()
    {
        return $this->hasMany(TesteLaboratorial::class, ['id_laboratorio' => 'id']);
    }
}
