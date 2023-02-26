<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Settings;

/**
 * SettingsSearch represents the model behind the search form of `app\models\Settings`.
 */
class SettingsSearch extends Settings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['company_name', 'address_line_1', 'address_line_2', 'city', 'state', 'postal_code', 'country', 'country_code', 'phone_no', 'gst', 'company_logo', 'gst_number', 'sales_prefix', 'company_email'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Settings::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'address_line_1', $this->address_line_1])
            ->andFilterWhere(['like', 'address_line_2', $this->address_line_2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'country_code', $this->country_code])
            ->andFilterWhere(['like', 'phone_no', $this->phone_no])
            ->andFilterWhere(['like', 'gst', $this->gst])
            ->andFilterWhere(['like', 'company_logo', $this->company_logo])
            ->andFilterWhere(['like', 'gst_number', $this->gst_number])
            ->andFilterWhere(['like', 'sales_prefix', $this->sales_prefix])
            ->andFilterWhere(['like', 'company_email', $this->company_email]);

        return $dataProvider;
    }
}
