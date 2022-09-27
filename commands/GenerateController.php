<?php

namespace app\commands;

use app\core\models\Timezone;
use app\core\models\User;
use app\core\models\Weekday;
use app\core\service\File;
use yii\console\Controller;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;


class GenerateController extends Controller
{
    /**
     * @return void
     * @throws \yii\console\Exception
     */
    public function actionUserData()
    {
        try {
            $file = './init/data/seed-data.csv';
            $data = File::readCSV($file);
            $users = ArrayHelper::getColumn($data, '0');
            unset($users[0]);
            $users = array_unique($users);
            foreach ($users as $user) {
                $name = explode(" ", $user);
                $users_data[] = [
                    'first_name' => $name[0],
                    'last_name' => $name[1],
                    'created_by' => 1,
                    'updated_by' => 1,
                    'updated_at' => date('c', time()),
                    'created_at' => date('c', time())
                ];
            }
            $ret = \Yii::$app->db->createCommand()->batchInsert('user', ['first_name', 'last_name', 'created_by', 'updated_by', 'updated_at', 'created_at'], $users_data)->execute();
            if ($ret) {
                Console::output("Migrated Users data");
            }
        } catch (\Exception $e) {
            throw new \yii\console\Exception("Error");
        }
    }

    /**
     * @return void
     * @throws \yii\console\Exception
     */
    public function actionTimezoneData(){
        try {
            $file = './init/data/seed-data.csv';
            $data = File::readCSV($file);
            $timezones = ArrayHelper::getColumn($data, '1');
            unset($timezones[0]);
            $timezones = array_unique($timezones);
            foreach ($timezones as $timezone) {
                $timezone_data[] = [
                    'title' => $timezone,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'updated_at' => date('c', time()),
                    'created_at' => date('c', time())
                ];
            }
            $ret = \Yii::$app->db->createCommand()->batchInsert('timezone', ['title', 'created_by', 'updated_by', 'updated_at', 'created_at'], $timezone_data)->execute();
            if ($ret) {
                Console::output("Migrated Timezone data");
            }
        }catch (\Exception $e){
            throw new \yii\console\Exception($e);
        }
    }

    /**
     * @return void
     * @throws \yii\console\Exception
     */
    public function actionWeekDaysData(){
        try {
            $file = './init/data/seed-data.csv';
            $data = File::readCSV($file);
            $week_days = ArrayHelper::getColumn($data, '2');
            unset($week_days[0]);
            $week_days = array_unique($week_days);
            foreach ($week_days as $week_day) {
                $week_days_data[] = [
                    'title' => $week_day,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'updated_at' => date('c', time()),
                    'created_at' => date('c', time())
                ];
            }
            $ret = \Yii::$app->db->createCommand()->batchInsert('week_day', ['title', 'created_by', 'updated_by', 'updated_at', 'created_at'], $week_days_data)->execute();
            if ($ret) {
                Console::output("Migrated Users data");
            }
        }catch (\Exception $e){
            throw new \yii\console\Exception("Error");
        }
    }

    public function actionAppointmentData(){
        try{
            $file = './init/data/seed-data.csv';
            $appointments = File::readCSV($file);
            unset($appointments[0]);
            foreach ($appointments as $appointment){
                $name = explode(" ", $appointment[0]);
                $user_id = (User::findOne(['first_name'=> $name[0], 'last_name' => $name[1]]))->id;
                $timezone_id = (Timezone::findOne(['title'=> $appointment[1]]))->id;
                $weekday_id = (Weekday::findOne(['title'=> $appointment[2]]))->id;
                $appointment_data[] = [
                    'user_id' => $user_id,
                    'timezone_id' => $timezone_id,
                    'week_day_id' => $weekday_id,
                    'available_at' => $appointment[3],
                    'available_till' => $appointment[4],
                    'created_by' => 1,
                    'updated_by' => 1,
                    'updated_at' => date('c', time()),
                    'created_at' => date('c', time())
                ];
            }
            $ret = \Yii::$app->db->createCommand()->batchInsert('appointment', ['user_id','timezone_id','week_day_id', 'available_at','available_till', 'created_by', 'updated_by', 'updated_at', 'created_at'], $appointment_data)->execute();
            if ($ret) {
                Console::output("Migrated Users data");
            }
        }catch (\Exception $e){
            throw new \yii\console\Exception($e);
        }
    }
}
