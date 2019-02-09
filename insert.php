<?php

//create database connection
$username = 'dkovalev_grcuser';
$password = 'GGman317839!';
$hostname = 'localhost';
$database = 'dkovalev_grc';
$con = @mysqli_connect($hostname, $username, $password, $database);

//check connection
if(mysqli_connect_errno())
{
    echo("Failed to connect to MySQL: " . mysqli_connect_error());
}
//insert posts into database
$blogtitle = $_POST['blogtitle'];
$content = $_POST['content'];
$authorname = $_POST['authorname'];


$sql="INSERT into blog_posts (post_title,content,author_name,post_date) values('$blogtitle', '$content', '$authorname', now())";

if (!mysqli_query($con,$sql))
{
    die("Error: " . mysqli_error($con));
}
echo("1 record added");
mysqli_close($con);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    &nbsp&nbsp<a href='blog_view.php'> view blog</a>
</body>
</html>