<div class="clearfix"></div>
<input type="hidden" name="moreResultsAvailable" id="moreResultsAvailable" value="<?php echo $moreResultsAvailable; ?>" />
<input type="hidden" name="cacheKey" id="cacheKey" value="<?php echo $cacheKey; ?>" />
<input type="hidden" name="cacheLocation" id="cacheLocation" value="<?php echo $cacheLocation; ?>" />
<input type="hidden" name="" id="agesappendurl" value="<?php echo $agesApendUrl; ?>" />
<table class="bgwhite table table-striped">
    <?php if(!empty($module)){ foreach($module as $item){ ?>
    <tr>
        <td class="wow fadeIn p-10-0 animated">
            <div class="col-md-3 col-xs-5 go-right rtl_pic">
                <div class="img_list">
                    <a href="<?php echo $item->slug;?>">
                        <img <?php echo lazy(); ?> class="" data-lazy="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,20);?>">
                        <div class="short_info"></div>
                    </a>
                </div>
            </div>
             <div class="col-md-6 col-xs-4 g0-left">
                <div class="row">
                  <h4 class="RTL go-text-right mt0 list_title">
                    <a href="<?php echo $item->slug;?>"><b><?php echo character_limiter($item->title,20);?></b></a>
                  </h4>
                  <?php if($appModule != "offers"){ ?> <a class="go-right ellipsisFIX go-text-right mob-fs14" href="javascript:void(0);" onclick="showMap('<?php echo base_url();?>home/maps/<?php echo $item->latitude; ?>/<?php echo $item->longitude; ?>/<?php echo $appModule; ?>/<?php echo $item->id;?>','modal');" title="<?php echo $item->location;?>"><i style="margin-left: -3px;" class="mob-fs14 icon-location-6 go-right"></i><?php echo character_limiter($item->location,10);?></a> <span class="go-right mob-fs10"><?php echo $item->stars;?></span> <?php } ?>
                  <?php if(!empty($item->avgReviews->imgUrl)){ ?> <img style="margin: 7px 0px 0px 0px;" class="img-responsive" src="<?php echo $item->avgReviews->imgUrl;?>" /> <?php } ?>
                  <p style="margin: 7px 0px 7px 0px;" class="grey RTL fs12 hidden-xs"><?php echo character_limiter($item->desc,150);?></p>
                </div>
              </div>
              <div class="col-md-3 col-xs-4 col-sm-4 go-left pull-right price_tab">
                <a href="<?php echo $item->slug;?>">
                  <?php  if($item->price > 0){ ?>
                  <div class="fs26 text-center">
                    <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><b><?php echo $item->price;?></b>
                  </div>
                  <?php } ?>
                  <button class="btn btn-primary loader loader btn-block"><?php echo trans('0177');?></button>
                </a>
              </div>
        </td>
    </tr>
    <?php } } ?>
</table>