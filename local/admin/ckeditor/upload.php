<?
if (file_exists($_SERVER['HTTP_HOST']. "/upload_dir/" . $_FILES["upload"]["name"]))
{
 echo $_FILES["upload"]["name"] . " already exists. ";
}
else
{
 move_uploaded_file($_FILES["upload"]["tmp_name"],
 $_SERVER['HTTP_HOST']. "/upload_dir/" . $_FILES["upload"]["name"]);
 echo "Stored in: " . $_SERVER['HTTP_HOST']. "/upload_dir/" . $_FILES["upload"]["name"];
}
?>