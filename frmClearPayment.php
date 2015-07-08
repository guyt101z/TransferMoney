
<?php include 'header.php';
	
	$getClear = get('btnClear');
	
	if($getClear=='ClearPayment'){
		$select=$db->query("call spReport('".$cboTransaction."','".$searchBranch."');");
		$rowselect=$db->dbCountRows($select);
		if($rowselect>0){
			echo 'Clear Payment .....';
			while($row=$db->fetch($select)){
				$TransactionID = $row->TransactionID;
				$getID = get("".$TransactionID."");
				if($getID == "on")
				{	
					$db->disconnect();
					$db->connect();
					
					$update1=$db->query("UPDATE tbltransaction SET isClearPayment = '1', 
					ClearPaymentDate='".$date_now."', ClearPayment_Description='' 
					WHERE TransactionID = '".$TransactionID."'");
				}
				/*if($TransactionID == get($TransactionID))
				{
					echo "<script type='text/javascript'>alert('It Work')</script>";	
				}*/
			}
			cRedirect('frmReport.php?cboTransaction='.$cboTransaction.'&txtFrom='.$txtFrom.'&txtTo='.$txtTo.'&searchBranch='.$searchBranch.'');
		}
	}
	else if($getClear=='All')
	{
		$select=$db->query("call spReport('".$cboTransaction."','".$searchBranch."');");
		$rowselect=$db->dbCountRows($select);
		if($rowselect>0){
			//echo 'Clear Payment .....';
			while($row=$db->fetch($select)){
				$TransactionID = $row->TransactionID;
				//$getID = get("".$TransactionID."");
					
					$db->disconnect();
					$db->connect();
					$update1=$db->query("UPDATE tbltransaction SET isClearPayment = '1', 
					ClearPaymentDate='".$date_now."', ClearPayment_Description='' 
					WHERE TransactionID = '".$TransactionID."'");
				/*if($TransactionID == get($TransactionID))
				{
					echo "<script type='text/javascript'>alert('It Work')</script>";	
				}*/
			}
			cRedirect('frmReport.php?cboTransaction='.$cboTransaction.'&txtFrom='.$txtFrom.'&txtTo='.$txtTo.'&searchBranch='.$searchBranch.'');
		}
	}		
  ?>
