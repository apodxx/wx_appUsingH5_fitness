<?php
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
$arr = [];

$sql = "select type FROM fitness_record WHERE former='$_POST[former]' and endTime is null order by endTime limit 1";
$result = $conn->query($sql);
echo "result :";
echo $result;
$type = $result->fetch_assoc()["type"];
if($type == @$_POST[type]){

    $sql = "UPDATE fitness_record SET endTime='$_POST[endTime]' WHERE endTime is null";

}else{

if ($result->num_rows!=0){
    $sql = "UPDATE fitness_record SET endTime='$_POST[endTime]' WHERE endTime is null";
    $sql2 = "INSERT INTO fitness_record (former,type,startTime,remark)
    VALUES ('$_POST[former]', '$_POST[type]', '$_POST[startTime]', '$_POST[remark]')";
    $result2 = $conn->query($sql2);
}else{
    $sql = "INSERT INTO fitness_record (former,type,startTime,remark)
    VALUES ('$_POST[former]', '$_POST[type]', '$_POST[startTime]', '$_POST[remark]')";

}
}
$result1 = $conn->query($sql);

echo json_encode($result1);


?>