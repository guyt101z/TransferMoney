
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
															$select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
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
                            <form>
                                <table class="table table-striped table-bordered table-hover sortable" id="dataTables-example">
                                   	   
                                     <thead>
                                        <tr>
                                        	<th>No</th>
                                        	<th>ServiceType</th>
                                            <th>Date</th>
                                            <th>Currency</th>
                                            <th>ATM</th>
                                            <th>Total Charge</th>
                                            <th>Local Charge</th> 
                                            <th>Another Charge</th>
                                            <th>Total</th>
                                            <th><!--<input type="checkbox" name="checkme">-->
                                            <input id="idall1" name="Hi" type="checkbox" onClick="Checkme1()" />
                                            	<script type="text/javascript">
													function Checkme1(){
														if (document.getElementById('idall1').checked){
															alert("checked") ;
														}else{
															alert("You didn't check it! Let me check it for you.")
														}
													}
												</script>
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
													/*if($CurrencyNo=='1434697930'){
														$reIncomeDolla += $Total_To_Paid;
													}
													else if($CurrencyNo=='1434698427'){
														$reIncomeKhmer += $Total_To_Paid;
													}*/
												echo'<tr class="even">
														<td>'.$i++.'</td>
														<td>'.$ServiceTypeName.'</td>
														<td>'.$Date.'</td>
														<td>'.$CurrencyName.'</td>
														<td>'.$Amt.'</td>
														<td>'.$TotalCharge.'</td>
														<td>'.$Local_Branch_Charge.'</td>
														<td>'.$Another_Branch_Charge.'</td>
														<td>'.$Total_To_Paid.'</td>
														<td><input type="checkbox" name="ck'.$TransactionID.'" ></td>';
												echo '</tr>';
												
	
												} 
												/*echo '<tr class="success">
														<td colspan="6">
															
														</td>
														<td colspan="2" class="success">
															<font size="+1">Dollar </fon> <font color="Red" size="+1"><br /><b>'.$reIncomeDolla.'</b></font>
														</td>
														<td colspan="3" class="success">
															<font size="+1">Khmer </font> <font color="Red" size="+1"><br /><b>'.$reIncomeKhmer.'</b></font>
														</td>
														
													 </tr>';*/
											}
											else
											{
												echo '<tr class="even">
														<td  colspan="10"><font size="+1" color="#CC0000"> No Products Selected.</font></td>
														</td>
													</tr>';	
											}
											/*echo '<tr class="even">
														<td colspan="5">
															
														</td>
														<td colspan="5">
														
														</td>
														
													 </tr>';*/
											$db->disconnect();
											$db->connect();
									   ?>    
                                            
                                    </tbody>
                                    
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