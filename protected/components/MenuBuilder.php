<?php

/**
 * Contruye las opciones para utilizarze en el componente CMenu a partir de un array de configuración
 * el cual incluye opciones de control de acceso por roles. Depende del archivo menu.php
 * que se encuentra en la carpeta data de la aplicación
 *
 * @author vsayajin
 * @package components
 */
class MenuBuilder extends CApplicationComponent {

	public $menus=array();
	public $root;

	public function init() {
		parent::init();
		$file = Yii::getPathOfAlias('application.data.menu') . '.php';
        	$this->menus = include($file);
	}

	/**
	 * Lee del archivo menu.php en la carpeta data y construye opciones de menu para
	 * utilizarse en una instancia de CMenu
	 * @return array
	 */
	public function getMenuOptions() {
		$menu = $this->getItems($this->menus);
		return array('items' => $menu);
	}

	/**
	 * Procesa recursivamente un array de opciones en el formato de este componente y devuelve
	 * las opciones en el formato esperado por CMenu realizando chequeos de control de acceso
	 * mientras itera por las opciones
	 * @param array $items
	 * @return array Formato necesario para {@link CMenu} 
	 */
	protected function getItems($items) {
		// TODO: chequear el rol padre, o cadena de roles? o dejar que el auth manager lo haga
		/* @var $user CWebUser */
		/* @var $auth CPhpAuthManager */
		$user = Yii::app()->user;
		$auth = Yii::app()->authManager;
		$menu = array();
		foreach ($items as $item) {
			$menuItem = array('label' => $item['label']);
			$menuItem['url'] = array('/' . $item['url']);
//			if (isset($item['access'])) {
//				$check = $item['access'];
//				if($check == '@') {
//					if ($user->isGuest) continue;
//				} else {
//					$roles = is_array($check) ? $check : explode(',', $check);
//					$pass = false;
//					foreach ($roles as $rol) {
//						if ($user->checkAccess(trim($rol)))
//							$pass = true;
//					}
//					if (!$pass)
//						continue;
//				}
//				//$vale = $auth->checkAccess($check, $user->getId());
//				//echo $vale;
//			}
			if (isset($item['items'])) {
				$subitems = $this->getItems($item['items']);
				if (count($subitems) == 0)
					continue;
				$menuItem['items'] = $subitems;
			}
			$menu[] = $menuItem;
			// TODO otras opciones del componente CMenu
		}
		return $menu;
	}

        /*
         *Lee la carpeta donde se encuentra todos los modelos dentro de
         * un modulo , si se encuentra vacio , leera los modelos de las
         * carpetas padre. Se aplica ademas los permisos de usuario
         * @param <string> $modulo Nombre del modulo
         * return <array>  $models        Devuelve un array con todos los modelos
         *
         */
        function getFilesModels($module){
            $model=array();

        }

}

?>
