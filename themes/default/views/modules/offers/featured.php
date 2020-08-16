<?php if(isModuleActive( 'offers') && $offersCount> 0){ ?>
<div class="more hidden-xs hidden-sm">
    <div class="container">
            <?php if($offersCount> 0){ ?>
            <?php //foreach($specialoffers as $offer){ ?>
            <div class="col-md-7">
                <?php if($specialoffers[0]->price > 0){ ?> <span class="wow bounce ttu"><?php echo trans('0536');?> <b><?php echo trans('0388');?></b> <small><?php echo $specialoffers[0]->currCode;?></small> <?php echo $specialoffers[0]->currSymbol; ?><?php echo $specialoffers[0]->price;?></span>
                <?php } ?>
                <div class="imgLodBg">
                    <div class="load"></div>
                    <a href="<?php echo base_url(); ?>offers">
                    <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $specialoffers[0]->thumbnail;?>">
                    </a>
                </div>
            </div>
            <div class="col-md-5">
                <h3 style="margin-top: 6px;"><strong class="ttu"><?php echo character_limiter($specialoffers[0]->title,30);?></strong></h3>
                <p> <?php echo character_limiter($specialoffers[0]->desc,240);?></p>
                <a href="<?php echo base_url(); ?>offers" class="loader btn btn-primary btn-block p16">
                <?php echo trans( '0297');?>
                </a>
                <?php // } ?>
                <?php } ?>
        </div>
    </div>
</div>
<?php } ?>