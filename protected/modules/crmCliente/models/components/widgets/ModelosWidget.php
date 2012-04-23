<?php

/**
 * Widget para escoger las ciudades. Por lo pronto depende del controlador de catálogos y de funciones en 
 * el modelo de Catalogo. Depende de la acción "ciudadAjax" del controlador Catalogos.
 * {@link CatalogosController::actionCiudadAjax}
 * Genera un dialogo JuiDialog que se debe abrir de la forma normal $(id).dialog('open');
 * Para configurar el cuadro usar la propiedad $dialogOptions de forma normal.
 * 
 * Para recibir los datos de selección de ciudad, definir $selectCallback con el nombre
 * de una función javascript con esta firma: onSelect(ciudad, provincia, pais, codigos).
 *
 * @author vsayajin
 * @package components.widgets
 */
class ModelosWidget extends CWidget {
	/** @var string Id del componente */
	public $id = 'dlg_modelos';
	/** @var array Opciones del cuadro de diálogo */
	public $dialogOptions;
	/** @var string Nombre de una función javascript para llamar en el evento de seleccionar una ciudad */
	public $selectCallback ='';
	public $openCallback ='';
	/** @var string Nombre del widget, no usado por el momento */
	public $nombre = '';
	
	/** @var string/array Url de la acción que devuelve la lista de ciudades por ajax  */
	public $url_lista =array();

        /* @var <string> Titulo del Popup*/

        public $title;
        /* @var <string> Nombre del modelo que necesitamos buscar */

        public $modelo;
        public $obj_name;
        public $obj_fk;
        public $busqueda;
        
        

	public function init() {
		parent::init();
	}

	public function run() {
		parent::run();
		$acciones = array();
		$data = array(
			'id' => $this->id,
			'options' => $this->dialogOptions,
			'selectCallback' => $this->selectCallback,
			'openCallback' => $this->openCallback,
			'nombre' => $this->nombre,
			'url_lista' => CHtml::normalizeUrl(array($this->url_lista)),
                        'title'=>$this->title,
                        'modelo'=>$this->modelo,
                        'obj_fk'=>$this->obj_fk,
                        'obj_name'=>$this->obj_name,
                        'busqueda'=>$this->busqueda,

		);

		$this->render('modelos_view', $data);
	}

}

?>
