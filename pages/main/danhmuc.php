<?php

$sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc='$_GET[id]' ORDER BY id_sanpham DESC"; //sắp xếp theo sp, cái nào thêm trc vào trc
$query_pro = mysqli_query($mysqli, $sql_pro);

//get ten danhmuc
$sql_cate = "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc='$_GET[id]' LIMIT 1"; //lấy ra 1 dữ liệu
$query_cate = mysqli_query($mysqli, $sql_cate);
$row_title = mysqli_fetch_array($query_cate);

?>
<h3>Danh mục sản phẩm: <?php echo $row_title['tendanhmuc'] ?> </h3>
<ul class="product_list">
    <?php
    while ($row_pro = mysqli_fetch_array($query_pro)) {
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>">
                <img src="admin/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh'] ?>">
                <p class="title_product"> <?php echo $row_pro['tensanpham'] ?> </p>
                <p class="price_product">Giá: <?php echo number_format($row_pro['giasp'], 0, ',', '.') . 'vnd' . '/kg' ?></p>
            </a>

        </li>
    <?php
    }
    ?>

</ul>