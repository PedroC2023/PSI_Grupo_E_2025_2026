<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "participacao_evento".
 *
 * @property int $id
 * @property int $id_evento
 * @property int $id_pessoa
 * @property string $data_participacao
 * @property string $status_participacao
 */
class ParticipacaoEvento extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'participacao_evento';
    }

    public function rules()
    {
        return [
            [['id_evento', 'id_pessoa'], 'required'],
            [['id_evento', 'id_pessoa'], 'integer'],
            [['data_participacao'], 'safe'],
            [['status_participacao'], 'string', 'max' => 50],
            // evitar duplicados: um mesmo utilizador não pode inscrever-se duas vezes num mesmo evento
            [['id_evento', 'id_pessoa'], 'unique', 'targetAttribute' => ['id_evento', 'id_pessoa'], 'message' => 'Já estás inscrito neste evento.'],
            // FK exist checks (opcionais)
            [['id_evento'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::class, 'targetAttribute' => ['id_evento' => 'id']],
            [['id_pessoa'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::class, 'targetAttribute' => ['id_pessoa' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_evento' => 'Evento',
            'id_pessoa' => 'Pessoa',
            'data_participacao' => 'Data Participação',
            'status_participacao' => 'Estado',
        ];
    }

    public function getEvento()
    {
        return $this->hasOne(Evento::class, ['id' => 'id_evento']);
    }

    public function getPessoa()
    {
        return $this->hasOne(Pessoa::class, ['id' => 'id_pessoa']);
    }
}
