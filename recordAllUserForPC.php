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
//删除signin表中一条记录
$sql = "select * FROM fitness_record  order by endTime";

$result = $conn->query($sql);
if ($result){
    while ($row = $result->fetch_assoc())
        $arr[] = $row;
}
$res = array( 
    "code" => 0, 
    "msg" => '',
    'count'=>count($arr),
     'data'=>$arr
    ); 
header('Content-Type:application/json; charset=utf-8');
echo json_encode($res,JSON_UNESCAPED_UNICODE);

?>