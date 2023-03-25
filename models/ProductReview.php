<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_review".
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property string|null $review
 * @property int $review_type
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class ProductReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id', 'review'], 'required'],
            [['product_id', 'user_id', 'review_type', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['review'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'review' => 'Review',
            'review_type' => 'Review Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
