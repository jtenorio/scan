<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class PresentacionController extends Controller
{
    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Presentacion('search');
        $model->unsetAttributes();
            if(isset($_POST['Presentacion']))
                $model->attributes=$_POST['Presentacion'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Presentacion;
        $this->performAjaxValidation($model);
         if(isset($_POST['Presentacion'])){
            $model->attributes=$_POST['Presentacion'];
            $model->setScenario('insert');

            
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"Presentacion")),
                                    "Presentacion",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'Presentacion','{data}'=>$model->nombre)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','Presentacion'));
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
         if(isset($_POST['Presentacion'])){
            $model->attributes=$_POST['Presentacion'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"Presentacion")),
                                    "Presentacion",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"Presentacion")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','Presentacion'));
                    $this->redirect(array('update','id'=>$model->id));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=CuentaBancaria::model()->find('idbanco=:postID', array(':postID'=>$model->idbanco));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"Presentacion")),
                                    "Presentacion",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"Presentacion")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','Presentacion'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"Presentacion")),
                                    "Presentacion",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"Presentacion")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','Presentacion'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='presentacion-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

   /**
	 * @return Banco
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','Presentacion'));
		return Presentacion::model()->findByPk($id);
	}

    public function actionbuscarAjaxPresentacion(){
        $param=$this->getParam('nombre');
        $modelo=$this->getParam('modelo');
        $obj_fk=$this->getParam('obj_fk');
        $obj_name=$this->getParam('obj_name');
        $id=$this->getParam('id');
        $model=new Presentacion;
        $criterio=$model->buscaPresentacion($param);
        $lista=$model->findAll($criterio);
        $this->renderPartial('popup/lista',compact('lista','modelo','obj_fk','obj_name','id'));
   }

}
