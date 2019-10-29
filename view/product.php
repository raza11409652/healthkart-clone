<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
    $type = null ; 
    $query = null ; 
    $active = null ; 
    //TODO: if type is null all product will be fetched and display
    //else only fetch product which type is mention
    if(isset($_GET['type'])){
       $type = $_GET['type'];
       $type = mysqli_escape_string($connection , $type);
    //    echo $type;
    $query = "select * from product where product_type='{$type}'";

    }else{
        $query = "select * from product  LIMIT 10";

    }
    $res = mysqli_query($connection , $query);
    $count = mysqli_num_rows($res);
    // var_dump($count);
?>
<section class="product-display">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-3">
        
                <ul class="list-group">
                    <li class="list-group-item">
                        <h5>Category</h5>
                    </li>
                    <?php 
                        $productType = "select * from product_type ";
                        $resProduct = mysqli_query($connection , $productType);
                        while($dataProd = mysqli_fetch_array($resProduct)){
                            // echo "{$dataProd['product_type_val']}";
                            if($dataProd['product_type_id'] == $type){
                                $active = "active";
                            }else{
                                $active = null;
                            }
                            echo "<li class='list-group-item {$active}'><a href='?v=product&type={$dataProd['product_type_id']}'>{$dataProd['product_type_val']}</a></li>";
                        }
                    ?>
                </ul>
                
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <?php 
                        while($data = mysqli_fetch_array($res)){
                            ?>
                        <a href="" class="col-lg-3">
                          <div class="product-card">
                              
                              <div class="image-holder">
                                  <img src="product/<?php echo $data['product_image'] ?>" alt="">
                              </div>
                              <div class="name text-center">
                                    <?php  echo $data['product_name']?>
                              </div>
                              <div class="price">
                                  <?php
                                    $price = $data['product_price'];
                                    $offerPrice = 0;
                                    $discount = $data['product_discount'];
                                    if($discount>0){
                                        $discountVal = intval($price * $discount/100 )  ;
                                        $offerPrice = $price - $discountVal;
                                    }else{
                                        $offerPrice = $price  ; 
                                    }
                                   // echo $offerPrice;
                                   echo "<span class='offer-price'>Rs. {$offerPrice}</span>
                                    <span class='original-price'>Rs.{$price}</span>
                                   
                                   ";
                                   // <span class='offer-disconut'>{$discount}% Off<span>
                                  ?>
                                <!-- Rs.<?php echo $data['product_price'] ?> -->
                              </div>
                              <span class="offer">
                                  <?php  echo "{$discount}% Off";?>
                              </span>
                          </div>
                        </a>  
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once "includes/footer.php"; ?>