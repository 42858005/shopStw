<?php 
require_once '../include.php';
checkLogined();
$id = $_REQUEST['id'];
$sql = "select * from stw_admin where id = '{$id}'";
$row = fetchOne($sql);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
	<script type="text/javascript" src = "scripts/jquery-1.6.4.js"></script>
</head>
<body>
<h3>编辑管理员</h3>
	<form id = "form1" action="doAdminAction.php?act=editAdmin&id=<?php echo $id;?>" method = "post">
		<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
			<tr>
				<td>管理员名称</td>
				<td><input type = "text" id = "username" name = "username" value = "<?php echo $row['username'];?>" placeholder = "<?php echo $row['username'];?>"/></td>
			</tr>
			<tr>
				<td>管理员密码</td>
				<td><input type = "password" id = "password" name = "password" value = "<?php echo $row['password'];?>"/></td>
			</tr>
			<tr>
				<td>管理员邮箱</td>
				<td><input type = "text" id = "email" name = "email" value = "<?php echo $row['email'];?>" placeholder = "<?php echo $row['email'];?>"/></td>
			</tr>
			<tr>
				<td colspan = "2"><input type = "button" value = "编辑管理员" onclick = "checkNull()"/></td>
			</tr>
		</table>
	</form>
</body>
<script type="text/javascript">
function checkNull(){
	if ($("#username").val() == "") {
		alert("管理员名称不能为空");
		return false;
	}
	if ($("#password").val() == "") {
		alert("管理员密码不能为空");
		return false;
	}
	if ($("#email").val() == "") {
		alert("管理员邮箱不能为空");
		return false;
	}
	$("#form1").submit();
	return true;
}
</script>
</html>