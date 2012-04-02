<?php

/**
 * Corresponde a un evento del sistema registrado en la tabla auditoria
 *
 * @property integer $id
 * @property string $nivel
 * @property string $categoria
 * @property timestamp $fecha
 * @property string $mesnsaje
 * @property string $data
 * @property string $usuarioid
 * @property string $parent_id
 * @property string $ip
 * 
 * @package models
 */
class Auditoria extends CActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return "auditoria";
	}
	
	public function rules() {
		return array(
			array('nivel, categoria, logtime, mensaje, data, usuario, ip,parent_id', 'safe'),
		);
	}
	
	public function search($pageSize=0) {
		$criteria = new CDbCriteria;
		$criteria->compare('nivel', $this->nivel);
		$criteria->compare('categoria', $this->categoria);
		$criteria->compare('mensaje', $this->mensaje, true);
		$criteria->compare('data', $this->data, true);
		$criteria->compare('usuario', $this->usuario);
		$criteria->compare('ip', $this->ip, true);
		$criteria->order = 'logtime desc';

		$options = array('criteria' => $criteria);
		if ($pageSize > 0)
			$options['pagination']['pageSize'] = $pageSize;

		return new CActiveDataProvider(get_class($this), $options);
	}

	public static function error($mensaje, $category,$parent_id='', $data='', $includeSystem = false) {
		$a = Auditoria::getNewLog($mensaje, CLogger::LEVEL_ERROR,$parent_id, $category);
		if ($data instanceof Exception) {
			$a->data = $data->getTraceAsString();
		} else if ($data)
			$a->data = $data;
		$a->save();
	}

	public static function info($mensaje, $category,$parent_id='', $data='', $includeSystem = false) {
		$a = Auditoria::getNewLog($mensaje, CLogger::LEVEL_INFO,$parent_id, $category);
		if ($data)
			$a->data = $data;
		$a->save();
	}

	public static function warning($mensaje, $category,$parent_id='', $data='', $includeSystem = false) {
		$a = Auditoria::getNewLog($mensaje, CLogger::LEVEL_WARNING, $parent_id,$category);
		if ($data)
			$a->data = $data;
		$a->save();
	}

	public static function getNewLog($mensaje, $level, $parent_id='',$category='', $includeSystem = false) {
		$a = new Auditoria('insert');
		$a->nivel = $level;
		$a->mensaje = $mensaje;
		$a->categoria = $category;
                $a->parent_id=$parent_id;
		$a->fecha = DateUtils::now();
		$a->usuarioid = Yii::app()->user->id;
		$a->ip = Yii::app()->getRequest()->getUserHostAddress();

		if ($includeSystem)
			Yii::log($mensaje, $level, $category);
		return $a;
	}

}