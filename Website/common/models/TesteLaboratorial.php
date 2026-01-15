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
            [['id_pessoa', 'id_tipo_teste'], 'required'],
            [['id_pessoa', 'id_laboratorio', 'id_tipo_teste'], 'integer'],
            [['data_criacao', 'data_realizacao'], 'safe'],
            [['estado'], 'in', 'range' => ['pendente','marcado','realizado']],
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

