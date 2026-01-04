<?php
namespace common\models;

use Yii;

class ParticipacaoEvento extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'participacao_evento';
    }

    public function rules()
    {
        return [
            [['id_evento', 'id_utilizador'], 'required'],
            [['id_evento', 'id_utilizador'], 'integer'],
            [['data_participacao'], 'safe'],
            [['status_participacao'], 'string', 'max' => 50],

            // evitar inscrições duplicadas
            [['id_evento', 'id_utilizador'], 'unique',
                'targetAttribute' => ['id_evento', 'id_utilizador'],
                'message' => 'Já estás inscrito neste evento.'
            ],

            // FK correta → EVENTO
            [['id_evento'], 'exist',
                'skipOnError' => true,
                'targetClass' => Evento::class,
                'targetAttribute' => ['id_evento' => 'id']
            ],

            // FK correta → USER (NÃO Pessoa)
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
            'id_evento' => 'Evento',
            'id_utilizador' => 'Utilizador',
            'data_participacao' => 'Data Participação',
            'status_participacao' => 'Estado',
        ];
    }

    // ================= RELAÇÕES =================

    public function getEvento()
    {
        return $this->hasOne(Evento::class, ['id' => 'id_evento']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_utilizador']);
    }

    public function getPessoa()
    {
        return $this->hasOne(Pessoa::class, ['id_user' => 'id_utilizador']);
    }
}
