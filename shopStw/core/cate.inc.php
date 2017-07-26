<?php
/**
 * 添加分类
 * @return string
 */
function addCate(){
    $arr = $_POST;
    if (insert("stw_cate", $arr)) {
        $mes = "分类添加成功!<br/><a href = 'addCate.php'>继续添加</a>|<a href = 'listCate.php'>查看分类</a>";
    } else {
        $mes = "分类添加失败!<br/><a href = 'addCate.php'>重新添加</a>|<a href = 'listCate.php'>查看分类</a>";
    }
    return $mes;
}

/**
 * 根据id得到指定的信息
 * @param int $id
 * @return multitype
 */
function getCateById($id){
    $sql = "select * from stw_cate where id = '{$id}'";
    return fetchOne($sql);
}

/**
 * 修改分类
 * @param int $id
 * @return string
 */
function editCate($id){
    $arr = $_POST;
    if (update("stw_cate", $arr, " id = '{$id}'")) {
        $mes = "分类修改成功!<br/><a href = 'listCate.php'>查看分类</a>";
    } else {
        $mes = "分类修改失败!<br/><a href = 'listCate.php'>重新修改</a>";
    }
    return $mes;
}

/**
 * 删除分类
 * @param int $id
 * @return string
 */
function delCate($id){
    $res = checkProExist($id);
    if (!$res) {
        if (delete("stw_cate", " id = '{$id}'")) {
            $mes = "分类删除成功!<br/><a href = 'listCate.php'>查看分类</a>";
        } else {
            $mes = "分类删除失败!<br/><a href = 'listCate.php'>重新删除</a>";
        }
    } else {
        $mes = "<script>
                if(window.confirm('检测到该分类下有商品，点击确定删除该分类下的商品!')){
			     window.location='doAdminAction.php?act=delProByCid&id={$id}';
		        } else {
                 window.location='listCate.php';
                }
                </script>";
    }
    return $mes;
}

/**
 * 得到所有分类
 * @return array
 */
function getAllCate(){
    $sql = "select * from stw_cate";
    $rows = fetchAll($sql);
    return $rows;
}