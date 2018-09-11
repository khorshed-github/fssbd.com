<?php
/**
 * Encrypt Transaction info and send to IPG server
 * PHP version 4 and 5
 * @author       Sanjeewa Jayasinghe <sanjeewaj@interblocks.com>
 * @copyright  Interblocks - http://www.interblocks.com
 * @license    
 */

/**
* Initializing
* IPG client IP, port and socket variables 
*/

$IPGClientIP = "103.48.119.138";
$IPGClientPort = "10000";

$ERRNO = "";
$ERRSTR = "";
$SOCKET_TIMEOUT = 2;
$IPGSocket = "";

$error_message = "";
$invoice_sent_error = "";
$encryption_ERR = "";

$Invoice = "";
$EncryptedInvoice = "";

$IPGServerURL = $_POST["ipg_server_url"]."/ipg/servlet_pay";

/**
* Create invoice for sale transaction
*/
//if($_POST["action"] == "SaleTxn") {
    $currencyCode = $_POST["cur"];
    $MerchantID = $_POST["mer_id"];
    $MerchantRefID = $_POST["mer_txn_id"];
    $TxnAmount = $_POST["txn_amt"];
    $ReturnURL = $_POST["ret_url"];

    $MerchantVar1 = $_POST["mer_var1"];
    $MerchantVar1 = $_POST["mer_var2"];
    $MerchantVar1 = $_POST["mer_var3"];
    $MerchantVar1 = $_POST["mer_var4"];

    $Invoice = "";
    $Invoice .= "<req>".
                    "<mer_id>" . $MerchantID . "</mer_id>".
                    "<mer_txn_id>" .$MerchantRefID. "</mer_txn_id>".
                    //"<action>" . $_POST["action"] . "</action>".
		    "<txn_amt>" . $TxnAmount . "</txn_amt>".
		    "<cur>" . $currencyCode . "</cur>" .
		    "<lang>en</lang>";

    if($ReturnURL != "") {
       $Invoice .= "<ret_url>" . $ReturnURL . "/decrypt.php</ret_url>"; 
    }

    if($MerchantVar1 != "") {
        $Invoice .= "<mer_var1>" .$MerchantVar1. "</mer_var1>";
    }

    if($MerchantVar2 != "") {
        $Invoice .= "<mer_var2>" .$MerchantVar2. "</mer_var2>";
    }

    if($MerchantVar3 != "") {
        $Invoice .= "<mer_var3>" .$MerchantVar3. "</mer_var3>";
    }

    if($MerchantVar4 != "") {
        $Invoice .= "<mer_var4>" .$MerchantVar4. "</mer_var4>";
    }

    $Invoice .= "</req>";
//}

/**
* Create invoice for sale merchant updated
*/
if($_POST["action"] == "SaleMerchUpdated") {
    $MerchantID = $_POST["mer_id"];
    $MerchantRefID = $_POST["mer_txn_id"];;
    $IPGTransactionID = $_POST["ipg_txn_id"];
    $ReturnURL = $_POST["ret_url"];

    $Invoice = "";
    $Invoice .= "<req>".
                    "<mer_id>" . $MerchantID . "</mer_id>".
                    "<mer_txn_id>" .$MerchantRefID. "</mer_txn_id>".
                    "<action>" . $_POST["action"] . "</action>".
		    "<ipg_txn_id>" .$IPGTransactionID. "</ipg_txn_id>";

    if($ReturnURL != "") {
       $Invoice .= "<ret_url>" . $ReturnURL . "/decrypt.php</ret_url>"; 
    }

    $Invoice .= "</req>";
}

/**
* Create invoice for sale transaction verify
*/
if($_POST["action"] == "SaleTxnVerify") {
    $MerchantID = $_POST["mer_id"];
    $MerchantRefID = $_POST["mer_txn_id"];
    $ReturnURL = $_POST["ret_url"];

    $Invoice = "";
    $Invoice .= "<req>".
                    "<mer_id>" . $MerchantID . "</mer_id>".
                    "<mer_txn_id>" .$MerchantRefID. "</mer_txn_id>".
                    "<action>" . $_POST["action"] . "</action>";

    if($ReturnURL != "") {
       $Invoice .= "<ret_url>" . $ReturnURL . "/decrypt.php</ret_url>"; 
    }

    $Invoice .= "</req>";
}

/**
* Step 1 : Create the socket connection with IPG client
*/

    if ($IPGClientIP != "" && $IPGClientPort != "") {
        $IPGSocket = fsockopen($IPGClientIP, $IPGClientPort, $ERRNO, $ERRSTR, $SOCKET_TIMEOUT);
    } else {
        $error_message = "Could not establish a socket connection for given IPGClientIP = ". $IPGClientIP . "and IPGClientPort = ".$IPGClientPort; 
        $socket_creation_err = true;
    }

/**
* Step 2 : Send Invoice to IPG client 
*/

    if(!$socket_creation_err) {
        socket_set_timeout($IPGSocket, $SOCKET_TIMEOUT);

        // Write the invoice to socket connection
        if(fwrite($IPGSocket,$Invoice) === false) {
            $error_message .= "Invoice could not be written to socket connection";
            $invoice_sent_error = true;
        }
    }
    

/**
* Step 3 : Recieve the encrypted Invoice from IPG client
*/

    if(!$socket_creation_err && !$invoice_sent_error) {
        while (!feof($IPGSocket)) {
            $EncryptedInvoice .= fread($IPGSocket, 8192);
        }    
    }

/**
* Step 4 : Close the socket connection
*/
    if(!$socket_creation_err) {
        fclose($IPGSocket);
    }

/**
* Step 5 : Check for Encryption errors
*/

    if (!(strpos($EncryptedInvoice, '<error_code>') === false && strpos($EncryptedInvoice, '</error_code>') === false && strpos($EncryptedInvoice, '<error_msg>') === false && strpos($EncryptedInvoice, '</error_msg>') === false)) {
        $encryption_ERR = true;
        
        $Error_code = substr($EncryptedInvoice, (strpos($EncryptedInvoice, '<error_code>')+12), (strpos($EncryptedInvoice, '</error_code>') - (strpos($EncryptedInvoice, '<error_code>')+12)));
    
        $Error_msg = substr($EncryptedInvoice, (strpos($EncryptedInvoice, '<error_msg>')+11), (strpos($EncryptedInvoice, '</error_msg>') - (strpos($EncryptedInvoice, '<error_msg>')+11)));

    }

	/**
	* Step 6 : Submit Encripted invoice to IPG server
	*/

    if(!$socket_creation_err && !$invoice_sent_error && !$encryption_ERR) {
        ?>
		<html>
        <head>
        </head>

            <body onLoad="document.send_form.submit();">
                <form name="send_form" method="post" action="<?php echo $IPGServerURL?>" >
                    <input type="hidden" value="<?php echo $EncryptedInvoice?>" name="encryptedInvoicePay">
                </form>
            </body>

        </html>
        <?php
    } else {
	// Following HTML code do not have to be available in the production code
	// here merchant can redirect to a error page
    // Eg : header('Location: http://www.example.com/error.php');
        ?>
        <html>
        <head>
        </head>
            <body>                
                <h2>Error in generating Encrypted invoice</h2><br /><br />
                <h4>Socket Creation Errors</h4>
                <ul>
                    <li><b>Socket Error No : </b> <?php print $ERRNO ?></li>
                    <li><b>Socket Error String : </b><?php print $ERRSTR ?></li>
                    <li><b>Application Error Message : </b><?php print $error_message ?></li>
                </ul>

                <h4>Encryption Errors</h4>
                <ul>
                    <li><b>Error Code : </b> <?php print $Error_code ?></li>
                    <li><b>Error Message : </b><?php print $Error_msg ?></li>
                </ul>
			</body>
        </html>
        <?php
    }

?>