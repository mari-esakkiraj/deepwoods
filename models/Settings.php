<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string|null $company_name
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 * @property string|null $country
 * @property string|null $country_code
 * @property string|null $phone_no
 * @property string|null $gst
 * @property int|null $freight_charges
 * @property int|null $qty_alert
 * @property string|null $company_logo
 * @property string|null $gst_number
 * @property string|null $sales_prefix
 * @property string|null $company_email
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['freight_charges', 'qty_alert'], 'integer'],
            [['company_logo'], 'string'],
            [['company_name'], 'string', 'max' => 100],
            [['address_line_1', 'address_line_2', 'city', 'postal_code', 'gst_number', 'company_email'], 'string', 'max' => 255],
            [['state', 'country', 'country_code', 'phone_no', 'gst', 'sales_prefix'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'address_line_1' => 'Address',
            'address_line_2' => 'Address Line 2',
            'city' => 'City',
            'state' => 'State',
            'postal_code' => 'Postal Code',
            'country' => 'Country',
            'country_code' => 'Country Code',
            'phone_no' => 'Phone No',
            'gst' => 'GST/Tax',
            'freight_charges' => 'Freight Charges',
            'qty_alert' => 'Quantity Alert',
            'company_logo' => 'Company Logo',
            'gst_number' => 'GST/Tax Number',
            'sales_prefix' => 'Sales Prefix',
            'company_email' => 'Company Email',
        ];
    }
}
