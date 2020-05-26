<?php
//注册，接受name， id， university，返回true或false
header("Content-type:text/html;charset=utf-8");    //设置php连接数据库用utf8编码，不然中文乱码
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "test";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

$conn->query("set names utf8");	//设置php连接数据库用utf8编码，不然中文乱码
$sql = "select * FROM registeruser WHERE name='$_POST[name]' ";
$result = $conn->query($sql);
$type = "";
if( $result->num_rows>0){
	//用户名重复
	echo json_encode("err_01",JSON_UNESCAPED_UNICODE);
}else{
	$sql = "INSERT INTO registeruser (name, password, email)
VALUES ('$_POST[name]', '$_POST[password]', '$_POST[email]')";
$result = $conn->query($sql);
if ($result->num_rows!=0)
	
	echo json_encode("success",JSON_UNESCAPED_UNICODE);
else
//其他原因注册失败
	
	echo json_encode("err_02",JSON_UNESCAPED_UNICODE);
}



?>