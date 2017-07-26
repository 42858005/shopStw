<?php
require_once '../include.php';
checkLogined();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
	<script type="text/javascript" src = "scripts/jquery-1.6.4.js"></script>
</head>
<body>
<h3>添加用户</h3>
	<form id = "form1" action="doAdminAction.php?act=addUser" method = "post" enctype = "multipart/form-data">
		<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
			<tr>
				<td>名称</td>
				<td><input type = "text" id = "username" name = "username" placeholder = "请输入名称"/></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type = "password" id = "password" name = "password"/></td>
			</tr>
			<tr>
				<td>邮箱</td>
				<td><input type = "text" id = "email" name = "email" placeholder = "请输入邮箱"/></td>
			</tr>
			<tr>
				<td>性别</td>
				<td>
					<input type = "radio" name = "sex" value = "1" checked = "checked"/>男
					<input type = "radio" name = "sex" value = "2"/>女
					<input type = "radio" name = "sex" value = "3"/>保密
				</td>
			</tr>
			<tr>
				<td>头像</td>
				<td><input type = "file" id = "myFile" name = "myFile" /></td>
			</tr>
			<tr>
				<td colspan = "2"><input type = "button" value = "添加用户" onclick = "checkNull()"/></td>
			</tr>
		</table>
	</form>
</body>
<script type="text/javascript">
function checkNull(){
	if ($("#username").val() == "") {
		alert("用户名称不能为空");
		return false;
	}
	if ($("#password").val() == "") {
		alert("用户密码不能为空");
		return false;
	}
	if ($("#email").val() == "") {
		alert("用户邮箱不能为空");
		return false;
	}
	$("#form1").submit();
	return true;
}
</script>
</html>