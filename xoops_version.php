<?php
// ---------------------------------------------------------------------- //
//               Xoops: Content Management System                         //
//                       < http://www.xoops.org >                         //
// ---------------------------------------------------------------------- //

$modversion['name'] = _MI_RASED_NAME;
$modversion['version'] = 1.0;
$modversion['description'] = _MI_RASED_DESC;
$modversion['license'] = "GPL";
$modversion['official'] = 0;
$modversion['image'] = "logo.gif";
$modversion['dirname'] = "rased";
$modversion['author'] = "www.arabxoops.com   translated into english by www.maitsco.com";

// sql file
$modversion['sqlfile']['mysql'] = "sql/rased.sql";

// Tables created by sql file
$modversion['tables'][0] = "rasedcountries";
$modversion['tables'][1] = "ips";
$modversion['tables'][2] = "rasedonline";

// Menu
$modversion['hasMain'] = 0;

// Admin things
$modversion['hasAdmin'] = 0;

// Block
$modversion['blocks'][1]['file'] = "rasedblock.php";
$modversion['blocks'][1]['name'] = _MI_RASED_BLOCK;
$modversion['blocks'][1]['description'] = _MI_RASED_BLOCK_DESC;
$modversion['blocks'][1]['show_func'] = "rased";

?>
