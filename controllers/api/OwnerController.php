<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "OwnerController".
 */

use Yii;
use app\models\Owner;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class OwnerController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Owner';
    
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
            $model = Owner::findOne($id);

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

        $query = Owner::find();

        $query
            ->andFilterWhere(['like', 'name', $q])
            ->andWhere(['is_deleted' => FALSE])
            ->limit(20);

        $mapper = [
            Owner::className() => [
                'id' => 'id',
                'text' => 'name',
            ],
        ];

        $output['results'] = ArrayHelper::toArray($query->all(), $mapper);

        return $output;
    }

}
