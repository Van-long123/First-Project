<div class="container suggested-products">
    <div class="suggested-title">
        <h4>Sản phẩm bán chạy</h4>
    </div>
    <div class="suggest-products mt-3">
        <?php
        $conn=mysqli_connect('localhost','root','','fooddrink');
        $sql = "SELECT * FROM sanpham ORDER BY RAND() LIMIT 7";
        $result=mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_array($result)){
    ?>
        
        <a href="mota.php?idsp=<?php echo $row['id'] ?>">
            <div class="suggest-item">
                <img class="suggest-item-img " src="../image1/<?php echo $row['hinhanh']?>" alt="">
                <img class="img-ch" src="../image1/chinhhang.png" alt="">
                <p class="suggest-item-name mt-1 ms-1">
                    <?php echo $row['tensanpham'] ?>
                </p>
                <p class="suggest-item-price ms-1 mt-1">
                    <?php echo $row['gia'] ?><sup>đ</sup>
                </p>
            </div>
        </a>
        <?php  
        }
        ?>
    </div>
</div>

