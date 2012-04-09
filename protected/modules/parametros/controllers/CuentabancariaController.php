<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class CuentabancariaController extends Controller{



      public function actionIndex(){
          $this->layout  = '//layouts/listado';
        $model=new Cuentabancaria('search');
        $model->unsetAttributes();
            if(isset($_POST['Cuentabancaria']))
                $model->attributes=$_POST['Cuentabancaria'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Cuentabancaria;
        $this->performAjaxValidation($model);
         if(isset($_POST['Cuentabancaria'])){
            $model->attributes=$_POST['Cuentabancaria'];
            $model->setScenario($this->getParam('scenario'));
            if($this->getParam('scenario')=='insert'){
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"CuentaBancaria")),
                                    "CuentaBancaria",
                                    $model->idcuentabancaria,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'CuentaBancaria','{data}'=>$model->descripcion)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','CuentaBancaria'));
                    $this->redirect(array('update','id'=>$model->idcuentabancaria));
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
           $this->redirect(array('delete','id'=>$model->idcuentabancaria));

        $model = $this->loadModel();
        $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Cuentabancaria'])){
            $model->attributes=$_POST['Cuentabancaria'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"CuentaBancaria")),
                                    "CuentaBancaria",
                                    $model->idcuentabancaria,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"CuentaBancaria")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','CuentaBancaria'));
                    $this->redirect(array('update','id'=>$model->idcuentabancaria));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
     //   $relation=CuentaBancaria::model()->find('idbanco=:postID', array(':postID'=>$model->idbanco));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"CuentaBancaria")),
                                    "CuentaBancaria",
                                    $model->idcuentabancaria,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"CuentaBancaria")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','CuentaBancaria'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"CuentaBancaria")),
                                    "CuentaBancaria",
                                    $model->idcuentabancaria,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"CuentaBancaria")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','CuentaBancaria'));
            $this->redirect(array('update','id'=>$model->idcuentabancaria));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='cuentabancaria-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

        /**
	 * @return CuentaBancaria
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','CuentaBancaria'));
		return Cuentabancaria::model()->findByPk($id);
	}


             /*
    * Carga todos las bancos dependiendo del filtro de busqueda
    * pasado por ajax
    *
    */
   public function actionbuscarAjaxCuenta(){
        $param=$this->getParam('nombre');
        $modelo=$this->getParam('modelo');
        $obj_fk=$this->getParam('obj_fk');
        $obj_name=$this->getParam('obj_name');
        $id=$this->getParam('id');
        $model=new Cuentabancaria;
        $criterio=$model->buscaCuentaBancaria($param);
        $lista=$model->findAll($criterio);
        $this->renderPartial('popup/lista',compact('lista','modelo','obj_fk','obj_name','id'));
   }

}
