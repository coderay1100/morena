<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<br/>
<br/>
<div class="container" style="border-style:solid;border-color:#c9e0ed;border-width:1px;">
<img src="<?php echo Yii::app()->request->baseUrl.'/images/logo_header_e-payroll.jpg'; ?> " alt="Mountain View" style="width:100%;">
</div>
<div class="container" style="background-color:white;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-color:#c9e0ed;border-width:1px;">
		<?php echo $content; ?>
			<div class="clear" ></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by PT. Prawathiya Karsa Pradiphta<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->
</div>

<?php $this->endContent(); ?>