<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $uid
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property int|null $clientUid
 * @property string $expireTime
 * @property string|null $id
 * @property string $status
 * @property int|null $agentUid
 * @property int|null $siteUid
 * @property float|null $priceTotal
 * @property float|null $paymentCommission
 * @property float|null $paymentTotal
 *
 * @property Advert[] $adverts
 * @property BookLog[] $bookLogs
 * @property User $agentU
 * @property Client $clientU
 * @property Site $siteU
 * @property BookingHistory[] $bookingHistories
 * @property BookingPricePart[] $bookingPriceParts
 * @property Order[] $orders
 * @property Receipt[] $receipts
 * @property Recipient[] $recipients
 * @property Refund[] $refunds
 * @property Reversal[] $reversals
 * @property SmsLog[] $smsLogs
 * @property Transaction[] $transactions
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createdTime', 'updatedTime', 'expireTime'], 'safe'],
            [['clientUid', 'agentUid', 'siteUid'], 'integer'],
            [['status'], 'required'],
            [['priceTotal', 'paymentCommission', 'paymentTotal'], 'number'],
            [['id', 'status'], 'string', 'max' => 255],
            [['agentUid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['agentUid' => 'uid']],
            [['clientUid'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['clientUid' => 'uid']],
            [['siteUid'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteUid' => 'uid']],
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
            'clientUid' => 'Client Uid',
            'expireTime' => 'Expire Time',
            'id' => 'ID',
            'status' => 'Status',
            'agentUid' => 'Agent Uid',
            'siteUid' => 'Site Uid',
            'priceTotal' => 'Price Total',
            'paymentCommission' => 'Payment Commission',
            'paymentTotal' => 'Payment Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Advert::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookLogs()
    {
        return $this->hasMany(BookLog::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgentU()
    {
        return $this->hasOne(User::className(), ['uid' => 'agentUid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientU()
    {
        return $this->hasOne(Client::className(), ['uid' => 'clientUid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteU()
    {
        return $this->hasOne(Site::className(), ['uid' => 'siteUid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingHistories()
    {
        return $this->hasMany(BookingHistory::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingPriceParts()
    {
        return $this->hasMany(BookingPricePart::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipients()
    {
        return $this->hasMany(Recipient::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefunds()
    {
        return $this->hasMany(Refund::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReversals()
    {
        return $this->hasMany(Reversal::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmsLogs()
    {
        return $this->hasMany(SmsLog::className(), ['bookingUid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['bookingUid' => 'uid']);
    }
}
