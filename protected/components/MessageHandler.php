<?php
/**
 *
 * Clase que nos ayuda a manejar los mensajes o etiquetas a nivel de toda la aplicacion
 * Facilita entender mejor el sistema dependiendo de la empresa.
 * 
 * @author josesambrano
 * @company B.O.S
 * @package components
 */
class MessageHandler extends CComponent{

    /*
     * Helper que ayuda a la traducccion, estado experimental , probablemente necesite
     * mas validaciones y mejoras
     * @param <string> $key  Valor que se va traducir
     * @param <string> $module  Modulo de donde se encuentra la carpeta messages
     * @param <string> $file nombre del archivo donde se encuentra la traduccion
     * @param <array>   array()
     * @return <string> 
     */
    public function transformar($key='',$module='',$file='',$param=array()){
       $current_language=Yii::app()->getLanguage();
      if(empty($module)||empty($file))
            return Yii::t('yii',$value,$param);
       if($module!='Default')
            $category=$module.'Module.'.$current_language.'.'.$file;
       else
           $category=$file;
       /* Verificar que el archivo exista */
        
        return Yii::t($category,$key,$param);
    }


}
?>
