<?php

/**

 * Controller is the customized base controller class.

 * All controller classes for this application should extend from this base class.

 */

class Controller extends CController

{

	/**

	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',

	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.

	 */

	public $layout='//layouts/column1';

	/**

	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.

	 */

	public $menu=array();

	/**

	 * @var array the breadcrumbs of the current page. The value of this property will

	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}

	 * for more details on how to specify this property.

	 */

	public $breadcrumbs=array();



        /**

	 * @var string Url absoluto base de la aplicación, muy util

	 */

	public $root;



	/** @var CAuthManager Referencia al componente de autorización del sistema para usarse en

	 * filtros y reglas de acceso

	 */

	public $authManager;

	/**

         * @var $empresa_id Id de la empresa que esta usandose

	 * 

	 */

        public $empresa_id;

        /**

         * @var $usuario_id Id de la empresa que esta usandose

	 *

	 */

        public $usuario_id;

        /**

         * @var $domain Id de la empresa que esta usandose

	 *	 */

        public $domain;

        /**

	 * Inicializador por defecto para todos los controladores

	 * @see CController::init()

	 */



	public function init() {

		parent::init();

	//	Yii::app()->session->open();

		$this->root = Yii::app()->request->baseUrl;

                $this->domain='http://localhost/ErpScan';

                /*Se debe cargar la empresa , para ser usada en todo el proyecto*/

                $this->empresa_id=1;
                $this->usuario_id=1;

//		$this->authManager = Yii::app()->authManager;

//		$user = Yii::app()->user;

//		// necesario mientras se utilice el manager de permisos en php

//		if (!$user->isGuest) {

//			$rol = $user->rol;

//			if (!$this->authManager->isAssigned($rol, $user->id))

//				$this->authManager->assign($rol, $user->id);

//		}

	}









        /**

	 * Adiciona valores al contexto "flash" por clave. Shortcut para el método más largo

	 * @param string $key nombre de la clave

	 * @param mixed $value Valor para adicional

	 */

	public function addFlash($key, $value) {

		Yii::app()->user->setFlash($key, $value);

	}



	/**

	 * Recupera valores del contexto "flash" por clave usando un valor por defecto también.

	 * Simple shortcut para la llamada más larga.

	 * @param string $key Clave del contexto flash

	 * @param mixed $defaultValue Valor por defecto si no se encuentra

	 */

	public function getFlash($key, $defaultValue = '') {

		return Yii::app()->user->getFlash($key, $defaultValue);

	}



	/**

	 * Determina si la petición se hace por ajax usando el método del objeto Request

	 * @return bool

	 */

	public function getIsAjaxRequest() {

		return Yii::app()->getRequest()->getIsAjaxRequest();

	}



	/**

	 * Determina si la petición se hace por POST

	 * @return bool

	 */

	public function getIsPost() {

		return Yii::app()->getRequest()->getIsPostRequest();

	}



	/**

	 * Shortcut para recuperar parámetros desde el request

	 * @param string $nombre

	 * @param mixed $default Valor por defecto si no se encuentra, default null

	 * @return mixed

	 */

	public function getParam($nombre, $default=null) {

		return Yii::app()->request->getParam($nombre, $default);

	}



}