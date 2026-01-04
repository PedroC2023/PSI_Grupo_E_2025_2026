<?php

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
            [
                ['titulo', 'descricao', 'data_inicio', 'data_fim', 'tipo_evento',
                 'status', 'pais', 'regiao', 'cidade', 'endereco'],
                'required'
            ],

            [['data_inicio', 'data_fim'], 'safe'],

            [
                'data_inicio',
                'compare',
                'compareAttribute' => 'data_fim',
                'operator' => '<',
                'type' => 'datetime',
                'message' => 'A data de início deve ser anterior à data de fim.'
            ],

            [['titulo', 'descricao', 'tipo_evento', 'status',
              'pais', 'regiao', 'cidade', 'endereco'], 'string', 'max' => 256],

            ['status', 'in', 'range' => ['aberto', 'fechado']],

            // quem criou o evento (colaborador)
            [['id_utilizador'], 'integer'],
            [['id_utilizador'], 'required'],
            [['id_utilizador'], 'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['id_utilizador' => 'id']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Título',
            'descricao' => 'Descrição',
            'data_inicio' => 'Data Início',
            'data_fim' => 'Data Fim',
            'tipo_evento' => 'Tipo de Evento',
            'status' => 'Estado',
            'pais' => 'País',
            'regiao' => 'Região',
            'cidade' => 'Cidade',
            'endereco' => 'Endereço',
        ];
    }

    // ================== LÓGICA ==================

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

    // ================== RELAÇÕES ==================

    public function getParticipacoes()
    {
        return $this->hasMany(ParticipacaoEvento::class, ['id_evento' => 'id']);
    }

    public function getCriador()
    {
        return $this->hasOne(User::class, ['id' => 'id_utilizador']);
    }
}
?>