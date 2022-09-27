<?php

namespace app\modules\v1\controllers;


use app\core\models\AppointmentBooking;


/**
 * User controller for the `v1` module
 */
class AppointmentBookingController extends ActiveController
{

    public $modelClass = AppointmentBooking::class;

    public function actions()
    {
        return [];
    }

     public function actionCreate()
     {
         $model = new AppointmentBooking();
         $body = \Yii::$app->request->getBodyParams();
         $model->appointment_id = $body['appointment_id'];
         $model->from = $body['from'];
         $model->to = $body['to'];
         $model->updated_by = 1;
         $model->created_by = 1;
         if($model->save())
            return "Successfully creating booking";
     }
}

