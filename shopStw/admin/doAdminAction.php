<?php
require_once '../include.php';
$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
switch ($act) {
    case "logout":
        logout();
        break;
    case "addAdmin":
        $mes = addAdmin();
        break;
    case "editAdmin":
        $mes = editAdmin($id);
        break;
    case "delAdmin":
        $mes = delAdmin($id);
        break;
    case "addCate":
        $mes = addCate();
        break;
    case "editCate":
        $mes = editCate($id);
        break;
    case "delCate":
        $mes = delCate($id);
        break;
    case "addPro":
        $mes = addPro($id);
        break;
    case "editPro":
        $mes = editPro($id);
        break;
    case "delPro":
        $mes = delPro($id);
        break;
    case "delProByCid":
        $mes = delProByCid($id);
        break;
    case "addUser":
        $mes = addUser();
        break;
    case "editUser":
        $mes = editUser($id);
        break;
    case "delUser":
        $mes = delUser($id);
        break;
    case "waterText":
        $mes = doWaterText($id);
        break;
    case "waterPic":
        $mes = doWaterPic($id);
        break;
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
</head>
<body>
	<?php 
	   if ($mes) {
	       echo $mes;
	   }
	?>
</body>
</html>