<?php
/**
 * 检查是否为管理员
 * @param unknown $sql
 * @return multitype
 */
function checkAdmin($sql){
    return fetchOne($sql);
}

/**
 * 检查是否登陆
 */
function checkLogined(){
    if (@$_SESSION['adminId'] == "" && @$_COOKIE['adminId'] == "") {
        alertMes("请先登陆", "login.php");
    }
}

/**
 * 添加管理员
 * @return string
 */
function addAdmin(){
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    if (insert("stw_admin", $arr)) {
        $mes = "添加成功!<br/><a href = 'addAdmin.php'>继续添加</a>|<a href = 'listAdmin.php'>查看管理员列表</a>";
    } else {
        $mes = "添加失败!<br/><a href = 'addAdmin.php'>重新添加</a>";
    }
    return $mes;
}

/**
 * 得到所有管理员
 * @return multitype
 */
function getAllAdmin(){
    $sql = "select * from stw_admin";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 编辑管理员
 * @param int $id
 * @return string
 */
function editAdmin($id){
    $arr = $_POST;
    //先判断密码有没有改，输入框获取的密码是经过md5加密的
    $sql = "select * from stw_admin where id = '{$id}'";
    $row = fetchOne($sql);
    if ($arr['password'] != $row['password']) {
        $arr['password'] = md5($_POST['password']);
    }
    if (update("stw_admin", $arr, "id={$id}")) {
        $mes = "编辑成功!<br/><a href = 'listAdmin.php'>查看管理员列表</a>";
    } else {
        $mes = "编辑失败!<br/><a href = 'listAdmin.php'>请重新修改</a>";
    }
    return $mes;
}

/**
 * 删除管理员
 * @param int $id
 * @return string
 */
function delAdmin($id){
    if (delete("stw_admin", "id = '{$id}'")) {
        $mes = "删除成功!<br/><a href = 'listAdmin.php'>查看管理员列表</a>";
    } else {
        $mes = "删除失败!<br/><a href = 'listAdmin.php'>重新删除</a>";
    }
    return $mes;
}

/**
 * 注销
 */
function logout(){
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(),"",time()-1);
    }
    if (isset($_COOKIE['adminId'])) {
        setcookie("adminId","",time()-1);
    }
    if (isset($_COOKIE['adminName'])) {
        setcookie("adminName","",time()-1);
    }
    session_destroy();
    alertMes("退出成功", "login.php");
}

/**
 * 添加用户
 * @return string
 */
function addUser(){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    $arr['regTime']=time();
    $uploadFile=uploadFile("../uploads");
    
    //print_r($uploadFile);
    if($uploadFile&&is_array($uploadFile)){
        $arr['face']=$uploadFile[0]['name'];
    }else{
        return "添加失败!<br/><a href = 'addUser.php'>重新添加</a>";
    }
    //	print_r($arr);exit;
    if(insert("stw_user", $arr)){
        $mes="添加成功!<br/><a href = 'addUser.php'>继续添加</a>|<a href = 'listUser.php'>查看列表</a>";
    }else{
        $filename="../uploads/".$uploadFile[0]['name'];
        if(file_exists($filename)){
            unlink($filename);
        }
        $mes="添加失败!<br/><a href = 'addUser.php'>重新添加</a>";
    }
    return $mes;
}

/**
 * 修改用户
 * @param int $id
 * @return string
 */
function editUser($id){
    $arr = $_POST;
    //先判断密码有没有改，输入框获取的密码是经过md5加密的
    $sql = "select * from stw_user where id = '{$id}'";
    $row = fetchOne($sql);
    if ($arr['password'] != $row['password']) {
        $arr['password'] = md5($_POST['password']);
    }
    if (update("stw_user", $arr, "id={$id}")) {
        $mes = "编辑成功!<br/><a href = 'listUser.php'>查看用户列表</a>";
    } else {
        $mes = "编辑失败!<br/><a href = 'listUser.php'>请重新修改</a>";
    }
    return $mes;
}

/**
 * 删除用户
 * @param int $id
 * @return string
 */
function delUser($id){
    if (delete("stw_user", "id = '{$id}'")) {
        $mes = "删除成功!<br/><a href = 'listUser.php'>查看用户列表</a>";
    } else {
        $mes = "删除失败!<br/><a href = 'listUser.php'>重新删除</a>";
    }
    return $mes;
}