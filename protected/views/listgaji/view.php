<div class="span-22">
	<div id="content">
<?php
echo TbHtml::breadcrumbs(array(
    'Home' => array('/'),
    'Manage payroll' => array('/listgaji'),
    'View Salary Slip'
)); 
?>

<h2>View Salary Slip User - <?php echo $model->nip; ?></h2>
<hr/>
<?php	$dateObj   = DateTime::createFromFormat('!m', $model->month);
		$monthName = $dateObj->format('F');  ?>

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

		<?php if ($model->meal != 0): ?>
			<tr class="even">
				<td><b>Meal</b></td>
				<td><?php echo 'Rp. '.number_format($model->meal,2,',','.').',-'; ?></td>
			</tr>
		<?php endif; ?>

		<?php if ($model->transport != 0): ?>
			<tr class="even">
				<td><b>Transportation</b></td>
				<td><?php echo 'Rp. '.number_format($model->transport,2,',','.').',-'; ?></td>
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
		<?php if ($model->taskForceAllowance != 0): ?>
			<tr class="even">
				<td><b>Task Force Allowance</b></td>
				<td><?php echo 'Rp. '.number_format($model->taskForceAllowance,2,',','.').',-'; ?></td>
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
		<?php $totalPendapatan = $model->grossSalary+$model->fixAllowance+$model->pulse+$model->medicalAllowance+$model->overtime+$model->bonus+$model->thr+$model->correctionPlus+$model->incentive+$model->jobAllowance+$model->marriageAllowance+$model->houseAllowance+$model->maternityAllowance+$model->glassesAllowance+$model->condolanceAllowance+$model->separationPay+$model->opex+$model->coc+$model->meal+$model->transport+$model->taskForceAllowance; ?>
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
        array('label' => 'Create Salary Slip', 'url' => array('/listgaji/create')),		
        array('label' => 'Manage Payroll', 'url' => array('/listgaji')),
        array('label' => 'View Salary Slip Payroll', 'url' => array('/listgaji/view','id'=>$model->id), 'active' => true),
        array('label' => 'Update Salary Slip Payroll', 'url' => array('/listgaji/update','id'=>$model->id)),
        array('label' => 'Delete Salary Slip', 'url' => '#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure to delete this item?') ),		
        array('label' => 'Another list header'),
        array('label' => 'Users Management', 'url' => array('/user/admin')),
        array('label' => 'About', 'url' => array('/site/page&view=about')),
    )); ?>
</div>
<?php  ?>
	</div><!-- sidebar -->
</div>