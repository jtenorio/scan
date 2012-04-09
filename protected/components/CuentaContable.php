<?php
/**
 *
 * Clase que maneja los diferentes niveles para las cuentas contables
 *
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 *
 *
 */

class CuentaContable extends CController{

    

    /**
     *  Verifica si existe nivel para la cuenta que se esta guardando
     *
     * @var <string> $cuenta
     * @return <string>
     *
    */

    public function existeNivel($cuenta=''){
        
        if (self::right(trim($cuenta),1)=='.'){
                for ($i=0;$i<strlen(trim($cuenta))-1;$i++){
                    $texto=substr(trim($cuenta),$i,1);
                      	if ($texto=='.')
                        	$posicion=$i+1;
                }
                $texto=substr(trim($cuenta),0,$posicion);
        }else{
        	for ($i=0;$i<=strlen(trim($cuenta));$i++){
                	$texto=substr(trim($cuenta),$i,1);
                    if ($texto=='.')
			$posicion=$i+1;
                }

                $texto=substr(trim($cuenta),0,$posicion);
        }
        return $texto;
    }
     /**
      Verifica si existe nivel para la cuenta que se esta guardando
     * @var <string> $codigo
     * @return <array>
     *
    */
    public function siguienteNivel($codigo){
        if (self::right(trim($codigo),1)=='.'){
		$cnivel=strlen(trim($codigo))-strlen(self::strtran(trim($codigo),'.'));
		$tipoc=true;
        }else{
		$cnivel=strlen(trim($codigo))-strlen(self::strtran(trim($codigo),'.'))+1;
		$tipoc=false;
        }
      return array('tipoc'=>$tipoc,'cnivel'=>$cnivel);
    }
    /**
    /   Simula la funcion right de Visual Fox Pro, retorna el ultimo caracter
     *  de la cadena que se pasa como parametro dependiendo
     * @var <string> $cadena
     * @var <integer> $len
     * @return <string>
     * 
    */
    private function right($cadena,$len=1){
        return substr($cadena,strlen($cadena)-1,$len);
    }
    /**
    /   Simula la funcion strtran de Visual Fox Pro, retorna el ultimo caracter
     *  de la cadena que se pasa como parametro dependiendo
     * @var <string> $cadena
     * @var <integer> $len
     * @return <string>
     *
    */
    private function strtran($cadena,$search='.',$replace=''){
        return str_replace($search, $replace, $cadena);
    }

}
?>
