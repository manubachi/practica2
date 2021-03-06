<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InmueblesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inmuebles';
$this->params['breadcrumbs'][] = $this->title;
$js = <<< JS
    $('.btnTelefono').on('click', function() {
        $(this).text('Nº telefono del propietario : '+ $(this).data("telefono"));
        $(this).removeClass('btnTelefono');
    });
JS;
$this->registerJs($js);
?>
<div class="inmuebles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?= Html::a('Create Inmuebles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'propietario_id',
            'n_habitaciones',
            'n_wc',
            'precio',
            'has_lavavajillas:boolean:¿Tiene Lavavajillas?',
            'has_garage:boolean:¿Tiene Garaje?',
            'has_trastero:boolean:¿Tiene Trastero?',
            'detalles',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{interesado}',
                'buttons' => [
                    'interesado' => function ($url, $model, $key){
                        return Html::button('Estoy Interesado', [
                            'class' =>'btnTelefono btn-sm btn-info',
                            'data-telefono' => $model->propietario->telefono
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>


</div>
