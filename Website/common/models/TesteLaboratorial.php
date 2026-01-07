<?php

namespace common\models;

use Yii;

class TesteLaboratorial extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'teste_laboratorial';
    }

    public function rules()
    {
        return [
<<<<<<< HEAD
            [['id_pessoa', 'id_laboratorio', 'tipo_teste', 'data_teste'], 'required'],
            [['id_pessoa', 'id_laboratorio'], 'integer'],
            [['data_teste'], 'safe'],
            [['tipo_teste'], 'string', 'max' => 100],
            [['resultado'], 'string', 'max' => 50],

            [['id_pessoa'], 'exist',
                'targetClass' => Pessoa::class,
                'targetAttribute' => ['id_pessoa' => 'id']
            ],
            [['id_laboratorio'], 'exist',
                'targetClass' => Laboratorio::class,
                'targetAttribute' => ['id_laboratorio' => 'id']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pessoa' => 'Paciente',
            'id_laboratorio' => 'Laboratório',
            'tipo_teste' => 'Tipo de Teste',
            'resultado' => 'Resultado',
            'data_teste' => 'Data do Teste',
=======
            [['id_pessoa', 'id_tipo_teste'], 'required'],
            [['id_pessoa', 'id_laboratorio', 'id_tipo_teste'], 'integer'],
            [['data_criacao', 'data_realizacao'], 'safe'],
            [['estado'], 'in', 'range' => ['pendente','marcado','realizado']],
>>>>>>> main
        ];
    }

    public function getPessoa()
    {
        return $this->hasOne(Pessoa::class, ['id' => 'id_pessoa']);
    }

    public function getLaboratorio()
    {
        return $this->hasOne(Laboratorio::class, ['id' => 'id_laboratorio']);
    }
<<<<<<< HEAD
}
=======
    public function getTipoTeste()
    {
        return $this->hasOne(TipoTeste::class, ['id' => 'id_tipo_teste']);
    }
    public function updateEstadoSeNecessario()
    {
        if (
            $this->estado === 'marcado' &&
            $this->data_realizacao !== null &&
            strtotime($this->data_realizacao) <= time()
        ) {
            $this->estado = 'realizado';
            return $this->save(false);
        }

        return false;
    }


}

>>>>>>> main
