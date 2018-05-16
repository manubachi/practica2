<?php

namespace app\models;

/**
 * This is the model class for table "inmuebles".
 *
 * @property int $id
 * @property int $propietario_id
 * @property int $n_habitaciones
 * @property int $n_wc
 * @property string $precio
 * @property bool $has_lavavajillas
 * @property bool $has_garage
 * @property bool $has_trastero
 * @property string $detalles
 *
 * @property Propietarios $propietario
 */
class Inmuebles extends \yii\db\ActiveRecord
{
    public $precio_minimo;
    public $precio_maximo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inmuebles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['propietario_id'], 'required'],
            [['propietario_id', 'n_habitaciones', 'n_wc'], 'default', 'value' => null],
            [['propietario_id', 'n_habitaciones', 'n_wc'], 'integer'],
            [['precio', 'precio_minimo'], 'number'],
            [['has_lavavajillas', 'has_garage', 'has_trastero'], 'boolean'],
            [['detalles'], 'string', 'max' => 255],
            [['propietario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Propietarios::className(), 'targetAttribute' => ['propietario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'propietario_id' => 'Propietario ID',
            'n_habitaciones' => 'N Habitaciones',
            'n_wc' => 'N Wc',
            'precio' => 'Precio',
            'has_lavavajillas' => 'Con Lavavajillas',
            'has_garage' => 'Con Garaje',
            'has_trastero' => 'Con Trastero',
            'detalles' => 'Detalles',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropietario()
    {
        return $this->hasOne(Propietarios::className(), ['id' => 'propietario_id']);
    }
}
