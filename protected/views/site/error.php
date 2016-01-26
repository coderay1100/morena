<div class="span-22">
	<div id="content">

<?php
/* @var $this ListgajiController */
/* @var $model Listgaji */


 echo TbHtml::breadcrumbs(array(
    'Home' => '/',
    'Error',
)); 
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
</div>
</div>
<div class="span-6 last">
	<div id="sidebar">
<?php  ?>	
	<div class="well" style="max-width: 340px; padding: 8px 0;">
    <?php echo TbHtml::navList(array(
		array('label' => 'Home', 'url' => array('/')),
		array('label' => 'My Profile', 'url' => array('/user/profile/profile')),
		array('label' => 'Change Password', 'url' => array('/user/profile/changepassword')),		
		TbHtml::menuDivider(),
        array('label' => 'Another list header'),
        array('label' => 'About', 'url' => array('/site/page&view=about')),
    )); ?>
</div>
<?php  ?>
	</div><!-- sidebar -->
</div>