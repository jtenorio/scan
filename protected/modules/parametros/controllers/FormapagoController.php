<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class FormapagoController extends Controller
{
    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Formapago('search');
        $model->unsetAttributes();
            if(isset($_POST['Formapago']))
                $model->attributes=$_POST['Formapago'];

        $this->render('index',array('model'=>$model));
    }

    public function actionCrear(){

        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Formapago;
        $this->performAjaxValidation($model);
         if(isset($_POST['FormaPago'])){
            $model->attributes=$_POST['Formapago'];
            $model->setScenario($this->getParam('scenario'));
            $model->setScenario('insert');
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"FormaPago")),
                                    "FormaPago",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'FormaPago','{data}'=>$model->nombre)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','FormaPago'));
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
         if(isset($_POST['Formapago'])){
            $model->attributes=$_POST['Formapago'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"FormaPago")),
                                    "FormaPago",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"FormaPago")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','FormaPago'));
                    $this->redirect(array('update','id'=>$model->id));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=Cuentabancaria::model()->find('idbanco=:postID', array(':postID'=>$model->id));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"FormaPago")),
                                    "FormaPago",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"FormaPago")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','FormaPago'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"FormaPago")),
                                    "FormaPago",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"FormaPago")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','FormaPago'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='form-pago-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

          /**
	 * @return FormaPago
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','FormaPago'));
		return Formapago::model()->findByPk($id);
	}

}
