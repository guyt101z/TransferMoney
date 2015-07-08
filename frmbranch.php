
<?php include 'header.php';?>

<?php
		// Add new

		// update
		$txtBranchID = get('txtBranchID');
		$txtBranchName = get('txtBranchName');
		$txtDesc = get('txtDesc');
		$btnSave = get('btnSave');
		
		if(isset($_POST['btnSave'])){
			$txtBranchName = $_POST['txtBranchName'];
			$txtDescription	=	post('txtDescription');
			$insert=$db->query("INSERT INTO tblbranch (BranchID, BranchName, Decription) VALUES ('".time()."','".$txtBranchName."','".$txtDescription."'); ");
				
				if($insert){
					cRedirect('frmbranch.php');
				}
			$error = "Error Internet Connection!";
		}
		
		/*if(isset($_POST['btnSave'])){
			$txtBranchID = $_POST['txtBranchID'];
			$txtBranchName = $_POST['txtBranchName'];
			$txtDesc	=	post('txtDesc');
			
			
				
				if($updatebranch){
					cRedirect('frmbranch.php');
				}
				else
				{
					
				}
		}*/
		
		if($btnSave == 'SaveUpdate')
		{
			$updatebranch=$db->query("UPDATE tblbranch SET BranchName=N'".$txtBranchName."', Decription='".$txtDesc."' WHERE BranchID = '".$txtBranchID."'; ");
			if($updatebranch){
				cRedirect('frmbranch.php');
		 	}
			else
			{
				echo "<script type='text/javascript'>alert('មានបញ្ហាបន្តិចបន្តួច! សូមបញ្ចូលម្តងទៀត!')</script>";
			}
		}
		
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
                	<form enctype="multipart/form-data">
                          
                          <input type="hidden" name="txtBranchID" id="ServiceID">
                          
                          <div class="form-group">
                            	<label>Branch Name: </label>
                                <input name="txtBranchName" class="form-control"  id="txtServiceName" placeholder="Enter text" required autofocus />
                          </div>
                          
                          <div class="form-group">
                            	<label>Description: </label>
                                <textarea class="form-control" id="txtDescUpdate" name="txtDesc" placeholder="Enter Descriptiion" rows="3"></textarea>
                          </div>
                     
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="btnSave" value="SaveUpdate" />
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
                                            <th>Branch Name</th>
                                            <th>Description</th>
                                             <th>Action</th> 
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
                                    	
                                        
                                        <?php
											$select=$db->query("CALL spSearchBranch('".$txtSearch."');");
											
									   		$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$BranchID = $row->BranchID;
												$BranchName = $row->BranchName;
												$Decription = $row->Decription;
												
												echo'<tr class="even">
														<td>'.$i++.'</td>
														<td>'.$BranchName.'</td>
														<td>'.$Decription.'</td>
														<td class="center" >';
														echo "<a onclick=\"myOtherCost('".$BranchID."','".$BranchName."','".$Decription."')\">Update";
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
                        <h4 class="modal-title" id="exampleModalLabel">New Branch</h4>
                         
                      </div>
                      <div class="modal-body">
                        <form role="form" method="post" >
                           <div class="form-group">
                            	<label>Branch Name: </label>
                                <input name="txtBranchName" class="form-control" placeholder="Enter text" required autofocus />
                          </div>
                          <div class="form-group">
                            	<label>Description: </label>
                                <textarea class="form-control" name="txtDescription" placeholder="Enter Descriptiion" rows="3"></textarea>
                          </div>
                          
                     
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                            <input type="submit" name="btnSave" class="btn btn-primary" value="Save" />
                          </div>
                      </form>
                      
                    </div>
                  </div>
                </div>
                <!-- End New User -->
                    
                <script type="text/javascript">				
				
					  		var ServiceID = document.getElementById("ServiceID");
							var txtServiceName = document.getElementById("txtServiceName");
							var txtDescUpdate = document.getElementById("txtDescUpdate");
							
							//myOtherCost
							function myOtherCost(getServiceID,gettxtServiceName,getDescUpdate)
							{
								$('.bs-example-modal-sm').modal('show');
								ServiceID.value = getServiceID;
								txtServiceName.value = gettxtServiceName;
								txtDescUpdate.value = getDescUpdate;
								
							}
					   </script>
                
                <!-- Check Out -->

                <!-- End Check Out -->
                
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- add new calendar event modal -->
<?php include 'footer.php';?>