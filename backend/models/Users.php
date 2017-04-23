<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property integer $role_id
 * @property string $name
 * @property string $email
 * @property integer $status
 * @property string $create_date
 * @property string $update_date
 *
 * @property Fee[] $fees
 * @property Fee[] $fees0
 * @property Role $role
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'name', 'email', 'status'], 'required'],
            [['role_id', 'status'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            ['email', 'email'],
            [['name', 'email'], 'string', 'max' => 255],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'name' => 'Name',
            'email' => 'Email',
            'status' => 'Status',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFees()
    {
        return $this->hasMany(Fee::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFees0()
    {
        return $this->hasMany(Fee::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    public function beforeSave($insert){
        $now = Yii::$app->formatter->asDatetime('now','php:Y-m-d H:i:s');
        if($this->isNewRecord){
            $this->create_date = $now;
        }
        $this->update_date = $now;
        return parent::beforeSave($insert);
    }
}
