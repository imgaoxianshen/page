<?php
//total_num 总记录数
//current_page 当前页
//perpage_num 每页显示
header('content-type:text/html;charset=utf-8');
function dump($arr){
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";
}

$name=isset($_GET['name'])?$_GET['name']:'';
$age=isset($_GET['age'])?intval($_GET['age']):0;

$where=' where 1=1';

if(!empty($name)){
    $where.=" and name='".$name."'";
}
if(!empty($age)){
    $where.=' and age='.$age;
}

$orders='';
$order=isset($_GET['order'])?$_GET['order']:'';
if(!empty($order)){
    $orderBy= ($order =='plus')?'asc':'desc';
    $orders .=" order by age $orderBy ,id";
}
$pdo=new PDO('mysql:host=localhost;dbname=pages','root','');
$pdo ->exec('set names utf8');
$res=$pdo->query("SELECT count(*) as num FROM user".$where.$orders);
$dbRes=$res ->fetch(PDO::FETCH_ASSOC);
$total_num=$dbRes['num'];

//每页显示条数
$perpage_num=5;

//总页数
$pages=ceil($total_num/$perpage_num);

$current_page=isset($_GET['p'])?$_GET['p']:1;

//最前的10条记录
$limit=" LIMIT ".(($current_page-1)*$perpage_num).",$perpage_num";
$data=$pdo ->query("SELECT id,name,createtime,age FROM user ".$where.$orders.$limit);
$dataRes=$data ->fetchAll(PDO::FETCH_ASSOC);


// $table="<table align=center border=1>";
// $table.="<tr>";
// $table.="<td>序号</td><td>姓名</td><td>年龄</td><td>创建时间</td>";
// $table.="</tr>";

// foreach($dataRes as $k=>$v){
//     $table.="<tr><td>".$v['id']."</td><td>".$v['name']."</td><td>".$v['age']."</td><td>".$v['createtime']."</td></tr>";
// }
// $table.="</table>";


// echo $table;


// $page='';
// $page.="<a href='page.php?p=1'>首页</a>&nbsp;";
// $page.="<a href='page.php?p=".($current_page>=2?$current_page-1:1)."'>上一页</a>&nbsp;";

// for($i=1;$i<=$pages;$i++){
// $page.="<a href='page.php?p=$i'>";

//     if($i==$current_page){
//         $page.="<font color=red>".$i."</font>";
//     }else{
//         $page.=$i;
//     }

// $page.="</a>&nbsp;";
// }

// $page.="<a href='page.php?p=".($current_page<=$pages-1?$current_page+1:$pages)."'>下一页</a>&nbsp;";
// $page.="<a href='page.php?p=".$pages."'>尾页</a>";
// $page.=' | 总共'.$total_num.'条记录，目前是在'.$current_page.'页';
// echo $page;
require './pagenation.php';