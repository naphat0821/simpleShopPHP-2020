<link rel="stylesheet" href="styledb1.css">
<html>
    <style>
        body{
            background-color: gainsboro;
        }
        th,td{
             border: 1px solid black;
             
        }
        .tablecon{
            display: flex;
            justify-content: center;
            padding: 20px;
        }
    </style>
    
    <?php

session_start();
include 'server.php';

if(empty($_SESSION['cart'])){
     header("location: index.php");
     $_SESSION['msgadd']='ไม่มีสินค้าในตะกร้า';
}
    
$productids = [];
    foreach($_SESSION['cart'] as $cartId => $cartqty) {
        $productids[] += $cartId;
    }

    $ids = 0;
    if(count($productids) > 0){
        $ids = implode(', ',$productids);
    }

    $query = mysqli_query($conn, "SELECT * FROM products WHERE id IN($ids)");
    $rows = mysqli_num_rows($query);
    
?>
   <body>
       <a href="index.php" style="text-decoration: none; color: #a94442;"><h3 >< กลับหน้าเเรก</h3></a>
    <div class="tablecon">
        
    <table>
        <tr>
            <th style="width: 100px">image</th>
            <th>Product name</th>
            <th style="width: 100px">Price</th>
            <th style="width: 100px">Qty</th>
            <th style="width: 100px">Total</th>
        </tr>
        <?php if($rows>0): ?>
        <?php while ($allproduct = mysqli_fetch_assoc($query)):?>
        <tr>
            <td>
                <div class="pro-img">
                    <img src="<?php echo "upload_image/",$allproduct['profile_image']; ?>" width="90px" alt="ไม่มีรูปภาพ"/>
                </div>
            </td>
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
            <td style="text-align: center;">
                <strong><?php echo ($allproduct['price']*$_SESSION['cart'][$allproduct['id']]),' baht'; ?></strong>
            </td>
            <td style="text-align: center;border: none;">
                 <a href="cart_del.php?id=<?php echo ($allproduct['id']); ?>"><button type="submit" name="del" class="btndel" onclick="return confirm('ลบสิ้นค้า ?')">ลบสินค้า</button></a>
            </td>
        </tr>
        
        <?php        endwhile;?>
        </table>
       </div>
       <div class="header">
        <h2>ป้อนที่อยู่</h2>
        </div>
       <form action="ptotal.php" method="post">
        <div class="input-group">
            <input type="text" name="address">
        </div>
        <div class="input-group">
            <button type="submit" name="buy" value="1"onclick="return confirm('ทำรายการ ?')" class="btn">สั่งซื้อ</button>
        </div>
        </form>
        <?php        else : ?>
        <tr>
            <td colspan="5"><h4 style="text-align: center;">ไม่มีรายการสินค้า</h4></td>
        </tr>
        <?php endif; ?>
    
    
        

       
   </body>
</html>

                                