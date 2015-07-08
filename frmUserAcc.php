
<?php include 'header.php';?>

<?php
	
	if(isset($_POST['btnSaveSalling'])){
	
		$autoid = time();
		$ProductID = get('txtProductID');	
		$ProductName = get('txtprdname');
		$ProductCategoryID = get('txtProductCategoryID');
		$ProductCode = get('txtProductCode');
		$QTY = get('txtQty');
		$BuyPrice = get('txtbuyprice');
		$SalePrice = get('txtsaleprice');	
		
			/*Create Invoice Customer Sale*/
			$InsertToCustomerOrder=$db->query(" INSERT INTO tbl_customerorder ( 
					CustomerOrderID,
					BranchID,
					InvoiceNo,
					CustomerOrderDate,
					UserID
					)
					VALUES
					(
					'".$autoid."',
					'".$U_Brandid."',
					'".$autoid."',
					'".$date_now."',
					'".$U_id."'
					)");
									
			/* $insertCustomerOrderdetail = $db->query("INSERT INTO `tbl_customerorderdetail`(
					CustomerOrderDetailID,
					BranchID,
					CustomerOrderID,
					ProductID,
					Qty,
					SalePrice,
					BuyPrice,
					perDicount,
					AmtDiscount,
					LastSalePrice,
					Total,
					Decription
					)
					VALUES
					(
					'".time().'2'."',
					'".$U_Brandid."',
					'".$autoid."',
					'".$ProductID."',
					'1',
					'".$SalePrice."',
					'".$BuyPrice."',
					'0',
					'0',
					'0',
					'',
					'Powered by 7Technology'
					)	
				");
									
			 $deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - 1 WHERE ProductID = '".$ProductID."' ");*/
			 if($InsertToCustomerOrder){
				cRedirect('index.php');
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
                               	
                                   <button class="btn btn-success" type="submit" data-toggle="modal" data-target="#Order"><i class="glyphicon glyphicon-plus"></i></button>
                              
                            </div>
                            
                           <div class="col-md-3 pull-right">
                                <form  role="search" >
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" value="<?php echo $sarchprd; ?>" name="txtSearchUser" >
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
                	<form enctype="multipart/form-data" action="savedirectOtherCost.php">
                          
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
                            	
                                <table class="table table-striped table-bordered table-hover sortable" id="dataTables-example">
                                   	
                                    <thead>
                                        <tr>
                                            <th>UserName</th>
                                            <th>BranchName</th>
                                            <th>UserType</th>
                                            <th>Status</th>
                                            <th>Action</th> 
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
                                    	
                                        
                                        <?php
											$select=$db->query("SELECT tblusers.UserID, 
											tblusers.BranchID, 
											tblbranch.BranchName, 
											tblusers.UserName, 
											tblusers.`Password`, 
											tblusers.`Level`,
											tblusers.`Status`
											FROM `tblusers`
											INNER JOIN tblbranch
											ON tblusers.BranchID = tblbranch.BranchID");
											
									   		$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$UserID = $row->UserID;
												$BranchName = $row->BranchName;
												$UserName = $row->UserName;
												$Level = $row->Level;
												$Status = $row->Status;
												if($Level== 1)
												{
													$Level= 'Admin';
												}
												else
												{
													$Level= 'User';
												}
												if($Status == 1){
													$Status = "Action";
												}
												else{
													$Status = "Suspend";
												}
												
												echo'<tr class="even">
														<td>'.$UserName.'</td>
														<td>'.$BranchName.'</td>
														<td>'.$Level.'</td>
														<td class="center"> '.$Status.'</td>
														<td class="center" >';
														
														echo "<a onclick=\"myOtherCost('','')\">Update";
														echo '</a>
														
														</td>
														
														
												
													</tr>';
													
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
               <div class="modal fade" id="Order" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">                    
                  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New Product</h4>
                         
                      </div>
                      <div class="modal-body">
                        <form enctype="multipart/form-data" action="savedirectsalling.php">
                          
                          <input type="hidden" name="txtProductID" id="ProductIDSale">
                          <input type="hidden" name="txtProductCategoryID" id="ProductCategoryID">
                          <input type="hidden" name="txtProductCode" id="ProductCode">
                          <input type="hidden" name="txtQty" value="1">
                          
                          <div class="form-group">
                            	<label>Product Name: </label>
                                <input name="txtprdname" class="form-control" readonly id="txtPrdName" placeholder="Enter text" required autofocus />
                          </div>
                          <div class="form-group">
                                <label>Buy Price:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon">$</span>
                                <input type="text" name="txtbuyprice"  onkeypress="return isNumberKey(event)"   required   class="form-control" id="buyprice" />
                            	</div>
                          </div>
                          <div class="form-group">
                                <label>Sale Price:</label>
                                
                                <div class="input-group">
                                  <div class="input-group-addon">$</div>
                                  <input type="text"  name="txtsaleprice" onKeyUp="ChangetoKhmer()" id="dolar" onKeyPress="return isNumberKey(event)"   class="form-control " />
                                </div>
                                <div class="input-group">
                                  <div class="input-group-addon">KH</div>
                                   <input type="text" name="txtsaleprice1" onKeyUp="ChangetoDolar()" id="khmer" onKeyPress="return isNumberKey(event)"  class="form-control "  />
                                </div>
                                
                                
                          </div>
                          
                          <div class="form-group">
                            	<label>Other Cost: </label>
                                
                                <div class="input-group">
                                  <div class="input-group-addon">$</div>
                                  <input name="txtOtherCost" class="form-control" id="txtOtherCostdollarSale" onKeyUp="ChangeOtherCostDolarSale()" placeholder="Enter Cost($)" required autofocus />
                                </div>
                                <div class="input-group">
                                  <div class="input-group-addon">KH</div>
                                  <input name="txtOtherCost1" class="form-control" id="txtOtherCostrealSale" onKeyUp="ChangeOtherCostRealSale()" placeholder="Enter Cost(R)"  autofocus />
                                </div>
                          </div>
                          
                          <div class="form-group">
                            	<label>Description: </label>
                                <textarea class="form-control" id="txtDescSale" name="txtDesc" placeholder="Enter Descriptiion" rows="3"></textarea>
                          </div>
                          
                     
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                            <input type="submit" name="btnSaveSalling" class="btn btn-primary" value="Save" />
                          </div>
                      </form>
                      
                    </div>
                  </div>
                </div>
                <!-- End New User -->
                    
                <script type="text/javascript">				
				
					  		var dolar = document.getElementById("dolar");
							var khmer = document.getElementById("khmer");
							var txtPrdName = document.getElementById("txtPrdName");
							var txtbuyprice = document.getElementById("buyprice");
							var txtProductID = document.getElementById("ProductID");
							var txtProductCategoryID = document.getElementById("ProductCategoryID");
							var txtProductCode = document.getElementById("ProductCode");
							var txtdolarbuying = document.getElementById("dolarbuying");
							var txtkhmerbuying = document.getElementById("khmerbuying");
							
							var txtkhmerSalling = document.getElementById("khmerSalling");
							var txtdolarSalling = document.getElementById("dolarSalling");
							
							var txtDesc = document.getElementById("txtDesc");
							var txtOtherCostdollar = document.getElementById("txtOtherCostdollar");
							var txtOtherCostreal = document.getElementById("txtOtherCostreal");
							var ProductIDSale = document.getElementById("ProductIDSale");
							
							var txtDescSale = document.getElementById("txtDescSale");
							var txtOtherCostdollarSale = document.getElementById("txtOtherCostdollarSale");
							var txtOtherCostrealSale = document.getElementById("txtOtherCostrealSale");
							
							//myOtherCost
							function myOtherCost(getProductID,getOtherCost,getDecription)
							{
								$('.bs-example-modal-sm').modal('show');
								txtProductID.value = getProductID;
								txtOtherCostdollar.value = getOtherCost;
								txtDesc.value = getDecription;
								txtOtherCostreal.value = parseFloat(txtOtherCostdollar.value) * 4 ;
							}
							
							function ChangeOtherCostDolar() {
								if(txtOtherCostdollar.value == '')
								{
									txtOtherCostreal.value = 0;
								}
								else
								{
									txtOtherCostreal.value = parseFloat(txtOtherCostdollar.value) * 4 ;
								}
							}
							
							
							function ChangeOtherCostReal() {
								if(txtOtherCostreal.value == '')
								{
									txtOtherCostdollar.value = 0;
								}
								else
								{
									txtOtherCostdollar.value = parseFloat(txtOtherCostreal.value) / 4 ;
								}
							}
							
							
							/*-----------------------------------------------------------------------------------------*/
							// Create Function to get Value for Sale Products
							//'".$OtherCost."','".$Decription."'
							function myfunction(getProductID,getProductName,getProductCategoryID,getProductCode,getQty, getBuyPrice, getSalePrice, getOtherCost, getDecription)
							{
								$('#Order').modal('show');
								//alert(getProductID + getProductID + getProductCategoryID + getQty)
								ProductIDSale.value = getProductID;
								txtPrdName.value = getProductName;
								txtbuyprice.value = getBuyPrice;
								dolar.value = getSalePrice;
								
								txtProductCategoryID.value = getProductCategoryID;
								txtProductCode.value = getProductCode;
								txtOtherCostdollarSale.value = getOtherCost;
								txtDescSale.value = getDecription;
								
								txtOtherCostrealSale.value = parseFloat(txtOtherCostdollarSale.value) * 4;
								khmer.value = parseFloat(dolar.value) * 4 ;
							}
							
							// Change Form Other Cost Dollar
							function ChangeOtherCostDolarSale() {
								if(txtOtherCostdollarSale.value == '')
								{
									txtOtherCostrealSale.value = 0;
								}
								else
								{
									txtOtherCostrealSale.value = parseFloat(txtOtherCostdollarSale.value) * 4 ;
								}
							}
							
							// Change Form Other Cost Real
							function ChangeOtherCostRealSale() {
								if(txtOtherCostrealSale.value == '')
								{
									txtOtherCostdollarSale.value = 0;
								}
								else
								{
									txtOtherCostdollarSale.value = parseFloat(txtOtherCostrealSale.value) / 4 ;
								}
							}
							
							// Change Form Khmer to Dolar Salling
							function ChangetoDollaSalling() {
								if(txtkhmerSalling.value == '')
								{
									txtdolarSalling.value = 0;
								}
								else
								{
									txtdolarSalling.value = parseFloat(txtkhmerSalling.value) / 4 ;
								}
							}
							
							// Change Form Dolar to Khmer Salling
							function ChangetoKhmerSalling() {
								if(txtdolarSalling.value == '')
								{
									txtkhmerSalling.value = 0;
								}
								else
								{
									txtkhmerSalling.value = parseFloat(txtdolarSalling.value) * 4 ;
								}
							}
							
							// Change Form Khmer to Dolar Buying
							function ChangetoDolarbuying() {
								if(txtkhmerbuying.value == '')
								{
									txtdolarbuying.value = 0;
								}
								else
								{
									txtdolarbuying.value = parseFloat(txtkhmerbuying.value) / 4 ;
								}
							}
							// Change Form Dolar to Khmer Buying
							function ChangetoKhmerbuying() {
								if(txtdolarbuying.value == '')
								{
									txtkhmerbuying.value = 0;
								}
								else
								{
									txtkhmerbuying.value = parseFloat(txtdolarbuying.value) * 4 ;
								}
							}			
							function ChangetoKhmer() {
									
									if(dolar.value == '')
									{
										khmer.value = 0;
									}
									else
									{
										khmer.value = parseFloat(dolar.value) * 4;
									}
								}
							function ChangetoDolar(){
								
								if(khmer.value == '')
								{
									dolar.value = 0;
								}
								else
								{
									dolar.value = parseFloat(khmer.value) / 4;
								}
							}
					   </script>
                
                <!-- Check Out -->

                <!-- End Check Out -->
                
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- add new calendar event modal -->
<?php include 'footer.php';?>