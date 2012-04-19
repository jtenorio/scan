<?php
$this->breadcrumbs=array(
	'Menu',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<form>
    <table>
        <tr>
            <td>Seleccione:</td>
            <td>
                <select id="optColaboracion" onchange="
                        switch(this.value){
                            case '1':
                                sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/llamada/create', 'colaboracion');
                                break;
                            case '2':
                                sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/reunion/create', 'colaboracion');
                                break;
                            case '3':
                                sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/tarea/create', 'colaboracion');
                                break;
                            case '4':
                                sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/documento/create', 'colaboracion');
                                sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/documento/admin', 'agenda');
                                break;    
                        }
                                            ">
                    <option value="0">Seleccione..</option>
                    <option value="1">Llamadas</option>
                    <option value="2">Reuniones</option>
                    <option value="3">Tareas</option>
                    <option value="4">Documentos</option>
                    
                </select>
            </td>
        </tr>
    </table>
</form>
<div id="colaboracion"></div>
