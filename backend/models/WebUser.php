<?php

namespace backend\models;

use Yii;
use yii\web\IdentityInterface;

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
 * @property Role $role
 */
class WebUser extends Users implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::find()->where(['=','id',$id])->one();
    }

}
