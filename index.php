<?php 
    session_start();
    include ('server.php');
//    show product
    $query = mysqli_query($conn, "SELECT * from products");

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <link rel="stylesheet" href="styledb1.css">
    <style>
        
             .con{
                     padding: 20px;
                     background-image: url('bgfootb.jpg');
                     height: 100%;
             }

            .productcon{
                width: 60%;
                display: grid;
                grid-template-columns: repeat(3 ,1fr);
                grid-gap: 20px;
                margin: auto;
                
            }
            .pro-item{
                border: 1px solid #999999;
               border-radius: 10px;
               overflow: hidden;
               box-shadow: 0 0 5px rgba(0,0,0,0.3);
               height: 365px;
               background-color: #f8f8f8;
            }
            .pro-img{
                 height: 60%;
                 overflow: hidden;
            }
            .pro-img img{
                width:100%;
                height: 100%;
            }
            .detail{
                padding: 5px;
            }
            .detail p{
                font-size: 75%;
                margin: 5px;
            }
            .price{
                display: flex;
                justify-content: space-between;
                margin: 10px;
                align-content: center;
                align-items: flex-end;
            }
            .pright button{
                color: whitesmoke;
                background-color: #232D3F;
                padding: 0.5rem;
                
            }
            .pright button:hover{
                background-color:#DECE9C;
                color: black;
            }
            
    </style>
</head>
<body>
    
    <div class="nav">
        <div class="home-logo">
            <a href="index.php"><img src="shlogo.png" alt=""></a>
        </div>
        <div class="nav">
            <div class="menu">
            <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <p class="menu-welcome">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
         <?php endif ?>
        </div>
            
        <div class="menu">
              
            <a href="cart.php" style="color: #DECE9C; font-size: 80%; text-decoration: none;">ตะกร้าสินค้า<?php if(!empty($_SESSION['cart'])): ?>
                (<?php echo count($_SESSION['cart']);?>)
                <?php endif;?>
            </a>
            
            <p><a href="insertpro.php" style="color: #DECE9C; font-size: 80%; text-decoration: none;">ขายสินค้า</a></p>
            <a href="index.php?logout='1'" style="color: red; font-size: 65%; text-decoration: none;">Logout</a>
        </div>
        </div>
    </div>

        <!--  notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3 style="text-align: center">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?> 
        
        <?php if (isset($_SESSION['add'])) : ?>
            <div class="success">
                <h3 style="text-align: center">
                    <?php 
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    ?>
                </h3>
            </div>
        <?php endif ?>  
        
        <?php if (isset($_SESSION['msgadd'])) : ?>
            <div class="cartalert">
                <h3 style="text-align: center">
                    <?php 
                        echo $_SESSION['msgadd'];
                        unset($_SESSION['msgadd']);
                    ?>
                </h3>
            </div>
        <?php endif ?> 
 
<!--        show product!!!!!!!!!!!!!!!!!!-->
    <div class="con">
       <div class="productcon">
    <?php        while ($allproduct = mysqli_fetch_assoc($query)):?>

                <div class="pro-item">
                            <div class="pro-img">
                                <img src="<?php echo "upload_image/",$allproduct['profile_image']; ?>" alt="ไม่มีรูปภาพ"/>
                            </div>
                            <div class="detail">
                                <p><strong><?php echo ($allproduct['product_name']); ?></strong></p>
                                <p><?php echo ($allproduct['detail']); ?></p>
                            </div>
                            <div class="price">
                                    <div class="pleft">
                                        <h4><?php echo ($allproduct['price']); ?> baht</h4>
                                    </div>
                                    <div class="pright">
                                        <a href="cart-add.php?id=<?php echo ($allproduct['id']); ?>"><button type="submit" name="buy" class="btn" id="<?php echo ($allproduct['id']); ?>" onclick="return confirm('เพิ่มสินค้าชิ้นนี้ลงตะกร้า ?')">ใส่ตะกร้า</button></a>
                                    </div>
                             </div>
                </div>
    <?php            endwhile;?>

        </div>
     </div>

<div class="foot">
    <img src="ft.png" width="100%" alt=""/>
   
</div>


</body>
</html>