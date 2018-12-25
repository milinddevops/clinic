<p class="inline-field">					
	<label>Bill Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Received Amount</label>
	<input type="text" id="bill_amt" name="patients[total_bill_amt]" value="{$patient->getTotalBillAmt()}" class="field size2"/>&nbsp;&nbsp;&nbsp;
	<input type="text" name="patients[received_amt]" value="{$patient->getReceivedAmt()}" class="field size2"/>
</p>
<p class="inline-field">					
	<label>Clinic Charges&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ref. Fee</label>				
	<input type="text" name="patients[ipd_amt]" value="{$patient->getIpdAmt()}" class="field size2">&nbsp;&nbsp;&nbsp;
	<input type="text" name="patients[opd_amt]" value="{$patient->getOpdAmt()}" class="field size2"/>
	
</p>