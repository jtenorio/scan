<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
}