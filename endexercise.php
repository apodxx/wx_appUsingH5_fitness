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
$result1 =-1;

$sql = "select type FROM fitness_record WHERE former='$_POST[former]' and endTime is null order by endTime limit 1";
$result = $conn->query($sql);
$type = "";

if( $result->num_rows>0){
    $type = $result->fetch_assoc()["type"];
    if($type == @$_POST[type]){
        //点击始终图标图标，停止锻炼
        $sql = "UPDATE fitness_record SET endTime='$_POST[endTime]' WHERE endTime is null";
        $result1 = $conn->query($sql);
        $arr['type'] = $type;
        $arr['res'] = 1;
    }else{
        //等于0 表示需要讲前端的时钟图表显示
        $result1 = 0;
        $arr['type'] = $type;
        $arr['res'] = $result1;
    }

};
//结果等于-1 表示没有内容 时钟图标隐藏
if(empty($type)){
    $arr['type'] = "";
    $arr['res'] = $result1;
}
echo json_encode($arr,JSON_UNESCAPED_UNICODE);

?>