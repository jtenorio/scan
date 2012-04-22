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
        public $headers;
        
        public function init(){}
        public function run(){
            $i=0;
            $this->headers = array();
          foreach($this->dataSet->getData() as $row ){
              $nombre = $this->keyName; 
              $this->table[$i][$this->keyName] = $row->$nombre;
              foreach($this->columnsToShow as $column=>$title){
                  $value = $row->$column;
                  $this->table[$i][$column] = $value;
                  if($i==0){
                      array_push($this->headers, $title);
                    }
              }
              $i++;
          }  
         $this->render("ajaxedgrid_view",array(
             "table"=>$this->table,
             "divToAjax"=>$this->divToAjax,
             "urlToAjax"=>$this->urlToAjax,
             "keyName"=>$this->keyName,
             "headers"=>$this->headers
                 )
             );   
        }
    }

?>

