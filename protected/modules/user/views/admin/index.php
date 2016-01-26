<div class="span-22">
	<div id="content">
<?php echo $updatePass;
echo TbHtml::breadcrumbs(array(
    'Home' => array('/'),
    'Users Management'
)); 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>
<h2><?php echo UserModule::t("Manage Users"); ?></h2>
<hr/>

<?php //==================== MESSAGE SUCCESS AND FAILED UPLOAD DATA ======================// ?>
<?php if($sukses > 0):?>
<?php Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,
    '<strong>Well done!</strong> You successfully insert '.$sukses.' data.'); ?>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>	
<?php endif;?>	
<?php if($gagal > 0):?>
<?php Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,
    '<strong>Oh Snap!</strong> You failed insert '.$gagal.' data.'); ?>
<?php endif; ?>
<?php $totalUserExist = '' ?>
<?php if($alreadyUser > 0): ?>
<?php foreach($userExists as $exist): ?>
<?php $totalUserExist = $totalUserExist.', '.$exist; ?>
<?php endforeach; ?>
<?php Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,
    'User <strong>'.$totalUserExist.'</strong> already exists please check that nip.'); ?>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>	
<?php endif;?>	
<?php //================== END OF MESSAGE SUCCESS AND FAILED UPLOAD DATA ==============// ?>



<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done. <?php echo "To view structure format for upload, please download  "; ?><?php echo CHtml::link('Template Upload',array('admin/download')); ?>.</p>



<?php echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><div>
<?php /*
	<span style="float:right";>&nbsp;&nbsp;&nbsp;</span>
	<button style="float:right"; class="btn btn-primary" type="button" name="yt13" data-target="#print" data-toggle="modal" >Download Users</button> <?php */ ?>
	<span style="float:right";>&nbsp;&nbsp;&nbsp;</span>
	<button style="float:right"; class="btn btn-primary" type="button" name="yt13" data-target="#upload" data-toggle="modal" >Upload Users</button>
</div>

<div id="upload" class="modal hide fade" tabindex="-1" role="dialog" style="left:45%;width:800px;">
	<div class="modal-header"style="text-align:center;">
		<button class="close" type="button" data-dismiss="modal">×</button>
		<br/><h3>Upload Data Employee</h3>
	</div>
	<br/>
	<div class="modal-body" style="padding-left:70px;">
		 <?php
		$form=$this->beginWidget('CActiveForm', array(
		 'id'=>'pendapatanexcel-form',
		 'enableAjaxValidation'=>false,
		 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		)); ?>
		<div class="alert alert-warning in fade" style="width:85%">
		<a class="close" type="button" data-dismiss="alert" href="#">×</a>
<h4>Warning!</h4>
- Birthdate, Joindate, Hiredate must be format Date (ex. 1992-07-21, or 2014-02-22)<br/>
- After upload is complete, employees can access their account with,<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>username: nip</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>password: password </b><br/>
- Format Excel Must .xls (Excel 2003)
</div>		
		
		<p>
			<b>Upload Data Employee with Excel (Excel 97-2003) :</b>
			<?php echo $form->fileField($model,'filee',array('size'=>60,'maxlength'=>200)); ?>
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" type="submit" name="yt11" >Upload</button>
		<button class="btn" type="button" name="yt12" data-dismiss="modal">Close</button>
	</div>
	<?php $this->endWidget(); ?>
</div>
<?php //============================END FROM UPLOAD DATA EMPLOYEE ==========================?>

<?php //============================ FORM UPLOAD DATA EMPLOYEE ========================== ?>
<div id="print" class="modal hide fade" tabindex="-1" role="dialog">
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">×</button><br/>
		<h3 style="text-align:center;">Download Data Employee</h3>
	</div>
	
	<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form-id',
        'action' => Yii::app()->createUrl('/listgaji/PdfAdmin'),  //<- your form action here
		'method' => 'get'
	)); ?>
	<div class="modal-body" style="pading:10cm;"><br/>
		<p class="span2" name="text" >Year</p>
		<p class="span3" name="text" >
		<select id="dropDown" class="span3" name="year">
			<option value="">Year</option>
			<?php for($x=2007;$x<=date('Y');$x++):?>
			<option value="<?php echo $x;?>"><?php echo $x;?></option>
			<?php endfor; ?>
		</select>
		</p>
		<p class="span2" name="text" >Month</p>
		<p class="span3" name="text" >
		<select id="dropDown" class="span3" name="month">
			<option value="">Month</option>
			<option value="1">January</option>
			<option value="2">February</option>
			<option value="3">March</option>
			<option value="4">April</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">July</option>
			<option value="8">August</option>
			<option value="9">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
		</select>
		</p>
		<p class="span2" name="text" >NIP</p>
		<p class="span3" name="text" >
			<input id="text" class="span3" type="text" name="nip" value="" placeholder="NIP">
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" type="submit" >Download</button>
		<button class="btn" type="button" name="yt12" data-dismiss="modal">Close</button>
	</div>
	<?php $this->endWidget(); ?>
</div>

<br/>
<br/>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
		),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		'create_at',
		'lastvisit_at',
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
		array(
			'class'=>'CLinkColumn',
			'label'=>'Reset',
			'urlExpression'=>'"index.php?r=user/admin/reset&id=".$data->id',
			'header'=>'Reset',
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
        array('label' => 'Manage Users', 'url' => array('/user/admin'), 'active' => true),
		array('label' => 'List Employee', 'url' => array('/user')),
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