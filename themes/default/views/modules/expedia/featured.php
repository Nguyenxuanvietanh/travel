<?php if(isModuleActive('ean')){ ?>
<div class="featured-back hidden-xs hidden-sm">
    <div class="container">
        <h2 class="destination-title go-right ttu">
            <i class="fa fa-building-o"></i> <?php echo trans('056');?>
        </h2>
        <div class="main_slider">
            <div class="set fa-left hotels-left"> <i class="icon-left-open-3"></i> </div>
            <div class="hotels" class="get">
                <?php foreach($featuredHotelsEan->hotels as $item){ ?>
                <div class="owl-item">
                    <div class="imgLodBg">
                        <div class="load"></div>
                        <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" style="width: 100%;" src="<?php echo $item->thumbnail;?>">
                        <div class="country-name wow fadeIn">
                            <h4 class="ellipsis go-text-right"><?php echo character_limiter($item->title,25);?></h4>
                            <p class="go-text-right"><i class="icon-location-6 go-text-right go-right"></i>
                                <?php echo character_limiter($item->location,20);?> &nbsp;
                            </p>
                        </div>
                        <div class="overlay">
                            <div class="textCenter">
                                <div class="textMiddle">
                                    <a class="loader" href="<?php echo $item->slug;?>">
                                    <?php echo trans( '0142');?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="additional-info">
                        <div class="pull-left rating-passive"> <span class="stars"><?php echo $item->stars;?></span> </div>
                        <div class="pull-right"> <i data-toggle="tooltip" title="Price" class="icon-tag-6"></i>
                            <?php if($item->price > 0){ ?> <span class="text-center">
                            <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                            </span>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="set fa-right hotels-right"> <i class="icon-right-open-3"></i> </div>
        </div>
    </div>
</div>
<?php } ?>