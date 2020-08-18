
<style>
  .summary  { border-right: solid 2px rgb(0, 93, 247); color: #ffffff; background: #4285f4; padding: 14px; float: left; font-size: 14px; }
  .sideline { margin-top: 15px; margin-bottom: 15px; padding-left: 15px; display: table-cell; border-left: solid 1px #e7e7e7; }
  .localarea { margin-top: 15px; margin-bottom: 15px; padding-left: 15px; }
  .captext  { display: block; font-size: 14px; font-weight: 400; color: #23527c; line-height: 1.2em; text-transform: capitalize; }
  .ellipsis { max-width: 250px; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; }
  .noResults { right: 30px; top: 26px; color: #008cff; font-size: 16px; }
  .table { margin-bottom: 5px; }
</style>

<div class="header-mob">
  <div class="container">
    <div class="row">
      <div class="col-xs-2 text-leftt">
        <a data-toggle="tooltip" data-placement="right" title="<?php echo trans('0533');?>" class="icon-angle-left pull-left mob-back" onclick="goBack()"></a>
      </div>
      <div class="col-xs-2 text-center pull-right visible-xs">
        <a class="ttu" data-toggle="modal" data-target="#sidebar_filter">
        <i class="icon-filter mob-filter"></i>
        <span class="cw"><?php echo trans('0217');?></span>
        </a>
      </div>
      <div class="col-xs-2 text-center pull-right hidden-xs ttu">
          <a class="btn btn-primary btn-xs btn-block" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">
          <i class="icon-location-7 mob-filter"></i>
          <span><?php echo trans('067');?></span>
          </a>
      </div>
    </div>
  </div>
</div>
    <div class="search_head">
  <div class="container">
    <?php echo searchForm($appModule, $data); ?>
    <div class="clearfix"></div>
    </div>
    </div>
  <div class="clearfix"></div>
<div style="margin-top:-15px" class="collapse" id="collapseMap">
  <div id="map" class="map"></div>
  <br>
</div>


<?php if($ismobile): ?>
<div class="modal <?php if($isRTL == "RTL"){ ?> right <?php } else { ?> left <?php } ?> fade" id="sidebar_filter" tabindex="1" role="dialog" aria-labelledby="sidebar_filter">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close go-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="close icon-angle-<?php if($isRTL == "RTL"){ ?>right<?php } else { ?>left<?php } ?>"></i></span></button>
        <h4 class="modal-title go-text-right" id="sidebar_filter"><i class="icon_set_1_icon-65 go-right"></i> <?php echo trans('0191');?></h4>
      </div>
      <?php require $themeurl.'views/includes/filter.php';?>
    </div>
  </div>
</div>
<?php endif; ?>

<div style="margin-top:-15px" class="collapse" id="collapseMap">
  <div id="map" class="map"></div>
  <br>
</div>
<div class="listingbg">
<div class="container offset-0">

  <div class="clearfix"></div>
  <?php if(!$ismobile): ?>
  <div class="col-md-3 hidden-sm hidden-xs"></div>
  <?php endif; ?>
  <div class="col-md-9 col-xs-12">
    <div class="itemscontainer">
      <?php if(!empty($module)){ ?>
      <table class="bgwhite table table-striped">
          <?php if($appModule != "offers"){ ?>
        <?php foreach($module as $item){ ?>
        <tr>
          <td class="wow fadeIn p-10-0">
            <div class="col-md-3 col-xs-5 go-right rtl_pic">
              <!-- Add to whishlist -->
              <?php if($appModule != "ean" && $appModule != "offers"){ ?>
              <span class="hidden-xs"><?php echo wishListInfo($appModule, $item->id); ?></span>
              <?php } ?>
              <!-- Add to whishlist -->
              <div class="img_list">
                   <?php  if($item->avgReviews->overall > 0){ ?>
                  <div class="review text-center size18 hidden-xs"><i class="icon-thumbs-up-4"></i><?php echo $item->avgReviews->overall; ?> / <?php echo $item->avgReviews->totalReviews; ?></div>
                  <?php } ?>

                <a href="<?php echo $item->id;?>">
                  <img <?php echo lazy(); ?> class="center-block loader" data-lazy="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,20);?>">
                  <div class="short_info"></div>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-xs-4 go-right">
              <div class="row">
                <h4 class="RTL go-text-right mt0 list_title">
                  <a href="<?php echo $item->url;?>"><b><?php echo character_limiter($item->name,20);?>
                  </b></a>
                  <!-- Cars airport pickup -->  <?php if($appModule == "cars"){ if($item->airportPickup == "yes"){ ?> <button class="btn btn-success btn-xs"><i class="icon-paper-plane-2"></i> <?php echo trans('0207');?></button> <?php } } ?> <!-- Cars airport pickup -->
                </h4>
                <a class="go-right ellipsisFIX go-text-right mob-fs14">
                  <i style="margin-left: -3px;" class="mob-fs14 icon-location-6 go-right"></i>
                  <?php echo character_limiter($item->category_name,10);?>
                </a>
                <p style="margin: 7px 0px 7px 0px;" class="grey RTL fs12 hidden-xs"><?php echo character_limiter($item->note,150);?></p>
                <div class="add_info hidden-sm hidden-xs go-right RTL">
                  <strong>Pass Type</strong> : 
                  <a href="#" class="tooltip-1" data-placement="top" data-original-title="<?php echo $item->type; ?>">
                    <?php echo $item->type; ?>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-4 col-sm-4 go-left pull-right price_tab">

             <a href="<?php echo $item->url;?>">
                  <?php  if($item->ammount > 0){ ?>
                <div class="fs26 text-center">
                <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><b><?php echo $item->ammount;?></b>
                </div>
              <?php } ?>
            <button class="btn btn-action loader loader btn-block">Detail</button>
            </a>

            </div>
          </td>
        </tr>
        <div class="clearfix"></div>
        <?php } ?>
        <?php } ?>
      </table>
      <div class="clearfix"></div>
      <div class="offset-3 offset-RTL">
        <ul class="nav nav-pills nav-justified pagination-margin" role="tablist">
          <?php echo createPagination($info);?>
        </ul>
      </div>
      <?php }else{  echo '<h1 class="text-center">No Results Found</h1>'; } ?>
      <!-- End of offset1-->
      <!-- start EAN multiple locations found and load more hotels -->
      <?php if($appModule == "ean"){ if($multipleLocations > 0){ foreach($locationInfo as $loc){ ?>
      <p><?php echo $loc->link; ?></p>
      <?php } } ?>
      <!--This is for display cache Parameter-->
      <div id="latest_record_para">
        <input type="hidden" name="moreResultsAvailable" id="moreResultsAvailable" value="<?php echo $moreResultsAvailable; ?>" />
        <input type="hidden" name="cacheKey" id="cacheKey" value="<?php echo $cacheKey; ?>" />
        <input type="hidden" name="cacheLocation" id="cacheLocation" value="<?php echo $cacheLocation; ?>" />
        <input type="hidden" name="" id="agesappendurl" value="<?php echo $agesApendUrl; ?>" />
        <input type="hidden" name="" id="adultsCount" value="<?php echo $adults;?>" />
      </div>
      <!--This is for display content-->
      <div id="New_data_load"></div>
      <!--This is for display Loader Image-->
      <div id="loader_new"></div>
      <div id="message_noResult"></div>
      <!-- END OF LIST CONTENT-->
      <?php } ?>
      <!-- End EAN multiple locations found and load more hotels  -->
    </div>
    <!-- END OF LIST CONTENT-->
  </div>
  <!-- END OF container-->
</div>
</div>