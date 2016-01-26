<div class="span-22">
	<div id="content">
<?php
echo TbHtml::breadcrumbs(array(
    'Home' => array('/'),
    'Users Management' => array('/user/admin'),
	'Create Profile Field'
)); 
?>
<h2><?php echo UserModule::t('Create Profile Field'); ?></h2>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
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
        array('label' => 'Users Management'),
        array('label' => 'Create User', 'url' => array('/user/admin/create')),		
        array('label' => 'Manage Users', 'url' => array('/user/admin')),
		array('label' => 'List Employee', 'url' => array('/user')),
		array('label' => 'Role Users Management', 'url' => array('/rights')),
		array('label' => 'Profile Header'),
        array('label' => 'Create Profile Field', 'url' => array('/user/profileField/create'), 'active' => true),		
        array('label' => 'Manage Profile Field', 'url' => array('/user/profileField/admin')),
        array('label' => 'Another list header'),
        array('label' => 'Payroll Management', 'url' => array('/listgaji')),
        array('label' => 'About', 'url' => array('/site/page&view=about')),
    )); ?>
</div>
<?php  ?>
	</div><!-- sidebar -->
</div>