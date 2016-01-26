<div class="span-22">
	<div id="content">
<?php
echo TbHtml::breadcrumbs(array(
    'Home' => array('/'),
    'Users Management' => array('/user/admin'),
	'Manage Profile Field'  => array('/user/profileField/admin'),
	'View Profile Field'
)); 
?>
<h2><?php echo UserModule::t('View Profile Field #').$model->varname; ?></h2>
<hr/>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover'),
	
	'attributes'=>array(
		'id',
		'varname',
		'title',
		'field_type',
		'field_size',
		'field_size_min',
		'required',
		'match',
		'range',
		'error_message',
		'other_validator',
		'widget',
		'widgetparams',
		'default',
		'position',
		'visible',
	),
)); ?>
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
        array('label' => 'Create Profile Field', 'url' => array('/user/profileField/create')),		
        array('label' => 'Manage Profile Field', 'url' => array('/user/profileField/admin')),
        array('label' => 'View Profile Field', 'url' => array('/user/profileField/view','id'=>$model->id), 'active' => true),
        array('label' => 'Delete Profile Field', 'url' => '#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?')) ),		
        array('label' => 'Another list header'),
        array('label' => 'Payroll Management', 'url' => array('/listgaji')),
        array('label' => 'About', 'url' => array('/site/page&view=about')),
    )); ?>
</div>
<?php  ?>
	</div><!-- sidebar -->
</div>