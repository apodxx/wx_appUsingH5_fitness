<?php
//发起签到，接受FormID，startTime， endTime，FormerID, topic, content,返回true或false
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
//添加日期
$sql = "SELECT distinct(type) FROM fitness_record ";

$result = $conn->query($sql);
//获取type类型
$arr = [];


//把数据库拿到的结果集转化成数组
if ($result){
	while ($row = $result->fetch_assoc()["type"])
		$arr[] = $row;
}
//获取每个类型的数量
$arr2 = [];


$endTime = date("Y-m-d H:i:s");
foreach($arr as $value){
    @$startTime = $_GET[startTime];
    if(empty($startTime)||$startTime=""){
        $sql = "SELECT COUNT(*) FROM FITNESS_RECORD WHERE  TYPE = '".$value."'";
    }else{
        $sql = "SELECT COUNT(*) FROM FITNESS_RECORD WHERE startTime between '$_GET[startTime]' and '$_GET[endTime]' and TYPE = '".$value."'";
    }
    $result = $conn->query($sql);
    array_push($arr2,intval($result->fetch_assoc()['COUNT(*)']));
}

$res = array( 
    'type'=>$arr,
    'count'=>$arr2
    ); 
header('Content-Type:application/json; charset=utf-8');
echo(json_encode($res,JSON_UNESCAPED_UNICODE));


?>