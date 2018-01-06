<?php
//total_num 总记录数
//current_page 当前页
//perpage_num 每页显示
class Page{

    public $total_num;
    public $perpage_num;
    public $current_page;
    public $pages;

    public function __construct($total_num,$perpage_num,$current_page){
             header('content-type:text/html;charset=utf-8');
             $this ->total_num=$total_num;
             $this ->perpage_num=$perpage_num;
             $this ->current_page=$current_page;
             $this ->pages=ceil($total_num/$perpage_num);
          
    }

    public function showPage(){
        
            $page='';
            $page.="<a href='page.php?p=1'>首页</a>&nbsp;";
            $page.="<a href='page.php?p=".($this->current_page>=2?$this->current_page-1:1)."'>上一页</a>&nbsp;";

            for($i=1;$i<=$this->pages;$i++){
            $page.="<a href='page.php?p=$i'>";

                if($i==$this->current_page){
                    $page.="<font color=red>".$i."</font>";
                }else{
                    $page.=$i;
                }

            $page.="</a>&nbsp;";
            }

            $page.="<a href='page.php?p=".(($this->current_page)<=($this->pages-1)?($this->current_page+1):$this->pages)."'>下一页</a>&nbsp;";
            $page.="<a href='page.php?p=".$this->pages."'>尾页</a>";
            $page.=' | 总共'.$this->total_num.'条记录，目前是在'.$this->current_page.'页';
            echo $page;
    }


}



            $pdo=new PDO('mysql:host=localhost;dbname=pages','root','');
            $pdo ->exec('set names utf8');
            $res=$pdo->query("SELECT count(*) as num FROM user");
            $dbRes=$res ->fetch(PDO::FETCH_ASSOC);
            $total_num=$dbRes['num'];

            //每页显示条数
            $perpage_num=10;

            //总页数
            $pages=ceil($total_num/$perpage_num);

            $current_page=isset($_GET['p'])?$_GET['p']:1;
            //最前的10条记录
            $limit="LIMIT ".(($current_page-1)*10).",10";
            $data=$pdo ->query("SELECT id,name,createtime,age FROM user ".$limit);
            $dataRes=$data ->fetchAll(PDO::FETCH_ASSOC);


            $table="<table align=center border=1>";
            $table.="<tr>";
            $table.="<td>序号</td><td>姓名</td><td>年龄</td><td>创建时间</td>";
            $table.="</tr>";

            foreach($dataRes as $k=>$v){
                $table.="<tr><td>".$v['id']."</td><td>".$v['name']."</td><td>".$v['age']."</td><td>".$v['createtime']."</td></tr>";
            }
            $table.="</table>";


            echo $table;

            $pageObj=new Page($total_num,$perpage_num,$current_page);
            $pageObj->showPage();

            require './page.html';
          