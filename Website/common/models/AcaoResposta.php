<?php
namespace common\models;

use Yii;

class AcaoResposta extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'acao_resposta';
    }

    public function rules()
    {
        return [
            [['id_evento', 'id_pessoa', 'id_tipo_acao'], 'required'],
            [['id_evento', 'id_pessoa', 'id_tipo_acao'], 'integer'],
            [['resposta'], 'string'],
            [['data'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_evento' => 'Evento',
            'id_pessoa' => 'Pessoa',
            'id_tipo_acao' => 'Tipo de Ação',
            'resposta' => 'Resposta',
            'data' => 'Data',
        ];
    }

    public function getTipoAcao()
    {
        return $this->hasOne(TipoAcao::class, ['id' => 'id_tipo_acao']);
    }
}


