<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Screen | Scan</title>
<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/typography.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/global2.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ddsmoothmenu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.calendars.picker.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ddsmoothmenu.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/functions.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/functions_th.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.all.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.picker-es.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.position.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.autocomplete.js"></script>



</head>
<body>
<div class="wrapper">
	<div id="header">
  	<h1>
    	<a href="#">SCAN</a>
    </h1>
  </div>
</div>
<?php if(isset(Yii::app()->controller->module)){     ?>   
<div id="menu">
	<div class="wrapper">    
    <div class="ddsmoothmenu" id="nav">
      <?php 
       
        $this->widget('zii.widgets.CMenu', Yii::app()->menuBuilder->getMenuOptions() ); 
      
        ?>
      <ul>
        
        <li class="last"><a href="#">CONTABILIDAD</a>
        	<ul>
            <li><a href="<?php echo Yii::app()->request->baseUrl.'/index.php/'?>/contabilidad/maestroasiento/admin">Maestro Asiento</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl.'/index.php/'?>contabilidad/maestroCheques/admin">Cheques Varios</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl.'/index.php/'?>contabilidad/maestroanticipoproveedor/admin">Ant Prov sin Fact</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl.'/index.php/'?>contabilidad/maestrochequeproveedor/admin">Pagos a Proveedor</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl.'/index.php/'?>contabilidad/maestrocajachica/admin">Reposicion Caja Chica</a></li>
          </ul>
        </li>
      </ul>
    </div>
           
  </div>
</div>
<?php } ?>
<div class="wrapper" id="section">
	<?php echo $content; 
       
        ?>
</div>
  
<div class="wrapper" id="footer">
<!--  	Tiempo de respuesta del servidor: 00:05 segundos-->
</div>
    

</body>
</html>
