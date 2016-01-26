<div class="span-22">
	<div id="content">
	
<?php
echo TbHtml::breadcrumbs(array(
    'Home' => array('/'),
    'Manage payroll' => array('/listgaji'),
    'Create Salary Slip'
)); 

$this->menu=array(
	array('label'=>'List Listgaji', 'url'=>array('index')),
	array('label'=>'Manage Listgaji', 'url'=>array('admin')),
);
?>

<h2>Create Listgaji</h2>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
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
        array('label' => 'Payroll'),
        array('label' => 'Manage Payroll Slip', 'url' => array('/listgaji')),
        array('label' => 'Create Salary Slip', 'url' => array('/listgaji/create'), 'active' => true),
        array('label' => 'Another list header'),
        array('label' => 'Users Management', 'url' => array('/user/admin')),
        array('label' => 'About', 'url' => array('/site/page&view=about')),
    )); ?>
</div>
<?php  ?>
	</div><!-- sidebar -->
</div>