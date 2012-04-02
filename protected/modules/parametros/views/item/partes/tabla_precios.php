<?php
/*
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.views
 */
?>



<script>
var fila=0;
var accedio=false;
        this.hacerFila = function(id, celdas){
		html = "<tr id="+id+">";
		for(var i=0;i<celdas.length;i++)
			html += "<td>"+celdas[i]+"</td>";
		html += "</tr>";
		return html;
	};
        this.limpiarProductos = function(){
		$('tr[id^=prod_row_]').remove();
	};

        function verFila(){
            fila=$("#fila").val();
            accedio=true;
        }

        function addFila(){
            if(accedio==false){
                verFila();
            }
             var el = document.getElementById("prod_row_"+fila);
             if(el) return
             
		
                id_control = "<input type='hidden' name='prod_"+fila+"' id='prod_"+fila+"' value='' />";
                cantidaddesde = "<input type='text' name='cantidaddesde_"+fila+"' id='cantidaddesde_"+fila+"' value='' />";
		cantidadhasta = "<input type='text' name='cantidadhasta_"+fila+"' id='cantidadhasta_"+fila+"' value='' />";
		valor = "<input type='text' name='valor_"+fila+"' id='valor_"+fila+"' value=''  />";
                vigentedesde = "<input type='text' name='vigentedesde_"+fila+"' id='vigentedesde_"+fila+"' value=''  class='fecha' />";
		vigentehasta = "<input  type='text' name='vigentehasta_"+fila+"' id='vigentehasta_"+fila+"' value='' class='fecha'  />";
                remove_control = "<a href='javascript:void(0);' onclick='borrar(\""+fila+"\");'>X</a>";
               
             celdas=[
                 cantidaddesde,cantidadhasta,valor,vigentedesde,
                 vigentehasta,remove_control,id_control
             ];
            row = this.hacerFila('prod_row_'+fila, celdas);
	    $('#tablaprecios').append(row);
            fila++;

        }

   function borrar(fila){
       $("#prod_row_"+fila).remove();
       
   }

</script>


<div>
    <?php echo CHtml::link("Añadir", "javascript:void(0);", array("onclick"=>'javascript:addFila();'))?>
			<table cellpadding="0" cellspacing="0" border="0" id="tablaprecios">


                                <thead>
                                <tr>
                                     <th>Cantidad Desde</th>
                                     <th>Cantidad Hasta</th>
                                     <th>Valor</th>
                                     <th>Vigente Desde</th>
                                     <th>Vigente Hasta</th>
                                     
                                
					<th>
      					   Borrar
					</th>

                                       
				</tr>
                                </thead>
                                <tbody id="targetpreciostabla">
                                    <?php if (is_array($tabla)):?>
                                    <?php foreach ($tabla as $key =>$value):?>
                                    <tr id="prod_row_<?php echo $key; ?>">
                                        <td><?php echo CHtml::textField("cantidaddesde_".$key, $value->cantidaddesde,array());  ?></td>
                                         <td><?php echo CHtml::textField("cantidadhasta_".$key, $value->cantidadhasta,array());  ?></td>
                                         <td><?php echo CHtml::textField("valor_".$key, $value->valor,array());  ?></td>
                                         <td><?php echo CHtml::textField("vigentedesde_".$key, $value->vigentedesde,array('class'=>'fecha'));  ?></td>
                                         <td><?php echo CHtml::textField("vigentehasta_".$key, $value->vigentehasta,array('class'=>'fecha'));
                                         echo CHtml::hiddenField("prod_".$key, $value->id);
                                         ?></td>
                                         <td><?php echo Chtml::link("X", "javascript:void(0);", array('onclick'=>"borrar(".$key.")"));?></td>

                                    </tr>
                                    <?php endforeach;?>
                                    <?php echo CHtml::hiddenField("fila", count($tabla));  ?>
                                    <?php else: ?>
                                    <?php echo CHtml::hiddenField("fila", "0");  ?>
                                    <?php endif;?>
                                </tbody>
                                </table>
</div>
