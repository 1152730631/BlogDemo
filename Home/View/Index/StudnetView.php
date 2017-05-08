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
<body>

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
  <{foreach $arrs as $arr}>
  <tr align="center">
    <td> <{$arr[0]}> </td>
    <td><{$arr[1]}> </td>
    <td><{$arr[2]}> </td>
    <td><{$arr[3]}> </td>
    <td><{$arr[4]}> </td>
    <td><{$arr[5]}> </td>
    <td><{$arr[6]}> </td>
    <td><{$arr[7]}> </td>

    <td>
      <a href="#">修改</a>
      <a href="#">删除</a>
    </td>
  </tr>

  <{/foreach}>
</table>
</body>
</html>
