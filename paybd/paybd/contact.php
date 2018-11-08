<?php include 'inc/header.php'; ?>


    <div class="jumbotron jumbotron-sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <h1 class="h1">
                        Contact us
                        <small>Feel free to contact us</small>
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row slide">
            <div class="col-md-8">
                <div class="well well-sm">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                           required="required"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        Email Address</label>
                                    <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                        <input type="email" name="email" class="form-control" id="email"
                                               placeholder="Enter email" required="required"/></div>
                                </div>
                                <div class="form-group">
                                    <label for="subject">
                                        Subject</label>
                                    <select id="subject" name="subject" class="form-control" required="required">
                                        <option value="na" selected="">Choose One:</option>
                                        <option value="General Customer Service">General Customer Service</option>
                                        <option value="Suggestions">Suggestions</option>
                                        <option value="Product Support">Product Support</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Message</label>
                                    <textarea name="body" id="message" class="form-control" rows="9" cols="25"
                                              required="required"
                                              placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $query = "select companyName,email,mobile,officeAddress from tbcompanyinfo";
                $selectData = $db->select($query);
                if ($selectData) {
                    while ($result = $selectData->fetch_assoc()) {

                        ?>
                        <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
                        <address>
                            <strong><?php echo $result['companyName']; ?></strong><br>
                            <?php echo $result['officeAddress']; ?><br><br>
                            <strong>Mobile</strong><br>
                            <!--P:</abbr>-->
                            <?php echo $result['mobile']; ?>
                        </address>
                        <address>
                            <strong>Email</strong><br>
                            <a href="mailto:#"><?php echo $result['email']; ?></a>
                        </address>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>


<?php
if (isset($_POST['submit']))
{

    $name = mysqli_real_escape_string($db->link,$_POST['name']);
    $email = mysqli_real_escape_string($db->link,$_POST['email']);
    $subject = mysqli_real_escape_string($db->link,$_POST['subject']);
    $body = mysqli_real_escape_string($db->link,$_POST['body']);

    /*$name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];*/


    $to = "Didarul Alam <emdidar@gmail.com>";

    $headers = "From: <" . $email . "> \r\n";
    //$headers .= "Reply-To: no-reply@tearesort.gov.bd \r\n";
    //$headers .= "CC: rahaman@thecodero.net\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $message = '<html><body>';
    $message .= '<h1>Guest Messages From Contact Page:</h1>';
    $message .= '</body></html>';
    $message = '<html><body>';
    $message .= '<img src="http://paybd.codinghelpbd.com/assets/images/logo.png" alt="Best Pay BD" />';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="15">';
    $message .= "<tr style='background: #eee;'><td><strong>Name :</strong> </td><td>" . strip_tags($name) . "</td></tr>";
    $message .= "<tr><td><strong>Email :</strong> </td><td>" . strip_tags($email) . "</td></tr>";
    $message .= "<tr><td><strong>Messages :</strong> </td><td>" . strip_tags($body) . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";

    $send = mail($to, $subject, $message, $headers);
}
if ($send) {
    header("Location: contact.php");

    $msg= "<p> Thank you for your Message</p>";
    echo $msg;

} else {


}
?>
    <div class="clear"></div>

    <div class="container">
        <div class="col-md-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3687.2243285144286!2d91.88440741430296!3d22.458202842821155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ad28e694fbf14b%3A0x70c4892c83550bb8!2sGuzra+Post+Office!5e0!3m2!1sen!2sbd!4v1535567015341"
                    width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>