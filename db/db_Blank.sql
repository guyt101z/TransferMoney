/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : db_transfertem

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2015-07-08 10:21:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tblbranch`
-- ----------------------------
DROP TABLE IF EXISTS `tblbranch`;
CREATE TABLE `tblbranch` (
  `BranchID` text,
  `BranchName` text,
  `Decription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblbranch
-- ----------------------------
INSERT INTO `tblbranch` VALUES ('1429759395', 'Owner', 'This is Branch Owner');

-- ----------------------------
-- Table structure for `tblcurrency`
-- ----------------------------
DROP TABLE IF EXISTS `tblcurrency`;
CREATE TABLE `tblcurrency` (
  `CurrencyNo` int(11) DEFAULT NULL,
  `Name` text,
  `Description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblcurrency
-- ----------------------------
INSERT INTO `tblcurrency` VALUES ('1434697930', 'Dollar', 'Dollar');
INSERT INTO `tblcurrency` VALUES ('1434698427', 'Khmer', 'Khmer');

-- ----------------------------
-- Table structure for `tblfilter`
-- ----------------------------
DROP TABLE IF EXISTS `tblfilter`;
CREATE TABLE `tblfilter` (
  `ID` text,
  `FromDate` datetime DEFAULT NULL,
  `ToDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblfilter
-- ----------------------------
INSERT INTO `tblfilter` VALUES ('1', '2015-06-28 10:06:00', '2015-07-08 23:57:20');

-- ----------------------------
-- Table structure for `tblservicetype`
-- ----------------------------
DROP TABLE IF EXISTS `tblservicetype`;
CREATE TABLE `tblservicetype` (
  `ServiceTypeID` int(11) DEFAULT NULL,
  `ServiceTypeName` text,
  `Description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblservicetype
-- ----------------------------
INSERT INTO `tblservicetype` VALUES ('1434361638', 'Transfer', 'Transfer');
INSERT INTO `tblservicetype` VALUES ('1434361713', 'Receive', 'Receive');

-- ----------------------------
-- Table structure for `tbltransaction`
-- ----------------------------
DROP TABLE IF EXISTS `tbltransaction`;
CREATE TABLE `tbltransaction` (
  `TransactionID` text,
  `UserID` text,
  `ServiceTypeID` text,
  `Local_BranchID` text,
  `Another_BranchID` text,
  `PhoneSender` text,
  `PhoneReceiver` text,
  `Code` text,
  `CurrencyNo` text,
  `Amt` float DEFAULT NULL,
  `Local_Branch_Charge` float DEFAULT NULL,
  `Another_Branch_Charge` float DEFAULT NULL,
  `TotalCharge` float DEFAULT NULL,
  `PayChargeType` text,
  `Total_To_Paid` float DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `isCancel` text,
  `Cancel_UserID` text,
  `Cancel_Date` datetime DEFAULT NULL,
  `Cancel_Description` text,
  `isClearPayment` text,
  `ClearPaymentDate` datetime DEFAULT NULL,
  `ClearPayment_Description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbltransaction
-- ----------------------------

-- ----------------------------
-- Table structure for `tblusers`
-- ----------------------------
DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE `tblusers` (
  `UserID` text,
  `BranchID` text,
  `UserName` text,
  `Password` text,
  `Level` int(11) DEFAULT NULL,
  `Decription` text,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblusers
-- ----------------------------
INSERT INTO `tblusers` VALUES ('1', '1429759395', 'admin', 'a09sNXhtNExpZ1MwZkJSY0wwVGxiQT09', '1', '', '1');

-- ----------------------------
-- View structure for `vreport`
-- ----------------------------
DROP VIEW IF EXISTS `vreport`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vreport` AS select `tbltransaction`.`TransactionID` AS `TransactionID`,`tbltransaction`.`ServiceTypeID` AS `ServiceTypeID`,`tbltransaction`.`Another_BranchID` AS `Another_BranchID`,`tblservicetype`.`ServiceTypeName` AS `ServiceTypeName`,`tbltransaction`.`Date` AS `Date`,`tbltransaction`.`Amt` AS `Amt`,`tbltransaction`.`TotalCharge` AS `TotalCharge`,`tbltransaction`.`Local_Branch_Charge` AS `Local_Branch_Charge`,`tbltransaction`.`Another_Branch_Charge` AS `Another_Branch_Charge`,`tbltransaction`.`Total_To_Paid` AS `Total_To_Paid`,`tbltransaction`.`CurrencyNo` AS `CurrencyNo`,`tbltransaction`.`isClearPayment` AS `isClearPayment`,`tblcurrency`.`Name` AS `CurrencyName`,`tbltransaction`.`PayChargeType` AS `PayChargeType` from ((`tbltransaction` join `tblservicetype` on((`tbltransaction`.`ServiceTypeID` = `tblservicetype`.`ServiceTypeID`))) join `tblcurrency` on((`tblcurrency`.`CurrencyNo` = `tbltransaction`.`CurrencyNo`))) ;

-- ----------------------------
-- Procedure structure for `prc_test`
-- ----------------------------
DROP PROCEDURE IF EXISTS `prc_test`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_test`(var INT)
BEGIN
    DECLARE  var2 INT;
    SET var2 = 1;
    SELECT  var2;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spReport`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spReport`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spReport`(IN 
_Transaction NVARCHAR(500), 
_AnotherBranch NVARCHAR(500))
BEGIN

	SET @FromDate = (SELECT FromDate FROM `tblfilter`);
	SET @ToDate = (SELECT ToDate FROM `tblfilter`);
	-- SELECT @FromDate;

	IF(_Transaction = "" AND _AnotherBranch = "") THEN
			SELECT * FROM vReport
			WHERE Date BETWEEN @FromDate AND @ToDate
			ORDER BY ServiceTypeName;
	
	ELSEIF (_Transaction = "" AND _AnotherBranch != "") THEN
			SELECT * FROM vReport
			WHERE  Another_BranchID = _AnotherBranch
			AND (Date BETWEEN @FromDate AND @ToDate)
			ORDER BY ServiceTypeName;
	ELSEIF (_Transaction != "" AND _AnotherBranch = "") THEN
			SELECT * FROM vReport
			WHERE ServiceTypeID = _Transaction
			AND (Date BETWEEN @FromDate AND @ToDate)
			ORDER BY ServiceTypeName;
	
	ELSE
		SELECT * FROM vReport
			WHERE
			ServiceTypeID = _Transaction AND Another_BranchID = _AnotherBranch
			AND (Date BETWEEN @FromDate AND @ToDate)
			ORDER BY ServiceTypeName;

	END IF;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spReport_copy1`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spReport_copy1`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spReport_copy1`(IN 
_Transaction NVARCHAR(500), 
_AnotherBranch NVARCHAR(500), 
_FromDate DATETIME, 
_ToDate DATETIME)
BEGIN
	IF(_Transaction = "" AND _AnotherBranch = "") THEN
			SELECT * FROM vReport
			WHERE Date BETWEEN _FromDate AND _ToDate
			ORDER BY ServiceTypeName;
	
	ELSEIF (_Transaction = "" AND _AnotherBranch != "") THEN
			SELECT * FROM vReport
			WHERE  Another_BranchID = _AnotherBranch
			AND (Date BETWEEN _FromDate AND _ToDate)
			ORDER BY ServiceTypeName;
	ELSEIF (_Transaction != "" AND _AnotherBranch = "") THEN
			SELECT * FROM vReport
			WHERE ServiceTypeID = _Transaction
			AND (Date BETWEEN _FromDate AND _ToDate)
			ORDER BY ServiceTypeName;
	
	ELSE
		SELECT * FROM vReport
			WHERE
			ServiceTypeID = _Transaction AND Another_BranchID = _AnotherBranch
			AND (Date BETWEEN _FromDate AND _ToDate)
			ORDER BY ServiceTypeName;

	END IF;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spReport_copy2`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spReport_copy2`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spReport_copy2`(IN 
_Transaction NVARCHAR(500), 
_AnotherBranch NVARCHAR(500))
BEGIN

	SET @FromDate = (SELECT FromDate FROM `tblfilter`);
	SET @ToDate = (SELECT ToDate FROM `tblfilter`);
	-- SELECT @FromDate;

	IF(_Transaction = "" AND _AnotherBranch = "") THEN
			SELECT * FROM vReport
			WHERE Date BETWEEN @FromDate AND @ToDate
			ORDER BY ServiceTypeName;
	
	ELSEIF (_Transaction = "" AND _AnotherBranch != "") THEN
			SELECT * FROM vReport
			WHERE  Another_BranchID = _AnotherBranch
			AND (Date BETWEEN @FromDate AND @ToDate)
			ORDER BY ServiceTypeName;
	ELSEIF (_Transaction != "" AND _AnotherBranch = "") THEN
			SELECT * FROM vReport
			WHERE ServiceTypeID = _Transaction
			AND (Date BETWEEN @FromDate AND @ToDate)
			ORDER BY ServiceTypeName;
	
	ELSE
		SELECT * FROM vReport
			WHERE
			ServiceTypeID = _Transaction AND Another_BranchID = _AnotherBranch
			AND (Date BETWEEN @FromDate AND @ToDate)
			ORDER BY ServiceTypeName;

	END IF;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spReport_Currency`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spReport_Currency`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spReport_Currency`(IN 
_Transaction NVARCHAR(500), 
_AnotherBranch NVARCHAR(500), _CurrencyType NVARCHAR(500))
BEGIN

	SET @FromDate = (SELECT FromDate FROM `tblfilter`);
	SET @ToDate = (SELECT ToDate FROM `tblfilter`);
	-- SELECT @FromDate;

	IF(_Transaction = "" AND _AnotherBranch = "") THEN
			SELECT * FROM vReport
			WHERE Date BETWEEN @FromDate AND @ToDate
			AND CurrencyNo = _CurrencyType 
			ORDER BY ServiceTypeName;
	
	ELSEIF (_Transaction = "" AND _AnotherBranch != "") THEN
			SELECT * FROM vReport
			WHERE  Another_BranchID = _AnotherBranch
			AND (Date BETWEEN @FromDate AND @ToDate)
			AND CurrencyNo = _CurrencyType
			ORDER BY ServiceTypeName;
	ELSEIF (_Transaction != "" AND _AnotherBranch = "") THEN
			SELECT * FROM vReport
			WHERE ServiceTypeID = _Transaction
			AND (Date BETWEEN @FromDate AND @ToDate)
			AND CurrencyNo = _CurrencyType
			ORDER BY ServiceTypeName;
	
	ELSE
		SELECT * FROM vReport
			WHERE
			ServiceTypeID = _Transaction AND Another_BranchID = _AnotherBranch
			AND (Date BETWEEN @FromDate AND @ToDate)
			AND CurrencyNo = _CurrencyType
			ORDER BY ServiceTypeName;

	END IF;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spSearchBranch`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spSearchBranch`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchBranch`(IN _Search NVARCHAR(500))
BEGIN
	IF(_Search = "") THEN
		SELECT BranchID, BranchName, Decription FROM `tblbranch`;
	ELSE
		SELECT BranchID, BranchName, Decription FROM `tblbranch` WHERE BranchName LIKE CONCAT(N'%' , _Search , '%');
	END IF;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spSearchCurrency`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spSearchCurrency`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchCurrency`(IN _Search NVARCHAR(500))
BEGIN
	IF(_Search = "") THEN
		SELECT CurrencyNo, `Name`, Description FROM `tblcurrency`;
	ELSE
		SELECT CurrencyNo, `Name`, Description FROM `tblcurrency` WHERE `Name` LIKE CONCAT(N'%' , _Search , '%');
	END IF;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spSearchPrdBuy`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spSearchPrdBuy`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchPrdBuy`(IN _SearchPrdBuy NVARCHAR(500))
BEGIN
	IF(_SearchPrdBuy = "") THEN
		SELECT 
			`tblproducts`.ProductID,
			`tblproducts`.ProductName,
			`tblproducts`.ProductCategoryID,
			tblproductcategory.ProductCategoryName,
			`tblproducts`.ProductCode,
			`tblproducts`.Qty,
			`tblproducts`.BuyPrice,
			`tblproducts`.SalePrice,
			tblproductsbranch.OtherCost,
			tblproductsbranch.Decription
			FROM `tblproducts`
			INNER JOIN tblproductcategory
			ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
		INNER JOIN tblproductsbranch
		ON tblproductsbranch.ProductID = tblproducts.ProductID
		WHERE tblproductsbranch.Qty >0
		LIMIT 7;
	ELSE
		SELECT 
			`tblproducts`.ProductID,
			`tblproducts`.ProductName,
			`tblproducts`.ProductCategoryID,
			tblproductcategory.ProductCategoryName,
			`tblproducts`.ProductCode,
			`tblproducts`.Qty,
			`tblproducts`.BuyPrice,
			`tblproducts`.SalePrice,
			tblproductsbranch.OtherCost,
			tblproductsbranch.Decription
			FROM `tblproducts`
			INNER JOIN tblproductcategory
			ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
			INNER JOIN tblproductsbranch
			ON tblproductsbranch.ProductID = tblproducts.ProductID
			WHERE  
			tblproducts.ProductName LIKE CONCAT(N'%' , _SearchPrdBuy , '%')
			OR tblproducts.ProductCode LIKE CONCAT(N'%' , _SearchPrdBuy , '%')
			AND tblproductsbranch.Qty >0;

	END IF;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spSearchReciever`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spSearchReciever`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchReciever`(IN _Search NVARCHAR(500))
BEGIN
	IF(_Search = "") THEN
		SELECT tbltransaction.TransactionID, 
			tbltransaction.UserID, 
			tbltransaction.ServiceTypeID,
			(SELECT tblservicetype.ServiceTypeName FROM tblservicetype WHERE tblservicetype.ServiceTypeID = tbltransaction.ServiceTypeID) AS ServiceTypeName,
			tbltransaction.Local_BranchID,
			(SELECT tblbranch.BranchName FROM tblbranch WHERE tblbranch.BranchID = tbltransaction.Local_BranchID) AS Local_BranchName,
			tbltransaction.Another_BranchID,
			(SELECT tblbranch.BranchName FROM tblbranch WHERE tblbranch.BranchID = tbltransaction.Another_BranchID) AS Another_BranchName,
			tbltransaction.PhoneSender, 
			tbltransaction.PhoneReceiver, 
			tbltransaction.`Code`, 
			tbltransaction.CurrencyNo,
			(SELECT tblcurrency.`Name` FROM tblcurrency WHERE tblcurrency.CurrencyNo = tbltransaction.CurrencyNo) AS CurrencyName,
			tbltransaction.Amt, 
			tbltransaction.Local_Branch_Charge, 
			tbltransaction.Another_Branch_Charge, 
			tbltransaction.TotalCharge, 
			tbltransaction.PayChargeType, 
			tbltransaction.Total_To_Paid, 
			tbltransaction.isCancel, 
			tbltransaction.isClearPayment
			FROM `tbltransaction`
			WHERE ServiceTypeID = '1434361713' 
			ORDER BY tbltransaction.TransactionID DESC
			LIMIT 5;
	ELSE
		SELECT tbltransaction.TransactionID, 
		tbltransaction.UserID, 
		tbltransaction.ServiceTypeID,
		(SELECT tblservicetype.ServiceTypeName FROM tblservicetype WHERE tblservicetype.ServiceTypeID = tbltransaction.ServiceTypeID) AS ServiceTypeName ,
		tbltransaction.Local_BranchID,
		(SELECT tblbranch.BranchName FROM tblbranch WHERE tblbranch.BranchID = tbltransaction.Local_BranchID ) AS Local_BranchName,
		tbltransaction.Another_BranchID,
		(SELECT tblbranch.BranchName FROM tblbranch WHERE tblbranch.BranchID = tbltransaction.Another_BranchID) AS Another_BranchName,
		tbltransaction.PhoneSender, 
		tbltransaction.PhoneReceiver, 
		tbltransaction.`Code`, 
		tbltransaction.CurrencyNo,
		(SELECT tblcurrency.`Name` FROM tblcurrency WHERE tblcurrency.CurrencyNo = tbltransaction.CurrencyNo) AS CurrencyName,
		tbltransaction.Amt, 
		tbltransaction.Local_Branch_Charge, 
		tbltransaction.Another_Branch_Charge, 
		tbltransaction.TotalCharge, 
		tbltransaction.PayChargeType, 
		tbltransaction.Total_To_Paid, 
		tbltransaction.isCancel, 
		tbltransaction.isClearPayment
		FROM `tbltransaction`
		INNER JOIN tblservicetype
		ON tblservicetype.ServiceTypeID = tbltransaction.ServiceTypeID
		INNER JOIN tblbranch
		ON tblbranch.BranchID = tbltransaction.Local_BranchID
		INNER JOIN tblbranch C
		ON C.BranchID= tbltransaction.Another_BranchID 
		WHERE (tbltransaction.`Code` LIKE  CONCAT(N'%' , _Search , '%')
		OR tbltransaction.PhoneSender LIKE  CONCAT(N'%' , _Search , '%')
		OR tbltransaction.PhoneReceiver LIKE  CONCAT(N'%' , _Search , '%'))
		AND tbltransaction.ServiceTypeID = '1434361713'
		ORDER BY tbltransaction.TransactionID DESC
;
	END IF;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spSearchServiceType`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spSearchServiceType`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchServiceType`(IN _SearchServiceType NVARCHAR(500))
BEGIN
	IF(_SearchServiceType = "") THEN
		SELECT ServiceTypeID, ServiceTypeName, Description FROM `tblservicetype`;
	ELSE
		SELECT ServiceTypeID, ServiceTypeName, Description FROM `tblservicetype` WHERE ServiceTypeName LIKE CONCAT(N'%' , _SearchServiceType , '%');

	END IF;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spSearchTransfer`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spSearchTransfer`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchTransfer`(IN _Search NVARCHAR(500))
BEGIN
	IF(_Search = "") THEN
		SELECT tbltransaction.TransactionID, 
			tbltransaction.UserID, 
			tbltransaction.ServiceTypeID,
			(SELECT tblservicetype.ServiceTypeName FROM tblservicetype WHERE tblservicetype.ServiceTypeID = tbltransaction.ServiceTypeID) AS ServiceTypeName,
			tbltransaction.Local_BranchID,
			(SELECT tblbranch.BranchName FROM tblbranch WHERE tblbranch.BranchID = tbltransaction.Local_BranchID) AS Local_BranchName,
			tbltransaction.Another_BranchID,
			(SELECT tblbranch.BranchName FROM tblbranch WHERE tblbranch.BranchID = tbltransaction.Another_BranchID) AS Another_BranchName,
			tbltransaction.PhoneSender, 
			tbltransaction.PhoneReceiver, 
			tbltransaction.`Code`, 
			tbltransaction.CurrencyNo,
			(SELECT tblcurrency.`Name` FROM tblcurrency WHERE tblcurrency.CurrencyNo = tbltransaction.CurrencyNo) AS CurrencyName,
			tbltransaction.Amt, 
			tbltransaction.Local_Branch_Charge, 
			tbltransaction.Another_Branch_Charge, 
			tbltransaction.TotalCharge, 
			tbltransaction.PayChargeType, 
			tbltransaction.Total_To_Paid, 
			tbltransaction.isCancel, 
			tbltransaction.isClearPayment
			FROM `tbltransaction`
			WHERE ServiceTypeID = '1434361638'
			ORDER BY tbltransaction.TransactionID DESC
		  LIMIT 5;
	ELSE
		SELECT tbltransaction.TransactionID, 
		tbltransaction.UserID, 
		tbltransaction.ServiceTypeID,
		(SELECT tblservicetype.ServiceTypeName FROM tblservicetype WHERE tblservicetype.ServiceTypeID = tbltransaction.ServiceTypeID) AS ServiceTypeName ,
		tbltransaction.Local_BranchID,
		(SELECT tblbranch.BranchName FROM tblbranch WHERE tblbranch.BranchID = tbltransaction.Local_BranchID ) AS Local_BranchName,
		tbltransaction.Another_BranchID,
		(SELECT tblbranch.BranchName FROM tblbranch WHERE tblbranch.BranchID = tbltransaction.Another_BranchID) AS Another_BranchName,
		tbltransaction.PhoneSender, 
		tbltransaction.PhoneReceiver, 
		tbltransaction.`Code`, 
		tbltransaction.CurrencyNo,
		(SELECT tblcurrency.`Name` FROM tblcurrency WHERE tblcurrency.CurrencyNo = tbltransaction.CurrencyNo) AS CurrencyName,
		tbltransaction.Amt, 
		tbltransaction.Local_Branch_Charge, 
		tbltransaction.Another_Branch_Charge, 
		tbltransaction.TotalCharge, 
		tbltransaction.PayChargeType, 
		tbltransaction.Total_To_Paid, 
		tbltransaction.isCancel, 
		tbltransaction.isClearPayment
		FROM `tbltransaction`
		INNER JOIN tblservicetype
		ON tblservicetype.ServiceTypeID = tbltransaction.ServiceTypeID
		INNER JOIN tblbranch
		ON tblbranch.BranchID = tbltransaction.Local_BranchID
		INNER JOIN tblbranch C
		ON C.BranchID= tbltransaction.Another_BranchID 
		WHERE (tbltransaction.`Code` LIKE  CONCAT(N'%' , _Search , '%')
	OR tbltransaction.PhoneSender LIKE  CONCAT(N'%' , _Search , '%')
	OR tbltransaction.PhoneReceiver LIKE  CONCAT(N'%' , _Search , '%'))
	AND tbltransaction.ServiceTypeID = '1434361638'
	ORDER BY tbltransaction.TransactionID DESC
;
	END IF;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sptest`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sptest`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sptest`()
BEGIN
	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spUserAccSelete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spUserAccSelete`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserAccSelete`(_UserName NVARCHAR(500),
_UserPwd NVARCHAR(500))
BEGIN
 
SELECT tblusers.UserID,
tblusers.BranchID,
tblusers.UserName,
tblusers.`Password` AS UserPassword,
tblusers.`Level` AS UserLever,
tblusers.`Status` AS UserStatus,
tblbranch.BranchName
 FROM tblusers INNER JOIN tblbranch
ON tblusers.BranchID = tblbranch.BranchID
WHERE tblusers.UserName = _UserName 
AND tblusers.`Password` = _UserPwd 
AND tblusers.`STATUS` = 1;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Branch_Delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Branch_Delete`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Branch_Delete`(IN  _BranchID NVARCHAR(50))
BEGIN
	DELETE From tblbranch 
	WHERE BranchID=_BranchID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Branch_Select`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Branch_Select`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Branch_Select`(IN  _Search NVARCHAR(50))
BEGIN

IF (_Search="") THEN
	SELECT 	
	BranchID,
	BranchName,
	Decription 
	From tblbranch
	WHERE BranchID != 0;
ELSE 
	SELECT 	
	BranchID,
	BranchName,
	Decription 
	From tblbranch 
	WHERE (BranchName Like CONCAT('%' , _Search , '%') OR Decription Like CONCAT('%' , _Search , '%')  )
	AND BranchID != 0;
END IF;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Branch_Update`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Branch_Update`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Branch_Update`(IN  _BranchID NVARCHAR(50),_BranchName NVARCHAR(100),_Decription NVARCHAR(250))
BEGIN
	UPDATE tblbranch SET
			BranchName=_BranchName,
			Decription=_Decription
	WHERE BranchID=_BranchID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Insert_Branch`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Insert_Branch`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Insert_Branch`(IN 
_BranchID NVARCHAR(50),
_BranchName NVARCHAR(100),
_Decription NVARCHAR(500))
BEGIN

INSERT INTO tblbranch(
	BranchID,
	BranchName,
	Decription
	
)
	VALUES ( 
	_BranchID,
	_BranchName,
	_Decription
	
);

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Insert_UserAccount`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Insert_UserAccount`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Insert_UserAccount`(IN  _UserID  NVARCHAR(100),_BranchID  NVARCHAR(50),_UserName  NVARCHAR(100),_Password  NVARCHAR(100), _Level int,_Decription NVARCHAR(500),_Status int)
BEGIN

INSERT INTO tblusers(
  UserID,
	BranchID,
	UserName,
	Password,
	Level,
	Decription,
	Status
)
	VALUES ( 
	_UserID,
	_BranchID,
	_UserName,	
	_Password,
	_Level,
	_Decription,
	_Status

);

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_UserAccount_Delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_UserAccount_Delete`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UserAccount_Delete`(IN  _UserID  NVARCHAR(100))
BEGIN
	DELETE From tblusers 
  WHERE UserID=_UserID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_UserAccount_Select`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_UserAccount_Select`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UserAccount_Select`(IN  _Search NVARCHAR(100))
BEGIN

IF (_Search="") THEN
	SELECT 	
	UserID,
	BranchID,
	UserName,
	Password,
	Level,
	Decription,
	Status	
	From tblusers;
ELSE 
	SELECT 	
		UserID,
		BranchID,
		UserName,
		Password,
		Level,
		Decription,
		Status
	From tblusers 
	WHERE (UserName Like CONCAT('%' , _Search , '%') OR Decription Like CONCAT('%' , _Search , '%')  );
END IF;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_UserAccount_Select_By_ID`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_UserAccount_Select_By_ID`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UserAccount_Select_By_ID`(IN  _BranchID NVARCHAR(100))
BEGIN

	SELECT 	
	UserID,
	BranchID,
	UserName,
	Password,
	Level,
	Decription,
	Status	
	From tblusers
	WHERE BranchID=_BranchID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_UserAccount_Update`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_UserAccount_Update`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UserAccount_Update`(IN  _UserID  NVARCHAR(100),_BranchID  NVARCHAR(50),_UserName  NVARCHAR(100), _Level int,_Decription NVARCHAR(500),_Status int)
BEGIN
	UPDATE tblusers SET
			BranchID =_BranchID,
			UserName=_UserName,
			Level=_Level,
			Decription=_Decription,
			Status=_Status
	WHERE UserID=_UserID;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for `PageCount`
-- ----------------------------
DROP FUNCTION IF EXISTS `PageCount`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `PageCount`( value INT ) RETURNS varchar(10) CHARSET utf8
    DETERMINISTIC
BEGIN

   DECLARE level varchar(20);

   IF value < 500 THEN
      SET level = 'Low';

   ELSEIF value >= 500 AND value <= 4000 THEN
      SET level = 'Medium';

   ELSE
      SET level = 'High';

   END IF;

   RETURN level;

END
;;
DELIMITER ;
