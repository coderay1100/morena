<?php

class Listgaji extends CActiveRecord
{

	public function tableName()
	{
		return 'listgaji';
	}

	public function rules()
	{
		return array(
			array('year, month, nip', 'required'),
			array('id, workDays, year, month', 'numerical', 'integerOnly'=>true),
			array('noSlipGaji', 'length', 'max'=>20),
			array('nip, grossSalary, fixAllowance, medicalAllowance, overtime, bonus, thr, correctionPlus, incentive, jobAllowance, marriageAllowance, houseAllowance, maternityAllowance, glassesAllowance, condolanceAllowance, separationPay, opex, coc, pph21, jamsostek, bpjs, benefitMin, copAllowanceMin, koperasi, mcs, loan, meal, transport, taskForceAllowance', 'length', 'max'=>15),
			array('pulse', 'length', 'max'=>10),
			array('state', 'length', 'max'=>1),
			array('createdBy, updatedBy', 'length', 'max'=>11),
			array('createdTimeStamp, updatedTimeStamp', 'safe'),
			array('id, noSlipGaji, nip, workDays, grossSalary, fixAllowance, pulse, medicalAllowance, overtime, bonus, thr, correctionPlus, incentive, jobAllowance, marriageAllowance, houseAllowance, maternityAllowance, glassesAllowance, condolanceAllowance, separationPay, opex, coc, pph21, bpjs, jamsostek, benefitMin, copAllowanceMin, koperasi, mcs, loan, state, createdTimeStamp, updatedTimeStamp, createdBy, updatedBy, meal, transport, taskForceAllowance', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'noSlipGaji' => 'No Slip Gaji',
			'year' => 'Year',
			'month' => 'Month',
			'nip' => 'Nip',
			'workDays' => 'Work Days',
			'grossSalary' => 'Gross Salary',
			'fixAllowance' => 'Fix Allowance',
			'pulse' => 'Pulse',
			'medicalAllowance' => 'Medical Allowance',
			'overtime' => 'Overtime',
			'bonus' => 'Bonus',
			'thr' => 'Thr',
			'correctionPlus' => 'Correction (+)',
			'incentive' => 'Incentive',
			'jobAllowance' => 'Job Allowance',
			'marriageAllowance' => 'Marriage Allowance',
			'houseAllowance' => 'House Allowance',
			'maternityAllowance' => 'Maternity Allowance',
			'glassesAllowance' => 'Glasses Allowance',
			'condolanceAllowance' => 'Condolance Allowance',
			'separationPay' => 'Separation Pay',
			'opex' => 'Opex',
			'coc' => 'Coc',
			'pph21' => 'Pph21',
			'bpjs' => 'Bpjs',
			'jamsostek' => 'Jamsostek',
			'benefitMin' => 'Benefit (-)',
			'copAllowanceMin' => 'Cop Allowance (-)',
			'koperasi' => 'Koperasi',
			'mcs' => 'Mcs',
			'loan' => 'Loan',
			'state' => 'State',
			'createdTimeStamp' => 'Created Time Stamp',
			'updatedTimeStamp' => 'Updated Time Stamp',
			'createdBy' => 'Created By',
			'updatedBy' => 'Updated By',
			'meal' => 'Meal',
			'transport' => 'Transportation',
			'taskForceAllowance' => 'Task Force Allowance'
		);
	}
	public function search()
	{	$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('noSlipGaji',$this->noSlipGaji,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('workDays',$this->workDays);
		$criteria->compare('grossSalary',$this->grossSalary);
		$criteria->compare('fixAllowance',$this->fixAllowance);
		$criteria->compare('pulse',$this->pulse);
		$criteria->compare('medicalAllowance',$this->medicalAllowance);
		$criteria->compare('overtime',$this->overtime);
		$criteria->compare('bonus',$this->bonus);
		$criteria->compare('thr',$this->thr);
		$criteria->compare('correctionPlus',$this->correctionPlus);
		$criteria->compare('incentive',$this->incentive);
		$criteria->compare('jobAllowance',$this->jobAllowance);
		$criteria->compare('marriageAllowance',$this->marriageAllowance);
		$criteria->compare('houseAllowance',$this->houseAllowance);
		$criteria->compare('maternityAllowance',$this->maternityAllowance);
		$criteria->compare('glassesAllowance',$this->glassesAllowance);
		$criteria->compare('condolanceAllowance',$this->condolanceAllowance);
		$criteria->compare('separationPay',$this->separationPay);
		$criteria->compare('opex',$this->opex);
		$criteria->compare('coc',$this->coc);
		$criteria->compare('pph21',$this->pph21);
		$criteria->compare('bpjs',$this->bpjs);
		$criteria->compare('jamsostek',$this->jamsostek);
		$criteria->compare('benefitMin',$this->benefitMin);
		$criteria->compare('copAllowanceMin',$this->copAllowanceMin);
		$criteria->compare('koperasi',$this->koperasi);
		$criteria->compare('mcs',$this->mcs);
		$criteria->compare('loan',$this->loan);
		$criteria->compare('meal',$this->meal);
		$criteria->compare('transport',$this->transport);
		$criteria->compare('taskForceAllowance',$this->taskForceAllowance);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('createdTimeStamp',$this->createdTimeStamp,true);
		$criteria->compare('updatedTimeStamp',$this->updatedTimeStamp,true);
		$criteria->compare('createdBy',$this->createdBy,true);
		$criteria->compare('updatedBy',$this->updatedBy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
