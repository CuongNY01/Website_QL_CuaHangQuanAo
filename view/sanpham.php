<link rel="stylesheet" href="../view/css/products.css">

<div class="banner">
    <img src="https://file.hstatic.net/200000973638/file/bannerlaliga.jpeg" alt="">
</div>
<div class="product" style="margin-top: 50px; margin-bottom: 2rem;">
    <div class="ten">
        <p>Trang chủ</p><i class="fa-solid fa-caret-right"></i>
        <p style="font-weight: bold;">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
          $dsdanhmmuc = danhmuc_showId($id);
          extract($dsdanhmmuc);
                    echo " $tendanhmuc " ;
            }
            ?>
        </p>
    </div>
    <div class="sanpham">
        <?php

           if (isset($_GET['id'])) {
               $id = $_GET['id'];
              $iddanhmuc=sanpham_showId($id);
                // var_dump($iddanhmuc);
               
               foreach($iddanhmuc as $row){
                echo '
                <div class="sanpham1">
                    <form method = "POST" action = "../controller/index.php?act=cart">
                    <nav style="background: #fff"; margin: "2rem";>
                    <img src="../view/images/' . $row['hinh'] . '" alt="">
                    <div class="content" >   
                                <h3 clas="tensp" style"width: 70%> ' . substr($row['tensp'], 0, 45)  . '</h3>
                  
                                <p>' . $row['gia'] . ' VNĐ</p>
                                <input type="hidden" name="hinh" value="' . $row['hinh'] . '"/>
                                 <input type="hidden" name="gia" value="' . $row['gia'] . '"/>
                                <input type="hidden" name="tensp" value="' . $row['tensp'] . '"/>
                                <input type="hidden" name="soluong" value="1">
                            <div class="buy">
                                <button> <a href="../controller/index.php?act=chitiet&idsp='. $row['id'].'">Xem chi tiết</a></button>
                                <input type="submit" value="Mua Ngay" name="addcart">
                            </div>
                      </div>  
                      </nav>
                    </form>
                </div>
                ';
               }
            }
        ?>

    </div>
</div>