<?php

$sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY tbl_sanpham.id_sanpham DESC LIMIT 12";
$query_pro = mysqli_query($mysqli, $sql_pro);

?>
<h3>Sản phẩm mới nhất</h3>
<ul class="product_list">
    <?php
    while ($row = mysqli_fetch_array($query_pro)) {

    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                <img src="admin/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>">
                <p class="title_product"> <?php echo $row['tensanpham'] ?> </p>
                <p class="price_product">Giá: <?php echo number_format($row['giasp'], 0, ',', '.') . 'vnd' . '/kg'  ?></p>
                <p style="text-align: center;color:#c7c5c5"><?php echo $row['tendanhmuc'] ?></p> <!--tên danh mục màu trắng phía dưới sp-->
            </a>

        </li>
    <?php
    }
    ?>

</ul>
<!--
<div class="clear:both;"></div>
<style type="text/css">
    ul.list_trang {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    ul.list_trang li {
        float: left;
        padding: 5px 10px;
        margin: 5px;
        background: #c7c5c5;
    }

    ul.list_trang li a {
        color: black;
        text-align: center;
        text-decoration: none;
        /*bo gach chan*/
        display: block;
    }
</style>
<p>Trang</p>
<ul class="list_trang">

    <li><a href="">1</a></li>
    <li><a href="">2</a></li>
</ul>
-->