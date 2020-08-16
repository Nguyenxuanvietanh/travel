<?php if(isModuleActive( 'tours')){ ?>
<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/featuredtours.css" />
    <div class="container">
     <div class="title">
        <h2> <i class="icon_set_1_icon-30"></i> <?php echo trans('0451');?> </h2>
    </div>
<div class="vc_row wpb_row vc_inner vc_row-fluid vc_column-gap-30 RTL">

  <?php foreach($featuredTours as $item){ ?>
    <div class="wpb_column vc_column_container vc_col-sm-6">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="row">
                <div class="hotel-item">
                        <div class="hotel-image">
                            <a href="<?php echo $item->slug;?>">
                              <div class="img"> <img style="max-height: 170px; min-height: 172px !important" width="250" height="240" src="<?php echo $item->thumbnail;?>" class="img-responsive wp-post-image" alt=""> </div>
                            </a>
                        </div>
                        <div class="hotel-body">
                            <h3><?php echo character_limiter($item->title,25);?></h3>
                            <i style="margin-left: -6px;" class="icon-location-6 go-text-right go-right"></i> &nbsp; <?php echo character_limiter($item->location,20);?> &nbsp;&nbsp;
                            <div class="clearfix"></div>
                            <span class="stars"><?php echo $item->stars;?></span>
                            <div class="free-service"></div>
                        </div>
                        <div class="hotel-right">
                            <div class="hotel-person">
                            <?php if($item->price > 0){ ?> <span class="text-center">
                            <small><?php echo $item->currCode;?></small> <!--<?php echo $item->currSymbol; ?>--><?php echo $item->price;?>
                            </span>
                            <?php } ?>
                          </div>
                            <a class="thm-btn btn-block" href="<?php echo $item->slug;?>"> <?php echo trans( '0142'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php } ?>
</div>
</div>
<?php } ?>