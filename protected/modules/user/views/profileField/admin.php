<div class="span-22">
	<div id="content">
<?php
echo TbHtml::breadcrumbs(array(
    'Home' => array('/'),
    'Users Management' => array('/user/admin'),
	'Manage Profile Field'
)); 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('profile-field-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>
<h1><?php echo UserModule::t('Manage Profile Fields'); ?></h1>

<p><?php echo UserModule::t("You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?></p>

<?php echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<br/>
<br/>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'varname',
			'type'=>'raw',
			'value'=>'UHtml::markSearch($data,"varname")',
		),
		array(
			'name'=>'title',
			'value'=>'UserModule::t($data->title)',
		),
		array(
			'name'=>'field_type',
			'value'=>'$data->field_type',
			'filter'=>ProfileField::itemAlias("field_type"),
		),
		'field_size',
		//'field_size_min',
		array(
			'name'=>'required',
			'value'=>'ProfileField::itemAlias("required",$data->required)',
			'filter'=>ProfileField::itemAlias("required"),
		),
		//'match',
		//'range',
		//'error_message',
		//'other_validator',
		//'default',
		'position',
		array(
			'name'=>'visible',
			'value'=>'ProfileField::itemAlias("visible",$data->visible)',
			'filter'=>ProfileField::itemAlias("visible"),
		),
		//*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
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
        array('label' => 'Manage Profile Field', 'url' => array('/user/profileField/admin'), 'active' => true),
        array('label' => 'Another list header'),
        array('label' => 'Payroll Management', 'url' => array('/listgaji')),
        array('label' => 'About', 'url' => array('/site/page&view=about')),
    )); ?>
</div>
<?php  ?>
	</div><!-- sidebar -->
</div>