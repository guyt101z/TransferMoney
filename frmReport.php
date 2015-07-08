
<?php include 'header.php';?>

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
                           <div class="col-md-12 pull-right">
                              <form class="form-inline">
                                    	
                                            	<div class="form-group">
                                                    <label for="exampleInputName2"></label>
                                                    <select class="form-control" name="cboTransaction">
                                                       
                                                        <?php
														if($cboTransaction == ""){
															$select=$db->query("SELECT ServiceTypeID, ServiceTypeName FROM `tblservicetype`;");
															$rowselect=$db->dbCountRows($select);
															echo'<option value=""></option>';
															if($rowselect>0){
																while($row=$db->fetch($select)){
																$ServiceTypeID = $row->ServiceTypeID;
																$ServiceTypeName = $row->ServiceTypeName;
																	 
																	echo'<option value='.$ServiceTypeID.'>'.$ServiceTypeName.'</option>';
																	
																} 
															}
														}
														else
														{
															$select=$db->query("SELECT ServiceTypeID, ServiceTypeName FROM `tblservicetype`;");
															$rowselect=$db->dbCountRows($select);
															echo'<option value=""></option>';
															if($rowselect>0){
																while($row=$db->fetch($select)){
																$ServiceTypeID = $row->ServiceTypeID;
																$ServiceTypeName = $row->ServiceTypeName;
																	 	if($cboTransaction == $ServiceTypeID){
																			echo'<option value='.$ServiceTypeID.' selected>'.$ServiceTypeName.'</option>';
																		}
																		else{
																			
																			echo'<option value='.$ServiceTypeID.'>'.$ServiceTypeName.'</option>';
																		}
																} 
															}
														}
														?>
                                                        
                                                	</select>  
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail2"> &nbsp;&nbsp;&nbsp;</label>
                                                    <input type="text" class="form-control some_class" id="exampleInputEmail2"
                                                    	<?php 
															if ($txtFrom == "")
															{
																 echo 'value="'.$date_now.'"';
															}
															else
															{
																 echo 'value="'.$txtFrom.'"';
															}
														?>  name="txtFrom"
                                                     placeholder="2015-06-26">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail2" id="some_class_1"> - </label>
                                                    <input type="text" class="form-control some_class" id="exampleInputEmail2"
                                                    <?php 
														if ($txtFrom == "")
														{
															 echo 'value="'.$date_now.'"';
														}
														else
														{
															 echo 'value="'.$txtTo.'"';
														}
													?>  name="txtTo"
                                                     placeholder="2015-06-26" >
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail2"> &nbsp;&nbsp;&nbsp;</label>
                                                     <select class="form-control" name="searchBranch" >
                                                       <?php
														if($searchBranch == "")
														{
															$select=$db->query("SELECT BranchID, BranchName FROM `tblbranch` WHERE BranchID != '".$U_Brandid."';");
															$rowselect=$db->dbCountRows($select);
															echo ' <option value=""></option>';
															if($rowselect>0){
																while($row=$db->fetch($select)){
																$BranchID = $row->BranchID;
																$BranchName = $row->BranchName;
																	echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
																} 
															}
														}
														else{
															$select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
															$rowselect=$db->dbCountRows($select);
															echo ' <option value=""></option>';
															if($rowselect>0){
																while($row=$db->fetch($select)){
																$BranchID = $row->BranchID;
																$BranchName = $row->BranchName;
																	if($searchBranch == $BranchID){
																		echo'<option value='.$BranchID.' selected>'.$BranchName.'</option>';
																	}
																	else
																	{
																		echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
																	}
																} 
															}
														}
														?>
                                                        
                                                	</select>  
                                                  </div>
                                                   <button type="submit" class="btn btn-default">Search</button>
                                 </form>
                            </div>
                            &nbsp;

                        
                    </h1>
                    
                   
                </section>

                <!-- Main content -->
         
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                            <form action="frmClearPayment.php">
                                <table class="table table-striped table-bordered table-hover sortable" id="dataTables-example">
                                   	   
                                     <thead>
                                        <tr>
                                        	<th>No</th>
                                        	<th>ServiceType</th>
                                            <th>Date</th>
                                            <th>Currency</th>
                                            <th>ATM</th>
                                            <th>Total Charge</th>
                                            <th>Type's Charge</th>
                                            <th>Local Charge</th> 
                                            <th>Another Charge</th>
                                            <th>Total</th>
                                            <th><!--<input type="checkbox" name="checkme">-->
                                            
                                            	
                                            <input type="hidden" name="cboTransaction" value="<?php echo $cboTransaction;?>" />
                                            <input type="hidden" name="txtFrom" value="<?php echo $txtFrom;?>" />
                                            <input type="hidden" name="txtTo" value="<?php echo $txtTo;?>" />
                                            <input type="hidden" name="searchBranch" value="<?php echo $searchBranch;?>" />
                                            
                                            <input type="submit" name="btnClear" value="ClearPayment">
                                            <input type="submit" name="btnClear" value="All">
											</th> 
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
                                    	
                                        
                                        <?php
											$update= $db->query("UPDATE tblfilter SET FromDate = '".$txtFrom."', ToDate = '".$txtTo."' WHERE ID = '1';");
											$select=$db->query("call spReport('".$cboTransaction."','".$searchBranch."');");
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												$reIncomeDolla = 0;
												$reIncomeKhmer = 0;
												while($row=$db->fetch($select)){
													$TransactionID = $row->TransactionID;
													$ServiceTypeID = $row->ServiceTypeID;
													$ServiceTypeName = $row->ServiceTypeName;
													$Date = $row->Date;
													$CurrencyName = $row->CurrencyName;
													$Amt = number_format($row->Amt, 2, '.', '');
													$TotalCharge = number_format($row->TotalCharge, 2, '.', '');
													$Local_Branch_Charge = number_format($row->Local_Branch_Charge, 2, '.', '');
													$Another_Branch_Charge = number_format($row->Another_Branch_Charge, 2, '.', '');
													$Total_To_Paid = number_format($row->Total_To_Paid, 2, '.', '');
													$CurrencyNo = $row->CurrencyNo;
													$CurrencyName = $row->CurrencyName;
													$isClearPayment = $row->isClearPayment;
													$PayChargeType = $row->PayChargeType;
													
												echo'<tr class="even">
														<td>'.$i++.'</td>
														<td>'.$ServiceTypeName.'</td>
														<td>'.$Date.'</td>
														<td>'.$CurrencyName.'</td>
														<td>'.$Amt.'</td>
														<td>'.$TotalCharge.'</td>
														<td>'.$PayChargeType.'</td>
														<td>'.$Local_Branch_Charge.'</td>
														<td>'.$Another_Branch_Charge.'</td>
														<td>'.$Total_To_Paid.'</td>
														<td>';
														if($isClearPayment=='1'){
															echo '<input type="checkbox" checked name="'.$TransactionID.'" disabled />';
														}
														else{
															echo '<input type="checkbox" name="'.$TransactionID.'" />';
														}
														echo '</td>';
												echo '</tr>';
												} 
											}
											else
											{
												echo '<tr class="even">
														<td  colspan="10"><font size="+1" color="#CC0000"> No Products Selected.</font></td>
														</td>
													</tr>';	
											}
											
											$db->disconnect();
											$db->connect();
									   ?>    
                                            
                                    </tbody>
                                  <!--  <input type="checkbox" checked name="'.$TransactionID.'" >-->
                                   
                                </table>
                                </form>
                                
                                <table class="table table-striped table-bordered table-hover sortable" id="dataTables-example">
                                   	  <thead>
                                        <tr>
                                        	<th class="col-md-6"></th>
									  <?php
											$select=$db->query("SELECT CurrencyNo, `Name` as CurrencyName FROM `tblcurrency` ORDER BY CurrencyNo;");
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
													$CurrencyID = $row->CurrencyNo;
													$CurrencyName = $row->CurrencyName;
													echo '<td>'.$CurrencyName.'</td>';
												}
											}
										?>  
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="even">
                                        <td colspan="1"></td>
                                        
                                        <?php
											$select=$db->query("SELECT CurrencyNo, `Name` as CurrencyName FROM `tblcurrency` ORDER BY CurrencyNo");
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
													$CurrencyID = $row->CurrencyNo;
													$CurrencyName = $row->CurrencyName;
													//echo ' &nbsp;&nbsp;'.$CurrencyID;
													
													
													$db->disconnect();
													$db->connect();
													$seCurrency=$db->query("call spReport_Currency('".$cboTransaction."','".$searchBranch."','".$CurrencyID."');");
													$rCurrency=$db->dbCountRows($seCurrency);
													if($rCurrency>0){
														//$i = 1;
													    $reTotalCurrency = 0;
														while($row1=$db->fetch($seCurrency)){
															$reTotalCurrency += $row1->Total_To_Paid;	
														}
														echo '<td colspan="1">'.$reTotalCurrency.'</td>';
													}
													else
													{
														echo '<td colspan="1"> 0 </td>';
													}
													// End Second Loop
												}
											} // End First Loop
										?>
                                        
                                    </tr>
									</tbody>
                                 </table>
								<?php	
									$db->disconnect();
									$db->connect();
							   ?>  
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