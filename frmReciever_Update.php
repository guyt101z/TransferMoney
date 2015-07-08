
<?php include 'header.php';?>

<?php
	
		$autoid = time();
		// TransactionID=1435306229&ServiceTypeID=1434361713&ServiceTypeName=Receive&Local_BranchID=1429329904&Local_BranchName=C&Another_BranchID=123&Another_BranchName=A&PhoneSender=12&PhoneReceiver=12&Code=12& CurrencyNo=1434697930&Amt=55&Local_Branch_Charge=3&Another_Branch_Charge=2&TotalCharge=5&PayChargeType=LocalChargeOnly&Total_To_Paid=0
		
		$getTransactionID  =  get('TransactionID');
		$getLocal_BranchID  =  get('Local_BranchID');
		$getAnother_BranchID  =  get('Another_BranchID');
		$getPhoneSender  =  get('PhoneSender');
		$getPhoneReceiver  =  get('PhoneReceiver');
		$getCode =  get('Code');
		$getCurrencyNo  =  get('CurrencyNo');
		$getAmt  =  get('Amt');
		$getLocal_Branch_Charge  =  get('Local_Branch_Charge');
		$getAnother_Branch_Charge  =  get('Another_Branch_Charge');
		$getTotalCharge  =  get('TotalCharge');
		$getPayChargeType  =  get('PayChargeType');
		$getLocalChargeOnly  =  get('LocalChargeOnly');
		
		$cboFromBranch  = get('cboToBranch');
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
		$txtgettransactionID = get('txtgettransactionID');
		$btnSave	=	get('btnSave');
		
		$ifall = - floatval($txtamt) + floatval($txtAnnotherCharge);
		$ifLocalCharge = - floatval($txtamt) ;
		$ifNotall = - floatval($txtamt) - floatval($txtLocalCharge);
		
		if($btnSave== "SaveNew"){
			
			if($cboPayChargeType == "AllCharge"){
				$updated=$db->query("UPDATE tbltransaction set 
				Another_BranchID = '".$cboFromBranch."', 
				PhoneSender = '".$txtPhoneSender."', 
				PhoneReceiver = '".$txtPhoneReciever."', 
				`Code` = '".$txtcode."', 
				CurrencyNo = '".$cboCurrency."', 
				Amt = ".$txtamt.", 
				Local_Branch_Charge = ".$txtLocalCharge.", 
				Another_Branch_Charge = ".$txtAnnotherCharge.", 
				TotalCharge = ".$txtTotalCharge.", 
				PayChargeType = '".$cboPayChargeType."', 
				Total_To_Paid = ".$ifall.",
				Date = '".$date_now."'
				WHERE TransactionID = '".$txtgettransactionID."'");
			}
			else if($cboPayChargeType == "LocalChargeOnly"){
				$updated=$db->query("UPDATE tbltransaction set 
				Another_BranchID = '".$cboFromBranch."', 
				PhoneSender = '".$txtPhoneSender."', 
				PhoneReceiver = '".$txtPhoneReciever."', 
				`Code` = '".$txtcode."', 
				CurrencyNo = '".$cboCurrency."', 
				Amt = ".$txtamt.", 
				Local_Branch_Charge = ".$txtLocalCharge.", 
				Another_Branch_Charge = ".$txtAnnotherCharge.", 
				TotalCharge = ".$txtTotalCharge.", 
				PayChargeType = '".$cboPayChargeType."', 
				Total_To_Paid = ".$ifLocalCharge.",
				Date = '".$date_now."'
				WHERE TransactionID = '".$txtgettransactionID."'");
			}
			else if($cboPayChargeType == "NotAll"){
				$updated=$db->query("UPDATE tbltransaction set 
				Another_BranchID = '".$cboFromBranch."', 
				PhoneSender = '".$txtPhoneSender."', 
				PhoneReceiver = '".$txtPhoneReciever."', 
				`Code` = '".$txtcode."', 
				CurrencyNo = '".$cboCurrency."', 
				Amt = ".$txtamt.", 
				Local_Branch_Charge = ".$txtLocalCharge.", 
				Another_Branch_Charge = ".$txtAnnotherCharge.", 
				TotalCharge = ".$txtTotalCharge.", 
				PayChargeType = '".$cboPayChargeType."', 
				Total_To_Paid = ".$ifNotall.",
				Date = '".$date_now."'
				WHERE TransactionID = '".$txtgettransactionID."'");
			}
			
			if($updated){
				cRedirect('frmReciever.php');
				//echo "<script type='text/javascript'>alert('Thank!')</script>";
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
                                   <button class="btn btn-success" type="submit">Transfer &nbsp;<i class="glyphicon glyphicon-chevron-up"></i></button>
                                </a>
                            </div>
                            <div class="col-md-4 pull-left">
                            	<font size="2">
                               	You are staying in Form Recieve Update.
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
          <div class="modal fade bs-example-modal-sm" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Other Cost</h4>
              </div>
              <div class="modal-body">
                	<form enctype="multipart/form-data" >
                          
                          <input type="hidden" name="txtProductID" id="ProductID">
                          
                          <div class="form-group">
                            	<label>Other Cost: </label>
                                
                                <div class="input-group">
                                  <div class="input-group-addon">$</div>
                                  <input name="txtOtherCost" class="form-control" id="txtOtherCostdollar" onKeyUp="ChangeOtherCostDolar()" placeholder="Enter Cost($)" required autofocus />
                                </div>
                                <div class="input-group">
                                  <div class="input-group-addon">KH</div>
                                  <input name="txtprdname" class="form-control" id="txtOtherCostreal" onKeyUp="ChangeOtherCostReal()" placeholder="Enter Cost(R)"  autofocus />
                                </div>
                          </div>
                          
                          <div class="form-group">
                            	<label>Description: </label>
                                <textarea class="form-control" id="txtDesc" name="txtDesc" placeholder="Enter Descriptiion" rows="3"></textarea>
                          </div>
                     
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Save" />
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
        
               
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                            	<table class="table table-striped table-bordered table-hover" border="0" id="dataTables-example">
                                   	<form enctype="multipart/form-data">
                                    	<input type="hidden" name="txtgettransactionID" value="<?php echo $getTransactionID; ?>" />
                                   		<tr>
                                            <th class="">
                                            	<div class="input-group-addon">From Branch</div>
                                            	<select class="form-control" name="cboToBranch">
                                   					<?php
                                                        $select=$db->query("SELECT BranchID, BranchName FROM `tblbranch` WHERE BranchID != '".$U_Brandid."';");
                                                        $rowselect=$db->dbCountRows($select);
                                                        if($rowselect>0){
                                                            while($row=$db->fetch($select)){
                                                            $BranchID = $row->BranchID;
                                                            $BranchName = $row->BranchName;
																if($getAnother_BranchID == $BranchID){
                                                               	 	echo'<option value='.$BranchID.' selected>'.$BranchName.'</option>';
																}
																else{
																	 echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
																}
                                                            } 
                                                        }
                                                   ?>
                                                   		
                                                    </select>
                                                    <div class="input-group-addon">Phone Sender</div>
                                            	<input type="text" name="txtPhoneSender"  value="<?php echo $getPhoneSender; ?>" placeholder="Tel Sender" id="" class="form-control currency"  />
                                                    
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
															if($getCurrencyNo == $CurrencyNo)
															{
                                                                echo'<option value='.$CurrencyNo.' selected>'.$CurrencyName.'</option>';
                                                            }
															else
															{
																echo'<option value='.$CurrencyNo.'>'.$CurrencyName.'</option>';
															}
															
															} 
                                                        }
                                                   ?>
                                                    </select>
                                                    <div class="input-group-addon">Phone Reciever</div>
                                            	<input name="txtPhoneReciever" tabindex="0" value="<?php echo $getPhoneReceiver;?>" class="form-control" placeholder="Tel Reciever"  autofocus />
                                             </th>
                                             <th>
                                            <div class="input-group-addon">Amt</div>
                                            <input type="text" name="txtamt" value="<?php echo $getAmt;?>" placeholder="Ammount" id="idAmt" onKeyUp="EnterAmmount()"  onKeyPress="return isNumberKey(event)" required class="form-control currency"  />
                                            <div class="input-group-addon">Code</div>
                                            <input type="text" name="txtcode" value="<?php echo $getCode;?>" placeholder="Input Code" id=""  class="form-control currency"  />
                                            
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
                                            	<input type="text" name="txtTotalCharge" value="<?php echo $getTotalCharge;?>" placeholder="Total Charge" id="idTotalCharge" onKeyUp="EnterTotalCharge()" onKeyPress="return isNumberKey(event)" required class="form-control currency"  />
                                                <div class="input-group-addon">Pay Charge Type</div>
                                            	<select class="form-control" name="cboPayChargeType" id="idChargeServiceType" onChange="myChargeServiceType()">
                                   					<option value="AllCharge" <?php if($getPayChargeType=="AllCharge") echo 'selected'; ?>>All Charge</option>
                                                    <option value="LocalChargeOnly" <?php if($getPayChargeType=="LocalChargeOnly") echo 'selected'; ?>>Local Charge Only</option>
                                                    <option value="NotAll" <?php if($getPayChargeType=="NotAll") echo 'selected'; ?>>No All</option>
                                                </select>  
                                            </th>
                                            
                                            <th>
                                            	<div class="input-group-addon">Local Charg</div> 
                                            	
                                                <input type="text" name="txtLocalCharge" placeholder="Local Charge" id="idlocalcharge" onKeyUp="Enterlocalcharge()"  onKeyPress="return isNumberKey(event)"  class="form-control currency" value="<?php echo $getLocal_Branch_Charge;?>" />
                                                    <div class="input-group-addon"> &nbsp;</div>
                                                     <select id="mySelect" class="form-control" onChange="myFunction()">
                                                      <option value=""></option>
                                                          <option value="include_service">Include Service</option>
                                                    </select>
                                             </th>
                                             <th>
                                            <div class="input-group-addon">Annother Charge</div>
                                            <input type="text" name="txtAnnotherCharge" placeholder="Another Charge" id="idanothercharge" onKeyUp="EnterAnotherCharge()"  onKeyPress="return isNumberKey(event)" required value="<?php echo $getAnother_Branch_Charge;?>" class="form-control currency"  />
                                           
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
									var idTotalCharge1 = document.getElementById("idTotalCharge1");
									var idanothercharge = document.getElementById("idanothercharge");
									
									function myFunction() {
										var x = document.getElementById("mySelect").value;
										//document.getElementById("demo").innerHTML = "You selected: " + x;
										var idChargeServiceType = document.getElementById("idChargeServiceType").value;
										if(idChargeServiceType == 'AllCharge' ){
											if(x == ''){
												idAmt.value = parseFloat(idAmt.value || 0) + parseFloat(idTotalCharge.value || 0);
											}
											else{
												idAmt.value = parseFloat(idAmt.value || 0) - parseFloat(idTotalCharge.value || 0);
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
									//Enter Total All Charge
									function EnterTotalCharge(){
										if(idTotalCharge.value == '')
										{
											idanothercharge.value = 0;
											idlocalcharge.value = 0;
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
											idanothercharge.value = parseFloat(idTotalCharge.value|| 0)- parseFloat(idlocalcharge.value|| 0);
										}
										else
										{
											idanothercharge.value = parseFloat(idTotalCharge.value|| 0)- parseFloat(idlocalcharge.value|| 0);
										}
									}
									
							   </script>
                               
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