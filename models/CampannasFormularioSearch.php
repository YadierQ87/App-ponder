<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CampannasFormulario;

/**
 * CampannasFormularioSearch represents the model behind the search form about `app\models\CampannasFormulario`.
 */
class CampannasFormularioSearch extends CampannasFormulario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'duracion_dias', 'user_creo', 'cantd_repeticiones'], 'integer'],
            [['nombre_campanna', 'dia_envio', 'hora_envio', 'tipo_tarea', 'fecha_creado', 'ult_fecha_ejecucion'], 'safe'],
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
        $query = CampannasFormulario::find();

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
            'dia_envio' => $this->dia_envio,
            'hora_envio' => $this->hora_envio,
            'duracion_dias' => $this->duracion_dias,
            'user_creo' => $this->user_creo,
            'fecha_creado' => $this->fecha_creado,
            'cantd_repeticiones' => $this->cantd_repeticiones,
            'ult_fecha_ejecucion' => $this->ult_fecha_ejecucion,
        ]);

        $query->andFilterWhere(['like', 'nombre_campanna', $this->nombre_campanna])
            ->andFilterWhere(['like', 'tipo_tarea', $this->tipo_tarea]);

        return $dataProvider;
    }
}
