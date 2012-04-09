<?php

/**
 * This is the model class for table "compraingreso".
 *
 * The followings are the available columns in table 'compraingreso':
 * @property integer $idcompra
 * @property integer $idejercicio
 * @property integer $idmesperiodo
 * @property integer $idsustentotributario
 * @property integer $idsecuencialtransaccion
 * @property integer $idproveedor
 * @property integer $idtipocomprobante
 * @property string $fecharegistro
 * @property string $estabcompra
 * @property string $puntocompra
 * @property string $secuencialcompra
 * @property string $fechaemision
 * @property string $autorizacompra
 * @property string $fechacaduca
 * @property string $basenograva
 * @property string $basecero
 * @property string $basegravada
 * @property integer $idporcentajeiva
 * @property string $montoiva
 * @property string $baseice
 * @property integer $idporcentajeice
 * @property string $montoice
 * @property string $montobaseiva30
 * @property string $retencioniva30
 * @property string $montobaseiva70
 * @property integer $porcentajeretencioniva70
 * @property string $retenidoiva70
 * @property string $montobaseiva100
 * @property integer $porcentajeretencioniva100
 * @property string $retenidoiva100
 * @property string $establecimientoretencion1
 * @property string $puntoemisionretencion1
 * @property string $secuencialretencion1
 * @property string $autorizacionretencion1
 * @property string $fecharetencion1
 * @property string $establecimientoretencion2
 * @property string $puntoemisionretencion2
 * @property string $secuencialretencion2
 * @property string $autorizacionretencion2
 * @property string $fecharetencion2
 * @property string $codigodocumentomodificanc
 * @property string $estabdocumentomodificanc
 * @property string $puntoemisiondocumentomodificanc
 * @property string $secuencialdocumentomodificanc
 * @property string $autorizaciondocumentomodificanc
 * @property string $fechadocumentomodificanc
 * @property integer $ubicacionformulario
 * @property integer $formapago
 * @property boolean $estado
 * @property string $numerocompratransaccion
 * @property integer $idbodega
 * @property integer $idtarjetacredito
 * @property integer $idempresa
 * @property string $compraempresa
 * @property integer $porcentajeretencioniva30
 * @property integer $idordencompra
 */
class Compra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Compra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'compraingreso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idejercicio, idmesperiodo, idsecuencialtransaccion, idproveedor, idtipocomprobante, fecharegistro, estabcompra, puntocompra, secuencialcompra, fechaemision, autorizacompra, fechacaduca, basenograva, basecero, basegravada, idporcentajeiva, formapago, numerocompratransaccion, idbodega, idempresa, compraempresa', 'required'),
			array('idejercicio, idmesperiodo, idsustentotributario, idsecuencialtransaccion, idproveedor, idtipocomprobante, idporcentajeiva, idporcentajeice, porcentajeretencioniva70,porcentajeretencioniva30, porcentajeretencioniva100, ubicacionformulario, formapago, idbodega, idtarjetacredito, idempresa', 'numerical', 'integerOnly'=>true),
			array('estabcompra, puntocompra, establecimientoretencion1, puntoemisionretencion1, establecimientoretencion2, puntoemisionretencion2, estabdocumentomodificanc, puntoemisiondocumentomodificanc', 'length', 'max'=>3),
			array('secuencialcompra, secuencialretencion1, secuencialretencion2, secuencialdocumentomodificanc', 'length', 'max'=>9),
			array('autorizacompra, autorizacionretencion1, autorizacionretencion2, autorizaciondocumentomodificanc, numerocompratransaccion, compraempresa', 'length', 'max'=>10),
			array('basenograva, basecero, basegravada, montoiva, baseice, montoice, montobaseiva30, retencioniva30, montobaseiva70, retenidoiva70, montobaseiva100, retenidoiva100', 'length', 'max'=>12),
			array('codigodocumentomodificanc', 'length', 'max'=>2),
			array('fecharetencion1, fecharetencion2, fechadocumentomodificanc, estado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcompra, idejercicio, idmesperiodo, idsustentotributario, idsecuencialtransaccion, idproveedor, idtipocomprobante, fecharegistro, estabcompra, puntocompra, secuencialcompra, fechaemision, autorizacompra, fechacaduca, basenograva, basecero, basegravada, idporcentajeiva, montoiva, baseice, idporcentajeice, montoice, montobaseiva30, retencioniva30, montobaseiva70, porcentajeretencioniva70,porcentajeretencioniva30, retenidoiva70, montobaseiva100, porcentajeretencioniva100, retenidoiva100, establecimientoretencion1, puntoemisionretencion1, secuencialretencion1, autorizacionretencion1, fecharetencion1, establecimientoretencion2, puntoemisionretencion2, secuencialretencion2, autorizacionretencion2, fecharetencion2, codigodocumentomodificanc, estabdocumentomodificanc, puntoemisiondocumentomodificanc, secuencialdocumentomodificanc, autorizaciondocumentomodificanc, fechadocumentomodificanc, ubicacionformulario, formapago, estado, numerocompratransaccion, idbodega, idtarjetacredito, idempresa, compraempresa', 'safe', 'on'=>'search'),
                        array('estabcompra+puntocompra+idempresa+secuencialcompra', 'application.modules.compra.extensions.uniqueMultiColumnValidator'),
                        array('estado','default','value'=>0),

		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcompra' => 'Idcompra',
			'idejercicio' => 'Idejercicio',
			'idmesperiodo' => 'Idmesperiodo',
			'idsustentotributario' => 'Idsustentotributario',
			'idsecuencialtransaccion' => 'Idsecuencialtransaccion',
			'idproveedor' => 'Idproveedor',
			'idtipocomprobante' => 'Idtipocomprobante',
			'fecharegistro' => 'Fecharegistro',
			'estabcompra' => 'Estabcompra',
			'puntocompra' => 'Puntocompra',
			'secuencialcompra' => 'Secuencialcompra',
			'fechaemision' => 'Fechaemision',
			'autorizacompra' => 'Autorizacompra',
			'fechacaduca' => 'Fechacaduca',
			'basenograva' => 'Basenograva',
			'basecero' => 'Basecero',
			'basegravada' => 'Basegravada',
			'idporcentajeiva' => 'Idporcentajeiva',
			'montoiva' => 'Montoiva',
			'baseice' => 'Baseice',
			'idporcentajeice' => 'Idporcentajeice',
			'montoice' => 'Montoice',
			'montobaseiva30' => 'Montobaseiva30',
			'retencioniva30' => 'Retencioniva30',
			'montobaseiva70' => 'Montobaseiva70',
			'porcentajeretencioniva70' => 'Porcentajeretencioniva70',
                        'porcentajeretencioniva30' => 'Porcentajeretencioniva30',
			'retenidoiva70' => 'Retenidoiva70',
			'montobaseiva100' => 'Montobaseiva100',
			'porcentajeretencioniva100' => 'Porcentajeretencioniva100',
			'retenidoiva100' => 'Retenidoiva100',
			'establecimientoretencion1' => 'Establecimientoretencion1',
			'puntoemisionretencion1' => 'Puntoemisionretencion1',
			'secuencialretencion1' => 'Secuencialretencion1',
			'autorizacionretencion1' => 'Autorizacionretencion1',
			'fecharetencion1' => 'Fecharetencion1',
			'establecimientoretencion2' => 'Establecimientoretencion2',
			'puntoemisionretencion2' => 'Puntoemisionretencion2',
			'secuencialretencion2' => 'Secuencialretencion2',
			'autorizacionretencion2' => 'Autorizacionretencion2',
			'fecharetencion2' => 'Fecharetencion2',
			'codigodocumentomodificanc' => 'Codigodocumentomodificanc',
			'estabdocumentomodificanc' => 'Estabdocumentomodificanc',
			'puntoemisiondocumentomodificanc' => 'Puntoemisiondocumentomodificanc',
			'secuencialdocumentomodificanc' => 'Secuencialdocumentomodificanc',
			'autorizaciondocumentomodificanc' => 'Autorizaciondocumentomodificanc',
			'fechadocumentomodificanc' => 'Fechadocumentomodificanc',
			'ubicacionformulario' => 'Ubicacionformulario',
			'formapago' => 'Formapago',
			'estado' => 'Estado',
			'numerocompratransaccion' => 'Numerocompratransaccion',
			'idbodega' => 'Idbodega',
			'idtarjetacredito' => 'Idtarjetacredito',
			'idempresa' => 'Idempresa',
			'compraempresa' => 'Compraempresa',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idcompra',$this->idcompra);
		$criteria->compare('idejercicio',$this->idejercicio);
		$criteria->compare('idmesperiodo',$this->idmesperiodo);
		$criteria->compare('idsustentotributario',$this->idsustentotributario);
		$criteria->compare('idsecuencialtransaccion',$this->idsecuencialtransaccion);
		$criteria->compare('idproveedor',$this->idproveedor);
		$criteria->compare('idtipocomprobante',$this->idtipocomprobante);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('estabcompra',$this->estabcompra,true);
		$criteria->compare('puntocompra',$this->puntocompra,true);
		$criteria->compare('secuencialcompra',$this->secuencialcompra,true);
		$criteria->compare('fechaemision',$this->fechaemision,true);
		$criteria->compare('autorizacompra',$this->autorizacompra,true);
		$criteria->compare('fechacaduca',$this->fechacaduca,true);
		$criteria->compare('basenograva',$this->basenograva,true);
		$criteria->compare('basecero',$this->basecero,true);
		$criteria->compare('basegravada',$this->basegravada,true);
		$criteria->compare('idporcentajeiva',$this->idporcentajeiva);
		$criteria->compare('montoiva',$this->montoiva,true);
		$criteria->compare('baseice',$this->baseice,true);
		$criteria->compare('idporcentajeice',$this->idporcentajeice);
		$criteria->compare('montoice',$this->montoice,true);
		$criteria->compare('montobaseiva30',$this->montobaseiva30,true);
		$criteria->compare('retencioniva30',$this->retencioniva30,true);
		$criteria->compare('montobaseiva70',$this->montobaseiva70,true);
		$criteria->compare('porcentajeretencioniva70',$this->porcentajeretencioniva70);
                $criteria->compare('porcentajeretencioniva30',$this->porcentajeretencioniva30);
		$criteria->compare('retenidoiva70',$this->retenidoiva70,true);
		$criteria->compare('montobaseiva100',$this->montobaseiva100,true);
		$criteria->compare('porcentajeretencioniva100',$this->porcentajeretencioniva100);
		$criteria->compare('retenidoiva100',$this->retenidoiva100,true);
		$criteria->compare('establecimientoretencion1',$this->establecimientoretencion1,true);
		$criteria->compare('puntoemisionretencion1',$this->puntoemisionretencion1,true);
		$criteria->compare('secuencialretencion1',$this->secuencialretencion1,true);
		$criteria->compare('autorizacionretencion1',$this->autorizacionretencion1,true);
		$criteria->compare('fecharetencion1',$this->fecharetencion1,true);
		$criteria->compare('establecimientoretencion2',$this->establecimientoretencion2,true);
		$criteria->compare('puntoemisionretencion2',$this->puntoemisionretencion2,true);
		$criteria->compare('secuencialretencion2',$this->secuencialretencion2,true);
		$criteria->compare('autorizacionretencion2',$this->autorizacionretencion2,true);
		$criteria->compare('fecharetencion2',$this->fecharetencion2,true);
		$criteria->compare('codigodocumentomodificanc',$this->codigodocumentomodificanc,true);
		$criteria->compare('estabdocumentomodificanc',$this->estabdocumentomodificanc,true);
		$criteria->compare('puntoemisiondocumentomodificanc',$this->puntoemisiondocumentomodificanc,true);
		$criteria->compare('secuencialdocumentomodificanc',$this->secuencialdocumentomodificanc,true);
		$criteria->compare('autorizaciondocumentomodificanc',$this->autorizaciondocumentomodificanc,true);
		$criteria->compare('fechadocumentomodificanc',$this->fechadocumentomodificanc,true);
		$criteria->compare('ubicacionformulario',$this->ubicacionformulario);
		$criteria->compare('formapago',$this->formapago);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('numerocompratransaccion',$this->numerocompratransaccion,true);
		$criteria->compare('idbodega',$this->idbodega);
		$criteria->compare('idtarjetacredito',$this->idtarjetacredito);
		$criteria->compare('idempresa',$this->idempresa);
		$criteria->compare('compraempresa',$this->compraempresa,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid
         */
         public function columnasLista(){
            $gridlista=array(
                          array('name'=>'numerocompratransaccion','type'=>'raw','value'=>'CHtml::link($data->numerocompratransaccion,array("ver","id"=>$data->idcompra,"idCstm"=>$data->getIdCstm(),"idMaestro"=>$data->getIdMaestroAsiento()))'),
                          array('name'=>'idproveedor','type'=>'raw','value'=>'$data->getNombreProveedor()'),
                          array('name'=>'idbodega','type'=>'raw','value'=>'$data->getNombreBodega()'),
                          array('name'=>'idejercicio','type'=>'raw','value'=>'$data->getEjercicio()'),
                          array('name'=>'idmesperiodo','type'=>'raw','value'=>'$data->getMesPeriodo()'),
                          'fechaemision',
                          'fechacaduca',
            );

            return $gridlista;
        }

        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid
         */
         public function columnasListaAnularRetencion(){
            $gridlista=array(
                          array('name'=>'numerocompratransaccion','type'=>'raw','value'=>'CHtml::link($data->numerocompratransaccion,array("anularetencion","id"=>$data->idcompra,"idCstm"=>$data->getIdCstm(),"idMaestro"=>$data->getIdMaestroAsiento()))'),
                          array('name'=>'idproveedor','type'=>'raw','value'=>'$data->getNombreProveedor()'),
                          array('name'=>'idbodega','type'=>'raw','value'=>'$data->getNombreBodega()'),
                          array('name'=>'idejercicio','type'=>'raw','value'=>'$data->getEjercicio()'),
                          array('name'=>'idmesperiodo','type'=>'raw','value'=>'$data->getMesPeriodo()'),
                          'fechaemision',
                          'fechacaduca',
            );

            return $gridlista;
        }

        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid
         */
         public function columnaslistacomprasanteriores(){
            $gridlista=array(
                          array('name'=>'numerocompratransaccion','type'=>'raw','value'=>'CHtml::link($data->numerocompratransaccion,array("vercomprasanteriores","id"=>$data->idcompra,"idCstm"=>$data->getIdCstm(),"idMaestro"=>$data->getIdMaestroAsiento()))'),
                          array('name'=>'idproveedor','type'=>'raw','value'=>'$data->getNombreProveedor()'),
                          array('name'=>'idbodega','type'=>'raw','value'=>'$data->getNombreBodega()'),
                          array('name'=>'idejercicio','type'=>'raw','value'=>'$data->getEjercicio()'),
                          array('name'=>'idmesperiodo','type'=>'raw','value'=>'$data->getMesPeriodo()'),
                          'fechaemision',
                          'fechacaduca',
            );

            return $gridlista;
        }

        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid
         */
         public function columnaslistadevolucioncompra(){
            $gridlista=array(
                          array('name'=>'numerocompratransaccion','type'=>'raw','value'=>'CHtml::link($data->numerocompratransaccion,array("verdevolucioncompra","id"=>$data->idcompra,"idCstm"=>$data->getIdCstm(),"idMaestro"=>$data->getIdMaestroAsiento()))'),
                          array('name'=>'idproveedor','type'=>'raw','value'=>'$data->getNombreProveedor()'),
                          array('name'=>'idbodega','type'=>'raw','value'=>'$data->getNombreBodega()'),
                          array('name'=>'idejercicio','type'=>'raw','value'=>'$data->getEjercicio()'),
                          array('name'=>'idmesperiodo','type'=>'raw','value'=>'$data->getMesPeriodo()'),
                          'fechaemision',
                          'fechacaduca',
            );

            return $gridlista;
        }

        public function buscaNumeroCompra($id){

            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return ($model->numerocompratransaccion);
            }else
                return '';
        }

        public function getNombreProveedor(){
            $proveedor=Proveedor::model()->buscaRucNombre($this->idproveedor);
            if($proveedor=='')
                return '';
            else
                return $proveedor;
        }

        public function getNombreBodega(){
            $bodega=Bodega::model()->buscaNombre($this->idbodega);
            if($bodega=='')
                return '';
            else
                return $bodega;
        }

        public function getEjercicio(){
            $ejercicio=Ejerciciocontable::model()->buscaNombre($this->idejercicio);
            if($ejercicio=='')
                return '';
            else
                return $ejercicio;
        }

        public function getMesPeriodo(){
            $periodo=Periodocontable::model()->buscaNombre($this->idmesperiodo);
            if($periodo=='')
                return '';
            else
                return $periodo;
        }

        public function getIdCstm(){
            $idCstm=Compraingresocstm::model()->buscaId($this->idcompra);
            if($idCstm=='')
                return '';
            else
                return $idCstm;
        }

        public function getIdMaestroAsiento(){
            $idMaestro=Compraingresocstm::model()->buscaIdMaestroAsiento($this->idcompra);
            if($idMaestro=='')
                return '';
            else
                return $idMaestro;
        }

        public function buscaDocumentoModificadoDevolucion($id){
            if($id==null)
                return '';
            $cstm = Compraingresocstm::model()->findAll(
                    array(
                    'condition' => '"idcompranotacredito" = :idcompranotacredito',
                    'params' => array(
                            ':idcompranotacredito' => $id
                    )));
            foreach($cstm as $cstms){
                $idCompraDevolucion=$cstms['idcompra'];
            }
            $compra=$this->model()->findByPk($idCompraDevolucion);
            return Tipocomprobante::model()->buscaNombre($compra->idtipocomprobante);
        }

        public function buscaFechaEmisionDevolucion($id){
            if($id==null)
                return '';
            $cstm = Compraingresocstm::model()->findAll(
                    array(
                    'condition' => '"idcompranotacredito" = :idcompranotacredito',
                    'params' => array(
                            ':idcompranotacredito' => $id
                    )));
            foreach($cstm as $cstms){
                $idCompraDevolucion=$cstms['idcompra'];
            }
            $compra=$this->model()->findByPk($idCompraDevolucion);
            return $compra->fechaemision;
        }

        public function buscaSaldoDevolucion($id){
            if($id==null)
                return '';
            $cstm = Compraingresocstm::model()->findAll(
                    array(
                    'condition' => '"idcompranotacredito" = :idcompranotacredito',
                    'params' => array(
                            ':idcompranotacredito' => $id
                    )));
            foreach($cstm as $cstms){
                $idCompraDevolucion=$cstms['id'];
            }
            $compraCstm=Compraingresocstm::model()->findByPk($idCompraDevolucion);
            return $compraCstm->saldocompra;
        }

        public function buscaEstablecimientoDevolucion($id){
            if($id==null)
                return '';
            $cstm = Compraingresocstm::model()->findAll(
                    array(
                    'condition' => '"idcompranotacredito" = :idcompranotacredito',
                    'params' => array(
                            ':idcompranotacredito' => $id
                    )));
            foreach($cstm as $cstms){
                $idCompraDevolucion=$cstms['idcompra'];
            }
            $compra=$this->model()->findByPk($idCompraDevolucion);
            return $compra->estabcompra;
        }

        public function buscaPuntoCompraDevolucion($id){
            if($id==null)
                return '';
            $cstm = Compraingresocstm::model()->findAll(
                    array(
                    'condition' => '"idcompranotacredito" = :idcompranotacredito',
                    'params' => array(
                            ':idcompranotacredito' => $id
                    )));
            foreach($cstm as $cstms){
                $idCompraDevolucion=$cstms['idcompra'];
            }
            $compra=$this->model()->findByPk($idCompraDevolucion);
            return $compra->puntocompra;
        }

        public function buscaSecuencialDevolucion($id){
            if($id==null)
                return '';
            $cstm = Compraingresocstm::model()->findAll(
                    array(
                    'condition' => '"idcompranotacredito" = :idcompranotacredito',
                    'params' => array(
                            ':idcompranotacredito' => $id
                    )));
            foreach($cstm as $cstms){
                $idCompraDevolucion=$cstms['idcompra'];
            }
            $compra=$this->model()->findByPk($idCompraDevolucion);
            return $compra->secuencialcompra;
        }

        public function buscaAutorizacionDevolucion($id){
            if($id==null)
                return '';
            $cstm = Compraingresocstm::model()->findAll(
                    array(
                    'condition' => '"idcompranotacredito" = :idcompranotacredito',
                    'params' => array(
                            ':idcompranotacredito' => $id
                    )));
            foreach($cstm as $cstms){
                $idCompraDevolucion=$cstms['idcompra'];
            }
            $compra=$this->model()->findByPk($idCompraDevolucion);
            return $compra->autorizacompra;
        }
}