<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DiaposCarrusel;

/**
 * DiaposCarruselSearch represents the model behind the search form about `app\models\DiaposCarrusel`.
 */
class DiaposCarruselSearch extends DiaposCarrusel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'titulo_tam_fuente', 'titulo_fr', 'titulo_pt'], 'integer'],
            [['ruta_imagen', 'titulo_alineacion', 'titulo_en', 'titulo_es', 'descripcion_tam_fuente', 'descripcion_alineacion', 'descripcion_en', 'descripcion_es', 'descripcion_fr', 'descripcion_pt'], 'safe'],
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
        $query = DiaposCarrusel::find();

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
            'titulo_tam_fuente' => $this->titulo_tam_fuente,
            'titulo_fr' => $this->titulo_fr,
            'titulo_pt' => $this->titulo_pt,
        ]);

        $query->andFilterWhere(['like', 'ruta_imagen', $this->ruta_imagen])
            ->andFilterWhere(['like', 'titulo_alineacion', $this->titulo_alineacion])
            ->andFilterWhere(['like', 'titulo_en', $this->titulo_en])
            ->andFilterWhere(['like', 'titulo_es', $this->titulo_es])
            ->andFilterWhere(['like', 'descripcion_tam_fuente', $this->descripcion_tam_fuente])
            ->andFilterWhere(['like', 'descripcion_alineacion', $this->descripcion_alineacion])
            ->andFilterWhere(['like', 'descripcion_en', $this->descripcion_en])
            ->andFilterWhere(['like', 'descripcion_es', $this->descripcion_es])
            ->andFilterWhere(['like', 'descripcion_fr', $this->descripcion_fr])
            ->andFilterWhere(['like', 'descripcion_pt', $this->descripcion_pt]);

        return $dataProvider;
    }
}
