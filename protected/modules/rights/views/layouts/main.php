<?php $this->beginContent(Rights::module()->appLayout); ?>
<div class="container" style="border-style:solid;border-color:#c9e0ed;border-width:1px;">
	<img src="<?php echo Yii::app()->request->baseUrl.'/images/logo_header_e-payroll.jpg'; ?> " alt="Mountain View" style="width:100%;">
</div>
<div id="rights" class="container" style="background-color:white;border-bottom-style:solid;border-right-style:solid;border-left-style:solid;border-color:#c9e0ed;border-width:1px;">
<div class="span-22">
	<div id="content">
<?php
echo TbHtml::breadcrumbs(array(
    'Home' => array('/'),
    'Users Management' => array('/user/admin'),
	'Role Users Management'
)); ?>
<h2><?php echo UserModule::t('Role users Management'); ?></h2>
<hr/>
		<?php if( $this->id!=='install' ): ?>

			<div id="menu">

				<?php $this->renderPartial('/_menu'); ?>

			</div>

		<?php endif; ?>

		<?php $this->renderPartial('/_flash'); ?>

		<?php echo $content; ?>

	</div><!-- content -->
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
        array('label' => 'Users Management'),
        array('label' => 'Create User', 'url' => array('/user/admin/create')),		
        array('label' => 'Manage Users', 'url' => array('/user/admin')),
		array('label' => 'List Employee', 'url' => array('/user')),
		array('label' => 'Role Users Management', 'url' => array('/rights'), 'active' => true),
		array('label' => 'Profile Header'),
        array('label' => 'Create Profile Field', 'url' => array('/user/profileField/create')),		
        array('label' => 'Manage Profile Field', 'url' => array('/user/profileField/admin')),
        array('label' => 'Another list header'),
        array('label' => 'Payroll Management', 'url' => array('/listgaji')),
        array('label' => 'About', 'url' => array('/site/page&view=about')),
    )); ?>
</div>
<?php  ?>
	</div><!-- sidebar -->
</div>	
			<div class="clear" ></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by PT. Prawathiya Karsa Pradiphta<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->
</div>

<?php $this->endContent(); ?>