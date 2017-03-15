<?php 

//要过滤的非法字符 
$filter =     "/and|order|select|insert|update|delete|\’|\`|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i";
$postfilter = "/and|order|select|insert|update|delete|\’|\`|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/";

function InjectCheck($StrFiltrate,$filter){ 

 if (preg_match($filter,$StrFiltrate)){ 

	echo "输入非法的字符！\n";

	exit();
} 

} 
//验证开始   这个方法可以用post加大小写绕过

foreach($_GET as $key=>$value){ 

	InjectCheck($value,$filter);
} 

foreach($_POST as $key=>$value){ 

	InjectCheck($value,$postfilter);
} 

foreach($_COOKIE as $key=>$value){ 

	InjectCheck($value,$filter);
} 
foreach($_GET as $key=>$value){ 

	InjectCheck(base64_decode($value),$filter);
} 

foreach($_POST as $key=>$value){ 

	InjectCheck(base64_decode($value),$postfilter);
} 
/*  
为了减小难度  cookie不过滤
foreach($_COOKIE as $key=>$value){ 

	InjectCheck(base64_decode(base64_decode($value)),$postfilter);
}

*/
?>