<!doctype html>
<html>
    <head>
        <title>ลงขายสินค้า</title>
         <link rel="stylesheet" href="styledb1.css">
    </head>
    
    <body style="background-image: url('10.jpg')">
         
        <div class="header"><h3>เพิ่มรายการสินค้า</h3></div>
        <form action="insert_db.php" method="post" enctype="multipart/form-data">
               
                    <div class="input-group">ชื่อสินค้า :<input type="text" name="product_name" id="product_name" value=""></div>
                    <div class="input-group">ราคา:<input type="text" name="price" id="price" value=""></div>
                    <div class="input-group">รูปภาพสินค้า:<input type="file" name="product-image" id="product-image" accept="image/png, image/jpg, image/jpeg" value=""></div>
                    <div class="input-group">รายละเอียด:<textarea type="text" name="detail" id="detail" value="" rows="4"></textarea></div>
                    <div class="input-group"><button type="submit" name="addproduct">ลงขายสินค้า</button></div>
                    <a href="index.php" style="text-decoration: none; color: #a94442;"><h3 >< กลับหน้าเเรก</h3></a>
            </form>
    </body>
</html>
