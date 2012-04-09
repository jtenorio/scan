<div id="buttons">
    <ul>
<?php $this->pageTitle=Yii::app()->name; ?>
<?php
    $menuHome = array();
    $file = Yii::getPathOfAlias('application.data.menuHome').'.php';
    $menuHome = include($file);
    
    foreach($menuHome as $item){
      ?>
        <li><a href="<?php echo Yii::app()->request->baseUrl.'/index.php/'.$item['url'] ?>"><?php echo $item['label'] ?></a></li>
        <?php
    }
?>
        
    </ul>
</div>    
  
      
   
  <div class="tabs">
        <ul class="tabNavigation">
            <li><a href="#Shortcuts">Shortcuts</a></li>
            <li><a href="#Dashlets">Dashlets</a></li>
            <li><a href="#Graficos">Gr&aacute;ficos</a></li>
        </ul>
        <div id="Shortcuts">
        	<div class="sup"></div>
          <div class="content">
            <h2>Shortcuts</h2>
            <img src="/scan/images/dash.jpg" alt="" />
          </div>
          <div class="bottom"></div>
        </div>
        <div id="Dashlets">
					<div class="sup"></div>
          <div class="content">
            <h2>Dashlets</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco xbvgxsdgb<br />llamco xbvgxsdgb<br />llamco xbvgxsdgb<br />llamco xbvgxsdgb<br />llamco xbvgxsdgb<br />llamco xbvgxsdgb<br />llamco xbvgxsdgb<br />laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="bottom"></div>
        </div>
        <div id="Graficos">
        	<div class="sup"></div>
          <div class="content">
            <h2>Graficos</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="bottom"></div>
        </div>
<img src="/scan/images/urbano.jpg" alt="" align="right" />
</div>
