<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
class PlancuentasnecController extends Controller{

    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Plancuentasnec('search');
        $model->unsetAttributes();
            if(isset($_POST['Plancuentasnec']))
                $model->attributes=$_POST['Plancuentasnec'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Plancuentasnec;
        $this->performAjaxValidation($model);
         if(isset($_POST['Plancuentasnec'])){
            $model->attributes=$_POST['Plancuentasnec'];
            $model->setScenario($this->getParam('scenario'));
            if($this->getParam('scenario')=='insert'){
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"PlanCuentasNec")),
                                    "PlanCuentasNec",
                                    $model->idcuentanec,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'PlanCuentasNec','{data}'=>$model->nombrecuenta)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','PlanCuentasNec'));
                    $this->redirect(array('update','id'=>$model->idcuentanec));
                }
            }else{
                if($model->update()){
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"PlanCuentasNec")),
                                    "PlanCuentasNec",
                                    $model->idcuentanec,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"PlanCuentasNec")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','PlanCuentasNec'));
                    $this->redirect(array('update','id'=>$model->idcuentanec));
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
           $this->redirect(array('delete','id'=>$model->idcuentanec));

       // $model = $this->loadModel();
        $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Plancuentasnec'])){
            $model->attributes=$_POST['Plancuentasnec'];
                if($model->update()){
                   Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"PlanCuentasNec")),
                                    "PlanCuentasNec",
                                    $model->idcuentanec,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"PlanCuentasNec")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','PlanCuentasNec'));
                    $this->redirect(array('update','id'=>$model->idcuentanec));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        //$relation=CuentaBancaria::model()->find('idbanco=:postID', array(':postID'=>$model->idbanco));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"PlanCuentasNec")),
                                    "PlanCuentasNec",
                                    $model->idcuentanec,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"PlanCuentasNec")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','PlanCuentasNec'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"PlanCuentasNec")),
                                    "PlanCuentasNec",
                                    $model->idcuentanec,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"PlanCuentasNec")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','PlanCuentasNec'));
            $this->redirect(array('update','id'=>$model->idcuentanec));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='plancuentasnec-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

   


   /**
	 * @return PlanCuentasNec
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','PlanCuentasNec'));
		return Plancuentasnec::model()->findByPk($id);
	}


               /*
    * Carga todos las cuentas contables niff dependiendo del filtro de busqueda
    * pasado por ajax
    *
    */
   public function actionbuscarAjaxCuentaNec(){
        $param=$this->getParam('nombre');
        $modelo=$this->getParam('modelo');
        $obj_fk=$this->getParam('obj_fk');
        $obj_name=$this->getParam('obj_name');
        $id=$this->getParam('id');
        $model=new Plancuentasnec;
        $criterio=$model->buscaCuentaNec($param);
        $lista=$model->findAll($criterio);
        $this->renderPartial('popup/lista',compact('lista','modelo','obj_fk','obj_name','id'));


   }

}

