<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $uid
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property int $bookingUid
 * @property string $orderId
 * @property string $type
 * @property float|null $priceTotal
 * @property string|null $creationDateTime
 * @property string|null $expireDateTime
 * @property string $status
 * @property string|null $data
 *
 * @property Booking $bookingU
 * @property Refund[] $refunds
 * @property SmsLog[] $smsLogs
 * @property TicketBlank[] $ticketBlanks
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createdTime', 'updatedTime', 'creationDateTime', 'expireDateTime'], 'safe'],
            [['bookingUid', 'orderId', 'type', 'status'], 'required'],
            [['bookingUid'], 'integer'],
            [['priceTotal'], 'number'],
            [['data'], 'string'],
            [['orderId', 'type', 'status'], 'string', 'max' => 255],
            [['bookingUid'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['bookingUid' => 'uid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'bookingUid' => 'Booking Uid',
            'orderId' => 'Order ID',
            'type' => 'Type',
            'priceTotal' => 'Price Total',
            'creationDateTime' => 'Creation Date Time',
            'expireDateTime' => 'Expire Date Time',
            'status' => 'Status',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingU()
    {
        return $this->hasOne(Booking::className(), ['uid' => 'bookingUid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefunds()
    {
        return $this->hasMany(Refund::className(), ['orderUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmsLogs()
    {
        return $this->hasMany(SmsLog::className(), ['orderUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketBlanks()
    {
        return $this->hasMany(TicketBlank::className(), ['orderUid' => 'uid']);
    }
}
