<?php

require_once __DIR__ . '/../model/tekaservice.class.php';

$list = ["1999", "2000", "2222"];
$q = $_GET[ "q" ];
//$f = $_GET[ "f" ];
echo "<option value='" . $q . "' />\n";

//ls = new TekaService;
//$list[] = $ls->getAllYears();


// Protrči kroz sva imena i vrati HTML kod <option> za samo ona 
// koja sadrže string q kao podstring.
//foreach( $list as $index )
//    if( strpos( $index, $q ) !== false )
//        echo "<option value='" . $index . "' />\n";
?>
