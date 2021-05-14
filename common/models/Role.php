<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%role}}".
 *
 * @property int $id
 * @property int $role_code
 * @property string $rolename
 * @property string|null $description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User[] $users
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_code', 'rolename'], 'required'],
            [['role_code', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['rolename'], 'string', 'max' => 255],
            [['role_code'], 'unique'],
            [['rolename'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_code' => 'Role Code',
            'rolename' => 'Rolename',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role' => 'role_code']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RoleQuery(get_called_class());
    }
}
