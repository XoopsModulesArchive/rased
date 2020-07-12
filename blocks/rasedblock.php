<?php

// include the default language file for the admin interface
if(!@include_once(XOOPS_ROOT_PATH."/modules/rased/language/" . $xoopsConfig['language'] . "/main.php")){
    include_once(XOOPS_ROOT_PATH."/modules/rased/language/english/main.php");
}

function rased() {

global $xoopsDB, $xoopsConfig, $xoopsTheme;
  $block = array();

$PHP_SELF=$_SERVER['PHP_SELF'];
$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];

$flagscounter=array();
$countryname=array();

$timeoutseconds=3600;
$time=time();
$timeout=$time-$timeoutseconds;

mysql_db_query(XOOPS_DB_NAME,"INSERT INTO ".$xoopsDB->prefix("rasedonline")." VALUES ('$time','$REMOTE_ADDR','$PHP_SELF')");
mysql_db_query(XOOPS_DB_NAME,"DELETE FROM ".$xoopsDB->prefix("rasedonline")." WHERE time<$timeout");

$resultonline=mysql_db_query(XOOPS_DB_NAME,"SELECT DISTINCT ip FROM ".$xoopsDB->prefix("rasedonline")." WHERE file='$PHP_SELF'");
$user=mysql_num_rows($resultonline);
$query=mysql_query("SELECT * FROM ".$xoopsDB->prefix("rasedonline")." WHERE file='$PHP_SELF' GROUP BY ip");
while($result=mysql_fetch_array($query))
{
$sql_ip=mysql_query("SELECT * FROM ".$xoopsDB->prefix("ips")." WHERE ips < INET_ATON('$result[ip]') ORDER BY ips DESC LIMIT 0,1");
$result_ip=mysql_fetch_array($sql_ip);
$sql_country=mysql_query("SELECT * FROM ".$xoopsDB->prefix("rasedcountries")." WHERE code='$result_ip[code]'");
$result_country=mysql_fetch_array($sql_country);
$code=$result_country["code"];

if($code=="")
{
if(!isset($flagscounter["unknown"]))
{
$flagscounter["unknown"]=1;
$countryname["unknown"]=""._MD_RASED_UNKNOWN."";
}else{
$flags["unknown"]++;
}
}else{
if(!isset($flagscounter[$code]))
{
$flagscounter[$code]=1;
$countryname[$code]=$result_country["country"];
}else{
$flagscounter[$code]++;
}
}
}
$block['content'] = "<div dir='"._MD_RASED_PAGEDIR."' style='padding: 1px; font-family: Verdana; text-align: "._MD_RASED_TEXTALIGN."'><b>"._MD_RASED_BROWSINGNOW." ($user) "._MD_RASED_VISITOR.":</b></div>";
$countertd=0;
foreach($flagscounter as $code => $counter)
{
$countertd++;
$country=$countryname[$code];

$block['content'] .= "<div dir='"._MD_RASED_PAGEDIR."' style='padding: 1px; text-align: "._MD_RASED_TEXTALIGN."'><img width='15' height='12' src='".XOOPS_URL."/modules/rased/flags/$code.jpg' border='1' alt='$country'> $country ($counter)</div>";
if($countertd=="1"){

$block['content'] .= "";
$countertd=0;
}
}

        return $block;
}
?>
