<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * InmueblesSearch represents the model behind the search form of `app\models\Inmuebles`.
 */
class InmueblesSearch extends Inmuebles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'propietario_id', 'n_habitaciones', 'n_wc'], 'integer'],
            [['precio', 'precio_minimo', 'precio_maximo'], 'number'],
            [['has_lavavajillas', 'has_garage', 'has_trastero'], 'boolean'],
            [['detalles'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'precio_minimo',
            'precio_maximo',
            'propietario.telefono',
        ]);
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
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Inmuebles::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->joinWith(['propietario p']);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['precio_minimo'] = [
            'asc' => ['precio_minimo' => SORT_ASC],
            'desc' => ['precio_minimo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['precio_maximo'] = [
            'asc' => ['precio_maximo' => SORT_ASC],
            'desc' => ['precio_maximo' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            //'n_habitaciones'   => $this->n_habitaciones,
            //'n_wc'             => $this->n_wc,
            'has_lavavajillas' => $this->has_lavavajillas,
            'has_garage' => $this->has_garage,
            'has_trastero' => $this->has_trastero,
        ]);
        $query->andFilterWhere(['>=', 'n_habitaciones', $this->n_habitaciones])
        ->andFilterWhere(['>=', 'n_wc', $this->n_wc])
        ->andFilterWhere(['>=', 'precio', $this->precio_minimo])
        ->andFilterWhere(['<=', 'precio', $this->precio_maximo]);

        $query->andFilterWhere(['ilike', 'detalles', $this->detalles]);

        return $dataProvider;
    }
}
