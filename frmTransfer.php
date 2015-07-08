
<?php include 'header.php';?>

<?php
	
		$autoid = time();
		// cboToBranch=123&txtPhoneSender=0123&cboCurrency=1434697930&txtPhoneReciever=333&txtamt=372&txtcode=333&txtTotalCharge=333&cboPayCharge+Type=LocalChargeOnly&txtLocalCharge=166.533&check3=on&txtAnnotherCharge=166.47333&btnSave=SaveNew
		
		$cboServiceTypeTransfter = '1434361638';
		$cboToBranch  = get('cboToBranch');
		$txtPhoneSender	=	get('txtPhoneSender');
		$cboCurrency	=	get('cboCurrency');
		$txtPhoneReciever	=	get('txtPhoneReciever');
		$txtamt	=	get('txtamt');
		$txtcode	=	get('txtcode');
		$txtTotalCharge	=	get('txtTotalCharge');
		$cboPayChargeType	=	get('cboPayChargeType');
		$txtLocalCharge	=	get('txtLocalCharge');
		$check3	=	get('check3');
		$txtAnnotherCharge	=	get('txtAnnotherCharge');
		$btnSave	=	get('btnSave');
		$ifall = floatval($txtamt) - floatval($txtAnnotherCharge);
		$ifLocalCharge = floatval($txtamt);
		$ifNotall = floatval($txtamt) + floatval($txtLocalCharge);
		
		if($btnSave== "SaveNew"){
			if($cboPayChargeType=="AllCharge")
			{
				$insert=$db->query("INSERT INTO tbltransaction (TransactionID, UserID, ServiceTypeID, Local_BranchID, Another_BranchID, 
			PhoneSender, PhoneReceiver, `Code`, CurrencyNo, 
			Amt, Local_Branch_Charge, Another_Branch_Charge, TotalCharge, PayChargeType, Total_To_Paid,Date)
			VALUES ('".time()."','".$U_id."','".$cboServiceTypeTransfter."','".$U_Brandid."','".$cboToBranch."',
			'".$txtPhoneSender."','".$txtPhoneReciever."','".$txtcode."','".$cboCurrency."',".$txtamt.",
			".$txtLocalCharge.",'".$txtAnnotherCharge."','".$txtTotalCharge."','".$cboPayChargeType."',".$ifall.",'".$date_now."')");
			}
			else if ($cboPayChargeType=="LocalChargeOnly")
			{
				$insert=$db->query("INSERT INTO tbltransaction (TransactionID, UserID, ServiceTypeID, Local_BranchID, Another_BranchID, 
			PhoneSender, PhoneReceiver, `Code`, CurrencyNo, 
			Amt, Local_Branch_Charge, Another_Branch_Charge, TotalCharge, PayChargeType, Total_To_Paid,Date)
			VALUES ('".time()."','".$U_id."','".$cboServiceTypeTransfter."','".$U_Brandid."','".$cboToBranch."',
			'".$txtPhoneSender."','".$txtPhoneReciever."','".$txtcode."','".$cboCurrency."',".$txtamt.",
			".$txtLocalCharge.",'".$txtAnnotherCharge."','".$txtTotalCharge."','".$cboPayChargeType."','".$ifLocalCharge."','".$date_now."')");
			}
			else if($cboPayChargeType=="NotAll")
			{
				$insert=$db->query("INSERT INTO tbltransaction (TransactionID, UserID, ServiceTypeID, Local_BranchID, Another_BranchID, 
			PhoneSender, PhoneReceiver, `Code`, CurrencyNo, 
			Amt, Local_Branch_Charge, Another_Branch_Charge, TotalCharge, PayChargeType, Total_To_Paid,Date)
			VALUES ('".time()."','".$U_id."','".$cboServiceTypeTransfter."','".$U_Brandid."','".$cboToBranch."',
			'".$txtPhoneSender."','".$txtPhoneReciever."','".$txtcode."','".$cboCurrency."',".$txtamt.",
			".$txtLocalCharge.",'".$txtAnnotherCharge."','".$txtTotalCharge."','".$cboPayChargeType."',".$ifNotall.",'".$date_now."')");
			}
			
				
			if($insert){
				cRedirect('frmTransfer.php');
			}
			else
			{
				echo "<script type='text/javascript'>alert('មានបញ្ហាបន្តិចបន្តួច! សូមបញ្ចូលម្តងទៀត!')</script>";
			}
		}
?>

    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
         <?php include 'nav.php';?>
        
            <!-- Left side column. contains the logo and sidebar -->
            <?php include 'menu.php';?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    		<div class="col-md-3 pull-left">
                               	<a href="frmReciever.php" title="Report Saling">
                                   <button class="btn btn-success" type="submit">Go Reciever &nbsp;<i class="glyphicon glyphicon-chevron-up"></i></button>
                                </a>
                               
                                                           
                            </div>
                            <div class="col-md-4 pull-left">
                            	<font size="3">
                               	You are staying in Form Transfer.
                                </font>
                            </div>
                            
                           <div class="col-md-3 pull-right">
                                <form  role="search" >
                                    <div class="input-group">
                                  
                                        <input type="text" class="form-control" placeholder="Search" value="<?php echo $txtSearch; ?>" name="txtSearch" >
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                               </form>
                            </div>
                            &nbsp;

                        
                    </h1>
                    
                   
                </section>

                <!-- Main content -->
         
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                            	<table class="table table-striped table-bordered table-hover" border="0" id="dataTables-example">
                                   	<form enctype="multipart/form-data">
                                    
                                   		<tr>
                                            <th class="">
                                            	<div class="input-group-addon">To Branch</div>
                                            	<select class="form-control" name="cboToBranch">
                                   					<?php
                                                        $select=$db->query("SELECT BranchID, BranchName FROM `tblbranch` WHERE BranchID != '".$U_Brandid."'");
                                                        $rowselect=$db->dbCountRows($select);
                                                        if($rowselect>0){
                                                            while($row=$db->fetch($select)){
                                                            $BranchID = $row->BranchID;
                                                            $BranchName = $row->BranchName;
                                                                echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
                                                            } 
                                                        }
                                                   ?>
                                                    </select>
                                                    <div class="input-group-addon">Phone Sender</div>
                                            	<input type="text" name="txtPhoneSender" placeholder="Tel Sender" id="" class="form-control currency"  />
                                                    
                                            </th>
                                            
                                            <th>
                                            	<div class="input-group-addon">Currency($)</div>
                                            	<select class="form-control" name="cboCurrency">
                                   					<?php
                                                        $select=$db->query("SELECT CurrencyNo, `Name` as CurrencyName FROM `tblcurrency`;");
                                                        $rowselect=$db->dbCountRows($select);
                                                        if($rowselect>0){
                                                            while($row=$db->fetch($select)){
                                                            $CurrencyNo = $row->CurrencyNo;
                                                            $CurrencyName = $row->CurrencyName;
                                                                echo'<option value='.$CurrencyNo.'>'.$CurrencyName.'</option>';
                                                            } 
                                                        }
                                                   ?>
                                                    </select>
                                                    <div class="input-group-addon">Phone Reciever</div>
                                            	<input name="txtPhoneReciever" tabindex="2"  class="form-control" placeholder="Tel Reciever" required  />
                                             </th>
                                             <th>
                                            <div class="input-group-addon">Amt</div>
                                            <input type="text" name="txtamt" tabindex="1"  placeholder="Ammount" autofocus id="idAmt" onKeyUp="EnterAmmount()"  onKeyPress="return isNumberKey(event)" required class="form-control currency"  />
                                            <div class="input-group-addon">Code</div>
                                            <input type="text" name="txtcode" placeholder="Input Code" id=""  class="form-control currency"  />
                                            
                                            </th>
                                            
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="info">
                                            	Service Fee
                                            </th>
                                            
                                        </tr>
                                        <tr>
                                            <th class="">
                                            	<div class="input-group-addon">Total Charge</div>
                                            	<input type="text" name="txtTotalCharge" placeholder="Total Charge" id="idTotalCharge" onKeyUp="EnterTotalCharge()" onKeyPress="return isNumberKey(event)" required class="form-control currency"  />
                                                <div class="input-group-addon">Pay Charge Type</div>
                                            	<select class="form-control" name="cboPayChargeType" id="idChargeServiceType" onChange="myChargeServiceType()">
                                   					<option value="AllCharge">All Charge</option>
                                                    <option value="LocalChargeOnly">Local Charge Only</option>
                                                    <option value="NotAll">No All</option>
                                                </select>  
                                            </th>
                                            
                                            <th>
                                            	<div class="input-group-addon">Local Charg</div> 
                                            
                                                <input type="text" name="txtLocalCharge" placeholder="Another Charge" id="idlocalcharge" onKeyUp="Enterlocalcharge()"  onKeyPress="return isNumberKey(event)" required class="form-control currency"  />
                                                    <div class="input-group-addon"> &nbsp;</div>
                                                   		<select class="form-control" id="mySelect" name="cboincludeservice" onChange="myFunction()">														  
                                                        
                                                          <option value=""></option>
                                                          <option value="include_service">Include Service</option>
                                                      	</select>
                                             </th>
                                             <th>
                                            <div class="input-group-addon">Annother Charge</div>
                                            <input type="text" name="txtAnnotherCharge" placeholder="Another Charge" id="idanothercharge" onKeyUp="EnterAnotherCharge()"  onKeyPress="return isNumberKey(event)" readonly required class="form-control currency"  />
                                            
                                            <div class="input-group-addon"> &nbsp;</div>
                                            	<input type="submit" class="btn btn-primary btn-lg btn-block" name="btnSave"  value="SaveNew" />
                                            </th>
                                        </tr>
                                 </form>
                                 </table>
                                 <script type="text/javascript">				
				
									var idAmt = document.getElementById("idAmt");
									var idTotalCharge = document.getElementById("idTotalCharge");
									var idlocalcharge = document.getElementById("idlocalcharge");
									var idTotalCharge = document.getElementById("idTotalCharge");
									var idanothercharge = document.getElementById("idanothercharge");
									
									
									/*function myChargeServiceType() {
										if ( idChargeServiceType == 'AllCharge' )
										{
											idAmt.value =  parseFloat(idAmt.value || 0)- parseFloat(idTotalCharge.value || 0);
										}
										else if(idChargeServiceType == 'LocalChargeOnly')
										{
											idAmt.value = parseFloat(idAmt.value || 0)- parseFloat(idlocalcharge.value || 0);
										}
									}*/
									
									function myFunction() {
										var x = document.getElementById("mySelect").value;
										var idChargeServiceType = document.getElementById("idChargeServiceType").value;
										// document.getElementById("demo").innerHTML = "You selected: " + x;
										
											if(idChargeServiceType == 'AllCharge' ){
												if(x == ''){
													idAmt.value = parseFloat(idAmt.value || 0)+ parseFloat(idTotalCharge.value || 0);
												}
												else{
													idAmt.value = parseFloat(idAmt.value || 0)- parseFloat(idTotalCharge.value || 0);
												}
												
											}
											else if(idChargeServiceType == 'LocalChargeOnly')
											{
												if(x == ''){
													idAmt.value = parseFloat(idAmt.value || 0)+ parseFloat(idlocalcharge.value || 0)
												}
												else{
													idAmt.value = parseFloat(idAmt.value || 0)- parseFloat(idlocalcharge.value || 0);
												}
											}
											else
											{
												idAmt.value = parseFloat(idAmt.value || 0);
											}
									}
									
											
									function EnterTotalCharge(){
										if(idTotalCharge.value == '')
										{
											
											idTotalCharge1.value = 0;
										}
										else
										{
											
											idanothercharge.value = parseFloat(idTotalCharge.value|| 0) / 2;
											idlocalcharge.value = parseFloat(idTotalCharge.value|| 0) / 2;
											
										}
									}
									
									//Enter Local Charge
									function Enterlocalcharge(){
										if(idlocalcharge.value == '' || idlocalcharge.value == 0)
										{
											idanothercharge.value =  parseFloat(idTotalCharge.value|| 0)- parseFloat(idlocalcharge.value|| 0);
										}
										else
										{
											idanothercharge.value = parseFloat(idTotalCharge.value|| 0)- parseFloat(idlocalcharge.value|| 0);
										}
									}
									
									
									
							   </script>
                                <table class="table table-striped table-bordered table-hover sortable" id="dataTables-example">
                                   	
                                     <thead>
                                        <tr>
                                        	<th>No</th>
                                            <th>ServiceType</th>
                                            <th>Local Branch</th>
                                            <th>Another Branch</th>
                                            <th>Code</th> 
                                            <th>Phone Reciever</th>
                                            <th>Currency</th>
                                            <th>Amt</th>
                                            <th>Local Charge</th> 
                                            <th>Another Charge</th> 
                                            <th>Total Charge</th>
                                            <th>Paid Charge Type</th>
                                            
                                            <th>Total Paid</th> 
                                            <th>Action</th> 
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
                                    	
                                        
                                        <?php
											$select=$db->query("CALL spSearchTransfer('".$txtSearch."');");
											
									   		$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												
												while($row=$db->fetch($select)){
													$TransactionID = $row->TransactionID;
													$ServiceTypeID = $row->ServiceTypeID;
													$ServiceTypeName = $row->ServiceTypeName;
													$Local_BranchID = $row->Local_BranchID;
													$Local_BranchName = $row->Local_BranchName;
													$Another_BranchID = $row->Another_BranchID;
													$Another_BranchName = $row->Another_BranchName;
													$PhoneSender = $row->PhoneSender;
													$PhoneReceiver = $row->PhoneReceiver;
													$Code = $row->Code;
													$CurrencyNo = $row->CurrencyNo;
													$CurrencyName = $row->CurrencyName;
													$Amt = number_format($row->Amt, 2, '.', '');
													$Local_Branch_Charge = number_format($row->Local_Branch_Charge, 2, '.', '');
													$Another_Branch_Charge = number_format($row->Another_Branch_Charge, 2, '.', '');
													$TotalCharge = number_format($row->TotalCharge, 2, '.', '');
													$PayChargeType = $row->PayChargeType;
													$Total_To_Paid = number_format($row->Total_To_Paid, 2, '.', '');
													$isCancel = $row->isCancel;
													$isClearPayment = $row->isClearPayment;
													

												echo'<tr class="even">
														<td>'.$i++.'</td>
														<td>'.$ServiceTypeName.'</td>
														<td>'.$Local_BranchName.'</td>
														<td>'.$Another_BranchName.'</td>
														<td>'.$Code.'</td>
														<td>'.$PhoneReceiver.'</td>
														<td>'.$CurrencyName.'</td>
														<td>'.$Amt.'</td>
														<td>'.$Local_Branch_Charge.'</td>
														<td>'.$Another_Branch_Charge.'</td>
														<td>'.$TotalCharge.'</td>
														<td>'.$PayChargeType.'</td>
														<td>'.$Total_To_Paid.'</td>';
												echo '<td><a href="frmTransfer_Update.php?TransactionID='.$TransactionID.'&ServiceTypeID='.$ServiceTypeID.'&ServiceTypeName='.$ServiceTypeName.'&Local_BranchID='.$Local_BranchID.'&Local_BranchName='.$Local_BranchName.'&Another_BranchID='.$Another_BranchID.'&Another_BranchName='.$Another_BranchName.'&PhoneSender='.$PhoneSender.'&PhoneReceiver='.$PhoneReceiver.'&Code='.$Code.'&CurrencyNo='.$CurrencyNo.'&Amt='.$Amt.'&Local_Branch_Charge='.$Local_Branch_Charge.'&Another_Branch_Charge='.$Another_Branch_Charge.'&TotalCharge='.$TotalCharge.'&PayChargeType='.$PayChargeType.'&Total_To_Paid='.$Total_To_Paid.'">Update</a></td>';
														
														/*echo '<td class="center" >';
														echo "<a onclick=\"myUpdate('".$TransactionID."','".$ServiceTypeID."','".$ServiceTypeName."','".$Local_BranchID."','".$Local_BranchName."','".$Another_BranchID."','".$Another_BranchName."','".$PhoneSender."','".$PhoneReceiver."','".$Code."','".$CurrencyNo."','".$Amt."','".$Local_Branch_Charge."','".$Another_Branch_Charge."','".$TotalCharge."','".$PayChargeType."','".$PayChargeTypeName."','".$Total_To_Paid."')\">Update";
														echo '</a></td>';*/
														
													
												echo '</tr>';
													
												} 
											}
											else
											{
												echo '<tr class="even">
														<td  colspan="15"><font size="+1" color="#CC0000"> No Products Selected.</font></td>
														</td>
													</tr>';	
											}
											$db->disconnect();
											$db->connect();
									   ?>    
                                             
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                      </div>
                        <!-- /.panel-body -->
           
                    
                
                
                <!-- Check Out -->

                <!-- End Check Out -->
                
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- add new calendar event modal -->
<?php include 'footer.php';?>