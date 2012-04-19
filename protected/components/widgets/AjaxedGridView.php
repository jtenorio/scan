<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    class AjaxedGridView extends CWidget
    {
        public $table;
        public $divToAjax;
        public $urlToAjax;
        public $dataSet;
        public $columnsToShow;
        public $keyName;
        
        public function init(){
            
        }
        public function run(){
            $i=0;
          foreach($dataSet as $row ){
              $this->table[$i][$keyName] = $row->$keyName;
              foreach($columnsToShow as $column){
                  $value = $row->$column;
                  
                  $this->table[$i][$column] = $value;
              }
              $i++;
          }  
         $this->render("ajaxedgrid_view",array(
             "table"=>$this->table,
             "divToAjax"=>$this->divToAjax,
             "urlToAjax"=>$this->urlToAjax,
             "keyName"=>$this->keyName
                 )
             );   
        }
    }

?>

