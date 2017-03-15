<?php
//禁用错误报告
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
require_once 'conn.php';
if(isset($_POST["username"])&&$_POST["password"])
{
	
 $uname=$_POST["username"];
 $pwd=$_POST["password"];
 
$uname = mysql_real_escape_string($uname);//防止SQL注入
$pwd = mysql_real_escape_string($pwd);//防止SQL注入


$query = "select * from user where uname='".$uname."' and pwd='".$pwd."'";//构建查询语句


$result = mysql_query($query);//执行查询


if (!$result) {
    die("could not to the database\n" . mysql_error());
}
if (mysql_numrows($result)<=0) {
	echo "<script type='text/javascript'>alert('登录错误，请重新登录！');location.href='index.html'</script>";
}else{
	while($result_row=mysql_fetch_row(($result)))//取出结果并显示
{
$uid=$result_row[0];
$db_uname=$result_row[1];
$db_pwd=$result_row[2];
$db_bill=$result_row[3];

echo "欢迎回来".$db_uname." !!</br>";;
echo "用户名为:".$db_uname."</br>";
echo "密码为:".$db_pwd."</br>";
echo "余额为:".$db_bill."</br>";
echo "<hr/>";

echo "<hr/>";
echo "<center>购买书籍</center>";
echo "<hr/>";
}
}
mysql_close($connection);//关闭连接

}
?>
<!DOCTYPE html>
<head>
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<title>后台页面</title>
<meta name="description" content="slick Login">
<meta name="author" content="MRYE+">

<script type="text/javascript" src="jquery-latest.min.js"></script>
<script type="text/javascript" src="placeholder.js"></script>
</head>
<body>
<!--<a href="index.php?url=#">I</a>-->
<form id="myForm" action="buy.php" method="post">
<table>
<tr>
<td>书籍1</td>
<td>书籍2</td>
</tr>
<tr>
<td><img src="book1.png" width="130px" height="260px"></td>
<td><img src="book2.png" width="130px" height="260px"></td>
</tr>
<tr>
<td>价格：10元/册<input type="hidden" id="bill1" name="bill1" value="10"/></td>
<td>价格：20元/册<input type="hidden" id="bill2" name="bill2" value="20"/></td>
</tr>
<tr>
<td><label for="num">数量</label><input type="text" id="num1" name="num1" value="0"/></td>
<td><label for="num">数量</label><input type="text" id="num2" name="num2" value="0"/></td>
</tr><input type="hidden" id="uid" name="uid" value="<?=$uid ?>"/>
<tr><td colspan="2"><input type="submit" value="购买"></td></tr>
</table>

</form>
</body>
</html>
