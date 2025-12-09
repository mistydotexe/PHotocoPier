<?php

// Declare all the values, PLEASE CHECK AND EDIT HERE!!

// Set export filename
$filename = array("file01.txt","file02.txt");

// Locate the location(s) of your old file(s) for deletion and replacement (and to copy it to the final file)
$del = array("../example/file01.txt","../example/file02.txt");

// Set working directory
$dir = "../temp/dir/";

// Determine text URLs to copy
$url = array("https://copy.source/01.txt","https://copy.source/02.txt");

// Other arrays. KEEP THESE EMPTY!!
$saveloc = array();
$paste = array();

// ===== PLEASE DO NOT MODIFY ANYTHING BELOW UNLESS YOU KNOW WHAT YOU'RE DOING!! ======

// ===== PART 01: Unlink old files =====
foreach ($del as $a)
{
	unlink($a);
}

// ===== PART 02: Set save location =====
foreach ($filename as $b)
{
	$saveloctemp = $dir . $b;
	array_push($saveloc, "$saveloctemp");
}

// ===== PART 03: cURL it! =====
foreach(array_combine($url, $saveloc) as $c => $d)
{
  // Initialize the cURL session
  $ch = curl_init($c);
  
  // Open file
  $fp = fopen($d, 'wb');

  // It set an option for a cURL transfer
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_FILE, $fp);
  curl_setopt($ch, CURLOPT_HEADER, 0);

  // Perform a cURL session
  curl_exec($ch);

  // Closes a cURL session and frees all resources
  curl_close($ch);

  // Close file
  fclose($fp);
}

// ===== PLEASE CHECK AND EDIT HERE! =====

// ===== PART 04: Pen pineapple apple pen. =====

// Remove and replace destination file
unlink("../destination/file.txt");

foreach ($del as $e)
{
	array_push($paste, file_get_contents($e));
}

// Set destination file to paste on (same as Line #65, the same one for unlink)
file_put_contents('../destination/file.txt', implode("\n", $paste));

// We're done. See you next update!
  exit();
?>