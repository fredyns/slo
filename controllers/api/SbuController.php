<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "SbuController".
 */

use Yii;
use app\models\Sbu;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class SbuController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Sbu';
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [];
    }

    /**
     * 
     * @param string $q
     * @param integer $id
     * @return array
     */
    public function actionList($q = null, $id = null)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $minimumInputLength = 2;
        $output = [
            'results' => [
                [
                    'id' => '',
                    'text' => '',
                ]
            ],
        ];

        if (empty($q) OR strlen($q) < $minimumInputLength) {
            return $output;
        }

        if ($id > 0) {
            $model = Sbu::findOne($id);

            if ($model) {
                $output['results'] = [
                    [
                        'id' => $id,
                        'text' => $model->name,
                    ]
                ];

                return $output;
            }
        }

        $query = Sbu::find();

        $query
            ->andFilterWhere(['like', 'name', $q])
            ->andWhere(['is_deleted' => FALSE])
            ->limit(20);

        $mapper = [
            Sbu::className() => [
                'id' => 'id',
                'text' => 'name',
            ],
        ];

        $output['results'] = ArrayHelper::toArray($query->all(), $mapper);

        return $output;
    }

}
