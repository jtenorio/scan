<?php
// configuración del menu principal de la app
return array(
	array('label'=>'Inicio', 'url'=>'site/index'), //Home
	array('label'=>'Parametros', 'url'=>'#', 'access'=>'admin',
		'items'=>array(
                 array('label'=>'Contabilidad','url'=>'#',
                     'items'=>array(
                            array('label'=>'Plan de cuentas Nec', 'url'=>'parametros/plancuentasnec/index'),
                            array('label'=>'Plan de cuentas Niff', 'url'=>'parametros/plancuentasniff/index'),
                           array('label'=>'Plan Centro de Costo', 'url'=>'parametros/plancentrocosto/index'),// dbeeria estar adentro
                            array('label'=>'Banco', 'url'=>'parametros/banco/index'),
                            array('label'=>'Cuentas Bancarias', 'url'=>'parametros/cuentabancaria/index'),

                         //// deberia estar en casa

                     )),
                  array('label'=>'Tributacion','url'=>'#',
                     'items'=>array(
                         array('label'=>'Tipo Comprobante', 'url'=>'parametros/tipocomprobante/index'),
                         array('label'=>'Porcentaje Iva', 'url'=>'parametros/porcentajeiva/index'),
                         array('label'=>'Porcentaje ICE', 'url'=>'parametros/porcentajeice/index'),
                         array('label'=>'Sustento Tributario', 'url'=>'parametros/sustentocredito/index'),
                         array('label'=>'Tipo Identificacion', 'url'=>'parametros/tipoidentificacion/index'),
                         array('label'=>'Sec. Transaccion', 'url'=>'parametros/secuencialtransaccion/index'),
                         array('label'=>'Por Ret Fuente', 'url'=>'parametros/porcentajeretencionfuente/index'),
                         array('label'=>'Por Ret IVA', 'url'=>'parametros/porcentajeretencioniva/index'),
                         array('label'=>'Cod Ret. Fuente', 'url'=>'parametros/codigoretencionfuente/index'),
                         array('label'=>'Tip. A. Retencion', 'url'=>'parametros/tipoagenteretencion/index'),
                         array('label'=>'Tipo Proveedor', 'url'=>'parametros/tipoproveedor/index'),
                         array('label'=>'Tarjeta Credito', 'url'=>'parametros/tarjetacredito/index'),


                     )),  array('label'=>'Inventario','url'=>'#','access'=>'admin',
                     'items'=>array(
                           array('label'=>'Bodega', 'url'=>'parametros/bodega/index'),
                           array('label'=>'Marca', 'url'=>'parametros/marca/index'),
                           array('label'=>'Modelo', 'url'=>'parametros/modelo/index'),
                           array('label'=>'Categoria', 'url'=>'parametros/categoria/index'),
                           array('label'=>'Presentacion', 'url'=>'parametros/presentacion/index'),
                           array('label'=>'Items Gasto', 'url'=>'parametros/item/itemgasto/index'),
                           array('label'=>'Items Servicios', 'url'=>'parametros/item/itemservicios/index'),
                           array('label'=>'Items Inventario', 'url'=>'parametros/item/iteminventario/index'),
                           array('label'=>'Items Activo Fijo', 'url'=>'parametros/item/index'),
                     )),

                 array('label'=>'Generales y Usuarios','url'=>'#','access'=>'admin',
                     'items'=>array(
                           array('label'=>'Empresa', 'url'=>'parametros/empresa/index'),
                           array('label'=>'Roles', 'url'=>'parametros/catalogos/index'),
                           array('label'=>'Usuarios', 'url'=>'productos/index'),
                           array('label'=>'Establecimientos', 'url'=>'parametros/establecimiento/index'),
                           array('label'=>'Par. Contabilidad', 'url'=>'parametros/parametrocontabilidad/index'),
                         array('label'=>'Par. Inventario', 'url'=>'parametros/parametrofacturacion/index'),
                           array('label'=>'Catalogos', 'url'=>'parametros/catalogos/index'),

                     )),

	)),
//        array('label'=>'Parametrizacion Sistema', 'url'=>'#', 'access'=>'admin',
//		'items'=>array(
//		array('label'=>'Usuarios', 'url'=>'usuarios/index'),
//		array('label'=>'Roles', 'url'=>'roles/index'),
//		//array('label'=>'Casas de Credito', 'url'=>'casas/index'),
//		//array('label'=>'Locales comerciales', 'url'=>'locales/index'), // dbeeria estar adentro
//		//array('label'=>'Productos/servicios', 'url'=>'productos/index'), // deberia estar en casa
//		array('label'=>'Catalogo general', 'url'=>'catalogos/index'),
//		array('label'=>'Catalogo productos', 'url'=>'productos/index'),
//		array('label'=>'Plantillas', 'url'=>'plantillas/index'),
//		array('label'=>'Información banco', 'url'=>'datosBanco/index'),
//		array('label'=>'Auditoria', 'url'=>'auditoria/index'),
//                array('label'=>'Observados', 'url'=>'observado/index'),
//                array('label'=>'Recurrente', 'url'=>'recurrente/index'),
//	)),

    array('label'=>'Contabilidad', 'url'=>'#',
		'items'=>array(
		array('label'=>'Maestro Asiento', 'url'=>'contabilidad/maestroasiento/admin', 'access'=>'@'),
                array('label'=>'Cheques Varios', 'url'=>'contabilidad/maestrocheques/admin', 'access'=>'@'),
                array('label'=>'Ant Prov sin Fact', 'url'=>'contabilidad/maestroanticipoproveedor/admin', 'access'=>'@'),
                array('label'=>'Pagos a Proveedor ', 'url'=>'contabilidad/maestrochequeproveedor/admin', 'access'=>'@'),
                array('label'=>'Reposicion Caja Chica ', 'url'=>'contabilidad/maestrocajachica/admin', 'access'=>'@'),
		//array('label'=>'Tabla amortización', 'url'=>'herramientas/tabla', 'access'=>'@'),
		//array('label'=>'Tramas banco', 'url'=>'herramientas/tramaBanco', 'access'=>'supervisor,admin'),
		//array('label'=>'Información sistema', 'url'=>'herramientas/info_sistema', 'access'=>'admin'),
                //array('label'=>'Enviar Mail', 'url'=>'herramientas/enviarMail', 'access'=>'admin'),
	)),
    array('label'=>'Cuentas por Pagar', 'url'=>'#',
		'items'=>array(
		array('label'=>'Proveedores', 'url'=>'parametros/proveedor/index', 'access'=>'@'),
		//array('label'=>'Tabla amortización', 'url'=>'herramientas/tabla', 'access'=>'@'),
		//array('label'=>'Tramas banco', 'url'=>'herramientas/tramaBanco', 'access'=>'supervisor,admin'),
		//array('label'=>'Información sistema', 'url'=>'herramientas/info_sistema', 'access'=>'admin'),
                //array('label'=>'Enviar Mail', 'url'=>'herramientas/enviarMail', 'access'=>'admin'),
	)),

    array('label'=>'Compras','url'=>'#',
                     'items'=>array(
                            array('label'=>'Orden Compra','url'=>'#',
                             'items'=>array(
                                    array('label'=>'Administrar Orden', 'url'=>'ordencompra/ordencompra/admin', 'access'=>'@'),
                                    array('label'=>'Aprobar Orden', 'url'=>'ordencompra/ordencompra/adminaprobar', 'access'=>'@'),
                             )),
                            array('label'=>'Administrar Compras', 'url'=>'compra/compra/buscar'),
                            array('label'=>'Anular Retencion', 'url'=>'compra/compra/buscaranularetencion'),
                            array('label'=>'Compras Anteriores', 'url'=>'compra/compra/buscarcomprasanteriores'),
                            array('label'=>'Devolucion Compras', 'url'=>'compra/compra/buscardevolucioncompra'),
                     )),
    array('label'=>'CRM', 'url'=>'#',
		'items'=>array(
		array('label'=>'Colaboracion', 'url'=>'crmColaboracion', 'access'=>'@'),
                array('label'=>'Contactos', 'url'=>'crmContacto/contacto/admin', 'access'=>'@'),
                array('label'=>'Clientes', 'url'=>'crmCliente/cliente/admin', 'access'=>'@'),
		//array('label'=>'Tabla amortización', 'url'=>'herramientas/tabla', 'access'=>'@'),
		//array('label'=>'Tramas banco', 'url'=>'herramientas/tramaBanco', 'access'=>'supervisor,admin'),
		//array('label'=>'Información sistema', 'url'=>'herramientas/info_sistema', 'access'=>'admin'),
                //array('label'=>'Enviar Mail', 'url'=>'herramientas/enviarMail', 'access'=>'admin'),
	)),

);

/*
Reporte banco:
	estadisticas, tiempo promedio por solicitud
Reporte freerisk :
	solicitudes por estado para ver cuales se puede facturar

*/

?>
