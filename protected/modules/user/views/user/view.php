<div class="span-22">
	<div id="content">
<?php
echo TbHtml::breadcrumbs(array(
    'Home' => array('/'),
    'Users Management' => array('/user/admin'),
	'View Employee'
)); 
$this->layout='//layouts/column2';
?>
<h2><?php echo UserModule::t('View User').' "'.$model->username.'"'; ?></h2>
<hr/>
<?php 

// For all users
	$attributes = array(
			'username',
	);
	
	$profileFields=ProfileField::model()->forAll()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),

				));
		}
	}
	array_push($attributes,
		'create_at',
		array(
			'name' => 'lastvisit_at',
			'value' => (($model->lastvisit_at!='0000-00-00 00:00:00')?$model->lastvisit_at:UserModule::t('Not visited')),
		)
	);
			
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
		'htmlOptions' => array(
			'class' => 'table table-striped table-condensed table-hover')
	));

?>
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
		array('label' => 'View Employee', 'url' => array('/user/user/view','id'=>$model->id), 'active' => true),
		array('label' => 'Role Users Management', 'url' => array('/rights')),
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