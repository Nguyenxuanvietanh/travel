<?php if(isModuleActive('cars')){ ?>
    <div style="padding:25px 0 80px 0">
    <div class="container">
        <div class="destination-title-container row">
            <h2 class="destination-title destination-title-home go-text-right ttu">
                <i class="icon_set_1_icon-21"></i> <?php echo trans('0490'); ?>
            </h2>
        </div>
        <?php foreach($featuredCars as $item){ ?>
            <div class="col-md-3 col-sm-6 owl-item mt25 cars">
                <div class="probox">
                    <div class="imgLodBg">
                        <div class="load"></div>
                        <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn"
                             src="<?php echo $item->thumbnail; ?>">
                        <div class="overlay">
                            <div class="textCenter">
                                <div class="textMiddle">
                                    <a class="loader" href="<?php echo $item->slug; ?>">
                                        <?php echo trans('0142'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="additional-info additional-info-cars">
                        <div class="pull-left rating-passive"><span class="stars"><?php echo $item->stars; ?></span>
                        </div>
                        <div class="pull-right"><i data-toggle="tooltip" title="Price" class="icon-tag-6"></i>
                            <?php if($item->price > 0){ ?>
                            <span class="text-center">
                            <small><?php echo $item->currCode; ?></small> <?php echo $item->currSymbol; ?><?php echo $item->price; ?>
                            </span>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="wow fadeIn" style="border-top: 2px dashed rgb(206, 206, 206); margin-top: 10px;">
                            <h4 class="ellipsis go-text-right"><?php echo character_limiter($item->title, 25); ?></h4>
                            <p class="go-text-right"><i class="icon-location-6 go-text-right go-right"></i>
                                <?php echo character_limiter($item->location, 20); ?> &nbsp;
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>
<?php } ?>