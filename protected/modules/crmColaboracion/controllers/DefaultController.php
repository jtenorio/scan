<?php

class DefaultController extends Controller
{
    /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/colaborativo';

	public function actionIndex()
	{
		$this->render('index');
     
	}
}