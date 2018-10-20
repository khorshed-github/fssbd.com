<?php
$con = mysql_connect("localhost","root","");
$db = mysql_select_db("selfempl_selfemply0_freelance");

$query = "SELECT * FROM working_sites";
$result = mysql_query($query);
$links="";
$arr = array();
while($row = mysql_fetch_array($result)){

	$links[] = $row['url'];
}
//print_r($link);

echo $links['3'];

exit;
$guidesXML = getEbayGuides($q);
$guides = array();
foreach ($guidesXML->guide as $guideXML) {
    $guide = array();
    $guide['url'] = makeguideLink($guideXML->url, $q);
    $guide['title'] = $guideXML->title;
    $guide['desc'] = $guideXML->desc;
    array_push($guides,$guide);
}

foreach($links as $link){
 echo $link;
}
echo $link['url'];
?>