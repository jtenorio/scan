<?php
/* 
 * Permite crear la relacion entre bodega e items
 * @author Jose Sambrano
 * @company B.O.S
 * protected.modules.parametros.components.
 */

class ManagerBodega extends CApplicationComponent{

    /*
     * Crear todos los item-bodega dada una bodega
     * @var <Bodega>
     *
     */
    public function crearFromBodega(Bodega $bodega){
        $items=Item::model()->findAll();
        if(is_array($items)){
            foreach($items as $key =>$value){
                if($value instanceof Item){
                   $crit=self::setCriterio($value->id,$bodega->id);
                   $item_bodega=Itembodega::model()->find($crit);
                   if($item_bodega==null){
                       $relacion=new ItemBodega;
                       $relacion->setScenario('ínsert');
                       $relacion->idbodega=$bodega->id;
                       $relacion->iditem=$value->id;
                       $relacion->stock=0;
                       $relacion->stockcomprometido=0;
                       $relacion->stockporllegar=0;
                       $relacion->stockcomprometido=0;
                       $relacion->idempresa=$this->empresa_id;
                       $relacion->save();
                   }
                }
            }
        }
    }
    /*
     *Crea todo las bodegas-items dado un Item
     * @var <Item>
     */
    public function crearFromItem(Item $producto){
           $bodegas=Bodega::model()->findAll();
           if(is_array($bodegas)){
                foreach($bodegas as $key =>$value){
                    $crit=self::setCriterio($producto->id,$value->id);
                    $item_bodega=Itembodega::model()->find($crit);
                    if($item_bodega==null){
                       $relacion=new ItemBodega;
                       $relacion->setScenario('ínsert');
                       $relacion->idbodega=$value->id;
                       $relacion->iditem=$producto->id;
                       $relacion->stock=0;
                       $relacion->stockcomprometido=0;
                       $relacion->stockporllegar=0;
                       $relacion->stockcomprometido=0;
                       $relacion->idempresa=$this->empresa_id;
                       $relacion->save();
                   }
                }
           }
    }

    /**/

    public function setCriterio($iditem,$idbodega){
                $crit=new CDbCriteria();
                $crit->addCondition("(\"idbodega\" =:bodega and \"iditem\" =:item)");
                $crit->params=array(':bodega' =>"$idbodega",':item'=>"$iditem");
                
                return  $crit;
    }
    
}
?>
