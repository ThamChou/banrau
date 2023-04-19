<p>Giỏ hàng
    <?php
    if (isset($_SESSION['dangky'])) {
        echo 'xin chào: '  . '<span style="color:red">' . $_SESSION['dangky'] . '</span>';
        //echo $_SESSION['id_khachhang'];
    }
    ?>

</p>

<?php
if (isset($_SESSION['cart'])) {
}
?>
<table style="width:100%; text-align:center;">
    <tr>
        <!-- <th>Id</th> -->
        <th>Mã sp</th>
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Số lượng</th>
        <th>Giá sp</th>
        <th>Thành tiền</th>
        <th>Quản lý</th>
    </tr>
    <?php
    if (isset($_SESSION['cart'])) {
        $i = 0;
        $tongtien = 0;
        foreach ($_SESSION['cart'] as $cart_item) {
            $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
            $tongtien += $thanhtien; //cộng 2 sp lại với nhau ra tổng, sau đó lấy tổng cộng sp tiếp theo
            $i++;

    ?>
            <tr>
                <!--    <td><?php echo $i; ?></td> -->
                <td><?php echo $cart_item['masp'] ?></td>
                <td><?php echo $cart_item['tensanpham'] ?></td>
                <td><img src="admin/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'] ?>" width="150px"></td>
                <td>
                    <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>"><i class="fas fa-plus" style="color: black;"></i></a>
                    <?php echo $cart_item['soluong'] ?>
                    <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>"><i class="fas fa-minus" style="color: black;"></i></a>

                </td>
                <td><?php echo number_format($cart_item['giasp'], 0, ',', '.') . 'vnd' ?></td>
                <td><?php echo number_format(($thanhtien), 0, ',', '.') . 'vnd' ?></td>
                <td><a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>"><i class="fas fa-trash" style="color: black;"></i></a></td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="8">
                <p style="float: left;">Tổng tiền: <?php echo number_format(($tongtien), 0, ',', '.') . 'vnd' ?></p><br>
                <p style="float: right;"><a href="pages/main/themgiohang.php?xoatatca=1"><button>Xóa tất cả</button></a></p> <!--bằng 1 có nghĩa là true, =0 là false-->
                <div style="clear: both;"></div>
                <?php
                if (isset($_SESSION['dangky'])) {
                ?>
                    <p><a href="pages/main/thanhtoan.php">Đặt hàng</a></p>
                <?php

                } else {
                ?>
                    <p><a href="index.php?quanly=dangky"><button>Đăng ký đặt hàng</button></a></p>
                <?php
                }
                ?>

            </td>

        </tr>
    <?php
    } else {

    ?>
        <tr>
            <td colspan="8">
                <p>Hiện tại giỏ hàng trống</p>
            </td>

        </tr>

    <?php
    }
    ?>

</table>