<?php

include($_SERVER['DOCUMENT_ROOT'].'Classes/CVideoGame.php');
include($_SERVER['DOCUMENT_ROOT'].'index.php');

if(preg_match("/[A-Z|a-z]+/", $_POST['Video_Game_Name'])){
$name=$_POST['searchtext'];

$sql ="select * from `video games` where Video_Game_Name LIKE '%" . $name . "%'";

$result = mysql_query($sql);

$numrows=mysql_num_rows($result);

while($row=mysql_fetch_array($result)){
    
    $VideoGameName= $row['Video_Game_Name'];
    $ID=$row['Video_Game_ID'];

echo "<ul>\n"; 
echo "<li>" . "<a href=\"search.aspx?id=$ID\">"  .$VideoGameName . "</a></li>\n";
echo "</ul>";
}
}
else{
echo "<p>Sorry, no results were found</p>";
}
?>