<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class PorcentajeIceController extends Controller{




    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Porcentajeice('search');
        $model->unsetAttributes();
            if(isset($_POST['Porcentajeice']))
                $model->attributes=$_POST['Porcentajeice'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Porcentajeice;
        $this->performAjaxValidation($model);
         if(isset($_POST['Porcentajeice'])){
            $model->attributes=$_POST['Porcentajeice'];
            $model->setScenario('insert');
            
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"PorcentajeIce")),
                                    "PorcentajeIce",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'PorcentajeIce','{data}'=>$model->porcentaje)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','PorcentajeIce'));
                    $this->redirect(array('update','id'=>$model->id));
                }
            
         }
        $this->render('crear',array('model'=>$model));

    }

    public function actionUpdate(){
        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        $model = $this->loadModel();

         if(!empty($_REQUEST['button_delete']))
           $this->redirect(array('delete','id'=>$model->id));

        $model = $this->loadModel();
        $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Porcentajeice'])){
            $model->attributes=$_POST['Porcentajeice'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"PorcentajeIce")),
                                    "PorcentajeIce",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"PorcentajeIce")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','PorcentajeIce'));
                    $this->redirect(array('update','id'=>$model->id));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        //$relation=CuentaBancaria::model()->find('idbanco=:postID', array(':postID'=>$model->idbanco));
        if(empty($relation)){
            
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"PorcentajeIce")),
                                    "PorcentajeIce",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"PorcentajeIce")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','PorcentajeIce'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"PorcentajeIce")),
                                    "PorcentajeIce",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"PorcentajeIce")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','PorcentajeIce'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='porcentajeice-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

   /**
	 * @return PorcentajeIce
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','PorcentajeIva'));
		return Porcentajeice::model()->findByPk($id);
	}

}
