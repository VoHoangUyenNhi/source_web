<html>
    <head>
        <style>
            .book-table{
                border-collapse:collapse;
            }
            .book-table td, .book-table th{
                border:1px solid #000;
                padding:5px;
            }
            .book-item
            {
                text-align: center;
                width: 200px;
                border: 1px solid #cecece;
                border-radius: 15px;
                overflow: hidden;
                font-size: 17px;
                margin: 0 auto;
            }
            .book-item img
            {
                width: 100%;
            }
            .book-container {
                display: grid;
                grid-template-columns: repeat(5, auto);
                grid-gap: 10px;
            }
            .menu li{
                display:inline-block;
                padding:15px;
            }
            .menu{
                background-color:#ff5850;
                color:white;
                font-weight:bold;
            }
            .menu li a{
                text-decoration:none;
                color:white;
            }
        </style>
    </head>
    <body>
    <?php
        require_once "config.php";
        $sql = "SELECT * FROM the_loai";
        // Thực thi câu lệnh
        $result = $conn->query($sql);
        $list_the_loai = [];
        if ($result) 
        {
        // Lấy và chuyển tất cả các bộ dữ liệu sang dạng mảng kết hợp
        $list_the_loai = $result->fetch_all(MYSQLI_ASSOC);
        }
        $id_selected="";
        if(isset($_GET["the_loai"]))
        {
            $id_selected = $_GET["the_loai"];
        }
    ?>

    <div class="menu">
        <ul class="menu-item">
            <li><a href="./book.php">Trang chủ</a></li>
            <?php
            foreach ($list_the_loai as $row) 
            {?>
                <li><a href="./book.php?the_loai=<?php echo $row['id'];?>"><?php echo $row['ten_the_loai'];?></a></li>
            <?php
            }
            ?>
    </ul>
    </div>
    <!--
        <form action="book.php" method="get">
        Chọn thể loại:
        <select name="the_loai">
            <?php
            /*foreach($list_the_loai as $row)
            {
                $attr="";
                if($id_selected==$row["id"])
                {
                    $attr="selected";
                }
            ?>
                <option value="<?php echo $row['id'];?>" <?php echo $attr;?>><?php echo $row['ten_the_loai'];?></option>
            <?php
            }*/


            ?>
        </select>
        <input type="submit" value="Xem">
        </form>
    -->
<?php
    $sql = "select * from sach order by gia_ban desc limit 10";
    if(isset($_GET["the_loai"]))
    {
        $the_loai = $_GET["the_loai"];
    //Viết câu lệnh SQL
    $sql = "SELECT id, tieu_de, tac_gia, hinh_thuc_bia, gia_ban, nha_xuat_ban, file_anh_bia
                    FROM sach
                    WHERE id_the_loai = ".$the_loai." limit 10";
    }
    // Thực thi câu lệnh
    $result = $conn->query($sql);
    if ($result) {
        // Lấy và chuyển tất cả các bộ dữ liệu sang dạng mảng kết hợp
        $book = $result->fetch_all(MYSQLI_ASSOC);
        // Hiển thị kết quả
        ?>
        <div class="book-container">
        <?php   
        foreach ($book as $row) {
        ?>
           <div class="book-item">
            <a href="book_detail.php?id=<?php echo $row['id'];?>">
            <img src="./book_image/<?php echo $row['file_anh_bia'];?>"><br>
            <b><?php echo $row['tieu_de'];?></b><br>
            <i><?php echo $row['gia_ban'];?>đ</i></a>
            </div>
        <?php
        }
        echo "</div>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
    $conn->close();
?>
    </body>
</html>


   


