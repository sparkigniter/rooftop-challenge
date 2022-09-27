<?php

namespace app\core\models;

use app\core\types\UserStatus;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yiier\helpers\DateHelper;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $created_at
 * @property int $updated_at
 */
class Appointment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%appointment}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return array
     */
    public function fields()
    {
        $fields = parent::fields();

        $fields['created_at'] = function (self $model) {
            return DateHelper::datetimeToIso8601($model->created_at);
        };

        $fields['updated_at'] = function (self $model) {
            return DateHelper::datetimeToIso8601($model->updated_at);
        };

        return $fields;
    }

    public function getWeekDay(){
       return $this->hasOne(Weekday::className(),['id' => 'week_day_id'])->one();
    }

    public function getTimeZone(){
        return $this->hasOne(Timezone::className(),['id' => 'timezone_id'])->one();
    }
}
