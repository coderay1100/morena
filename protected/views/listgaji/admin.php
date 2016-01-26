			

<div class="span-22">
	<div id="content">

<?php 
/* @var $this ListgajiController */
/* @var $model Listgaji */
 echo TbHtml::breadcrumbs(array(
    'Home' => '/',
    'Manage Payroll',
)); 


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#listgaji-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});

");
?>

<h2>Manage Payroll</h2>
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
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>	
<?php endif;?>	
<?php $totalSlipExists = '' ?>
<?php if($alreadySlip > 0): ?>
<?php foreach($slipExists as $exists): ?>
<?php $totalSlipExists = $totalSlipExists.', '.$exists; ?>
<?php endforeach; ?>
<?php Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,
    'You failed insert '.$alreadySlip.' data! User <strong>'.$totalSlipExists.'</strong> already exists please check that no Slip.'); ?>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>	
<?php endif;?>	
<?php //================== END OF MESSAGE SUCCESS AND FAILED UPLOAD DATA ==============// ?>


<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done. <?php echo "To view structure format for upload, please download  "; ?><?php echo CHtml::link('Template Upload',array('listgaji/download')); ?>.</p>


</p><br/>

<?php //=============== BUTTON ADVANCED SEARCH, UPLOAD, DOWNLOAD ==============?>
<?php echo TBHtml::button("Remove Selected Items",array('color' => TbHtml::BUTTON_COLOR_DANGER,"id"=>"butt")); ?>



<span style="float:right";>&nbsp;&nbsp;&nbsp;</span>
<button style="float:right"; class="btn btn-primary" type="button" name="yt13" data-target="#print" data-toggle="modal" >Download Salary Slip</button>
<span style="float:right";>&nbsp;&nbsp;&nbsp;</span>
<button style="float:right"; class="btn btn-primary" type="button" name="yt13" data-target="#upload" data-toggle="modal" >Upload Salary Slip</button>
<br/><br/>	
<?php if($dateStamp['count(id)'] > 0) : ?>
<?php echo TbHtml::alert(TbHtml::ALERT_COLOR_INFO, 'Today you successfully insert '.$dateStamp['count(id)'].' data.'); ?>
<?php endif; ?>

<?php //=============== END OF BUTTON ADVANCED SEARCH, UPLOAD, DOWNLOAD ==============?>

<?php //==================== FORM UPLOAD DATA EMPLOYEE===================?>

<div id="upload" class="modal hide fade" tabindex="-1" role="dialog" style="left:45%;width:800px;">
	<div class="modal-header"style="text-align:center;">
		<button class="close" type="button" data-dismiss="modal">×</button>
		<br/><h3>Upload Data Salary Slip</h3>
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
- Please insert column Month with number! (ex. 'July' insert with 7, 'December insert with 12)<br/>
- Data NIP must be available in database employee.<br/>
- Please insert all column with number!<br/>
- ' , ' Comma, ( . ) Dot, or another symbol are NOT allowed.<br/>
- Format file must .xls (Ms. Excel 2003)
</div>
		<p>
			<b>Upload Salary Slip with Excel (Excel 97-2003) :</b>
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
		<h3 style="text-align:center;">Download Data Salary Slip</h3>
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
			<?php for($x=2014;$x<=date('Y');$x++):?>
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
<?php isset($_GET['signedBy2'])? $_GET['signedBy2']=$_GET['signedBy2'] : $_GET['signedBy2']=''; ?>
<?php /*
<div  style="position:absolute;bottom:17px;right:380px;">
<select id="printSignedBy" style="width:110px;" name="signedBy2" >
	<option value="">Signed By</option>
	<?php foreach($loadModelFirstname as $employeeName):?>
	<option value="<?php echo($employeeName);?>" ><?php echo($employeeName); ?></option>
	<?php endforeach; ?>
</select>
</div> */ ?>
<?php $asd = 'asd' ; ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'item-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' => 10,
	'columns'=>array(
        array(
            'class'=>'CCheckBoxColumn',  //CHECKBOX COLUMN ADDED.
        ),	
		'noSlipGaji',
		'year',
		array(
			'name'=>'month',
			'value'=>'DateTime::createFromFormat(\'!m\', "$data->month")->format(\'F\')',
			),	
		'nip',
		array(
			'name'=>'grossSalary',
			'htmlOptions'=>array('style'=>'width:90px;'),
			),	
		array(
			'name'=>'createdTimeStamp',
			'header'=>'Created Time',
			'value'=>'$data->createdTimeStamp',
			'htmlOptions'=>array('style'=>'text-align:center;'),
			),	
		array(
			'id'=>'form-pdf',
			'header'=>'Print-PDF',
			/*'header'=>CHtml::dropDownList('',$loadModelFirstname,
						$loadModelFirstname,
						array('empty'=>'Signed By','id'=>'printSignedBy','style'=>'width:110px;bottom:-56px;position:relative;')),*/
			'type'=>'raw',
			'value'=>'"<a href=# onclick=printPdf(".$data->id.")>View PDF</a>"',
			//'filterHtmlOptions'=>'profiles::model()->findAll()',
	
			/*CHtml::dropDownList('','',
						$loadModelFirstname,
						array('empty'=>'Select Month','id'=>'printSignedBy')),
					   
			//'urlExpression'=> 'array("listgaji/pdf", "id" => $data->id, "nip" => $data->nip,"signedBy2" => "' . $_GET['signedBy2'] . '")',*/
		
			),		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<script>
function printPdf(data) {
	signedBy = document.getElementById('printSignedBy');
    window.open('index.php?r=listgaji/pdf&id='+data/*+'&signedBy='+signedBy.options[signedBy.selectedIndex].text*/,'_blank');
}
</script>

<?php Yii::app()->clientScript->registerScript('delete','
$("#butt").click(function(){
        var checked=$("#item-grid").yiiGridView("getChecked","item-grid_c0");
        var count=checked.length;
        if(count>0 && confirm("Do you want to delete these "+count+" item(s)"))
        { 
                $.ajax({
                        data:{checked:checked},
                        url:"'.CHtml::normalizeUrl(array('listgaji/remove')).'",
                        success:function(data){$("#item-grid").yiiGridView("update",{});},              
                });
        }
		else{ alert(\'Please check at least one record to delete\')
		}
        });
'); ?>

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
        array('label' => 'Payroll'),
        array('label' => 'Create Salary Slip', 'url' => array('/listgaji/create')),		
        array('label' => 'Manage Payroll', 'url' => array('/listgaji'), 'active' => true),
        array('label' => 'Another list header'),
        array('label' => 'Users Management', 'url' => array('/user/admin')),
        array('label' => 'About', 'url' => array('/site/page&view=about')),
    )); ?>
</div>
<?php  ?>
	</div><!-- sidebar -->
</div>