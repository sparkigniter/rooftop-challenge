<?php

namespace app\modules\v1\controllers;


use app\core\models\User;

/**
 * User controller for the `v1` module
 */
class UserController extends ActiveController
{

    public $modelClass = User::class;

    public function actions()
    {
        return [];
    }

    public function actionIndex()
     {
         return User::find()->where(['is_deleted' => false])->all();
     }
}
