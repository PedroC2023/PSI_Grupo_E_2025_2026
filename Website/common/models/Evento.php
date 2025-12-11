<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descricao
 * @property string $data_inicio
 * @property string $data_fim
 * @property string $tipo_evento
 * @property string $status
 * @property int $id_utilizador
 * @property string $pais
 * @property string $regiao
 * @property string $cidade
 * @property string $endereco
 */
namespace common\models;

use Yii;

class Evento extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'evento';
    }

    public function rules()
    {
        return [
            [['titulo', 'descricao', 'data_inicio', 'data_fim', 'tipo_evento',
              'pais', 'regiao', 'cidade', 'endereco'], 'required'],
            ['status', 'in', 'range' => ['aberto', 'fechado']],

            [['data_inicio', 'data_fim'], 'safe'],
            [['titulo', 'descricao', 'tipo_evento', 'status',
              'pais', 'regiao', 'cidade', 'endereco'], 'string', 'max' => 256],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Título',
            'descricao' => 'Descrição',
            [['titulo','data_inicio','data_fim','tipo_evento','status'], 'required'],
            [['data_inicio','data_fim'], 'safe'],
            ['data_inicio', 'compare', 'compareAttribute' => 'data_fim', 'operator' => '<', 'type' => 'datetime', 'message' => 'A data de início deve ser anterior à data de fim.'],
            'tipo_evento' => 'Tipo',
            'status' => 'Estado',
            'pais' => 'País',
            'regiao' => 'Região',
            'cidade' => 'Cidade',
            'endereco' => 'Endereço',
        ];
    }

    public function isExpired()
    {
        return strtotime($this->data_fim) < time();
    }

    public function updateStatusIfNeeded()
    {
        if ($this->isExpired() && $this->status !== 'fechado') {
            $this->status = 'fechado';
            $this->save(false, ['status']);
        }
    }


    public function getParticipacoes()
    {
        return $this->hasMany(ParticipacaoEvento::class, ['id_evento' => 'id']);
    }

    public function getColaboradores()
    {
        return $this->hasMany(ColaboracaoEvento::class, ['id_evento' => 'id']);
    }
}

