<?php

namespace app\modules\v1\controllers;


use app\core\models\Appointment;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\ServerErrorHttpException;

/**
 * User controller for the `v1` module
 */
class AppointmentController extends ActiveController
{

    public $modelClass = Appointment::class;

    public function actions()
    {
        return [];
    }

    /**
     * @return array
     * @throws ServerErrorHttpException
     * This function returns the 30 mins slots for a user availability
     */
     public function actionSlots()
     {
         try {
             //TODO :: ADD VALIDATION FOR ALREADY BOOKED SLOT
             $days = $this->loadModel();
             $timeslots = [];
             foreach ($days as $day) {
                 $available_at = strtotime($day['available_at']);
                 $available_till = strtotime($day['available_till']);
                 while ($available_at <= $available_till) //Run loop
                 {
                     $from = date("G:i", $available_at);
                     $available_at += 30 * 60;
                     $to = date("G:i", $available_at);
                     ArrayHelper::setValue($timeslots[], ArrayHelper::getValue($day->getWeekDay(), 'title'), ['appointment_id'=> $day['id'], 'from' => $from, 'to' => $to, 'timezone' => ($day->getTimeZone())['title']]);
                 }
             }
             return $timeslots;
         }catch (Exception $e){
             throw new ServerErrorHttpException("Something went wrong");
         }
     }

    /**
     * @return array|\yii\db\ActiveRecord[]
     * This function returns the appointment model data
     */
     private function loadModel() {
       return Appointment::find()->alias('a')
             ->select('*')
             ->innerJoin('public.user u', 'u.id = a.user_id')
             ->innerJoin('week_day w', 'w.id = a.week_day_id')
             ->where(['and', [
                 'a.is_deleted' => false,
                 'u.is_deleted' => false,
                 'w.is_deleted' => false,
                 'u.id' => \Yii::$app->request->headers['user_id']
             ]])->all();
     }
}

