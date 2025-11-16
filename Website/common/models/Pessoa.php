<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pessoa".
 *
 * @property int $id
 * @property string|null $telefone
 * @property string $role
 * @property int|null $id_regiao
 * @property int|null $id_user
 * @property string $nome
 * @property string $n_identificacao_fiscal
 * @property string $morada
 * @property string $codigo_postal
 * @property string $n_seguranca_social
 * @property string $n_utente_saude
 * @property string $n_cartao_cidadao
 *
 * @property User $user
 */
class Pessoa extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ROLE_PACIENTE = 'paciente';
    const ROLE_COLABORADOR = 'colaborador';
    const ROLE_ADMIN = 'admin';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefone', 'id_regiao', 'id_user'], 'default', 'value' => null],
            [['role', 'nome', 'n_identificacao_fiscal', 'morada', 'codigo_postal', 'n_seguranca_social', 'n_utente_saude', 'n_cartao_cidadao'], 'required'],
            [['role'], 'string'],
            [['id_regiao', 'id_user'], 'integer'],
            [['telefone'], 'string', 'max' => 20],
            [['nome', 'morada', 'codigo_postal'], 'string', 'max' => 256],
            [['n_identificacao_fiscal', 'n_utente_saude'], 'string', 'max' => 9],
            [['n_seguranca_social'], 'string', 'max' => 11],
            [['n_cartao_cidadao'], 'string', 'max' => 15],
            ['role', 'in', 'range' => array_keys(self::optsRole())],
            [['id_user'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'telefone' => 'Telefone',
            'role' => 'Role',
            'id_regiao' => 'Id Regiao',
            'id_user' => 'Id User',
            'nome' => 'Nome',
            'n_identificacao_fiscal' => 'N Identificacao Fiscal',
            'morada' => 'Morada',
            'codigo_postal' => 'Codigo Postal',
            'n_seguranca_social' => 'N Seguranca Social',
            'n_utente_saude' => 'N Utente Saude',
            'n_cartao_cidadao' => 'N Cartao Cidadao',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }


    /**
     * column role ENUM value labels
     * @return string[]
     */
    public static function optsRole()
    {
        return [
            self::ROLE_PACIENTE => 'paciente',
            self::ROLE_COLABORADOR => 'colaborador',
            self::ROLE_ADMIN => 'admin',
        ];
    }

    /**
     * @return string
     */
    public function displayRole()
    {
        return self::optsRole()[$this->role];
    }

    /**
     * @return bool
     */
    public function isRolePaciente()
    {
        return $this->role === self::ROLE_PACIENTE;
    }

    public function setRoleToPaciente()
    {
        $this->role = self::ROLE_PACIENTE;
    }

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


}
