    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'listgaji-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Please insert <b>without</b> "," (comma), character String, or separator values. Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>
	<br/>
	
<table class="table-condensed  table-hover">
	<thead>
		<tr>
			<th colspan=2 style="color:white;background-color:#0088cc"><h4>Information Salary Slip</h4></th>
		</tr>
	</thead>
	<tbody>
		<tr>
		<td colspan=2> &nbsp;</td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Year</b></td>
			<?php for($x=2014;$x<=date('Y');$x++):
					$thn[$x]=$x;
					endfor;?>
			<td><?php echo $form->dropDownListControlGroup($model, 'year',
        $thn, array('empty' => 'Year','label'=>'<i>Must insert this value</i>','span'=>4)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Month</b></td>
			<td><?php echo $form->dropDownListControlGroup($model, 'month',
        array(1 => 'January',2 => 'February',3 => 'March',4 => 'April',5 => 'May',6 => 'June',7 => 'July',8 => 'August',9 => 'September',10 => 'October',11 => 'November',12 => 'December'), array('empty' => 'Month','label'=>'<i>Must insert this value</i>','span'=>4)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>NIP</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'nip',array('label'=>'<i>Must insert this value</i>','span'=>4)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Work Days</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'workDays',array('label'=>'','span'=>4)); ?></td>
		</tr>
	</tbody>
</table>	
	
<table class=" table-condensed  table-hover span4 table-color:blue; ">
	<thead>
		<tr>
			<th colspan=2 style="color:white;background-color:#0088cc"><h4>Income</h4></th>
		</tr>
	</thead>
	<tbody>
			<tr>
		<td colspan=2> &nbsp;</td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Gross Salary</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'grossSalary',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Fix Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'fixAllowance',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Meal</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'meal',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Transport</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'transport',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Pulse</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'pulse',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Medical Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'medicalAllowance',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Overtime</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'overtime',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Bonus</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'bonus',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>THR</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'thr',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Correction (+)</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'correctionPlus',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Incentive</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'incentive',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Job Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'jobAllowance',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Marriage Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'marriageAllowance',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>House Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'houseAllowance',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Task Force Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'taskForceAllowance',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Maternity Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'maternityAllowance',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Glasses Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'glassesAllowance',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Condolance Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'condolanceAllowance',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>Separation Pay</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'separationPay',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>OPEX</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'opex',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>COC</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'coc',array('label'=>'','span'=>2)); ?></td>
		</tr>
	</tbody>
</table>

<table class=" table-condensed  table-hover span4">
	<thead>
		<tr>
			<th colspan=2 style="color:white;background-color:#0088cc"><h4>Outcome</h4></th>
		</tr>
	</thead>
	<tbody>
			<tr>
		<td colspan=2> &nbsp;</td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>PPH21</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'pph21',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>BPJS</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'bpjs',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>Jamsostek</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'jamsostek',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="odd">
			<td style="text-align:right;"><b>benefit (-)</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'benefitMin',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>COP Allowance</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'copAllowanceMin',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<?php /*
		<tr class="odd">
			<td style="text-align:right;"><b>Koperasi</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'koperasi',array('label'=>'','span'=>2)); ?></td>
		</tr>
		<tr class="even">
			<td style="text-align:right;"><b>MCS</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'mcs',array('label'=>'','span'=>2)); ?></td>
		</tr> */ ?>
		<tr class="odd">
			<td style="text-align:right;"><b>Loan</b></td>
			<td><?php echo $form->textFieldControlGroup($model,'loan',array('label'=>'','span'=>2)); ?></td>
		</tr>
		
	</tbody>
</table>

    <div  class="form-actions span8" >
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,'style'=>'float:right'
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

