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
<h3>添加分类</h3>
	<form id = "form1" action="doAdminAction.php?act=addCate" method = "post">
		<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
			<tr>
				<td>分类名称</td>
				<td><input type = "text" id = "cName" name = "cName" placeholder = "请输入分类名称"/></td>
			</tr>
			<tr>
				<td colspan = "2"><input type = "button" value = "添加分类" onclick = "checkNull()"/></td>
			</tr>
		</table>
	</form>
</body>
<script type="text/javascript">
function checkNull(){
	if ($("#cName").val() == "") {
		alert("分类名称不能为空");
		return false;
	}
	$("#form1").submit();
	return true;
}
</script>
</html>