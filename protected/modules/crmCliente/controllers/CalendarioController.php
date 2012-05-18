<?php

class CalendarioController extends Controller
{
	public function actionIndex($id)
	{

        $mes = isset($_REQUEST['mes'])?$_REQUEST['mes']:date('m');
        $anio = isset($_REQUEST['anio'])?$_REQUEST['anio']:date('Y');


        //obtener los eventos del mes

        $diasMes = cal_days_in_month(0, $mes, $anio);
        $eventos = array();

        if($id != null )
        {
            for($dia = 1;$dia <= $diasMes;$dia++)
            {
                //formato fecha universal Ymd
                $fechaGet = "$anio-$mes-$dia";
                $llamadas = $this->getAllLlamadas($fechaGet,$id);
                $reuniones = $this->getAllReuniones($fechaGet,$id);
                $tareas = $this->getAllTareas($fechaGet,$id);
                $eventos['llamadas'][$dia] = $llamadas->getData();
                $eventos['reuniones'][$dia] = $reuniones->getData();
                $eventos['tareas'][$dia] = $tareas->getData();
            }
        }

		$this->renderPartial('index',array(
                    'mes'=>$mes,
                    'anio'=>$anio,
                    'eventos'=>$eventos,
                    'id'=>$id,
                ));
	}


    private function getAllLlamadas($fecha,$id)
    {
        $llamadas = Llamada::model()->getAllLlamadas($fecha,$id);
        return $llamadas;
    }
    
    private function getAllReuniones($fecha,$id)
    {
        $reuniones = Reunion::model()->getAllReuniones($fecha,$id);
        return $reuniones;
    }
    
    private function getAllTareas($fecha,$id)
    {
        $tareas = Tarea::model()->getAllTareas($fecha,$id);
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