<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class ItemserviciosController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $path='/protected/modules/parametros/data/item_imagen';
	/**
	 * @return array action filters
	 */
    public $tipos=array('2'=>'Servicios');
    public $tarifas=array('1'=>'Base 0','2'=>'Base Gravada','3'=>'Base no Objeto');

    public function actionIndex(){
        $model=new Item;
        $model->setScenario('search');
        $model->unsetAttributes();
        
        
            if(isset($_POST['Item']))
                $model->attributes=$_POST['Item'];
        $model->usarentipomovimiento=2;
        $this->render('index',array('model'=>$model));
    }

    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Item;
        $model_cstm =new Itemcstm;
        $tabla_precios=new Tablaprecios;
        
        $this->performAjaxValidation($model);
        $this->performAjaxValidation($model_cstm);
        $this->performAjaxValidation($tabla_precios);
         if(isset($_POST['Item'])&&(isset($_POST['Itemcstm']))){
            $model->attributes=$_POST['Item'];
            $model_cstm->attributes=$_POST['Itemcstm'];
            $model->setScenario('insert');
            $model_cstm->setScenario('insert');
            $model->imagen=CUploadedFile::getInstance($model,'imagen');
            $model->usarentipomovimiento=2;
                if($model->save()){

                    $model_cstm->iditem=$model->id;
                    $model_cstm->save();
                    ManagerBodega::crearFromItem($model);
                    if($model->usatablaprecios==1){
                        $datos = $_POST;
                        foreach ($datos as $key => $value) {
                            $pos = strpos($key, 'prod_');
                            if ($pos === false || $pos > 0)
                                continue;
                            $id = str_replace('prod_', '', $key);
                            
                            $tabla=new Tablaprecios('insert');
                            $tabla->iditem=$model->id;
                            $tabla->cantidaddesde=$datos['cantidaddesde_' . $id];
                            $tabla->cantidadhasta=$datos['cantidadhasta_' . $id];
                            $tabla->valor=$datos['valor_' . $id];
                            $tabla->vigentedesde=$datos['vigentedesde_' . $id];
                            $tabla->vigentehasta=$datos['vigentehasta_' . $id];
                            $tabla->estado=true;
                            $tabla->save();

                            

                        }
                    }
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"Item")),
                                    "Item",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'Item','{data}'=>$model->nombre)));
                 if($model->imagen instanceOf CUploadedFile)
                    $model->imagen->saveAs($this->path);
                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','Item'));
                    $this->redirect(array('update','id'=>$model->id));
                }
            

         }
        $this->render('crear',array('model'=>$model,'tipos'=>$this->tipos,'tarifas'=>$this->tarifas,'model_cstm'=>$model_cstm,'tabla'=>$tabla_precios));

    }

    public function actionUpdate(){
        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        $model = $this->loadModel();
        if($model!=null){
            $model_cstm=$this->loadModelCstm($model->id);
            $tabla_precios=$this->loadModelTabla($model->id);
        }
         if(!empty($_REQUEST['button_delete']))
           $this->redirect(array('delete','id'=>$model->id));
        
        
        $nombre=  Item::buscaImagen($model->id);
        if(is_array($nombre)){
            $data=$nombre[0];
        }

        
        $this->performAjaxValidation($model);
        $this->performAjaxValidation($model_cstm);
       
         if(isset($_POST['Item'])&&(isset($_POST['Itemcstm']))){

             $model->attributes=$_POST['Item'];
            $model_cstm->attributes=$_POST['Itemcstm'];
            $model->setScenario('update');
        $model_cstm->setScenario('update');
        
            
                $model->imagen=CUploadedFile::getInstance($model,'imagen');
                $model->usarentipomovimiento=2;
                if($model->save()){
                    $model_cstm->update();
                    ManagerBodega::crearFromItem($model);
                 if($model->imagen instanceOf CUploadedFile){
                     if(!empty($model->imagen->name)){
                        $val=$model->imagen->saveAs(Yii::getPathOfAlias('webroot').$this->path.'/'.$model->imagen->name);
                     }
                 }else{
                         $model->imagen=$data['imagen'];
                         $model->update();
                     }

                     if($model->usatablaprecios==1){
                        $datos = $_POST;
                        foreach ($datos as $key => $value) {
                            $pos = strpos($key, 'prod_');
                            if ($pos === false || $pos > 0)
                                continue;
                            $id = str_replace('prod_', '', $key);
                            
                            if(!empty($datos['prod_' . $id])){
                                $tabla=$this->loadTablaPrecio($datos['prod_' . $id]);
                                $ids[]=$datos['prod_' . $id];
                             }else{
                                $tabla=new Tablaprecios('insert');
                            }
                            $tabla->iditem=$model->id;
                            $tabla->cantidaddesde=$datos['cantidaddesde_' . $id];
                            $tabla->cantidadhasta=$datos['cantidadhasta_' . $id];
                            $tabla->valor=$datos['valor_' . $id];
                            $tabla->vigentedesde=$datos['vigentedesde_' . $id];
                            $tabla->vigentehasta=$datos['vigentehasta_' . $id];
                            $tabla->estado=true;
                            if(!empty($datos['prod_' . $id])){
                                $tabla->update();
                            }else{
                                $tabla->save();
                                $ids[]=$model->id;
                            }
                            



                        }
                        if(count($ids)>0)
                            Tablaprecios::model()->actualizar($ids,$model->id);
                        else
                            Tablaprecios::model()->eliminar($model->id);
                    }else
                      Tablaprecios::model()->eliminar($model->id);

                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"Item")),
                                    "Item",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"Item")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','Item'));
                       
                    $this->redirect(array('update','id'=>$model->id));
                }
          }
        
        $this->render('update',array('model'=>$model,'data_imagen'=>$data,'path'=>$this->path,'tipos'=>$this->tipos,'tarifas'=>$this->tarifas,'model_cstm'=>$model_cstm,'tabla'=>$tabla_precios));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=Item::model()->find('id=:postID', array(':postID'=>$model->id));
        if(empty($relation)){
         
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"Item")),
                                    "Item",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"Item")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','Item'));
            $this->redirect(array('index'));
        }else{
           
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"Item")),
                                    "Item",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"Item")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','Item'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='item-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

   /**
	 * @return Item
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','Item'));
		return Item::model()->findByPk($id);
	}


        /**
	 * @return ItemCstm
	 */
	protected function loadModelCstm($id) {

		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','Item'));
		return Itemcstm::model()->find('iditem=:id',array(':id'=>$id));
	}
                /**
	 * @return TablaPrecio
	 */
	protected function loadModelTabla($id) {

		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','Item'));
		return Tablaprecios::model()->findAll('iditem=:id and estado=true',array(':id'=>$id));
	}

        /**
	 * @return TablaPrecio
	 */
	protected function loadTablaPrecio($id) {

		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','Item'));
		return Tablaprecios::model()->findByPk($id);
	}

}
