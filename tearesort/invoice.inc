<?
    if(!$socket_creation_err && !$invoice_sent_error && !$encryption_ERR)
    {	
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
    }
    else
    {
	// Following HTML code does not have to be available in the production code
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