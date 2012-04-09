<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
 
    <div id="login">

        <h3>URBANO</h3>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
            <table>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'username:'); ?>
                </td>
                <td>
                    <?php echo $form->textField($model,'username',array('id'=>'login input')); ?>
                </td>
                <td>
                    <?php echo $form->error($model,'username'); ?>
                </td>
               
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'password:'); ?>
                </td>
                <td>
                    <?php echo $form->passwordField($model,'password'); ?>
                </td>
                <td>
                    <?php echo $form->error($model,'password'); ?>
                </td>
            </tr>
            <tr>
                <td>Lenguage:</td>
                <td>
                <select name="language">
                    <option value="de">Default</option>
                    <option value="en">English</option>
                  <option value="es">Español</option>
                </select>
              </td>
            </tr>
            <tr>    
                <td colspan="2"><?php echo CHtml::submitButton('Login',array('class'=>'loginButton')); ?></td>
            </tr>
          </table>
        <?php $this->endWidget(); ?>
    </div>
    <div class="wrapper" id="footer">
        <h4 class="scan">Scan</h4>
        <p class="copyright">SCAN © 2012 | All Rights Reserved</p>
    </div>

<!--<div class="wrapper" id="footer">
<h4 class="scan">Scan</h4>
<p class="copyright">SCAN © 2012 | All Rights Reserved</p>

</div>-->

<!--<div class="form">


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		
	</div>

	<div class="row">
		
		<p class="hint">
			Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		
	</div>


</div> form -->
