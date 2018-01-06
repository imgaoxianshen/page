<html>
    <head>
       <meta http-equiv="content-type" content="text/html;charset=utf-8">
     <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.js"></script>
     <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
      

    <div class="text-center">
    
    <form class="form-horizontal" role="form" action="" method="get">
  <div class="form-group">
    <label for="firstname" class="col-sm-5 control-label">名字</label>
    <div class="col-sm-3">
      <input type="text" name="name" class="form-control"  placeholder="请输入名字" value=<?php if(isset($name)&&!empty($name))echo $name;?>>
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-5 control-label">年龄</label>
    <div class="col-sm-3">
      <input type="text" name="age" class="form-control"  placeholder="请输入年龄" value=<?php if(isset($age)&&!empty($age))echo $age;?>>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-10">
      <button type="submit" class="btn btn-default">查询</button>
    </div>
  </div>
</form>
</div>


<table class="table">
  <thead>
    <tr>
      <th>id</th>
      <th>名字</th>
      <th>创建时间</th>
      <th>年龄<a href="page.php?name=<?php if(isset($name)&&!empty($name)) echo $name;?>&age=<?php  if(isset($age)&&!empty($age)) echo $age;?>&p=<?echo  $current_page>=2?$current_page-1:1?>&order=plus">升序</a>
      |<a href="page.php?name=<?php if(isset($name)&&!empty($name)) echo $name;?>&age=<?php  if(isset($age)&&!empty($age)) echo $age;?>&p=<?echo  $current_page>=2?$current_page-1:1?>&order=less">降序</a></th></tr>
  </thead>
  <tbody>
      <?php foreach($dataRes as $v):?>
    <tr class="active">
      <td><? echo  $v['id'];?></td>
      <td><? echo  $v['name'];?></td>
      <td><?echo $v['createtime'];?></td>
      <td><?echo $v['age'];?></td></tr>
<?php endforeach;?>
  </tbody>
</table>

  

          <nav class="text-center">
            <ul class="pagination">
              <li><a href="page.php?name=<?php if(isset($name)&&!empty($name)) echo $name;?>&age=<?php  if(isset($age)&&!empty($age)) echo $age;?>&p=<?echo  $current_page>=2?$current_page-1:1?>">上一页</a></li>
              <?php for($i=1;$i<=$pages;$i++):?>

              <li <?php if($current_page==$i)echo "class='active'"?>>
              <a href="page.php?name=<?php if(isset($name)&&!empty($name))echo $name;?>&age=<?php  if(isset($age)&&!empty($age))echo $age;?>&p=<?php echo $i;?>"><?php echo $i;?></a>
              </li>
              <?php endfor;?>
              <li><a href="page.php?name=<?php if(isset($name)&&!empty($name))echo $name;?>&age=<?php  if(isset($age)&&!empty($age))echo $age;?>&p=<?php echo $current_page<=$pages-1?$current_page+1:$pages?>">下一页</a></li>
          </ul>
          </nav>

    </body>
</html>