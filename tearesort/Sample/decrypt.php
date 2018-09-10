<?php
/**
 * Decrypt Transaction info recieved from IPG server
 * PHP version 4 and 5
 * @author       Sanjeewa Jayasinghe <sanjeewaj@interblocks.com>
 * @copyright  Interblocks - http://www.interblocks.com
 * @license    
 */

/**
* Initializing
* IPG client IP, port and socket variables 
*/

$IPGClientIP = "127.0.0.1";
$IPGClientPort = "10000";

$ERRNO = "";
$ERRSTR = "";
$SOCKET_TIMEOUT = 2;
$IPGSocket = "";

$EncryptedReceipt = "";
$DecryptedReceipt = "";

$error_message = "";
$encrypted_rcpt_sent_error = "";
$encryptedRcpt_ERR = "";
$decryptedRcpt_ERR = "";


$EncryptedReceipt = $_POST["encryptedReceiptPay"];

    if($EncryptedReceipt == "") {
        $error_message .= "Could not find Encrypted Receipt";
        $encryptedRcpt_ERR = true;
    }

/**
* Step 1 : Create the socket connection with IPG client
*/
    if(!$encryptedRcpt_ERR) {
        if ($IPGClientIP != "" && $IPGClientPort != "") {
            $IPGSocket = fsockopen($IPGClientIP, $IPGClientPort, $ERRNO, $ERRSTR, $SOCKET_TIMEOUT);
        } else {
            $error_message = "Could not establish a socket connection for given IPGClientIP = ". $IPGClientIP . "and IPGClientPort = ".$IPGClientPort; 
            $socket_creation_err = true;
        }      
    }

/**
* Step 2 : Send Encrypted Receipt to IPG client 
*/

    if(!$socket_creation_err && !$encryptedRcpt_ERR) {
        socket_set_timeout($IPGSocket, $SOCKET_TIMEOUT);

        // Write the encrypted receipt to socket connection
        if(fwrite($IPGSocket,$EncryptedReceipt) === false) {
            $error_message .= "Encrypted Receipt could not be written to socket connection";
            $encrypted_rcpt_sent_error = true;
        }
    }

/**
* Step 3 : Recieve the decrypted Receipt from IPG client
*/

    if(!$socket_creation_err && !$encrypted_rcpt_sent_error) {
        while (!feof($IPGSocket)) {
            $DecryptedReceipt .= fread($IPGSocket, 8192);
        }    
    }

/**
* Step 4 : Close the socket connection
*/
    if(!$socket_creation_err) {
        fclose($IPGSocket);
    }

/**
* Step 5 : Process $DecryptedReceipt
*/
$Error_code = "";
$Error_msg = "";
$Acc_No = "";
$Action = "";
$Bank_ref_ID = "";
$Currency = "";
$IPG_txn_ID = "";
$Lang = "";
$Merchant_txn_ID = "";
$Merchant_var1 = "";
$Merchant_var2 = "";
$Merchant_var3 = "";
$Merchant_var4 = "";
$Name = "";
$Reason = "";
$Transaction_amount = "";
$Transaction_status = "";

    if (!(strpos($DecryptedReceipt, '<error_code>') === false && strpos($DecryptedReceipt, '</error_code>') === false && strpos($DecryptedReceipt, '<error_msg>') === false && strpos($DecryptedReceipt, '</error_msg>') === false)) {
        $decryptedRcpt_ERR = true;
        
        $Error_code = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<error_code>')+12), (strpos($DecryptedReceipt, '</error_code>') - (strpos($DecryptedReceipt, '<error_code>')+12)));
    
        $Error_msg = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<error_msg>')+11), (strpos($DecryptedReceipt, '</error_msg>') - (strpos($DecryptedReceipt, '<error_msg>')+11)));
    
    } else {
    
        if (!(strpos($DecryptedReceipt, '<acc_no>') === false && strpos($DecryptedReceipt, '</acc_no>') === false)) {
            $Acc_No = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<acc_no>')+8), (strpos($DecryptedReceipt, '</acc_no>') - (strpos($DecryptedReceipt, '<acc_no>')+8)));
        }
        
        if (!(strpos($DecryptedReceipt, '<action>') === false && strpos($DecryptedReceipt, '</action>') === false)) {
            $Action = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<action>')+8), (strpos($DecryptedReceipt, '</action>')-(strpos($DecryptedReceipt, '<action>')+8)));
        }
        
        if (!(strpos($DecryptedReceipt, '<bank_ref_id>') === false && strpos($DecryptedReceipt, '</bank_ref_id>') === false)) {
            $Bank_ref_ID = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<bank_ref_id>')+13), (strpos($DecryptedReceipt, '</bank_ref_id>')-(strpos($DecryptedReceipt, '<bank_ref_id>')+13)));
        }
        
        if (!(strpos($DecryptedReceipt, '<cur>') === false && strpos($DecryptedReceipt, '</cur>') === false)) {
            $Currency = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<cur>')+5),(strpos($DecryptedReceipt, '</cur>')-(strpos($DecryptedReceipt, '<cur>')+5)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<ipg_txn_id>') === false && strpos($DecryptedReceipt, '</ipg_txn_id>') === false)) {
            $IPG_txn_ID = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<ipg_txn_id>')+12),(strpos($DecryptedReceipt, '</ipg_txn_id>')-(strpos($DecryptedReceipt, '<ipg_txn_id>')+12)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<lang>') === false && strpos($DecryptedReceipt, '</lang>') === false)) {
            $Lang = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<lang>')+6),(strpos($DecryptedReceipt, '</lang>')-(strpos($DecryptedReceipt, '<lang>')+6)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<mer_txn_id>') === false && strpos($DecryptedReceipt, '</mer_txn_id>') === false)) {
            $Merchant_txn_ID = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<mer_txn_id>')+12),(strpos($DecryptedReceipt, '</mer_txn_id>')-(strpos($DecryptedReceipt, '<mer_txn_id>')+12)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<mer_var1>') === false && strpos($DecryptedReceipt, '</mer_var1>') === false)) {
            $Merchant_var1 = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<mer_var1>')+10),(strpos($DecryptedReceipt, '</mer_var1>')-(strpos($DecryptedReceipt, '<mer_var1>')+10)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<mer_var2>') === false && strpos($DecryptedReceipt, '</mer_var2>') === false)) {
            $Merchant_var2 = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<mer_var2>')+10),(strpos($DecryptedReceipt, '</mer_var2>')-(strpos($DecryptedReceipt, '<mer_var2>')+10)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<mer_var3>') === false && strpos($DecryptedReceipt, '</mer_var3>') === false)) {
            $Merchant_var3 = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<mer_var3>')+10),(strpos($DecryptedReceipt, '</mer_var3>')-(strpos($DecryptedReceipt, '<mer_var3>')+10)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<mer_var4>') === false && strpos($DecryptedReceipt, '</mer_var4>') === false)) {
            $Merchant_var4 = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<mer_var4>')+10),(strpos($DecryptedReceipt, '</mer_var4>')-(strpos($DecryptedReceipt, '<mer_var4>')+10)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<name>') === false && strpos($DecryptedReceipt, '</name>') === false)) {
            $Name = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<name>')+6),(strpos($DecryptedReceipt, '</name>')-(strpos($DecryptedReceipt, '<name>')+6)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<reason>') === false && strpos($DecryptedReceipt, '</reason>') === false)) {
            $Reason = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<reason>')+8),(strpos($DecryptedReceipt, '</reason>')-(strpos($DecryptedReceipt, '<reason>')+8)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<txn_amt>') === false && strpos($DecryptedReceipt, '</txn_amt>') === false)) {
            $Transaction_amount = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<txn_amt>')+9),(strpos($DecryptedReceipt, '</txn_amt>')-(strpos($DecryptedReceipt, '<txn_amt>')+9)) );
        }
        
        if (!(strpos($DecryptedReceipt, '<txn_status>') === false && strpos($DecryptedReceipt, '</txn_status>') === false)) {
            $Transaction_status = substr($DecryptedReceipt, (strpos($DecryptedReceipt, '<txn_status>')+12),(strpos($DecryptedReceipt, '</txn_status>')-(strpos($DecryptedReceipt, '<txn_status>')+12)) );
        }
    }


/**
* Step 6 : Finish Transaction
*/

    // Check whether any problem in socket creation with IPG client and sending encrypted receipt
    // Check whether any problem in decryption
    
    if(!$socket_creation_err && !$encrypted_rcpt_sent_error && !$decryptedRcpt_ERR) {
        if($Transaction_status == "ACCEPTED") {
            // here merchant can redirect to a success page
            // Eg : header('Location: http://www.example.com/success.php');

            
        } else { //$Transaction_status == "REJECTED"
            // here merchant can redirect to a error page
            // Eg : header('Location: http://www.example.com/error.php');

        }
            // Following HTML code do not have to be available in the production code. Remove if redirection is enabled. 
        ?>
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>RECEIPT</title>
            
            <link rel="stylesheet" type="text/css" href="default.css" />
            </head>
            
            <body>
            <div id="result_table">
            <h4>RECEIPT</h4>
            <table>
            <thead>
                    <td>VARIABLE</td>
                    <td>VALUE</td>

            </thead>
                    <tr>
                    <td>Account Number</td>
                    <td><?php print $Acc_No?></td>
                </tr>
                
                <tr>
                    <td>Action</td>
                    <td><?php print $Action?></td>
                </tr>
                
                <tr>
                    <td>Bank Reference ID</td>
                    <td><?php print $Bank_ref_ID?></td>

                </tr>
                
                <tr>
                    <td>Currency</td>
                    <td><?php print $Currency?></td>
                </tr>

                <tr>
                    <td>IPG Transaction ID</td>
                    <td><?php print $IPG_txn_ID?></td>
                </tr>

                <tr>
                    <td>Language</td>
                    <td><?php print $Lang?></td>
                </tr>

                <tr>
                    <td>Merchant Transaction ID</td>
                    <td><?php print $Merchant_txn_ID?></td>
                </tr>

                <tr>
                    <td>Merchant Variable 1</td>
                    <td><?php print $Merchant_var1?></td>
                </tr>

                <tr>
                    <td>Merchant Variable 2</td>
                    <td><?php print $Merchant_var2?></td>
                </tr>

                <tr>
                    <td>Merchant Variable 3</td>
                    <td><?php print $Merchant_var3?></td>
                </tr>

                <tr>
                    <td>Merchant Variable 4</td>
                    <td><?php print $Merchant_var4?></td>
                </tr>

                <tr>
                    <td>Name</td>
                    <td><?php print $Name?></td>
                </tr>

                <tr>
                    <td>Reason</td>
                    <td><?php print $Reason?></td>
                </tr>

                <tr>
                    <td>Transaction Amount</td>
                    <td><?php print $Transaction_amount?></td>
                </tr>
                
                <tr>
                    <td>Transaction Status</td>
                    <td><?php print $Transaction_status?></td>
                </tr>

            </table>
            
            </div>
            
            </body>
            </html>
        <?php
    } else {
        ?>
        <html>
        <head>
        </head>
            <body>
                
                <h2>Error in IPG client communication or Decryption</h2><br /><br />
                <h4>Socket Creation Errors</h4>
                <ul>
                    <li><b>Socket Error No : </b> <?php print $ERRNO ?></li>
                    <li><b>Socket Error String : </b><?php print $ERRSTR ?></li>
                    <li><b>Application Error Message : </b><?php print $error_message ?></li>
                </ul>
                <br /><br />
                <h4>IPG Client generated Errors</h4>
                <ul>
                    <li><b>Error Code : </b> <?php print $Error_code ?></li>
                    <li><b>Error Message : </b><?php print $Error_msg ?></li>
                </ul>
            </body>

        </html>
        <?php
    }

?>