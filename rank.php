<?php
//查看自己发起的所有签到，接受FormerID，返回自己发起的所有签到，json数组形式返回
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

$endTime = date("Y-m-d H:i:s");
@$startTime = $_POST[startTime];

if(!empty($startTime)){
	$sql = "select former,sum(endtime-starttime) as rank from fitness_record WHERE STARTTIME > '".$startTime."' group by former order by rank ";
}else{
	$sql = "select former,sum(endtime-starttime) as rank from fitness_record group by former order by rank ";
}


//查询数据库，结果集保存在result中
$result = $conn->query($sql);
//json化此数组，返回数据给微信
$arr = [];


//把数据库拿到的结果集转化成数组
if ($result){
	while ($row = $result->fetch_assoc())
		$arr[] = $row;
}
//返回给微信的json数据，注意json接受的参数只能是数组或者对象
echo json_encode($arr,JSON_UNESCAPED_UNICODE);
$conn->close();
?>