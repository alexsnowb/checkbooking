<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $uid
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property float $amount
 * @property string $currency
 * @property int $bookingUid
 * @property int $paymentSystemUid
 * @property string|null $log
 * @property string|null $paymentTime
 * @property string|null $gateType
 * @property float|null $commission
 * @property float|null $rusetPayment
 * @property string|null $status
 * @property string|null $psId
 *
 * @property Receipt[] $receipts
 * @property Booking $bookingU
 * @property PaymentSystem $paymentSystemU
 * @property TransactionHistory[] $transactionHistories
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createdTime', 'updatedTime', 'paymentTime'], 'safe'],
            [['amount', 'currency', 'bookingUid', 'paymentSystemUid'], 'required'],
            [['amount', 'commission', 'rusetPayment'], 'number'],
            [['bookingUid', 'paymentSystemUid'], 'integer'],
            [['log', 'gateType', 'status', 'psId'], 'string'],
            [['currency'], 'string', 'max' => 255],
            [['bookingUid'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['bookingUid' => 'uid']],
            [['paymentSystemUid'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentSystem::className(), 'targetAttribute' => ['paymentSystemUid' => 'uid']],
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
            'amount' => 'Amount',
            'currency' => 'Currency',
            'bookingUid' => 'Booking Uid',
            'paymentSystemUid' => 'Payment System Uid',
            'log' => 'Log',
            'paymentTime' => 'Payment Time',
            'gateType' => 'Gate Type',
            'commission' => 'Commission',
            'rusetPayment' => 'Ruset Payment',
            'status' => 'Status',
            'psId' => 'Ps ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::className(), ['transactionUid' => 'uid']);
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
    public function getPaymentSystemU()
    {
        return $this->hasOne(PaymentSystem::className(), ['uid' => 'paymentSystemUid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionHistories()
    {
        return $this->hasMany(TransactionHistory::className(), ['transactionUid' => 'uid']);
    }
}
