			<div class="span-22">
	<div id="content">

<?php 
 echo TbHtml::breadcrumbs(array(
    'Home' => '/',
    'My Slip Salary',
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

<h2>My Salary Slip</h2>
<hr/>


<?php //=============== BUTTON ADVANCED SEARCH, UPLOAD, DOWNLOAD ==============?>
<b>Please insert month and year to view salary slip</b><br/><br/>
<div style="float:left;">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'form-id',
	'action' => Yii::app()->createUrl('listgaji/mySlip'),  //<- your form action here
	'method' => 'get'
	
	)); ?>

	<select id="dropDown" class="span2" name="month" >
		<option value="1"><?php echo 'January'; ?></option>
		<option value="2"><?php echo 'February'; ?></option>
		<option value="3"><?php echo 'March'; ?></option>
		<option value="4"><?php echo 'April'; ?></option>
		<option value="5"><?php echo 'May'; ?></option>
		<option value="6"><?php echo 'June'; ?></option>
		<option value="7"><?php echo 'July'; ?></option>
		<option value="8"><?php echo 'August'; ?></option>
		<option value="9"><?php echo 'September'; ?></option>
		<option value="10"><?php echo 'October'; ?></option>
		<option value="11"><?php echo 'November'; ?></option>
		<option value="12"><?php echo 'December'; ?></option>
	</select>
	<select id="dropDown" class="span2" name="year" >
		<?php for($x=2014; $x<=date('Y'); $x++): ?>
			<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
		<?php endfor; ?>
	</select>
	
	<button class="btn btn-success span2" type="button" style="float:right" name="yt13" data-target="#print" data-toggle="modal" >Download Salary Slip</button>
	<button class="btn btn-primary span2" type="submit" style="float:right" >Search Salary</button>
<?php $this->endWidget(); ?>
</div>

<?php if($slip == true): ?>
			<?php if($model == null){ ?><br/><br/><br/><br/>
				<div style="text-align:center" >
				<i><b><?php echo ('Salary Slip cannot be found in Database, please check year, Month or contact administrator.'); ?></b></i>
				</div>
			<?php } else { ?>
<br/><br/><br/>
	<?php	$dateObj   = DateTime::createFromFormat('!m', $model->month);
			$monthName = $dateObj->format('F');  ?>
	<h4 style="float:left;">Salary Slip User : <?php echo $model->nip; ?> </h4>
	<h4 style="float:right;">Period - <?php echo $monthName.', '.$_GET['year']; ?> </h4>
	<hr/>

		
<table class="items table table-condensed table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th colspan=2>Data's Employee</th>
		</tr>
	</thead>
	<tbody>
		<tr class="odd">
			<td style="width:40%;text-align:right;"><b>Number Salary Slip</b></td>
			<td><?php echo $model->noSlipGaji; ?></td>
		</tr>
		<tr class="even">
			<td style="width:40%;text-align:right;"><b>Name</b></td>
			<td><?php echo $model2['firstname'].' '.$model2['lastname']; ?></td>
		</tr>
		<tr class="odd">
			<td style="width:40%;text-align:right;"><b>NIP</b></td>
			<td><?php echo $model2['nip']; ?></td>
		</tr>
		<tr class="even">
			<td style="width:40%;text-align:right;"><b>Period</b></td>
			<td><?php echo $monthName.' '.$model->year; ?></td>
		</tr>
		<tr class="odd">
			<td style="width:40%;text-align:right;"><b>Work Days</b></td>
			<td><?php echo $model->workDays; ?></td>
		</tr>
	</tbody>
</table>


<table class="items table table-condensed table-bordered table-striped table-hover span4">
	<thead>
		<tr>
			<th colspan=2>Income</th>
		</tr>
	</thead>
	<tbody>
		<tr class="odd">
			<td style="width:60%;"><b>Gross Salary</b></td>
			<td><?php echo 'Rp. '.number_format($model->grossSalary,2,',','.').',-'; ?></td>
		</tr>
		
		<?php if($model->fixAllowance != 0): ?>
		<tr class="even">
			<td><b>Fix Allowance</b></td>
			<td><?php echo 'Rp. '.number_format($model->fixAllowance,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if($model->pulse != 0): ?>		
		<tr class="odd">
			<td><b>Pulse</b></td>
			<td><?php echo 'Rp. '.number_format($model->pulse,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->overtime != 0): ?>		
		<tr class="odd">
			<td><b>Overtime</b></td>
			<td><?php echo 'Rp. '.number_format($model->overtime,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->bonus != 0): ?>			
		<tr class="even">
			<td><b>Bonus</b></td>
			<td><?php echo 'Rp. '.number_format($model->bonus,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->thr != 0): ?>			
		<tr class="odd">
			<td><b>THR</b></td>
			<td><?php echo 'Rp. '.number_format($model->thr,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->correctionPlus != 0): ?>			
		<tr class="even">
			<td><b>Correction (+)</b></td>
			<td><?php echo 'Rp. '.number_format($model->correctionPlus,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->incentive != 0): ?>
		<tr class="odd">
			<td><b>Incentive</b></td>
			<td><?php echo 'Rp. '.number_format($model->incentive,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->jobAllowance != 0): ?>
		<tr class="even">
			<td><b>Job Allowance</b></td>
			<td><?php echo 'Rp. '.number_format($model->jobAllowance,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->houseAllowance != 0): ?>
		<tr class="odd">
			<td><b>House Allowance</b></td>
			<td><?php echo 'Rp. '.number_format($model->houseAllowance,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->separationPay != 0): ?>
		<tr class="odd">
			<td><b>Separation Pay</b></td>
			<td><?php echo 'Rp. '.number_format($model->separationPay,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<tr class="even">
			<td><b>Benefit(+)</b></td>
			<td></td>
		</tr>		
		<tr class="even">
			<td style="padding-left:30px;"><b>Medical Allowance</b></td>
			<td><?php echo 'Rp. '.number_format($model->medicalAllowance,2,',','.').',-'; ?></td>
		</tr>	
		<tr class="odd">
			<td style="padding-left:30px;"><b>Marriage Allowance</b></td>
			<td><?php echo 'Rp. '.number_format($model->marriageAllowance,2,',','.').',-'; ?></td>
		</tr>
		<tr class="odd">
			<td style="padding-left:30px;"><b>Maternity Allowance</b></td>
			<td><?php echo 'Rp. '.number_format($model->maternityAllowance,2,',','.').',-'; ?></td>
		</tr>
		<tr class="odd">
			<td style="padding-left:30px;"><b>Glasses Allowance</b></td>
			<td><?php echo 'Rp. '.number_format($model->glassesAllowance,2,',','.').',-'; ?></td>
		</tr>
		<tr class="odd">
			<td style="padding-left:30px;"><b>Condolance Allowance</b></td>
			<td><?php echo 'Rp. '.number_format($model->condolanceAllowance,2,',','.').',-'; ?></td>
		</tr>
		<?php if($model->opex != 0 or $model->coc !=0): ?>
		<tr class="odd">
			<td><b>COP Allowance (+)</b></td>
			<td></td>
		</tr>
		<?php endif; ?>
		<?php if($model->opex != 0): ?>
		<tr class="odd">
			<td style="padding-left:30px;"><b>OPEX</b></td>
			<td><?php echo 'Rp. '.number_format($model->opex,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->coc != 0): ?>
		<tr class="odd">
			<td style="padding-left:30px;"><b>COC</b></td>
			<td><?php echo 'Rp. '.number_format($model->coc,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<tr class="even">
		<?php $totalPendapatan = $model->grossSalary+$model->fixAllowance+$model->pulse+$model->medicalAllowance+$model->overtime+$model->bonus+$model->thr+$model->correctionPlus+$model->incentive+$model->jobAllowance+$model->marriageAllowance+$model->houseAllowance+$model->maternityAllowance+$model->glassesAllowance+$model->condolanceAllowance+$model->separationPay+$model->opex+$model->coc; ?>
			<td style="background-color:blue;color:white;"><b>Total Income</b></td>
			<td style="background-color:blue;color:white;"><?php echo 'Rp. '.number_format($totalPendapatan,2,',','.').',-'; ?></td>
		</tr>		
	</tbody>
</table>

<table class="items table table-condensed table-bordered table-striped table-hover span4">
	<thead>
		<tr>
			<th colspan=2>Outcome</th>
		</tr>
	</thead>
	<tbody>

		<tr class="odd">
			<td style="width:45%;"><b>PPH21</b></td>
			<td><?php echo 'Rp. '.number_format($model->pph21,2,',','.').',-'; ?></td>
		</tr>

		<?php if($model->bpjs != 0): ?>
		<tr class="even">
			<td><b>BPJS</b></td>
			<td><?php echo 'Rp. '.number_format($model->bpjs,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->jamsostek != 0): ?>
		<tr class="even">
			<td><b>Jamsostek</b></td>
			<td><?php echo 'Rp. '.number_format($model->jamsostek,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->benefitMin != 0): ?>
		<tr class="odd">
			<td><b>Benefit (-)</b></td>
			<td><?php echo 'Rp. '.number_format($model->benefitMin,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->copAllowanceMin != 0): ?>
		<tr class="even">
			<td><b>COP Allowance (-)</b></td>
			<td><?php echo 'Rp. '.number_format($model->copAllowanceMin,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<?php /* ?>
		<tr class="odd">
			<td><b>Koperasi</b></td>
			<td><?php echo 'Rp. '.number_format($model->koperasi,2,',','.').',-'; ?></td>
		</tr>
		<tr class="even">
			<td><b>MCS</b></td>
			<td><?php echo 'Rp. '.number_format($model->mcs,2,',','.').',-'; ?></td>
		</tr>
		<?php */ ?>
		<?php if($model->loan != 0): ?>
		<tr class="odd">
			<td><b>Loan</b></td>
			<td><?php echo 'Rp. '.number_format($model->loan,2,',','.').',-'; ?></td>
		</tr>
		<?php endif; ?>
		<tr class="odd">
		<?php $totalPengurangan = $model->pph21+$model->bpjs+$model->jamsostek+$model->benefitMin+$model->copAllowanceMin/*+$model->koperasi+$model->mcs*/+$model->loan ?>
			<td style="background-color:blue;color:white;"><b>Total Outcome</b></td>
			<td style="background-color:blue;color:white;"><?php echo 'Rp. '.number_format($totalPengurangan,2,',','.').',-'; ?></td>
		</tr>
	</tbody>
</table>

<table class="items table table-condensed table-bordered table-striped table-hover">
	<tbody>
		<tr>
			<td style="color:white;width:35%;padding-left:50px;background-color:green;"><b>Total Amount of Take Home Pay</b></td>
			<td style="color:white;background-color:green;"><?php echo 'Rp. '.number_format(($totalPendapatan-$totalPengurangan),2,',','.').',-'; ?></td>
		</tr>
	</tbody>
</table>
	
	<a href="index.php?r=listgaji/pdf&noSlipGaji=<?php echo $model->noSlipGaji; ?> " class="btn btn-primary span3" type="button" style="float:right"  >Print PDF this Salary Slip</a>

			
		<?php }?>
<?php endif; ?>
	

<div id="print" class="modal hide fade" tabindex="-1" role="dialog">
	<div class="modal-header">
		<button class="close" type="button" data-dismiss="modal">x</button><br/>
		<h3 style="text-align:center;">Download Salary Slip</h3>
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

		<p class="span3" name="text" >
		<input hidden id="text" class="span3" type="hidden" name="nip" value="<?php echo $model2['nip']; ?>" placeholder="NIP">
		</p> 

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" type="submit" >Download</button>
		<button class="btn" type="button" name="yt12" data-dismiss="modal">Close</button>
	</div>
	<?php $this->endWidget(); ?>
</div>
		
	
	

<?php //=============== END OF BUTTON ADVANCED SEARCH, UPLOAD, DOWNLOAD ==============?>
<br/><br/><br/><br/>


	</div><!-- content -->
</div>
<div class="span-6 last" style="float:left;">
	<div id="sidebar" style="float:left;">
	
	<div class="well" style="max-width: 340px; padding: 8px 0 float:left;">
    <?php echo TbHtml::navList(array(
		array('label' => 'Home', 'url' => array('/')),
		array('label' => 'My Profile', 'url' => array('/user/profile/profile')),
		array('label' => 'Change Password', 'url' => array('/user/profile/changepassword')),		
		TbHtml::menuDivider(),
        array('label' => 'Payroll'),
        array('label' => 'My Slip', 'url' => array('/listgaji/mySlip'), 'active' => true),
        array('label' => 'Another list header'),
        array('label' => 'About', 'url' => array('/site/page&view=about')),
    )); ?>
</div>
<?php  ?>
	</div><!-- sidebar -->
</div>
