<?php
session_start();
include('../../admin/config/config.php');
//them so luong
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
            );
            $_SESSION['cart'] = $product;
        } else {
            $tangsoluong = $cart_item['soluong'] + 1;
            if ($cart_item['soluong'] <= 9) {

                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $tangsoluong,
                    'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
                );
            } else {
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'],
                    'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
                );
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('Location:../../index.php?quanly=giohang');
}

//tru so luong
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
            );
            $_SESSION['cart'] = $product;
        } else {
            $tangsoluong = $cart_item['soluong'] - 1;
            if ($cart_item['soluong'] > 1) {

                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $tangsoluong,
                    'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
                );
            } else {
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'],
                    'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
                );
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('Location:../../index.php?quanly=giohang');
}
//xoa sp
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
            );
        }
        $_SESSION['cart'] = $product;
        header('Location:../../index.php?quanly=giohang');
    }
}
//xóa tất cả
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']); //chi dinh 1 cai session can xoa
    header('Location:../../index.php?quanly=giohang');
}
//them sp vao gio hang
if (isset($_POST['themgiohang'])) {
    //session_destroy(); //pha huy session cũ
    $id = $_GET['idsanpham'];
    $soluong = 1;
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='" . $id . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);

    if ($row) {
        $new_product = array(array(
            'tensanpham' => $row['tensanpham'], 'id' => $id, 'soluong' => $soluong,
            'giasp' => $row['giasp'], 'hinhanh' => $row['hinhanh'], 'masp' => $row['masp']
        )); //mang 1
        //kiem tra session gio hang ton tai
        if (isset($_SESSION['cart'])) {
            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                //nếu dữ liệu trùng
                if ($cart_item['id'] == $id) {
                    $product[] = array(
                        'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $soluong + 1,
                        'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
                    );
                    $found = true;
                } else { //nếu dữ liệu ko trùng
                    $product[] = array(
                        'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'],
                        'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
                    ); //mang2
                }
            }
            if ($found == false) {
                //liên kết dữ liệu new_product với product
                $_SESSION['cart'] = array_merge($product, $new_product); //lien ket mang: neu sp ko trung thi lien ket mang1 va mang2
            } else {
                $_SESSION['cart'] = $product; //nếu session cart ko tồn tại thì tạo cho mình mảng new_product, nếu sp trùng thì số lượng sẽ tăng 1 và tạo cho mình cái mảng product nữa ở dòng 23
            }
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
    header('Location:../../index.php?quanly=giohang');
}
