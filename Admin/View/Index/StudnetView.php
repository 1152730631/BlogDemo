<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>学生信息管理中心</title>
    <style media="screen">
      .divtitle{
        text-align: center;
        padding: 10px 0px;
      }
    </style>

  </head>
  <body bgcolor="#7fffd4">

    <div class="divtitle">
        <h2>学生信息管理中心</h2>

    </div>

    <table border="1" width='600' align='center' rules='all'>
        <tr>
          <th>编号</th>
          <th>姓名</th>
          <th>性别</th>
          <th>年龄</th>
          <th>学历</th>
          <th>工资</th>
          <th>奖金</th>
          <th>籍贯</th>
          <th>操作选项</th>
        </tr>
        <?php
          foreach ($arrs as $key => $value) {

        ?>
        <tr align="center">
          <td> <?php echo $value[0] ?></td>
          <td> <?php echo $value[1] ?></td>
          <td> <?php echo $value[2] ?></td>
          <td> <?php echo $value[3] ?></td>
          <td> <?php echo $value[4] ?></td>
          <td> <?php echo $value[5] ?></td>
          <td> <?php echo $value[6] ?></td>
          <td> <?php echo $value[7] ?></td>

          <td>
            <a href="#">修改</a>
            <a href="#">删除</a>
          </td>
        </tr>

        <?php } ?>
    </table>
  </body>
</html>
