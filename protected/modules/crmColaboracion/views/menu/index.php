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
                        }
                                            ">
                    <option value="0">Seleccione..</option>
                    <option value="1">Llanadas</option>
                    <option value="2">Reuniones</option>
                </select>
            </td>
        </tr>
    </table>
</form>
<div id="colaboracion"></div>
