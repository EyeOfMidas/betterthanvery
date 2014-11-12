<?php
$word = (isset($_POST['word']) && !empty($_POST['word'])) ? $_POST['word'] : "happy";
$word = strtolower(strip_tags($word));
//TODO: strip out invalid stuff

$dictionary = array();

$handle = fopen("dictionary.dat", "r");
if($handle) {
 while(($buffer = fgets($handle, 4096)) !== false) {
     $buffer = trim($buffer);
     $wordLine = explode(":", $buffer);
     $eachWord = $wordLine[0];
     $eachSuggestions = explode(",", $wordLine[1]);
     $dictionary[$eachWord] = $eachSuggestions;
 }
}

$return = array("word" => $word);
$suggestions = isset($dictionary[$word]) ? $dictionary[$word] : null;
if($suggestions == null) {
    $return['error'] = "could not be found.";
} else {
    $return['suggestion'] = array_shift($suggestions);
    $return['alternates'] = $suggestions;
}
echo json_encode($return);