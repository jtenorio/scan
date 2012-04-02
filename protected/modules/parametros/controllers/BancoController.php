<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class BancoController extends Controller{


    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Banco('search');
        $model->unsetAttributes();
            if(isset($_POST['Banco']))
                $model->attributes=$_POST['Banco'];
            
        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        
        $model=new Banco;
        $this->performAjaxValidation($model);
         if(isset($_POST['Banco'])){
            $model->attributes=$_POST['Banco'];
            $model->setScenario($this->getParam('scenario'));
            if($this->getParam('scenario')=='insert'){
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"Banco")),
                                    "Banco",
                                    $model->idbanco,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'Banco','{data}'=>$model->nombre)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','Banco'));
                    $this->redirect(array('update','id'=>$model->idbanco));
                }
            }else{
                if($model->update()){
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"Banco")),
                                    "Banco",
                                    $model->idbanco,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"Banco")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','Banco'));
                    $this->redirect(array('update','id'=>$model->idbanco));
                }
            }

         }
        $this->render('crear',array('model'=>$model));

    }

    public function actionUpdate(){
        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        $model = $this->loadModel();

         if(!empty($_REQUEST['button_delete']))
           $this->redirect(array('delete','id'=>$model->idbanco));

        $model = $this->loadModel();
        if($model!=null)
            $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Banco'])){
            $model->attributes=$_POST['Banco'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"Banco")),
                                    "Banco",
                                    $model->idbanco,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"Banco")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','Banco'));
                    $this->redirect(array('update','id'=>$model->idbanco));
                }
          }
   
        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=CuentaBancaria::model()->find('idbanco=:postID', array(':postID'=>$model->idbanco));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"Banco")),
                                    "Banco",
                                    $model->idbanco,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"Banco")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','Banco'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"Banco")),
                                    "Banco",
                                    $model->idbanco,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"Banco")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','Banco'));
            $this->redirect(array('update','id'=>$model->idbanco));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='banco-form'){
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
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','Banco'));
		return Banco::model()->findByPk($id);
	}

        /*
    * Carga todos las bancos dependiendo del filtro de busqueda
    * pasado por ajax
    *
    */
   public function actionbuscarAjaxBanco(){
        $param=$this->getParam('nombre');
        $modelo=$this->getParam('modelo');
        $obj_fk=$this->getParam('obj_fk');
        $obj_name=$this->getParam('obj_name');

        $model=new Banco;
        $criterio=$model->buscaBanco($param);
        $lista=$model->findAll($criterio);
        $this->renderPartial('popup/lista',compact('lista','modelo','obj_fk','obj_name'));


   }

}


