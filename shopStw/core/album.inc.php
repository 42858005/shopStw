<?php
/**
 * 插入
 * @param array $arr
 */
function addAlbum($arr){
    insert("stw_album", $arr);
}

/**
 * 根据商品id得到商品图片
 * @param int $id
 * @return array
 */
function getProImgById($id){
    $sql = "select albumPath from stw_album where pId = {$id} limit 1";
    $row = fetchOne($sql);
    return $row;
}

/**
 * 根据商品id得到所有图片
 * @param int $id
 * @return array
 */
function getProImgsById($id){
    $sql = "select albumPath from stw_album where pId = {$id}";
    $rows = fetchAll($sql);
    return $rows;
}

/**
 * 添加文字水印
 * @param int $id
 * @return string
 */
function doWaterText($id){
    $rows = getProImgsById($id);
    foreach ($rows as $row) {
        $filename = "../image_800/".$row['albumPath'];
        waterText($filename);
    }
    $mes = "添加文字水印成功!<br/><a href = 'listProImages.php'>返回</a>";
    return $mes;
}

/**
 * 添加图片水印
 * @param int $id
 * @return string
 */
function doWaterPic($id){
    $rows = getProImgsById($id);
    foreach ($rows as $row) {
        $filename = "../image_800/".$row['albumPath'];
        waterPic($filename);
    }
    $mes = "添加图片水印成功!<br/><a href = 'listProImages.php'>返回</a>";
    return $mes;
}