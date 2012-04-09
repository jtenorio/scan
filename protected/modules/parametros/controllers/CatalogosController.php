<?php

/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class CatalogosController extends Controller {

	public $formConfig;

	public function init() {
		parent::init();
		$this->formConfig = array(
			'elements' => array(
				'clase' => array('type' => 'text', 'maxlength' => 45, 'size' => 60), '<br>',
				'codigo' => array('type' => 'text', 'maxlength' => 20), '<br>',
				'valor' => array('type' => 'text', 'maxlength' => 500, 'size' => 120), '<br>',
				'descripcion' => array('type' => 'text', 'maxlength' => 100, 'size' => 80), '<br>',
			),
			'buttons' => array(
				'guardar' => array(
					'type' => 'submit',
					'label' => 'Guardar',
				),
			),
			'activeForm' => array(
				'class' => 'CActiveForm',
				'id' => 'catalogo-form',
				'enableAjaxValidation' => true,
			),
		);
	}

	public function accessRules() {
//		return array(
//			array('deny',
//				'users' => array('?'),
//			),
//		);
	}

	public function actionIndex() {
            $this->layout  = '//layouts/listado';
		$cat = new Catalogo('search');
                
		if (isset($_POST['Catalogo']))
			$cat->attributes = $_POST['Catalogo'];
		$dataProvider = $cat->search(20);
		$this->render('index', array('provider' => $dataProvider));
	}

	public function actionView() {
		$this->render('view', array('model' => $this->loadModel()));
	}

	public function actionCargar() {
		$this->render('cargar');
	}

	/**
	 * Recibe un id de casa comercial y el archivo de excel para ejecutar la carga via AJAX y retorna
	 * un string con el resultado o el error
	 * Idea de:
	 * http://www.techportal.co.za/jquery/197-how-to-upload-a-file-via-ajax-using-a-form-with-jquery-and-php
	 */
	public function actionCargaAjax() {
		$this->layout = false;
		$file = CUploadedFile::getInstanceByName('archivo');
		if (!$file)
			return print "Seleccione un archivo";
		$archivo = $file->getTempName();
		$ext = $file->getExtensionName();
		if (strtolower($ext) != 'xls')
			return print "Formato inválido";

                $folder = Yii::getPathOfAlias('application.modules.parametros.components.carga');
                $path=$folder.'/CargadorCatalogo.php';
                if(file_exists($path)){
                    include_once $path;
        	$cargador = new CargadorCatalogo();
		$cargador->encode = true;
		$lista = $cargador->procesarYGuardar($archivo);
		print "Completo, cargados " . count($lista) . ' items';
                }else
                    print "Error de inclusion de archivo";

	}

	protected function loadModel() {
		$id = Yii::app()->request->getParam('id');
		if (!$id)
			throw new CHttpException(500, 'Entidad no encontrada');
		return Catalogo::model()->findByPk($id);
	}

	// metodos de busqueda

	/**
	 * Toma el parámetro 'nombre' del request, busca ciudades que contengan el texto y despliega una tabla incluyendo
	 * pais y provincia. Es utilizado por el widget @link CiudadesWidget
	 */
	public function actionCiudadAjax() {
                  $param=$this->getParam('nombre');
        $modelo=$this->getParam('modelo');
        $obj_fk=$this->getParam('obj_fk');
        $obj_name=$this->getParam('obj_name');
        $id=$this->getParam('id');

		$this->layout = false;
		$nombre = $this->getParam('nombre');
		$lista = Catalogo::model()->buscarCiudad($nombre);
		$this->render('ciudadAjax', compact('lista','modelo','obj_fk','obj_name','id'));
	}

	public function actionProductoAjax() {
		$this->layout = false;
		$nombre = $this->getParam('nombre');
		$casa_id = $this->getParam('casa_id');
		$lista = Producto::model()->buscarPorCasa($casa_id, $nombre);
		$this->render('productoAjax', compact('lista', 'casa_id'));
	}

	public function actionProducto() {
		$this->layout = false;
		$casa_id = $this->getParam('casa_id');
		$this->render('producto', compact('casa_id'));
	}

	public function actionActividad() {
		$this->layout = false;
		$nombre = $this->getParam('nombre');
		$data['nombre'] = $nombre;
		$c = Catalogo::model()->criterioBuscarActividad($nombre);
		$options = array('criteria' => $c);
		$options['pagination']['pageSize'] = 10;
		$prov = new CActiveDataProvider('Catalogo', $options);
		$data['provider'] = $prov;
		$this->render('lista_actividad', $data);
	}

}