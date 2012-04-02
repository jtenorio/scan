<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class EmpresaController extends Controller{



     public function actionIndex(){
         $this->layout  = '//layouts/listado';
        $model=new Empresa('search');

        $model->unsetAttributes();
            if(isset($_POST['Empresa']))
                $model->attributes=$_POST['Empresa'];
        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Empresa;
        $this->performAjaxValidation($model);
         if(isset($_POST['Empresa'])){
            $model->attributes=$_POST['Empresa'];
            $model->setScenario($this->getParam('scenario'));
            if($this->getParam('scenario')=='insert'){
                if($model->save()){
                    $this->addFlash ("mensaje", "Empresa Creada");
                    $this->redirect(array('update','id'=>$model->idempresa));
                }
            }else{
                if($model->update()){
                    $this->addFlash ("mensaje", "Empresa Modificado");
                    $this->redirect(array('update','id'=>$model->idempresa));
                }
            }

         }
        $this->render('crear',array('model'=>$model));

    }

    public function actionUpdate(){
        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        if(!empty($_REQUEST['button_delete']))
           $this->redirect(array('delete'));

        $model = $this->loadModel();
        $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Empresa'])){
            $model->attributes=$_POST['Empresa'];
                if($model->save()){
                    $this->addFlash ("mensaje", "Empresa Modificada");
                    $this->redirect(array('update','id'=>$model->idempresa));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){


    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='empresa-form'){
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
			throw new CHttpException(500, 'Entidad no encontrada');
		return Empresa::model()->findByPk($id);
	}
}


