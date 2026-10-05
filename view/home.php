<link rel="stylesheet" href="../view/css/index.css">
<link rel="stylesheet" href="../view/css/products.css">
<div class="banner">
     <img src="https://file.hstatic.net/200000973638/file/banner4.png" alt="">
</div>
<div class="product">
    <div class="balo" style="max-width: 1424px;">
        <div class="tille">
            <h3>Sản phẩm nổi bật</h3>
        </div>
        <div class="sanpham responsive">

            <?php

            $dssanpham = sanpham_showId_1();

            foreach ($dssanpham as $row) {
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
            

            ?>

        </div>
    </div>
    <div class="vali" style="margin-top: 250px;">
        <div class="tille">
            <h3>Sản phẩm ưu đãi</h3>
        </div>
        <div class="sanpham responsive">
            <?php
            $dssanpham = sanpham_showId_2();
            foreach ($dssanpham as $row) {
                echo '
                        <div class="sanpham1">
                            <form method = "POST" action = "../controller/index.php?act=cart">
                            <nav  style="background: #fff"; margin: "2rem";>
                                <img src="../view/images/' . $row['hinh'] . '" alt="" class:"anhsp">
                                <h3  clas="tensp" style"width: 70%; font-weight: 500; margin-left: 2rem;>' . substr($row['tensp'], 0, 45)  . '</h3>
                                <p>' . $row['gia'] . ' VNĐ</p>
                                <input type="hidden" name="hinh" value="' . $row['hinh'] . '"/>
                                <input type="hidden" name="tensp" value="' . $row['tensp'] . '"/>
                                <input type="hidden" name="gia" value="' . $row['gia'] . '"/>
                                <input type="hidden" name="soluong" value="1">
                                <div class="buy">
                                <button><a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">Xem chi tiết</a></button>
                                <input type="submit" value="Mua Ngay" name="addcart">
                                </div>
                                </nav>
                            </form>
                        </div>
                                 ';
            }
            ?>
        </div>
    </div>
    <div class="cap" style="margin-top: 60px;">
        <div class="tille">
            <h3>Sản phẩm khác</h3>
        </div>
        <div class="sanpham responsive">
            <?php
            $dssanpham = sanpham_showId_3();
            foreach ($dssanpham as $row) {
                echo '
                           <div class="sanpham1">
                               <form method = "POST" action = "../controller/index.php?act=cart">
                               <nav  style="background: #fff"; margin: "2rem";>
                                   <img src="../view/images/' . $row['hinh'] . '" alt="">
                                   <h3  clas="tensp" style"width: 70%; font-weight: 500; margin-left: 2rem;>' . substr($row['tensp'], 0, 45)  . '</h3>
                                   <p>' . $row['gia'] . ' VNĐ</p>
                                   <input type="hidden" name="hinh" value="' . $row['hinh'] . '"/>
                                   <input type="hidden" name="tensp" value="' . $row['tensp'] . '"/>
                                   <input type="hidden" name="gia" value="' . $row['gia'] . '"/>
                                   <input type="hidden" name="soluong" value="1">
                                   <div class="buy">
                                   <button><a href="../controller/index.php?act=chitiet&idsp=' . $row['id'] . '">Xem chi tiết</a></button>
                                   <input type="submit" value="Mua Ngay" name="addcart">
                                   </div>
                                   </nav>
                               </form>
                           </div>
                                    ';
            }
            ?>
        </div>
    </div>



</div>