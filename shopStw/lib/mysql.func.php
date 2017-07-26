<?php

function connect(){
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die('Connect Error:'.mysqli_connect_errno().":".mysqli_connect_error());
    mysqli_set_charset($link, 'UTF8');
    return $link;
}

/**
 * 插入记录操作
 * @param string $table
 * @param array $array
 * @return number
 */
function insert($table, $array){
    $link = connect();
    $keys = join(",", array_keys($array));
    $vals = "'".join("','", array_values($array))."'";
    $sql = "insert {$table}($keys) values({$vals})";
    mysqli_query($link, $sql);
    return mysqli_insert_id($link);
}

/**
 * 更新操作
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number
 */
function update($table, $array, $where = null){
    $link = connect();
    foreach ($array as $key => $val) {
        if ($str == null) {
            $sep = "";
        } else {
            $sep = ",";
        }
        $str .= $sep.$key."='".$val."'";
    }
    $sql = "update {$table} set {$str} ".($where == null ? null : " where ".$where);
    $result = mysqli_query($link, $sql);
    if ($result) {
        return mysqli_affected_rows($link);
    } else {
        return false;
    }
}

/**
 * 删除操作
 * @param string $table
 * @param string $where
 */
function delete($table, $where = null){
    $link = connect();
    $where = $where == null ? null : " where ".$where;
    $sql = "delete from {$table} {$where}";
    return mysqli_query($link, $sql);
}

/**
 * 查询一条
 * @param string $sql
 * @param string $result_type
 * @return multitype
 */
function fetchOne($sql, $result_type = MYSQLI_ASSOC){
    $link = connect();
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, $result_type);
    return $row;
}

/**
 * 得到结果集中所有记录
 * @param string $sql
 * @param string $result_type
 * @return multitype
 */
function fetchAll($sql, $result_type = MYSQLI_ASSOC){
    $link = connect();
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result)) {
        while (@$row = mysqli_fetch_array($result, $result_type)) {
            $rows[] = $row;
        }
    }
    
    return $rows;
}

/**
 * 得到结果集中的记录条数
 * @param string $sql
 * @return number
 */
function getResultNum($sql){
    $link = connect();
    $result = mysqli_query($link, $sql);
    return mysqli_num_rows($result);
}

/**
 * 得到上一步插入记录id
 * @return int
 */
function getInsertId(){
    $link = connect();
    return mysqli_insert_id($link);
}

function delProWork($id){
    $link = connect();
    $sql2 = "select * from stw_album where pId = '{$id}'";
    $proImgs = fetchAll($sql2);
    
    mysqli_autocommit($link, false);
    $sql = "delete from stw_pro where id = '{$id}'";
    $res = mysqli_query($link, $sql);
    $res_affect = mysqli_affected_rows($link);
    
    $sql1 = "delete from stw_album where pId = '{$id}'";
    $res1 = mysqli_query($link, $sql1);
    $res1_affect = mysqli_affected_rows($link);
    
    if ($res && $res_affect > 0 && $res1 && $res1_affect > 0) {
        mysqli_commit($link);
        mysqli_autocommit($link, true);
        mysqli_close($link);
        
        if ($proImgs && is_array($proImgs)) {
            foreach ($proImgs as $proImg) {
                if (file_exists("uploads/".$proImg['albumPath'])) {
                    unlink("uploads/".$proImg['albumPath']);
                }
                if (file_exists("../image_50/".$proImg['albumPath'])) {
                    unlink("../image_50/".$proImg['albumPath']);
                }
                if (file_exists("../image_220/".$proImg['albumPath'])) {
                    unlink("../image_220/".$proImg['albumPath']);
                }
                if (file_exists("../image_350/".$proImg['albumPath'])) {
                    unlink("../image_350/".$proImg['albumPath']);
                }
                if (file_exists("../image_800/".$proImg['albumPath'])) {
                    unlink("../image_800/".$proImg['albumPath']);
                }
            }
        }
        $mes = "商品删除成功!<br/><a href = 'listPro.php' target = 'mainFrame'>查看商品列表</a>";
    } else {
        mysqli_rollback($link);
        mysqli_close($link);
        $mes = "商品删除失败!<br/><a href = 'listPro.php' target = 'mainFrame'>重新删除</a>";
    }
    return $mes;
}