<br/><h2  style="text-align:center;"><?php echo UserModule::t("Login"); ?></h2>
<hr/>
<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p style="text-align:center;"><i><?php echo UserModule::t("Please enter your Username and password here."); ?></i></p>

<div class="form" style="text-align:center;">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
		
		<b> Username </b> &nbsp;&nbsp; <?php echo CHtml::activeTextField($model,'username') ?>
	</div>
	
	<div class="row">
		
		<b> Password </b> &nbsp;&nbsp; <?php echo CHtml::activePasswordField($model,'password') ?>
	</div>
	<?php /* 
	<div class="row">
		<p class="hint">
		<?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div> */ ?>
<?php /*	
	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>
*/ ?>
	<div class="row submit">
		<button id="btn">Login</button>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',

        ),
    ),
), $model);
?>
<script>
$(document).ready( function() {
  document.getElementByName('yt0').addClass( 'some_other_class' );
} );

</script>
<style>
#btn {
  background: #ffdd00;
  background-image: -webkit-linear-gradient(top, #ffdd00, #ff9900);
  background-image: -moz-linear-gradient(top, #ffdd00, #ff9900);
  background-image: -ms-linear-gradient(top, #ffdd00, #ff9900);
  background-image: -o-linear-gradient(top, #ffdd00, #ff9900);
  background-image: linear-gradient(to bottom, #ffdd00, #ff9900);
  -webkit-border-radius: 12;
  -moz-border-radius: 12;
  border-radius: 12px;
  font-family: Arial;
  color: #ffffff;
  font-size: 13px;
  padding: 7px 30px 7px 30px;
  text-decoration: none;
}

#btn:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
</style>