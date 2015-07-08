
<?php include 'header.php';?>

<?php
		// Add new
		//frmtransfer.php?txtTransactionID=1434507559&txtServiceTypeID=1434361638&txtFromBrandID=1234
		//&txtToBranchID=1429329904&txtPayChargType=&cboServiceType=&cboFromBranch=&cboToBranch=&txtPhoneSender=&txtPhoneReceiver=sdfsdf&
		//txtCode=sdf&txtCurrencyNo=sdfsdf&txtAmt=sdfsd&txtLocalBranchCharge=&txtAnotherBranchCharge=&cboPaychargtype=&txtTotalCharge=0&btnSave=SaveUpdate
		// update
		$txtTransactionID = get('txtTransactionID');
		$txtServiceTypeID = get('txtServiceTypeID');
		$txtFromBrandID = get('txtFromBrandID');
		$txtToBranchID = get('txtToBranchID');
		$txtPayChargType = get('txtPayChargType');
		$btnSaveUpdate = get('btnSaveUpdate');
		
		$cboServiceType = get('cboServiceType');
		$cboFromBranch	=	get('cboFromBranch');
		$cboToBranch	=	get('cboToBranch');
		$txtPhoneSender	=	get('txtPhoneSender');
		$txtPhoneReceiver	=	get('txtPhoneReceiver');
		$txtCode	=	get('txtCode');
		$txtCurrencyNo	=	get('txtCurrencyNo');
		$txtAmt	=	get('txtAmt');
		$txtLocalBranchCharge	=	get('txtLocalBranchCharge');
		$txtAnotherBranchCharge	=	get('txtAnotherBranchCharge');
		$cboPaychargtype	=	get('cboPaychargtype');
		$txtTotal	=	get('txtTotal');
		$btnSave = get('btnSave');
		$txtTotalCharge = get('txtTotalCharge');
		//$TotalCharge = $txtAmt * 
		
		/*if($btnSaveUpdate== "SaveUpdate"){
			if($cboServiceType != "" && $cboFromBranch != "" && $cboToBranch != "" && $cboPaychargtype != "")
			{
				$Update=$db->query("Update tbltransaction SET ServiceTypeID='".$cboServiceType."', Local_BranchID='".$cboFromBranch."', Another_BranchID='".$cboToBranch."', PhoneSender='".$txtPhoneSender."', 
				PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', 
				TotalCharge='', PayChargeType='".$cboPaychargtype."', Total_To_Paid=''WHERE TransactionID = '".$txtTransactionID."';");
			}
			else
			{
				if($cboServiceType != "" && $cboFromBranch == "" && $cboToBranch == "" && $cboPaychargtype == "")
				{
					$Update=$db->query("Update tbltransaction SET ServiceTypeID='".$cboServiceType."', PhoneSender='".$txtPhoneSender."', 	PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', TotalCharge='', Total_To_Paid='' WHERE TransactionID = '".$txtTransactionID."';");
				}
				else if($cboServiceType == "" && $cboFromBranch != "" && $cboToBranch == "" && $cboPaychargtype == "")
				{
					$Update=$db->query("Update tbltransaction SET Local_BranchID='".$cboFromBranch."', PhoneSender='".$txtPhoneSender."', 	PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', TotalCharge='', Total_To_Paid='' WHERE TransactionID = '".$txtTransactionID."';");
				}
				
				else if($cboServiceType == "" && $cboFromBranch == "" && $cboToBranch != "" && $cboPaychargtype == "")
				{
					$Update=$db->query("Update tbltransaction SET  Another_BranchID='".$cboToBranch."', PhoneSender='".$txtPhoneSender."', 	PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', TotalCharge='',  Total_To_Paid='' WHERE TransactionID = '".$txtTransactionID."';");
				}
				else if($cboServiceType == "" && $cboFromBranch == "" && $cboToBranch == "" && $cboPaychargtype != "")
				{
					$Update=$db->query("Update tbltransaction SET  Another_BranchID='".$cboToBranch."', PhoneSender='".$txtPhoneSender."', 	PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', TotalCharge='', PayChargeType='".$cboPaychargtype."', Total_To_Paid=''WHERE TransactionID = '".$txtTransactionID."';");
				}
				// Check with two condition
				else if($cboServiceType != "" && $cboFromBranch != "" && $cboToBranch == "" && $cboPaychargtype == "")
				{
					$Update=$db->query("Update tbltransaction SET ServiceTypeID='".$cboServiceType."', Local_BranchID='".$cboFromBranch."', PhoneSender='".$txtPhoneSender."', 
				PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', TotalCharge='',  Total_To_Paid='' WHERE TransactionID = '".$txtTransactionID."';");
				}
				else if($cboServiceType != "" && $cboFromBranch == "" && $cboToBranch != "" && $cboPaychargtype == "")
				{
					$Update=$db->query("Update tbltransaction SET ServiceTypeID='".$cboServiceType."',  Another_BranchID='".$cboToBranch."', PhoneSender='".$txtPhoneSender."', 
				PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', TotalCharge='',  Total_To_Paid=''WHERE TransactionID = '".$txtTransactionID."';");
				}
				else if($cboServiceType != "" && $cboFromBranch == "" && $cboToBranch == "" && $cboPaychargtype != "")
				{
					$Update=$db->query("Update tbltransaction SET ServiceTypeID='".$cboServiceType."', Local_BranchID='".$cboFromBranch."', Another_BranchID='".$cboToBranch."', PhoneSender='".$txtPhoneSender."', 
				PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', 
				TotalCharge='', PayChargeType='".$cboPaychargtype."', Total_To_Paid=''WHERE TransactionID = '".$txtTransactionID."';");
				}
				else if($cboServiceType != "" && $cboFromBranch != "" && $cboToBranch == "" && $cboPaychargtype == "")
				{
					$Update=$db->query("Update tbltransaction SET ServiceTypeID='".$cboServiceType."', Local_BranchID='".$cboFromBranch."', Another_BranchID='".$cboToBranch."', PhoneSender='".$txtPhoneSender."', 
				PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', 
				TotalCharge='', PayChargeType='".$cboPaychargtype."', Total_To_Paid=''WHERE TransactionID = '".$txtTransactionID."';");
				}
				
				
				
				
				else
				{
					$Update=$db->query("Update tbltransaction SET    PhoneSender='".$txtPhoneSender."', 
				PhoneReceiver='".$txtPhoneReceiver."', `Code`='".$txtCode."', CurrencyNo='".$txtCurrencyNo."', Amt='".$txtAmt."', Local_Branch_Charge='', Another_Branch_Charge='', TotalCharge='',  Total_To_Paid=''WHERE TransactionID = '".$txtTransactionID."';");
				}
				
			}
			if($Update){
				cRedirect('frmtransfer.php');
			}
			else
			{
				echo "<script type='text/javascript'>alert('មានបញ្ហាបន្តិចបន្តួច! សូមបញ្ចូលម្តងទៀត!')</script>";
			}
		}
		*/
		if($btnSave== "Save"){
			$insert=$db->query("INSERT INTO tbltransaction (TransactionID, UserID, ServiceTypeID, Local_BranchID, Another_BranchID, 
			PhoneSender, PhoneReceiver, `Code`, CurrencyNo, 
			Amt, Local_Branch_Charge, Another_Branch_Charge, TotalCharge, PayChargeType, Total_To_Paid)
			VALUES ('".time()."','".$U_id."','".$cboServiceType."','".$cboFromBranch."','".$cboToBranch."',
			'".$txtPhoneSender."','".$txtPhoneReceiver."','".$txtCode."','".$txtCurrencyNo."',".$txtAmt.",
			".$txtLocalBranchCharge.",'".$txtAnotherBranchCharge."','".$txtTotalCharge."','".$cboPaychargtype."','1500')");
				
			if($insert){
			//	cRedirect('frmtransfer.php');
			}
			else
			{
				echo "<script type='text/javascript'>alert('មានបញ្ហាបន្តិចបន្តួច! សូមបញ្ចូលម្តងទៀត!')</script>";
			}
		}
		
		/*if($btnSave == 'SaveUpdate')
		{
			$updatebranch=$db->query("UPDATE tblbranch SET BranchName=N'".$txtBranchName."', Decription='".$txtDesc."' WHERE BranchID = '".$txtBranchID."'; ");
			if($updatebranch){
				cRedirect('frmbranch.php');
		 	}
			else
			{
				echo "<script type='text/javascript'>alert('មានបញ្ហាបន្តិចបន្តួច! សូមបញ្ចូលម្តងទៀត!')</script>";
			}
		}*/
		
		/*if($btnSave == 'Save')
		{
			$InsertServiceType=$db->query("INSERT INTO tblservicetype( ServiceTypeID, ServiceTypeName, Description ) 
		VALUES (".$autoid.",N'".$txtservicename."',N'".$txtDesc."');");
			if($InsertServiceType){
			cRedirect('frmServicesType.php');
		 	}
		}		
		if($getbtnSave == 'SaveUpdate')
		{
			$UpdateServiceType=$db->query("UPDATE tblservicetype SET  ServiceTypeName='".$gettxtservicename."', Description='".$gettxtDesc."' 
			WHERE ServiceTypeID='".$gettxtServiceTypeID."';");
			if($UpdateServiceType){
				cRedirect('frmServicesType.php');
		 	}
		}			*/

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
                               	
                                   <button class="btn btn-success" type="submit" data-toggle="modal" data-target="#Order"><i class="glyphicon glyphicon-plus"></i></button>
                              
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
                <h4 class="modal-title" id="myModalLabel">Update Branch</h4>
              </div>
              <div class="modal-body">
                	<form class="form-horizontal" enctype="multipart/form-data">
                          
                          <input type="hidden" name="txtTransactionID" id="idTranSactionid">
                          <input type="hidden" name="txtServiceTypeID" id="idServicetypeid">
                          <input type="hidden" name="txtFromBrandID" id="idFromBranchID">
                          <input type="hidden" name="txtToBranchID" id="idToBranchID">
                          <input type="hidden" name="txtPayChargType" id="idtxtPayChargType">
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Services Type</label>
                            <div class="input-group">
                              <div class="input-group-addon"><input type="button" id="idServiceType" /></div>
                              <select class="form-control" name="cboServiceType">
								<?php
                                    $select=$db->query("SELECT ServiceTypeID, ServiceTypeName FROM `tblservicetype`;");
                                    $rowselect=$db->dbCountRows($select);
                                    if($rowselect>0){
										 echo'<option value=""></option>';
                                        while($row=$db->fetch($select)){
                                        $ServiceTypeID = $row->ServiceTypeID;
                                        $ServiceTypeName = $row->ServiceTypeName;
                                            echo'<option value='.$ServiceTypeID.'>'.$ServiceTypeName.'</option>';
                                        }
                                     }
                               	?>
                              </select>
                             </div>
                         </div>
                         
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">From Branch</label>
                            <div class="input-group">
                              <div class="input-group-addon"><input type="button" id="idFromBranch" /></div>
                              <select class="form-control" name="cboFromBranch">
								<?php
                                    $select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
                                    $rowselect=$db->dbCountRows($select);
                                    if($rowselect>0){
										 echo'<option value=""></option>';
                                        while($row=$db->fetch($select)){
                                        $BranchID = $row->BranchID;
                                        $BranchName = $row->BranchName;
                                            echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
                                        }
                                        
                                    }
                               	?>
                              </select>
                             </div>
                         </div>
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">To Branch</label>
                            <div class="input-group">
                              <div class="input-group-addon"><input type="button" id="idToBranch" /></div>
                              <select class="form-control" name="cboToBranch">
								<?php
                                    $select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
                                    $rowselect=$db->dbCountRows($select);
                                    if($rowselect>0){
										 echo'<option value=""></option>';
                                        while($row=$db->fetch($select)){
                                        $BranchID = $row->BranchID;
                                        $BranchName = $row->BranchName;
                                            echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
                                        }
                                        
                                    }
                               	?>
                              </select>
                             </div>
                         </div>
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">PhoneSender</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtPhoneSender" id="idPhoneSender" placeholder="Input PhoneSender">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">PhoneReceiver</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtPhoneReceiver" id="idPhoneReciever" placeholder="Input PhoneReceiver" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Code</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtCode" id="idCode" placeholder="Input Code" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">CurrencyNo</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtCurrencyNo" id="idCurrentNo" placeholder="Input Currency" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Amt</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtAmt" id="idamt" onKeyUp="onKeyUpAmt()" id="txtamt" placeholder="Input Amt" required />
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Local_Branch_Charge</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtLocalBranchCharge" onKeyUp="onKeyUpLocal_Branch_Charge()" id="idLocalBranchCharge" placeholder="Input Local Branch Charge">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Another_Branch_Charge</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  onKeyUp="onKeyUpAnother_Branch_Charge()" name="txtAnotherBranchCharge" id="idanotherbranchcharge" placeholder="Input Another Branch Charge">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Type's Pay Charge</label>
                            <div class="input-group">
                              <div class="input-group-addon"><input type="button" id="idPaychargtype" /></div>
                              	<select class="form-control" name="cboPaychargtype">
									<option value=""></option>';
                                    <option value="1">All Charge</option>';
                                    <option value="2">Local Charge Only</option>';
                                    <option value="3">No All</option>'; 
                               </select>
                             </div>
                         </div>
                         
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Total Charge</label>
                            <div class="input-group">
                              <div class="input-group-addon">$</div>
                              <input type="text" class="form-control" name="txtTotalCharge" style="background: #FFFFCC; color:#FF0000; font-weight:600;" id="txttotalcharge" placeholder="Total Charge">
                             
                            </div>
                          </div>
                          
                     
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="btnSaveUpdate" value="SaveUpdate" />
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
        
               
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                            	
                                <table class="table table-striped table-bordered table-hover sortable" id="dataTables-example">
                                   	
                                    <thead>
                                        <tr>
                                        	<th>No</th>
                                            <th>ServiceType</th>
                                            <th>Local Branch</th>
                                            <th>Another Branch</th>
                                            <th>Code</th> 
                                            <th>Phone Reciever</th>
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
													$Amt = $row->Amt;
													$Local_Branch_Charge = $row->Local_Branch_Charge;
													$Another_Branch_Charge = $row->Another_Branch_Charge;
													$TotalCharge = $row->TotalCharge;
													$PayChargeType = $row->PayChargeType;
													$Total_To_Paid = $row->Total_To_Paid;
													$isCancel = $row->isCancel;
													$isClearPayment = $row->isClearPayment;
													$PayChargeTypeName = "";
													if($PayChargeType == 1){
														$PayChargeTypeName = 'All Charge';
													}
													else if($PayChargeType == 2){
														$PayChargeTypeName = 'Local Charge Only';
													}
													else if($PayChargeType==3){
														$PayChargeTypeName = 'No All';
													}

												echo'<tr class="even">
														<td>'.$i++.'</td>
														<td>'.$ServiceTypeName.'</td>
														<td>'.$Local_BranchName.'</td>
														<td>'.$Another_BranchName.'</td>
														<td>'.$Code.'</td>
														<td>'.$PhoneReceiver.'</td>
														<td>$'.$Amt.'</td>
														<td>$'.$Local_Branch_Charge.'</td>
														<td>$'.$Another_Branch_Charge.'</td>
														<td>$'.$TotalCharge.'</td>
														<td>'.$PayChargeTypeName.'</td>
														<td>$'.$Total_To_Paid.'</td>';
												//echo '<td><a href="frmtransfer_update.php?TransactionID='.$TransactionID.'&ServiceTypeID='.$ServiceTypeID.'&ServiceTypeName='.$ServiceTypeName.'&Local_BranchID='.$Local_BranchID.'&Local_BranchName'.$Local_BranchName.'&Another_BranchID'.$Another_BranchID.'&Another_BranchName='.$Another_BranchName.'&PhoneSender='.$PhoneSender.'&PhoneReceiver='.$PhoneReceiver.'&Code'.$Code.'&CurrencyNo='.$CurrencyNo.'&Amt='.$Amt.'&Local_Branch_Charge='.$Local_Branch_Charge.'&Another_Branch_Charge='.$Another_Branch_Charge.'&TotalCharge='.$TotalCharge.'&PayChargeType='.$PayChargeType.'&PayChargeTypeName='.$PayChargeTypeName.'&Total_To_Paid='.$Total_To_Paid.'">Update</a></td>';
														/*echo '<td class="center" >';
														echo "<a onclick=\"myUpdate('".$TransactionID."','".$ServiceTypeID."','".$ServiceTypeName."','".$Local_BranchID."','".$Local_BranchName."','".$Another_BranchID."','".$Another_BranchName."','".$PhoneSender."','".$PhoneReceiver."','".$Code."','".$CurrencyNo."','".$Amt."','".$Local_Branch_Charge."','".$Another_Branch_Charge."','".$TotalCharge."','".$PayChargeType."','".$PayChargeTypeName."','".$Total_To_Paid."')\">Update";
														echo '</a></td>';*/
														
													
												echo '</tr>';
													
												} 
											}
											else
											{
												echo '<tr class="even">
														<td  colspan="8"><font size="+1" color="#CC0000"> No Products Selected.</font></td>
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
               <!-- New User -->
  <!-- Add new Transfer-->
               <div class="modal fade" id="Order" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">                    
                  <div class="modal-content">
                      
                      <div class="modal-body">
                        <form class="form-horizontal">
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Services Type</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="cboServiceType">
								<?php
                                    $select=$db->query("SELECT ServiceTypeID, ServiceTypeName FROM `tblservicetype`;");
                                    $rowselect=$db->dbCountRows($select);
                                    if($rowselect>0){
                                        while($row=$db->fetch($select)){
                                        $ServiceTypeID = $row->ServiceTypeID;
                                        $ServiceTypeName = $row->ServiceTypeName;
                                            echo'<option value='.$ServiceTypeID.'>'.$ServiceTypeName.'</option>';
                                        }
                                        
                                    }
                               	?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">From Branch</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="cboFromBranch">
								<?php
                                    $select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
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
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">To Branch</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="cboToBranch">
								<?php
                                    $select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
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
                            </div>
                          </div>
                           <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">PhoneSender</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtPhoneSender" placeholder="Input PhoneSender">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">PhoneReceiver</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtPhoneReceiver" placeholder="Input PhoneReceiver" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Code</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtCode" placeholder="Input Code" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">CurrencyNo</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtCurrencyNo" placeholder="Input Currency" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Amt</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtAmt" onKeyUp="onKeyUpAmt()" id="txtamt" placeholder="Input Amt" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Local_Branch_Charge</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="txtLocalBranchCharge" onKeyUp="onKeyUpLocal_Branch_Charge()" id="txtLocalBranchCharge" placeholder="Input Local Branch Charge">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Another_Branch_Charge</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control"  onKeyUp="onKeyUpAnother_Branch_Charge()" name="txtAnotherBranchCharge" id="txtanotherbranchcharge" placeholder="Input Another Branch Charge">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Type's Pay Charge</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="cboPaychargtype">
									<option value="1">All Charge</option>';
                                    <option value="2">Local Charge Only</option>';
                                    <option value="3">No All</option>'; 
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Total Charge</label>
                            <div class="input-group">
                              <div class="input-group-addon">$</div>
                              <input type="text" class="form-control" name="txtTotalCharge" style="background: #FFFFCC; color:#FF0000; font-weight:600;" id="txttotalcharge" placeholder="Total Charge">
                             
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">&nbsp;</label>
                            <div class="input-group">
                              <input type="submit" name="btnSave" value="Save" />&nbsp;
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                         
                        </form>
                      
                    </div>
                  </div>
                </div>
                <!-- End New User -->
                    
                <script type="text/javascript">				

					  		var txtamt = document.getElementById("txtamt");
							var txtLocalBranchCharge = document.getElementById("txtLocalBranchCharge");
							var txtanotherbranchcharge = document.getElementById("txtanotherbranchcharge");
							var txttotalcharge = document.getElementById("txttotalcharge");
							// Block For Update
							var idTranSactionid = document.getElementById("idTranSactionid");
							var idServicetypeid = document.getElementById("idServicetypeid");
							var idServiceType = document.getElementById("idServiceType");
							var idFromBranchID = document.getElementById("idFromBranchID");
							var idFromBranch = document.getElementById("idFromBranch");
							var idToBranchID = document.getElementById("idToBranchID");
							var idToBranch = document.getElementById("idToBranch");				
							
							var idPhoneSender = document.getElementById("idPhoneSender");
							var idPhoneReciever = document.getElementById("idPhoneReciever");
							var idCode = document.getElementById("idCode");
							var idCurrentNo = document.getElementById("idCurrentNo");
							var idamt = document.getElementById("idamt");
							var idLocalBranchCharge = document.getElementById("idLocalBranchCharge");
							var idanotherbranchcharge = document.getElementById("idanotherbranchcharge");
							var idPaychargtype = document.getElementById("idPaychargtype");
							var idtxtPayChargType = document.getElementById("idtxtPayChargType");
						    //onclick=\"myUpdate('".$TransactionID."','".$ServiceTypeID."','".$ServiceTypeName."','".$Local_BranchID."','".$Local_BranchName."',
						    //'".$Another_BranchID."','".$Another_BranchName."','".$PhoneSender."','".$PhoneReceiver."','".$Code."','".$CurrencyNo."','".$Amt."',
							//'".$Local_Branch_Charge."','".$Another_Branch_Charge."','".$TotalCharge."','".$PayChargeType."','".$Total_To_Paid."')\"
							//myOtherCost
							function myUpdate(getTransactionID,getServiceTypeID,getServiceTypeName,getLocal_BranchID,getLocal_BranchName,getAnother_BranchID,getAnother_BranchName,getPhoneSender,getPhoneReceiver,getCode,getCurrencyNo,getAmt,getLocal_Branch_Charge,getAnother_Branch_Charge,getTotalCharge,getPayChargeID,getPayChargeTypeName,getTotal_To_Paid)
							{
								$('.bs-example-modal-sm').modal('show');
								idTranSactionid.value = getTransactionID;
								idServicetypeid.value = getServiceTypeID;	
								idServiceType.value = getServiceTypeName;
								idFromBranchID.value = getLocal_BranchID;
								idFromBranch.value = getLocal_BranchName;
								idToBranchID.value = getAnother_BranchID;
								idToBranch.value = getAnother_BranchName;
								idToBranch.value = getAnother_BranchName;
								idPhoneSender.value = getPhoneSender;
								idPhoneReciever.value = getPhoneReceiver;
								idCode.value = getCode;
								idCurrentNo.value = getCurrencyNo;
								idamt.value = getAmt;
								idLocalBranchCharge.value = getLocal_Branch_Charge;
								idPaychargtype.value = getPayChargeID;
								idtxtPayChargType.value = getPayChargeID;
								
								
								// idPaychargtype.value = "All Charge";
								if(getPayChargeID == 1){
									idPaychargtype.value = "All Charge";
								}
								else if(getPayChargeID == 2){
									idPaychargtype.value = "Local Charge Only";
								}
								else if(getPayChargeID == 3){
									idPaychargtype.value = "No All";
								}
								
							}
							
							// Keyup on Local_Branch_Charge
							function onKeyUpAnother_Branch_Charge() {
								if(txtanotherbranchcharge.value == '')
								{
									txttotalcharge.value = 0;
								}
								else
								{
									txttotalcharge.value = parseFloat(txtamt.value|| 0) + parseFloat(txtLocalBranchCharge.value|| 0)  + parseFloat(txtanotherbranchcharge.value|| 0) ;
								}
							}
							// Keyup on Local_Branch_Charge
							function onKeyUpLocal_Branch_Charge() {
								if(txtLocalBranchCharge.value == '')
								{
									txttotalcharge.value = 0;
								}
								else
								{
									txttotalcharge.value = parseFloat(txtamt.value|| 0) + parseFloat(txtLocalBranchCharge.value|| 0)  + parseFloat(txtanotherbranchcharge.value|| 0) ;
								}
							}
							// Keyup on Amt
							function onKeyUpAmt() {
								if(txtamt.value == '')
								{
									txttotalcharge.value = 0;
								}
								else
								{
									txttotalcharge.value = parseFloat(txtamt.value|| 0) + parseFloat(txtLocalBranchCharge.value|| 0)  + parseFloat(txtanotherbranchcharge.value|| 0) ;
								}
							}
							
							
					   </script>
                
                <!-- Check Out -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- add new calendar event modal -->
<?php include 'footer.php';?>