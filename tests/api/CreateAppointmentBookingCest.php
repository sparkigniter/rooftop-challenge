<?php

namespace app\tests\api;

use ApiTester;
use app\core\exceptions\ErrorCodes;
use Codeception\Example;
use Codeception\Util\HttpCode;

class CreateAppointmentBookingCest
{
    /**
     * @codingStandardsIgnoreStart
     * @param ApiTester $I
     */
    public function _before(ApiTester $I)
    {
        // @codingStandardsIgnoreEnd
    }

    /**
     * @param ApiTester $I
     */
    public function createAppointmentBooking(ApiTester $I)
    {
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPOST('appointment-booking/create', [
            'appointment_id' => '2',
            'from' => '5:00:00',
            'to' => '5:30:00',
        ]);
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }

    /**
     * @param ApiTester $I
     */
    public function createAppointmentBookingFailure(ApiTester $I)
    {
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPOST('appointment-booking/create', [
            'appointment_id' => 'demo',
            'from' => '5:00:00',
            'to' => '5:30:00',
        ]);
        $I->seeResponseCodeIs(HttpCode::INTERNAL_SERVER_ERROR); // 500
        $I->seeResponseIsJson();
    }
}
