<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teste_laboratorial".
 *
 * @property int $id
 * @property int $id_pessoa
 * @property int $id_laboratorio
 * @property string|null $tipo_teste
 * @property string|null $resultado
 * @property string|null $data_teste
 */
class TesteLaboratorial extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teste_laboratorial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_teste', 'resultado', 'data_teste'], 'default', 'value' => null],
            [['id_pessoa', 'id_laboratorio'], 'required'],
            [['id_pessoa', 'id_laboratorio'], 'integer'],
            [['data_teste'], 'safe'],
            [['tipo_teste'], 'string', 'max' => 100],
            [['resultado'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pessoa' => 'Id Pessoa',
            'id_laboratorio' => 'Id Laboratorio',
            'tipo_teste' => 'Tipo Teste',
            'resultado' => 'Resultado',
            'data_teste' => 'Data Teste',
        ];
    }

}
