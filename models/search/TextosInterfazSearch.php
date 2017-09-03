<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TextosInterfaz;

/**
 * TextosInterfazSearch represents the model behind the search form about `app\models\TextosInterfaz`.
 */
class TextosInterfazSearch extends TextosInterfaz
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['titulo_es', 'titulo_en', 'titulo_fr', 'titulo_pt', 'contenido_es', 'contenido_en', 'contenido_fr', 'contenido_pt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = TextosInterfaz::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'titulo_es', $this->titulo_es])
            ->andFilterWhere(['like', 'titulo_en', $this->titulo_en])
            ->andFilterWhere(['like', 'titulo_fr', $this->titulo_fr])
            ->andFilterWhere(['like', 'titulo_pt', $this->titulo_pt])
            ->andFilterWhere(['like', 'contenido_es', $this->contenido_es])
            ->andFilterWhere(['like', 'contenido_en', $this->contenido_en])
            ->andFilterWhere(['like', 'contenido_fr', $this->contenido_fr])
            ->andFilterWhere(['like', 'contenido_pt', $this->contenido_pt]);

        return $dataProvider;
    }
}
