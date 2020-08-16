<style>
  .summary  { border-right: solid 2px rgb(0, 93, 247); color: #ffffff; background: #4285f4; padding: 14px; float: left; font-size: 14px; }
  .sideline { margin-top: 15px; margin-bottom: 15px; padding-left: 15px; display: table-cell; border-left: solid 1px #e7e7e7; }
  .localarea { margin-top: 15px; margin-bottom: 15px; padding-left: 15px; }
  .captext  { display: block; font-size: 14px; font-weight: 400; color: #23527c; line-height: 1.2em; text-transform: capitalize; }
  .ellipsis { max-width: 250px; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; }
  .noResults { right: 30px; top: 26px; color: #008cff; font-size: 16px; }
  .table { margin-bottom: 5px; }
</style>
<?php if($ismobile): ?>
<div class="modal <?php if($isRTL == "RTL"){ ?> right <?php } else { ?> left <?php } ?> fade" id="sidebar_filter" tabindex="1" role="dialog" aria-labelledby="sidebar_filter">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close go-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="close icon-angle-<?php if($isRTL == "RTL"){ ?>right<?php } else { ?>left<?php } ?>"></i></span></button>
        <h4 class="modal-title go-text-right" id="sidebar_filter"><i class="icon_set_1_icon-65 go-right"></i> <?php echo trans('0191');?></h4>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
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
    <?php echo searchForm($appModule); ?>
    <div class="clearfix"></div>
    </div>
    </div>
  <div class="clearfix"></div>
<div style="margin-top:-15px" class="collapse" id="collapseMap">
  <div id="map" class="map"></div>
  <br>
</div>
<div class="listingbg">
<div class="container">
  <div class="clearfix"></div>
  <?php if(!$ismobile): ?>
  <div class="col-md-3 hidden-sm hidden-xs filter">
      <!-- FILTERS -->
      <form name="fFilters" action="<?php echo base_url().$appModule;?>/search" method="GET" role="search">
          <!-- TOP TIP -->
          <div style="padding:10px 10px 10px 10px">
              <div class="textline">
                  <span class="filterstext"><span><i class="icon_set_1_icon-95"></i><?php echo trans('0191');?></span></span>
              </div>
          </div>
          <div class="clearfix"></div>
          <!-- Star ratings -->
          <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
              <?php echo trans('0137');?> <?php echo trans('069');?> <span class="collapsearrow"></span>
          </button>
          <div id="collapse1" class="collapse in">
              <div class="hpadding20">
                  <br>
                  <?php $star = '<i class="star text-warning fa fa-star voted"></i>'; ?>
                  <?php $stars = '<i class="star fa fa-star-o"></i>'; ?>
                  <div  class="rating" style="font-size: 14px;">
                      <div class="go-right"><input id="1" type="radio" name="stars" class="go-right radio" value="1" <?php if($starsCount == "1"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="1"><?php echo $star; ?><?php for($i=1;$i<=4;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                      <div class="clearfix"></div>
                      <div class="go-right"><input id="2" type="radio" name="stars" class="radio go-right" value="2" <?php if($starsCount == "2"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="2"><?php for($i=1;$i<=2;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=3;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                      <div class="clearfix"></div>
                      <div class="go-right"><input id="3" type="radio" name="stars" class="radio" value="3" <?php if($starsCount == "3"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="3"><?php for($i=1;$i<=3;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=2;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                      <div class="clearfix"></div>
                      <div class="go-right"><input id="4" type="radio" name="stars" class="radio" value="4" <?php if($starsCount == "4"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="4"><?php for($i=1;$i<=4;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=1;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                      <div class="clearfix"></div>
                      <div class="go-right"><input id="5" type="radio" name="stars" class="radio" value="5" <?php if($starsCount == "5"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="5"><?php for($i=1;$i<=5;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=0;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
                      <div class="clearfix"></div>
                  </div>
              </div>
              <div class="clearfix"></div>
              <br>
          </div>
          <!-- End of Star ratings -->
          <!-- Price range -->
          <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
              <?php echo trans('0301');?> <span class="collapsearrow"></span>
          </button>
          <div id="collapse2" class="collapse in">
              <div class="panel-body text-center">
                  <?php if(!empty($priceRange)){
                      $selectedprice = str_replace('-',',', $priceRange);
                  }else{
                      $selectedprice =  $minprice.",".$maxprice;
                  }?>
                  <input type="text" class="col-md-12" value="" data-slider-min="<?=$minprice?>" data-slider-max="<?=$maxprice?> " data-slider-step="10" data-slider-value="[<?=$selectedprice?>]" id="sl2" name="price">
              </div>
          </div>
          <!-- End of Price range -->
          <!-- Module types -->
          <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse3">
              <?php if($appModule == "hotels"){ echo trans('0478'); }else if($appModule == "tours"){ echo trans('0366'); }else if($appModule == "cars"){ echo trans('0214'); } ?> <span class="collapsearrow"></span>
          </button>
          <div id="collapse3" class="collapse in">
              <div class="hpadding20">
                  <br>
                  <div class="clearfix"></div>
                  <?php $vartype = explode('-', $fpropertyTypes);
                  if(empty($vartype)){
                      $vartype = array();
                  }
                  foreach($moduleTypes as $mtype){
                      if(!empty($mtype->name)){ ?>
                          <div class="go-right">
                              <input type="checkbox" value="<?php echo $mtype->id;?>" <?php if(in_array($mtype->id,$vartype)){echo "checked";}?> name="type[]" id="<?php echo $mtype->name;?>" class="checkbox" />
                              <label for="<?php echo $mtype->name;?>" class="css-label go-left">&nbsp;&nbsp;<?php echo $mtype->name;?></label>
                          </div>
                          <div class="clearfix"></div>
                  <?php }} ?>
                  <br>
              </div>
              <div class="clearfix"></div>
          </div>
          <!-- End of Module Types -->
          <!-- Hotel Amenities -->
          <?php if(!empty($amenities)){ ?>
              <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse4">
                  <?php echo trans('0249');?> <span class="collapsearrow"></span>
              </button>
              <div id="collapse4" class="collapse in">
                  <div class="hpadding20">
                      <br>
                      <div class="clearfix"></div>
                      <?php $varAmt = explode('-', $famenities);
                      if(empty($varAmt)){
                          $varAmt = array();
                      }
                      foreach($amenities as $hamt){
                          ?>
                          <div class="go-right">
                              <input type="checkbox" value="<?php echo $hamt->id;?>" <?php if(in_array($hamt->id,$varAmt)){echo "checked";}?> name="amenities[]" id="<?php echo $hamt->name;?>" class="checkbox" />
                              <label for="<?php echo $hamt->name;?>" class="css-label go-left"> <img class="go-right amenities" src="<?php echo $hamt->icon;?>">  <?php echo $hamt->name;?></label>
                          </div>
                          <div class="clearfix"></div>
                      <?php } ?>
                  </div>
                  <div class="clearfix"></div>
              </div>
          <?php } ?>
          <!-- End of Hotel Amenities -->
          <div class="clearfix"></div>
          <br/>
          <input type="hidden" name="txtSearch" value="<?php echo @$_GET['txtSearch']; ?>">
          <input type="hidden" name="searching" value="<?php echo @$_GET['searching']; ?>"> <input type="hidden" name="modType" value="<?php echo @$_GET['modType']; ?>">
          <button style="border-radius:0px;margin-bottom:0px;" type="submit" class="btn btn-primary br25 btn-lg btn-block loader" id="searchform"><?php echo trans('012');?></button>
      </form>
      <script>
          $("form[name=fFilters]").on("submit", function(e) {
              e.preventDefault();
              var uri = '<?=$uri?>';
              var stars = $(".iradio_square-grey.checked").find("input[name=stars]").val() || 0;
              var price = $("input[name=price]").val();
              var propertyTypes = $('.icheckbox_square-grey.checked input[name^="type"]').map(function() {
                  return this.value;
              }).get();
              var amenities = $('.icheckbox_square-grey.checked input[name^="amenities"]').map(function() {
                  return this.value;
              }).get();
              // Validation
              price = price.replace(',','-') || 0;
              propertyTypes = propertyTypes.join("-") || 0;
              amenities = amenities.join("-") || 0;
              var redirect_url = uri+"/"+stars+"/"+price+"/"+propertyTypes+"/"+amenities;
              window.location.href = redirect_url;
          });
      </script>
  </div>
  <?php endif; ?>
  <div class="col-md-9 col-xs-12">
   <div class="row">
   <div class="itemscontainer">
      <?php if(!empty($module)){ ?>
      <table class="bgwhite table table-striped">
        <?php
            foreach($module as $item){
                $hotel_title = ($item->trans_title)?$item->trans_title:$item->hotel_title;
                $hotel_desc = ($item->trans_desc)?$item->trans_desc:$item->hotel_desc;
                $city = (isset($item->location_trans) && $item->location_trans != 'NULL')?$item->location_trans:$city;
        ?>
        <tr>
          <td class="wow fadeIn p-10-0">
            <div class="col-md-3 col-xs-4 go-right rtl_pic">
              <!-- Add to whishlist -->
              <span class="hidden-xs"><?php echo wishListInfo($appModule, $item->hotel_id); ?></span>
              <!-- Add to whishlist -->
              <div class="img_list">

              <?php  if($item->avg_review > 0){ ?>
              <div class="review text-center size18 hidden-xs">
                <?=number_format($item->avg_review, 2, '.', '')?> / <?=floor(($item->reviews_count/2))?>
              </div>
              <?php } ?>

                <a href="<?php echo sprintf($detailpage_uri, strtolower($city), strtolower($item->hotel_slug)); ?>">
                  <img <?php echo lazy(); ?> class="center-block loader" data-lazy="<?php echo base_url('uploads/images/hotels/slider/thumbs/'.$item->thumbnail_image);?>" alt="<?php echo character_limiter($hotel_title,20);?>">
                  <div class="short_info"></div>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-xs-4 go-right">
              <div class="row">
                <h4 class="RTL go-text-right mt0 mb4 list_title"><a href="<?php echo sprintf($detailpage_uri, strtolower($city), strtolower($item->hotel_slug)); ?>"><b><?php echo character_limiter($hotel_title,20);?></b></a></h4>
                <?php if($appModule != "offers"){ ?>
                        <a class="go-right ellipsisFIX go-text-right mob-fs14" href="javascript:void(0);" onclick="showMap('<?php echo base_url();?>home/maps/<?php echo $item->hotel_latitude; ?>/<?php echo $item->hotel_longitude; ?>/<?php echo $appModule; ?>/<?php echo $item->hotel_id;?>','modal');" title="<?php echo $city;?>">
                          <i style="margin-left: -3px;" class="mob-fs14 icon-location-6 go-right"></i><?php echo $city;?>
                        </a>
                    <?php for($i=0;$i<5;$i++):  if($i < $item->hotel_stars):
                         ?><i class="star fa fa-star"></i>
                    <?php else: ?>
                         <i class="star fa fa-star-o"></i>
                    <?php endif; endfor; } ?>
                <div style="margin: 7px 0px 7px 0px;" class="grey RTL fs12 hidden-xs"><?php echo character_limiter($hotel_desc,150);?></div>
                <ul class="hotelpreferences go-right hidden-xs">
                  <?php
                    $cnt = 0;
                    if(!empty($amenities = json_decode($item->h_amenities))){
                        foreach($amenities as $amenity){
                            $name = ($amenity->trans_name)?$amenity->trans_name:$amenity->sett_name;
                            $cnt++;
                            if($cnt <= 10){
                             ?>
                             <img title="<?=$name?>" data-toggle="tooltip" data-placement="top" style="height:20px;" src="<?=base_url('uploads/images/hotels/amenities/'.$amenity->sett_img)?>" alt="<?=$name?>" />
                    <?php } } } ?>
                </ul>
                <div class="hidden-xs">
                  <div class="mt15"></div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-4 col-sm-4 go-left pull-right price_tab">
                  <div class="row">
                    <?php  if($item->price > 0){ ?>
                    <div class="fs26 text-center">
                      <small><?php echo $currCode;?></small> <b><?php echo $currSign; ?><?php echo currencyConverter($item->price);?></b>
                    </div>
                    <?php } ?>
                  </div>
                  <a href="<?php echo base_url('hotels/detail/'.$city.'/'.$item->hotel_slug);?>">
                  <button class="btn btn-primary br25 loader loader btn-block"><?php echo trans('0177');?></button>
                  </a>
                </div>
          </td>
        </tr>
        <div class="clearfix"></div>
        <?php } ?>
      </table>
      <div class="clearfix"></div>
    </div>
    </div>
   <!-- END OF LIST CONTENT-->
   <div class="pull-right">
       <?php echo $pagination; ?>
   </div>
   <?php }else{  echo '<h2 class="text-center">' . trans("066") . '</h2>'; } ?>
  </div>
  <!-- END OF container-->
</div>
</div>
<!-- END OF CONTENT -->
<!-- End container -->
<!-- Map -->
<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div  class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo trans('0254');?></h4>
      </div>
      <div class="mapContent"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-block btn-lg pfb0" data-dismiss="modal"><?php echo trans('0234');?></button>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<script>
  $('#collapseMap').on('shown.bs.collapse', function(e){
  (function(A) {

  if (!Array.prototype.forEach)
   A.forEach = A.forEach || function(action, that) {
     for (var i = 0, l = this.length; i < l; i++)
       if (i in this)
         action.call(that, this[i], i, this);
     };

   })(Array.prototype);
   var
   mapObject,
   markers = [],
   markersData = {
     'map-red': [
      <?php foreach($module as $item): ?>
     {
       name: 'hotel name',
       location_latitude: "<?php echo $item->hotel_latitude;?>",
       location_longitude: "<?php echo $item->hotel_longitude;?>",
       map_image_url: "<?php echo base_url('uploads/images/hotels/slider/thumbs/'.$item->thumbnail_image);?>",
       name_point: "<?php echo $item->hotel_title;?>",
       description_point: "<?php echo character_limiter(strip_tags(trim($hotel_desc)),75);?>",
       url_point: "<?php echo base_url('hotels/detail/'.$city.'/'.$item->hotel_slug);?>"
     },
      <?php endforeach; ?>
     ],
   };
     var mapOptions = {
        <?php if(empty($_GET)){ ?>
       zoom: 10,
        <?php }else{ ?>
         zoom: 12,
        <?php } ?>
       center: new google.maps.LatLng(<?php echo $item->hotel_latitude;?>, <?php echo $item->hotel_longitude;?>),
       mapTypeId: google.maps.MapTypeId.ROADMAP,

       mapTypeControl: false,
       mapTypeControlOptions: {
         style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
         position: google.maps.ControlPosition.LEFT_CENTER
       },
       panControl: false,
       panControlOptions: {
         position: google.maps.ControlPosition.TOP_RIGHT
       },
       zoomControl: true,
       zoomControlOptions: {
         style: google.maps.ZoomControlStyle.LARGE,
         position: google.maps.ControlPosition.TOP_RIGHT
       },
       scrollwheel: false,
       scaleControl: false,
       scaleControlOptions: {
         position: google.maps.ControlPosition.TOP_LEFT
       },
       streetViewControl: true,
       streetViewControlOptions: {
         position: google.maps.ControlPosition.LEFT_TOP
       },
       styles: [/*map styles*/]
     };
     var
     marker;
     mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
     for (var key in markersData)
       markersData[key].forEach(function (item) {
         marker = new google.maps.Marker({
           position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
           map: mapObject,
           icon: '<?php echo base_url(); ?>assets/img/' + key + '.png',
         });

         if ('undefined' === typeof markers[key])
           markers[key] = [];
         markers[key].push(marker);
         google.maps.event.addListener(marker, 'click', (function () {
       closeInfoBox();
       getInfoBox(item).open(mapObject, this);
       mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
      }));
  });
   function hideAllMarkers () {
     for (var key in markers)
       markers[key].forEach(function (marker) {
         marker.setMap(null);
       });
   };
   function closeInfoBox() {
     $('div.infoBox').remove();
   };
   function getInfoBox(item) {
     return new InfoBox({
       content:
       '<div class="marker_info" id="marker_info">' +
       '<img style="width:280px;height:140px" src="' + item.map_image_url + '" alt=""/>' +
       '<h3>'+ item.name_point +'</h3>' +
       '<span>'+ item.description_point +'</span>' +
       '<a href="'+ item.url_point + '" class="btn btn-primary"><?php echo trans('0177');?></a>' +
       '</div>',
       disableAutoPan: true,
       maxWidth: 0,
       pixelOffset: new google.maps.Size(40, -190),
       closeBoxMargin: '0px -20px 2px 2px',
       closeBoxURL: "<?php echo $theme_url; ?>assets/img/close.png",
       isHidden: false,
       pane: 'floatPane',
       enableEventPropagation: true
     }); };  });
</script>