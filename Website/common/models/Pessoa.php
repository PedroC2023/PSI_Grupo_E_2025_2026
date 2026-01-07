<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Pessoa extends ActiveRecord
{
    public static function tableName()
    {
        return 'pessoa';
    }

    public function rules()
    {
        return [
            [['nome', 'n_identificacao_fiscal', 'morada', 'codigo_postal'], 'required'],
            [['id_regiao', 'id_user'], 'integer'],
            [['telefone'], 'string', 'max' => 20],
            [['nome', 'morada', 'codigo_postal'], 'string', 'max' => 256],
            [['n_identificacao_fiscal'], 'string', 'max' => 9],
            [['id_user'], 'unique'],
            [
                ['id_user'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['id_user' => 'id']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'telefone' => 'Telefone',
            'morada' => 'Morada',
            'codigo_postal' => 'Código Postal',
            'n_identificacao_fiscal' => 'NIF',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }

    /* Helpers opcionais (não obrigatórios) */
    public function isPaciente()
    {
        return Yii::$app->user->can('viewMyTestes');
    }

    public function isColaborador()
    {
        return Yii::$app->user->can('manageTestes');
    }

    public function isAdmin()
    {
        return Yii::$app->user->can('admin');
    }
    public function isCompleta()
    {
        return (bool) $this->perfil_completo;
    }
<<<<<<< HEAD

    /**
     * @return bool
     */
    public function isRoleColaborador()
    {
        return $this->role === self::ROLE_COLABORADOR;
    }

    public function setRoleToColaborador()
    {
        $this->role = self::ROLE_COLABORADOR;
    }

    /**
     * @return bool
     */
    public function isRoleAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function setRoleToAdmin()
    {
        $this->role = self::ROLE_ADMIN;
    }
    
    public function applyRole()
    {
        $auth = Yii::$app->authManager;

        // Remove roles antigos
        $auth->revokeAll($this->id_user);

        // Atribui o role atual
        $role = $auth->getRole($this->role);
        if ($role !== null) {
            $auth->assign($role, $this->id_user);
        }
    }
    public function init()
    {
        parent::init();

        if ($this->isNewRecord) {
            $this->role = 'paciente';
        }
    }
    public function getParticipacoes()
    {
        return $this->hasMany(ParticipacaoEvento::class, ['id_pessoa' => 'id']);
    }

    public function getColaboracoes()
    {
        return $this->hasMany(ColaboracaoEvento::class, ['id_pessoa' => 'id']);
    }



=======
>>>>>>> main
}
