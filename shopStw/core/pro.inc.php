<?php
/**
 * 添加商品
 * @return string
 */
function addPro(){
    $arr = $_POST;
    $arr['pubTime'] = time();
    $path = "./uploads";
    $uploadFiles = uploadFile($path);
    if (is_array($uploadFiles) && $uploadFiles) {
        foreach ($uploadFiles as $key => $uploadFile) {
            thumb($path."/".$uploadFile['name'], "../image_50/".$uploadFile['name'], 50, 50);
            thumb($path."/".$uploadFile['name'], "../image_220/".$uploadFile['name'], 220, 220);
            thumb($path."/".$uploadFile['name'], "../image_350/".$uploadFile['name'], 350, 350);
            thumb($path."/".$uploadFile['name'], "../image_800/".$uploadFile['name'], 800, 800);
        }
    }
    $res = insert("stw_pro", $arr);
    $pid = $res;
    if ($res && $pid) {
        foreach ($uploadFiles as $uploadFile) {
            $arr1['pid'] = $pid;
            $arr1['albumPath'] = $uploadFile['name'];
            addAlbum($arr1);
        }
        $mes = "添加成功<br/><a href = 'addPro.php' target = 'mainFrame'>继续添加</a>|<a href = 'listPro.php' target = 'mainFrame'>查看商品列表</a>";
    } else {
        foreach ($uploadFiles as $uploadFile) {
            if (file_exists("../image_800/".$uploadFile['name'])) {
                unlink("../image_800/".$uploadFile['name']);
            }
            if (file_exists("../image_50/".$uploadFile['name'])) {
                unlink("../image_50/".$uploadFile['name']);
            }
            if (file_exists("../image_220/".$uploadFile['name'])) {
                unlink("../image_220/".$uploadFile['name']);
            }
            if (file_exists("../image_350/".$uploadFile['name'])) {
                unlink("../image_350/".$uploadFile['name']);
            }
        }
        $mes = "添加失败<br/><a href = 'addPro.php' target = 'mainFrame'>重新添加</a>";
    }
    return $mes;
}

/**
 * 得到商品所有信息
 * @return array
 */
function getAllProByAdmin(){
    $sql = "select p.*,c.cName from stw_pro as p join stw_cate c on p.cId = c.id";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 根据商品id得到相对应相册表里的图片
 * @param int $id
 * @return array
 */
function getAllImgByProId($id){
    $sql = "select * from stw_album where pId = '{$id}'";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 根据商品id得到商品详细信息
 * @param int $id
 * @return array
 */
function getProById($id){
    $sql = "select p.*,c.cName from stw_pro as p join stw_cate c on p.cId = c.id where p.id = '{$id}'";
    $row = fetchOne($sql);
    return $row;
}

/**
 * 编辑商品
 * @param int $id
 * @return string
 */
function editPro($id){
    $arr = $_POST;
    $path = "./uploads";
    $uploadFiles = uploadFile($path);
    if (is_array($uploadFiles) && $uploadFiles) {
        foreach ($uploadFiles as $key => $uploadFile) {
            thumb($path."/".$uploadFile['name'], "../image_50/".$uploadFile['name'], 50, 50);
            thumb($path."/".$uploadFile['name'], "../image_220/".$uploadFile['name'], 220, 220);
            thumb($path."/".$uploadFile['name'], "../image_350/".$uploadFile['name'], 350, 350);
            thumb($path."/".$uploadFile['name'], "../image_800/".$uploadFile['name'], 800, 800);
        }
    }
    $res = update("stw_pro", $arr, "id = '{$id}'");
    $pid = $id;
    if ($res && $pid || $uploadFiles) {
        if ($uploadFiles && is_array($uploadFiles)) {
            foreach ($uploadFiles as $uploadFile) {
                $arr1['pid'] = $pid;
                $arr1['albumPath'] = $uploadFile['name'];
                addAlbum($arr1);
            }
        }
        $mes = "编辑成功<br/><a href = 'listPro.php' target = 'mainFrame'>查看商品列表</a>";
    } else {
        if (is_array($uploadFiles) && $uploadFiles) {
            foreach ($uploadFiles as $uploadFile) {
                if (file_exists("../image_800/".$uploadFile['name'])) {
                    unlink("../image_800/".$uploadFile['name']);
                }
                if (file_exists("../image_50/".$uploadFile['name'])) {
                    unlink("../image_50/".$uploadFile['name']);
                }
                if (file_exists("../image_220/".$uploadFile['name'])) {
                    unlink("../image_220/".$uploadFile['name']);
                }
                if (file_exists("../image_350/".$uploadFile['name'])) {
                    unlink("../image_350/".$uploadFile['name']);
                }
            }
        }
        $mes = "编辑失败<br/><a href = 'listPro.php' target = 'mainFrame'>重新编辑</a>";
    }
    return $mes;
}

/**
 * 事务删除商品
 * @param int $id
 * @return string
 */
function delPro($id){
    return delProWork($id);
}

/**
 * 根据商品分类的id删除商品
 * @param int $cId
 * @return string
 */
function delProByCid($cId){
    $rows = checkProExist($cId);
    foreach ($rows as $row) {
        $res = delPro($row['id']);
    }
    return $res;
}

/**
 * 检查分类下是否有产品
 * @param int $cId
 * @return array
 */
function checkProExist($cId){
    $sql = "select * from stw_pro where cId = '{$cId}'";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 根据分类id得到4条商品
 * @param int $cId
 * @return array
 */
function getProsByCid($cId){
    $sql = "select p.*,c.cName from stw_pro as p join stw_cate c on p.cId = c.id where p.cId = '{$cId}' limit 4";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 得到下4条产品
 * @param int $cId
 * @return array
 */
function getSmallProsByCid($cId){
    $sql = "select p.*,c.cName from stw_pro as p join stw_cate c on p.cId = c.id where p.cId = '{$cId}' limit 4,4";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 得到所有商品
 * @return array
 */
function getProInfo(){
    $sql = "select * from stw_pro order by id asc";
    $rows = fetchAll($sql);
    return $rows;
}