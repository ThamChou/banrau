
<?php
session_start();
include("../../admin/config/config.php");
require('../../mail/sendmail.php');
$id_khachhang = $_SESSION['id_khachhang'];
$code_order = rand(0, 9999);
$insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart,cart_status) VALUE('" . $id_khachhang . "','" . $code_order . "',1)";
$cart_query = mysqli_query($mysqli, $insert_cart);
if ($cart_query) {
    //them gio hang chi tiet
    foreach ($_SESSION['cart'] as $key => $value) {
        $id_sanpham = $value['id'];
        $soluong = $value['soluong'];
        $insert_order_chitiet = "INSERT INTO tbl_cart_chitiet(id_sanpham,code_cart,soluongmua) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
        mysqli_query($mysqli, $insert_order_chitiet);
    }
    $tieude = "Đặt hàng tại website bán rau củ thành công!";
    $noidung = "<p>Cảm ơn quý khách đã đặt hàng tại website bán rau củ với mã đơn hàng: " . $code_order . ", vui lòng chuẩn bị tiền để nhận hàng</p>";
    $maildathang = $_SESSION['email'];
    $mail = new Mailer();
    $mail->dathangmail($tieude, $noidung, $maildathang);
}
unset($_SESSION['cart']);
header('Location:../../index.php?quanly=camon');

?>