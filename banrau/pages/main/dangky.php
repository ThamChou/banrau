<?php
//session_start();
if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hoten'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $matkhau = md5($_POST['matkhau']);
    $dienthoai = $_POST['dienthoai'];

    $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_dangky(tenkhachhang,email,diachi,matkhau,dienthoai) VALUE('" . $tenkhachhang . "','" . $email . "','" . $diachi . "','" . $matkhau . "','" . $dienthoai . "')");
    if ($sql_dangky) {
        echo '<p style="color:red">Bạn đã đăng ký thành công</p>';
        $_SESSION['dangky'] = $tenkhachhang;
        $_SESSION['dangky'] = $email;
        $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);

        header('Location:index.php?quanly=giohang');
    }
}
?>
<p>Đăng ký thành viên</p>
<form action="" method="POST">
    <table class="dangky" border="1" width="500px" cellspacing="0" cellpadding="10px">
        <!-- Họ tên row - Start -->
        <tr>
            <td width="100px">
                <label>Họ tên:</label>
            </td>
            <td>
                <input type="text" name="hoten" autocomplete="off" required="required" placeholder="Vui lòng nhập Họ tên" /> <!-- autofocus="autofocus"-->
            </td>
        </tr>
        <!-- Họ tên row - End -->
        <!-- Địa chỉ email row - End -->
        <tr>
            <td>
                <label>Email:</label>
            </td>
            <td>
                <input type="email" name="email" autocomplete="off" required="true" />
            </td>
        </tr>
        <!-- Mật khẩu row - Start -->
        <tr>
            <td>
                <label>Mật khẩu:</label>
            </td>
            <td>
                <input type="password" name="matkhau" required="required" maxlength="32" />
            </td>
        </tr>
        <!-- Nhập số Điện thoại row - Start -->
        <tr>
            <td>
                <label>Số điện thoại:</label>
            </td>
            <td>
                <input type="tel" name="dienthoai" autocomplete="off" required="true" pattern="[0-9]{10,}" title="Định dạng nhập là: Nhập 10 số xxxxxxxxxx" />
            </td>
        </tr>
        <!-- Địa chỉ nha row - Start -->
        <tr>
            <td>
                <label>Địa chỉ:</label>
            </td>
            <td>
                <input type="text" name="diachi" autocomplete="off" required="true" maxlength="200" />
            </td>
        </tr>

        <!-- Nút bấm row - Start -->
        <tr>
            <td align="center">
                <input type="submit" name="dangky" value="Đăng ký" />
            </td>
            <td><a href="index.php?quanly=dangnhap">Đăng nhập nếu có tài khoản</a></td>

        </tr>

        <!-- -->
    </table>

</form>