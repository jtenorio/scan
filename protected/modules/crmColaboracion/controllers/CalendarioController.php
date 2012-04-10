<?php

class CalendarioController extends Controller
{
	public function actionIndex()
	{
            
                $mes = isset($_REQUEST['mes'])?$_REQUEST['mes']:date('m');
                $anio = isset($_REQUEST['anio'])?$_REQUEST['anio']:date('Y');
            
		$this->renderPartial('index',array(
                    'mes'=>$mes,
                    'anio'=>$anio,
                ));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}