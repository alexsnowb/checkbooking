<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Booking;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Class CheckController
 * @package app\commands
 */
class CheckController extends Controller
{
	/**
	 * @return int
	 */
    public function actionBooking()
    {

	    /** @var Booking[] $badBookingList */
        $badBookingList = Booking::find()
	        ->joinWith('transactions')
	        ->where([
	        	'transaction.status' => 'success',
		        ])
	        ->andWhere(['!=', 'booking.status', 'Sold'])
	        ->andWhere(['>', 'booking.createdTime', '2019-11-11 11:11:11'])
            ->all();


	    foreach ( $badBookingList as $booking ) {
		    echo $booking->uid.PHP_EOL;
        }

        return ExitCode::OK;
    }
}
