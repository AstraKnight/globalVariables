<?php

// instead of var_dump($_SERVER), use this:
prettyPrint($_SERVER);


$scheme = $_SERVER["REQUEST_SCHEME"];       //http
$host = $_SERVER["HTTP_HOST"];              //localhost
$fullUri =  $_SERVER["REQUEST_URI"];            // /php01/test02.php

// SPECIFIC CASES for debugging:
// $fullUri = "/php01/docs/Learn/Common_questions/What_is_a_URL/test01.php";
// $fullUri = "/test01.php";
// $fullUri = "/php01/docs/Learn/Common_questions/What_is_a_URL";


// split URI by slash '/'
$aUriExploded = explode('/',  $fullUri);
// echo "Uri Exploded: "; prettyPrint($aUriExploded);   // DEBUG

// --------------- PAGE --------------------------
// get last element of array in $page
$pageIndex= sizeof($aUriExploded) -1 ;
$page = $aUriExploded[$pageIndex];
// echo "check page: "; echo $page; echo "<br>";      // DEBUG


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

// echo "final page: "; echo $page; echo "<br><br>";        // DEBUG
// echo "New Uri Exploded: "; prettyPrint($aUriExploded);   // DEBUG


// --------------- PATH and URI --------------------------
$path = "";
$uri = "";

// check if URI ($aUriExploded) has paths
if (sizeof($aUriExploded) == 1) {
  $path = "/";  // no, 0 path found (no URI)
}
else {
  // yes, found 1 or more paths/URI

  $aUriReverse = array_reverse($aUriExploded);
  // echo "array_reverse: "; prettyPrint($aUriReverse);     // DEBUG

  $emptyItem = array_pop($aUriReverse);       // pop empty item
  $path = array_pop($aUriReverse);            // path value
  // echo "path: "; echo $path; echo "<br>";           // DEBUG
  // echo "aUriReverse: "; prettyPrint($aUriReverse);  // DEBUG

  $aUriExploded = array_reverse($aUriReverse);
  // echo "aUriExploded:"; prettyPrint($aUriExploded);    // DEBUG

  // If array has items, these items are URIs

  //Loop through the paths in URI ($aUriExploded)
  //echo join("/", $aUriExploded);       // join version instead of foreach
  foreach($aUriExploded as $p) {
    if (strlen($uri) > 0) {     // Check if $path has already a value
        $uri .= "/";            // Yes, the add '/' before next path
    }
    $uri .= $p;          // add slash at every path and join all paths
    //echo "/" . $p . "<br>";   //debug
  }
}

// echo "final path: "; echo $path; echo "<br>";           // DEBUG
// echo "final uri: "; echo $uri; echo "<br>";           // DEBUG

// --------------- CREATE FINAL ARRAY --------------------------
// key-value array with URI params
$myArray = array("scheme" => $scheme, "host" => $host, "path" => $path, "uri" => $uri, "page" => $page);
prettyPrint($myArray);


// to display code properly
function prettyPrint($array){
    print "<pre>";
    print_r($array);
    print "</pre>";
}


/* ----------------- MY BEAUTIFUL TABLE ----------------- */

?>

<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>

 </head>
 <body>
  
 <hr><br>
 <h1 style='color:blue'>My beautiful table</h1>

 <table border='1'>
  <tr>
    <th>URL</th>
    <th>DATA</th>
  </tr>

  <?php  
  foreach($myArray as $key => $value) {
    echo "<tr><td>$key</td><td>$value</td></tr>";
  }
  ?>
  </table>

</body>
</html>

<?php  
/*
// dummy version
echo "<table border='1'>
  <tr>
    <th>URL</th>
    <th>DATA</th>
  </tr>
  <tr>
    <td>Scheme</td>
    <td>$scheme</td>
  </tr>
  <tr>
    <td>Host</td>
    <td>$host</td>
  </tr>
  <tr>
    <td>Path</td>
    <td>$path</td>
  </tr>
  <tr>
    <td>URI</td>
    <td>$uri</td>
  </tr>
  <tr>
    <td>Page</td>
    <td>$page</td>
  </tr>
</table>";


// Smart version
echo "<table border='1'>
  <tr>
    <th>URL</th>
    <th>DATA</th>
  </tr>";

  foreach($myArray as $key => $value) {
    echo "<tr><td>$key</td><td>$value</td></tr>";
  }

  echo "</table>";
*/
?>





