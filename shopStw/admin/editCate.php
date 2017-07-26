<?php 
require_once '../include.php';
checkLogined();
$id = $_REQUEST['id'];
$row = getCateById($id);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
	<script type="text/javascript" src = "scripts/jquery-1.6.4.js"></script>
</head>
<body>
<h3>修改分类</h3>
	<form id = "form1" action="doAdminAction.php?act=editCate&id=<?php echo $id;?>" method = "post">
		<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
			<tr>
				<td>分类名称</td>
				<td><input type = "text" id = "cName" name = "cName" placeholder = "<?php echo $row['cName'];?>"/></td>
			</tr>
			<tr>
				<td colspan = "2"><input type = "button" value = "修改分类" onclick = "checkNull()"/></td>
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