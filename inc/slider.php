<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
                $getIphone = $product->latestFromIphone();
                if ($getIphone) {
                    while($result = $getIphone->fetch_assoc()) {
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="preview.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Iphone</h2>
                    <p><?php echo $result['productName']; ?></p>
                    <div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php
                    }
                }
            ?>

            <?php
            $getIphone = $product->latestFromIphone();
            if ($getIphone) {
                while($result = $getIphone->fetch_assoc()) {
                    ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="preview.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Acer</h2>
                            <p><?php echo $result['productName']; ?></p>
                            <div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>


        <div class="section group">
            <?php
            $getSamsung = $product->latestFromSamsung();
            if ($getSamsung) {
                while($result = $getSamsung->fetch_assoc()) {
                    ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="preview.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Iphone</h2>
                            <p><?php echo $result['productName']; ?></p>
                            <div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <?php
            $getCanon = $product->latestFromCanon();
            if ($getCanon) {
                while($result = $getCanon->fetch_assoc()) {
                    ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="preview.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Canon</h2>
                            <p><?php echo $result['productName']; ?></p>
                            <div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt=""/></li>
                    <li><img src="images/2.jpg" alt=""/></li>
                    <li><img src="images/3.jpg" alt=""/></li>
                    <li><img src="images/4.jpg" alt=""/></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>