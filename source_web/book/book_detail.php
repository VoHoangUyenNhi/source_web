<html>
    <head></head>
    <body>
        <?php
         require_once "config.php";
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                $sql="SELECT tieu_de, nha_cung_cap, nha_xuat_ban, tac_gia, hinh_thuc_bia, mo_ta, file_anh_bia FROM sach WHERE id=$id";
                $result = $conn->query($sql);
                if ($result) {
                    // Lấy và chuyển tất cả các bộ dữ liệu sang dạng mảng kết hợp
                    $book = $result->fetch_assoc();
                ?>
                <div style="width=70%; margin:0 auto; padding:5px;">
                    <h2><?php echo $book['tieu_de'];?></h2>
                    <div style="float:left;">
                        <img src="./book_image/<?php echo $book['file_anh_bia'];?>" width="200px">
                    </div>
                    <div style="float:left; margin-left:20px;">
                        Nhà cung cấp: <?php echo $book['nha_cung_cap'];?><br>
                        Nhà xuất bản: <?php echo $book['nha_xuat_ban'];?><br>
                        Tác giả: <?php echo $book['tac_gia'];?><br>
                        Hình thức bìa: <?php echo $book['hinh_thuc_bia'];?>
                    </div>
                    <br style="clear:both">
                    <div>
                        <b>Mô tả:</br><br></b>
                        <?php echo $book['mo_ta'];?>
                    </div>
                </div>
        <?php
            }
        }
        ?>
</body>
</html>