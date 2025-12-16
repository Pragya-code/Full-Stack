<?php
$file = fopen("note.txt", "w");

fwrite($file, "This is the line one.\n");
fwrite($file, "This is the line two.\n");

fclose($file);

$file = fopen("note.txt", "r");
echo nl2br(fread($file, filesize("note.txt")));

fclose($file);

?>