<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fee".
 *
 * @property integer $int
 * @property integer $user_id
 * @property integer $fee
 * @property integer $fee_type
 * @property integer $created_by
 * @property string $create_date
 * @property string $last_date
 * @property integer $status
 *
 * @property Users $user
 * @property Users $createdBy
 */
class Fee extends \yii\db\ActiveRecord
{
    const FEE_TYPE_MONTHLY = 'monthly';
    const FEE_TYPE_YEARLY = 'yearly';
    const FEE_TYPE_QUATERLY = 'quaterly';

    const YES = 'yes';
    const NO = 'no';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'fee', 'fee_type', 'status'], 'required'],
            [['user_id', 'fee', 'status'], 'integer'],
            [['create_date', 'last_date'], 'safe'],
            [['fee_type'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'int' => 'Int',
            'user_id' => 'User ID',
            'fee' => 'Fee',
            'fee_type' => 'Fee Type',
            'created_by' => 'Created By',
            'create_date' => 'Create Date',
            'last_date' => 'Last Date',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeType(){
        return
            [   self::FEE_TYPE_MONTHLY => ucfirst(self::FEE_TYPE_MONTHLY) ,
                self::FEE_TYPE_QUATERLY => ucfirst(self::FEE_TYPE_QUATERLY),
                self::FEE_TYPE_YEARLY => ucfirst(self::FEE_TYPE_YEARLY),
            ];

    }

}
