<?php
//禁用错误报告
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
require_once 'conn.php';

$bill1=$_POST["bill1"];
$bill2=$_POST["bill2"];
$num1=$_POST["num1"];
$num2=$_POST["num2"];
$uid=$_POST["uid"];

$uid = mysql_real_escape_string($uid);//防止SQL注入
$bill1 = mysql_real_escape_string($bill1);//防止SQL注入
$bill2 = mysql_real_escape_string($bill2);//防止SQL注入
$num1 = mysql_real_escape_string($num1);//防止SQL注入
$num2 = mysql_real_escape_string($num2);//防止SQL注入

echo $bill1."</br>";
echo $bill2."</br>";
echo $num1."</br>";
echo $num2."</br>";
echo $uid."</br>";

$count=$bill1*$num1+$bill2*$num2;//总价

echo $count."</br>";

$query = "select * from user where uid='".$uid."' ";//构建查询语句


$result = mysql_query($query);//执行查询


if (!$result) {
    die("could not to the database\n" . mysql_error());
}
if (mysql_numrows($result)<=0) {
	echo "<script type='text/javascript'>alert('用户失效，请重新登录验证！');location.href='index.html'</script>";
}else{
	while($result_row=mysql_fetch_row(($result)))//取出结果并显示
{
$uid=$result_row[0];
$db_uname=$result_row[1];
$db_pwd=$result_row[2];
$db_bill=$result_row[3];
}
if($count<0){
	echo "<script type='text/javascript'>alert('不要尝试白拿书！');location.href='index.php'</script>";
}else if($count>$db_bill){
	echo "<script type='text/javascript'>alert('您的余额不足，请充值或者购买少量书籍！');location.href='index.php'</script>";
}else{
	$db_bill2=$db_bill-$count;//购买后的金额
	$updateSql = "update user set bill = '".$db_bill2."' where uid='".$uid."'";
$result = mysql_query($updateSql);
if($result>0){
	echo "<script type='text/javascript'>alert('您购买的".$num1." 本书籍1和".$num2."本书籍2购买成功,您原来的余额为".$db_bill."元，现在的余额为".$db_bill2."元！');location.href='index.php'</script>";
}
}
}
mysql_close($connection);//关闭连接
