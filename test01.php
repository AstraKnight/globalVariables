<?php

// instead of var_dump($_SERVER), use this:
prettyPrint($_SERVER);


$scheme = $_SERVER["REQUEST_SCHEME"];       //http
$host = $_SERVER["HTTP_HOST"];              //localhost
$uri =  $_SERVER["REQUEST_URI"];            // /php01/test02.php


// SPECIFIC CASES for debugging:
//$uri = "/fr/docs/Learn/Common_questions/What_is_a_URL/test01.php";
// $uri = "/test01.php";
//$uri = "/fr/docs/Learn/Common_questions/What_is_a_URL";


// split URI by slash '/'
$aUriExploded = explode('/',  $uri);
//prettyPrint($aUriExploded);       //DEBUG


// get last element of array in $page
$pageIndex= sizeof($aUriExploded) -1 ;
$page = $aUriExploded[$pageIndex];
//echo $page;


// check if last array element is a page .php
if (str_ends_with($page, ".php")) {
    //yes, last element is a php page
    $removed = array_pop($aUriExploded);
    //prettyPrint($aUriExploded);       //DEBUG
}
else {
    //no, last element is not a php page / page not found in URI
    $page = "";
}


$path = "";

// check if URI ($aUriExploded) has paths
if (sizeof($aUriExploded) > 1) {
    // yes, found 1 or more path to join

    //Loop through the paths in URI ($aUriExploded)
    //echo join("/", $aUriExploded);       // join version instead of foreach
    foreach($aUriExploded as $p) {
        if (strlen($p) > 0) {            //remove the first empty element
            if (strlen($path) > 0) {     // Check if $path has already a value
                $path .= "/";            // Yes, the add '/' before next path
            }
            $path .= $p;          // add slash at every path and join all paths
            //echo "/" . $p . "<br>";   //debug
        }    
    }
}
else {
    // no, 0 path found
    $path = "/";
}

// echo $path;      //debug


// key-value array with URI params
$myArray = array("scheme" => $scheme, "host" => $host, "path" => $path, "page" => $page);
prettyPrint($myArray);


// to display code properly
function prettyPrint($array){
    print "<pre>";
    print_r($array);
    print "</pre>";
}






