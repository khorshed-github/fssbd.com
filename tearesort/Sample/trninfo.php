<html>
<head>
<title>Transaction Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="default.css" />
</head>

<body>
<div class="form_container">
<form method="POST" action="encrypt.php">
<fieldset>
<?php
$action = $_POST["action"];
?>

<b>Provide the following data (fields with * are mandatory)</b><br />

<?php if($action == "SaleTxn") { ?>
<label for="cur">Currency Code</label><input type="text" name="cur" size="20" value="" maxlength="3"> *<br />
<label for="mer_id">Merchant ID</label><input type="text" name="mer_id" size="20" value="" maxlength="20"> *<br />
<label for="mer_txn_id">Merchant Reference ID</label><input type="text" name="mer_txn_id" size="20" value="" maxlength="20"> *<br />
<label for="mer_amt">Transaction Amount</label><input type="text" name="txn_amt" size="20" value="" maxlength="12"> *<br />
<label for="ret_url">Return URL</label><input type="text" name="ret_url" size="30" value="" maxlength="50">/decrypt.php <br />
E.g. http://localhost/merchant/decrypt.php<br />

<label for="mer_var1">Merchant Variable 1</label><input type="text" name="mer_var1" size="20" value="" maxlength="50"><br />
<label for="mer_var2">Merchant Variable 2</label><input type="text" name="mer_var2" size="20" value="" maxlength="50"><br />
<label for="mer_var3">Merchant Variable 3</label><input type="text" name="mer_var3" size="20" value="" maxlength="50"><br />
<label for="mer_var4">Merchant Variable 4</label><input type="text" name="mer_var4" size="20" value="" maxlength="50"><br />

<?php } if($action == "SaleMerchUpdated") { ?>  
<label for="ipg_txn_id">IPG Transaction ID</label><input type="text" name="ipg_txn_id" size="20" value="" maxlength="30"> *<br />
<label for="mer_id">Merchant ID</label><input type="text" name="mer_id" size="20" value="" maxlength="20"> *<br />
<label for="mer_txn_id">Merchant Reference ID</label><input type="text" name="mer_txn_id" size="20" value="" maxlength="20"> *<br />
<label for="ret_url">Return URL</label><input type="text" name="ret_url" size="30" value="" maxlength="50">/decrypt.php<br />
E.g. http://localhost/merchant/decrypt.php<br />
    
<?php } if($action == "SaleTxnVerify") { ?>
<label for="mer_id">Merchant ID</label><input type="text" name="mer_id" size="20" value="" maxlength="20"> *<br />
<label for="mer_txn_id">Merchant Reference ID</label><input type="text" name="mer_txn_id" size="20" value="" maxlength="20"> *<br />
<label for="ret_url">Return URL</label><input type="text" name="ret_url" size="30" value="" maxlength="50">/decrypt.php<br />
E.g. http://localhost/merchant/decrypt.php<br />
<?php } ?>
    
<label for="ipg_server_url">IPG Server URL</label><input type="text" name="ipg_server_url" size="30" value="(Type domain name or IP)" maxlength="50">/ipg/servlet_pay<br />
E.g. https://www.IPGServer.com/ipg/servlet_pay<br />
</fieldset>
<input type = "hidden" Value = "<?php echo $action;?>" name= "action">
<input type="submit" value="Encrypt" name="B">


</form>
</div>

</body>
</html>