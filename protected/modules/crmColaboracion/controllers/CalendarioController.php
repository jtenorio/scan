<?php

class CalendarioController extends Controller
{
	public function actionIndex()
	{

        $mes = isset($_REQUEST['mes'])?$_REQUEST['mes']:date('m');
        $anio = isset($_REQUEST['anio'])?$_REQUEST['anio']:date('Y');


        //obtener los eventos del mes

        $diasMes = cal_days_in_month(0, $mes, $anio);
        $eventos = array();

        for($dia = 1;$dia <= $diasMes;$dia++)
        {
            //formato fecha universal Ymd
            $fechaGet = "$anio-$mes-$dia";
            $llamadas = $this->getAllLlamadas($fechaGet);
            $reuniones = $this->getAllReuniones($fechaGet);
            $tareas = $this->getAllTareas($fechaGet);
            $eventos['llamadas'][$dia] = $llamadas->getData();
            $eventos['reuniones'][$dia] = $reuniones->getData();
            $eventos['tareas'][$dia] = $tareas->getData();
        }

		$this->renderPartial('index',array(
                    'mes'=>$mes,
                    'anio'=>$anio,
                    'eventos'=>$eventos,
                ));
	}


    private function getAllLlamadas($fecha)
    {
        $llamadas = Llamada::model()->getAllLlamadas($fecha);
        return $llamadas;
    }
    
    private function getAllReuniones($fecha)
    {
        $reuniones = Reunion::model()->getAllReuniones($fecha);
        return $reuniones;
    }
    
    private function getAllTareas($fecha)
    {
        $tareas = Tarea::model()->getAllTareas($fecha);
        return $tareas;
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