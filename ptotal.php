<style>
        .tablecon{
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        @media print {
    button.print-button {
        display: none;
    }
}

</style>
<?php

session_start();
include 'server.php';

    $productids = [];
    foreach($_SESSION['cart'] as $cartId => $cartqty) {
        $productids[] = $cartId;
    }

    $ids = 0;
    if(count($productids) > 0){
        $ids = implode(', ',$productids);
    }

    $query = mysqli_query($conn, "SELECT * FROM products WHERE id IN($ids)");
    $rows = mysqli_num_rows($query);
    
    
    
    ?>
<html>
    <body>
    <?php
    $_SESSION['total'] = 0;
        ?>
        <h3 style="text-align: center;">รายการทั้งหมด</h3>
        <div class="tablecon">
        <table>
        <tr>
            <th>Product name</th>
            <th style="width: 100px">ราคา</th>
            <th style="width: 100px">จำนวน</th>
        </tr>

        <?php while ($allproduct = mysqli_fetch_assoc($query)):?>
        <tr>
            <td>
                <div class="detail">
                    <p><strong><?php echo ($allproduct['product_name']); ?></strong></p>
                    <p><?php echo ($allproduct['detail']); ?></p>
                </div>
            </td>
            <td>
                <div class="pleft">
                    <h4><?php echo ($allproduct['price']); ?> baht</h4>
                </div>
            </td>
            <td style="text-align: center;">
                <?php echo $_SESSION['cart'][$allproduct['id']];?>
            </td>
        </tr>
        <?php $_SESSION['total']+=$_SESSION['cart'][$allproduct['id']] * $allproduct['price'];?>
        <?php        endwhile;?>
        <tr>
            <td><strong><?php echo 'คุณ ' ,$_SESSION['username'],'<br>ที่อยู่  ',$_REQUEST['address']?> </strong></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: right;"><strong><?php echo 'ราคาสินค้ารวมทั้งสิ้น  ',$_SESSION['total'],' บาท';?> </strong></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;"><button type="submit" class="print-button" name="print" onclick="printPage()">ปริ้น</button></td>
        </tr>
        </table>
        </div>
        
        <script>
            function printPage() {
                window.print();
           }
        </script>
    
    </body>
</html>
