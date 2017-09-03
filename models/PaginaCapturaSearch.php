<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaginaCaptura;

/**
 * PaginaCapturaSearch represents the model behind the search form about `app\models\PaginaCaptura`.
 */
class PaginaCapturaSearch extends PaginaCaptura
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'titulo_tam_fuente', 'contenido_tam_fuente', 'estado'], 'integer'],
            [['ruta_imagen_fondo', 'titulo_alineacion', 'titulo_en', 'titulo_es', 'titulo_fr', 'titulo_pt', 'contenido_alineacion', 'contenido_en', 'contenido_es', 'contenido_fr', 'contenido_pt'], 'safe'],
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
        $query = PaginaCaptura::find();

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
            'contenido_tam_fuente' => $this->contenido_tam_fuente,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'ruta_imagen_fondo', $this->ruta_imagen_fondo])
            ->andFilterWhere(['like', 'titulo_alineacion', $this->titulo_alineacion])
            ->andFilterWhere(['like', 'titulo_en', $this->titulo_en])
            ->andFilterWhere(['like', 'titulo_es', $this->titulo_es])
            ->andFilterWhere(['like', 'titulo_fr', $this->titulo_fr])
            ->andFilterWhere(['like', 'titulo_pt', $this->titulo_pt])
            ->andFilterWhere(['like', 'contenido_alineacion', $this->contenido_alineacion])
            ->andFilterWhere(['like', 'contenido_en', $this->contenido_en])
            ->andFilterWhere(['like', 'contenido_es', $this->contenido_es])
            ->andFilterWhere(['like', 'contenido_fr', $this->contenido_fr])
            ->andFilterWhere(['like', 'contenido_pt', $this->contenido_pt]);

        return $dataProvider;
    }
}
