<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form of `app\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'isBlocked', 'isRepeat', 'useNotification', 'active'], 'integer'],
            [['title', 'description', 'dateStart', 'timeStart', 'dateFinish', 'timeFinish', 'repeatType', 'repeatEnd', 'notifyType', 'created_at', 'updated_at'], 'safe'],
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
        $query = Activity::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'dateStart' => $this->dateStart,
            // 'timeStart' => $this->timeStart,
            'dateFinish' => $this->dateFinish,
            // 'timeFinish' => $this->timeFinish,
            'isBlocked' => $this->isBlocked,
            'isRepeat' => $this->isRepeat,
            'repeatEnd' => $this->repeatEnd,
            'useNotification' => $this->useNotification,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'repeatType', $this->repeatType])
            ->andFilterWhere(['like', 'notifyType', $this->notifyType]);

        return $dataProvider;
    }
}
