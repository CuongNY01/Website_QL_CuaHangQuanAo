<?php

function sanpham_showAll(){
    $sql = "SELECT sanpham.*, danhmuc.tendanhmuc FROM sanpham LEFT JOIN danhmuc ON sanpham.iddanhmuc = danhmuc.iddanhmuc ORDER BY sanpham.id DESC";
    return pdo_query($sql);
}

function sanpham_showHot(){
    $sql = "SELECT sanpham.*, danhmuc.tendanhmuc FROM sanpham LEFT JOIN danhmuc ON sanpham.iddanhmuc = danhmuc.iddanhmuc ORDER BY sanpham.id DESC LIMIT 8";
    return pdo_query($sql);
}

function sanpham_showId_1(){
    $sql = "SELECT * FROM sanpham WHERE iddanhmuc=1 ORDER BY id DESC";
    return pdo_query($sql);
}

function sanpham_showId_2(){
    $sql = "SELECT * FROM sanpham WHERE iddanhmuc=2 ORDER BY id DESC";
    return pdo_query($sql);
}

function sanpham_showId_3(){
    $sql = "SELECT * FROM sanpham WHERE iddanhmuc=3 ORDER BY id DESC";
    return pdo_query($sql);
}

function sanpham_showId_4(){
    $sql = "SELECT * FROM sanpham WHERE iddanhmuc=4 ORDER BY id DESC";
    return pdo_query($sql);
}

function sanpham_showId_5(){
    $sql = "SELECT * FROM sanpham WHERE iddanhmuc=5 ORDER BY id DESC";
    return pdo_query($sql);
}

function sanpham_showId($id){
    $sql = "SELECT * FROM sanpham WHERE iddanhmuc=? ORDER BY id DESC";
    return pdo_query($sql, $id);
}

function sanpham_showChiTiet($id){
    $sql = "SELECT sanpham.*, danhmuc.tendanhmuc FROM sanpham LEFT JOIN danhmuc ON sanpham.iddanhmuc = danhmuc.iddanhmuc WHERE sanpham.id=?";
    return pdo_query_one($sql, $id);
}

function sanpham_insert($tensp, $avata, $gia, $danhmuc){
    $sql = "INSERT INTO sanpham(tensp, hinh, gia, iddanhmuc) VALUES(?, ?, ?, ?)";
    pdo_execute($sql, $tensp, $avata, $gia, $danhmuc);
}

function sanpham_update($tensp, $hinh, $gia, $danhmuc, $id){
    $sql = "UPDATE sanpham SET tensp=?, hinh=?, gia=?, iddanhmuc=? WHERE id=?";
    pdo_execute($sql, $tensp, $hinh, $gia, $danhmuc, $id);
}

function sanpham_delete($id){
    $sql_del_bl = "DELETE FROM binhluan WHERE idsp=?";
    pdo_execute($sql_del_bl, $id);

    $sql = "DELETE FROM sanpham WHERE id=?";
    pdo_execute($sql, $id);
}

function sanpham_seach($name){
    $sql = "SELECT sanpham.*, danhmuc.tendanhmuc FROM sanpham LEFT JOIN danhmuc ON sanpham.iddanhmuc = danhmuc.iddanhmuc WHERE sanpham.tensp LIKE ? OR danhmuc.tendanhmuc LIKE ? ORDER BY sanpham.id DESC";
    return pdo_query($sql, '%' . $name . '%', '%' . $name . '%');
}
?>
