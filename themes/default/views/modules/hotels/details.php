<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/js/details.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>
<?php require $themeurl.'views/socialshare.php';?>

<div class="modal <?php if($isRTL == "RTL"){ ?> right <?php } else { ?> left <?php } ?> fade" id="modify" tabindex="1" role="dialog" aria-labelledby="sidebar_filter">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close go-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="close icon-angle-<?php if($isRTL == "RTL"){ ?>right<?php } else { ?>left<?php } ?>"></i></span></button>
        <h4 class="modal-title go-text-right" id="modify"><i class="icon_set_1_icon-65 go-right"></i> <?php echo trans('0106');?></h4>
      </div>
        <?php require $themeurl.'views/modules/hotels/rooms_modify_dates.php'; ?>
    </div>
  </div>
</div>

<div class="header-mob">
  <div class="container">
    <div class="row">
      <div class="col-xs-2 col-sm-1 text-left">
        <a data-toggle="tooltip" data-placement="right" title="<?php echo trans('0533');?>" class="mt10 icon-angle-left pull-left mob-back" onclick="goBack()"></a>
      </div>
      <?php if($appModule != "offers"){ ?>
      <div class="col-xs-8 col-sm-7 ">
        <div class="mob-trip-info-head ttu">
          <span><strong class="ellipsis ttu"><span><?php echo character_limiter($module->title, 28);?></span></strong></span>
          <span class="RTL">
          <?php if($appModule == "offers"){  }else if($appModule == "cars" || $appModule == "hotels" || $appModule == "ean" || $appModule == "tours"){ ?>
          <i style="margin-left:-5px" class="icon-location-6"></i>
          <?php } ?>
          <?php echo $module->location; ?> <?php if(!empty($module->mapAddress)){ ?> <small class="hidden-xs">, <?php echo character_limiter($module->mapAddress, 50);?></small> <?php } ?>
          </span>
          <div class="clearfix"></div>
          <div><small><?php echo $module->stars;?></small></div>
        </div>
      </div>
      <div class="col-xs-2 col-sm-1 text-center pull-right visible-xs">
        <a class="ttu" data-toggle="modal" data-target="#modify">
        <i class="icon-filter mob-filter"></i>
        <span class="cw"><?php echo trans('0106');?></span>
        </a>
      </div>

       <?php } ?>
       <?php if($appModule != "ean" && $appModule != "hotels" && $appModule != "tours" && $appModule != "cars"){ ?>
      <h3 style="margin: 12px 0px; color: white;" class="text-success text-center"><?php echo character_limiter($module->title, 28);?></h3>
     <?php } ?>
    </div>
  </div>
</div>



<div id="OVERVIEW" class="container mob-row">
  <div class="col-xs-12 col-md-8 go-right mob-row mt-15 pl0">
   <?php if($appModule == "offers"){ ?>
   <h3 style="margin: 0px; background: #eee; padding: 15px; text-transform: uppercase; font-size: 18px; letter-spacing: 3px; border: 1px solid #ccc; font-weight: bold;" class="go-text-right"><i class="icon_set_1_icon-55"></i> <?php echo $module->phone;?></h3>
   <?php } ?>
      <style>
        .fotorama__wrap .fotorama__wrap--css3 .fotorama__wrap--slide .fotorama__wrap--toggle-arrows .fotorama__wrap--no-controls { width:100%; }
        .fotorama__loaded--img img { width:100%; }
      </style>
      <!-- slider -->
      <?php if($hasRooms){ ?>
      <div class="avgprice">
        <small><?php echo trans('0141');?></small>
        <?php if($hasRooms || $appModule == "offers"){ ?>
        <strong><?php echo trans('070');?></strong> <?php echo @$currencySign; ?> <?php echo @$lowestPrice; ?>
        <?php } ?>
      </div>
      <?php } ?>
      <div style="width:100%" class="fotorama bg-dark" data-width="1000" data-height="490" data-allowfullscreen="true" data-autoplay="true" data-nav="thumbs">
        <?php foreach($module->sliderImages as $img){ ?>
        <img style="width:100%;height:450px !important" src="<?php echo $img['fullImage']; ?>" />
        <?php } ?>
      </div>
      <div class="clearfix form-group"></div>
    </div>

    <div class="col-md-4 hidden-xs">
            <div class="row">
              <?php if($appModule == "tours"){ ?>
              <iframe id="mapframe" width="100%" height="558" style="position: static; background: #eee;" src="" frameborder="0"></iframe>
              <script>
                // $('#collapseMap').on('shown.bs.collapse', function(e){
                $(document).ready(function(e){
                  $("#mapframe").prop("src","<?php echo base_url();?>tours/tourmap/<?php echo $module->id; ?>");
                });
              </script>
              <?php }else{ ?>
              <div id="map" class="map hidden-xs"></div>
              <br>
              <script>
                  // $('#collapseMap').on('shown.bs.collapse', function(e){
                  $(document).ready(function(e){
                  (function(A){
                      if(!Array.prototype.forEach)
                        A.forEach=A.forEach||function(action,that){for(var i=0,l=this.length;i<l;i++)
                        if(i in this) action.call(that,this[i],i,this);}
                  })(Array.prototype);
                  var mapObject,markers=[],markersData={'marker':[{name:'<?php echo character_limiter($module->title, 80);?>',location_latitude:<?php echo $module->latitude;?>,location_longitude:<?php echo $module->longitude;?>,map_image_url:'<?php echo $module->thumbnail;?>',name_point:'<?php echo character_limiter($module->title, 80);?>',description_point:'<?php echo character_limiter(strip_tags(trim($module->desc)),100);?>',url_point:'<?php echo base_url($appModule.'/'.$module->slug);?>'},<?php foreach($module->relatedItems as $item):?>{name:'hotel name',location_latitude:"<?php echo $item->latitude;?>",location_longitude:"<?php echo $item->longitude;?>",map_image_url:"<?php echo $item->thumbnail;?>",name_point:"<?php echo $item->title;?>",description_point:'<?php echo character_limiter(strip_tags(trim($item->desc)),100);?>',url_point:"<?php echo $item->slug;?>"},<?php endforeach;?>]};var mapOptions={zoom:14,center:new google.maps.LatLng(<?php echo $module->latitude;?>,<?php echo $module->longitude;?>),mapTypeId:google.maps.MapTypeId.ROADMAP,mapTypeControl:!1,mapTypeControlOptions:{style:google.maps.MapTypeControlStyle.DROPDOWN_MENU,position:google.maps.ControlPosition.LEFT_CENTER},panControl:!1,panControlOptions:{position:google.maps.ControlPosition.TOP_RIGHT},zoomControl:!0,zoomControlOptions:{style:google.maps.ZoomControlStyle.LARGE,position:google.maps.ControlPosition.TOP_RIGHT},scrollwheel:!1,scaleControl:!1,scaleControlOptions:{position:google.maps.ControlPosition.TOP_LEFT},streetViewControl:!0,streetViewControlOptions:{position:google.maps.ControlPosition.LEFT_TOP},styles:[]};var marker;mapObject=new google.maps.Map(document.getElementById('map'),mapOptions);for(var key in markersData)
                    markersData[key].forEach(function(item){marker=new google.maps.Marker({position:new google.maps.LatLng(item.location_latitude,item.location_longitude),map:mapObject,icon:'<?php echo base_url(); ?>uploads/global/default/'+key+'.png',});if('undefined'===typeof markers[key])
                    markers[key]=[];markers[key].push(marker);google.maps.event.addListener(marker,'click',(function(){closeInfoBox();getInfoBox(item).open(mapObject,this);mapObject.setCenter(new google.maps.LatLng(item.location_latitude,item.location_longitude))}))});function hideAllMarkers(){for(var key in markers)
                    markers[key].forEach(function(marker){marker.setMap(null)})};function closeInfoBox(){$('div.infoBox').remove()};function getInfoBox(item){return new InfoBox({content:'<div class="marker_info" id="marker_info">'+'<img style="width:280px;height:140px" src="'+item.map_image_url+'" alt="<?php echo character_limiter($module->title, 80);?>"/>'+'<h3>'+item.name_point+'</h3>'+'<span>'+item.description_point+'</span>'+'<a href="'+item.url_point+'" class="btn btn-primary"><?php echo trans('0177');?></a>'+'</div>',disableAutoPan:!0,maxWidth:0,pixelOffset:new google.maps.Size(40,-190),closeBoxMargin:'0px -20px 2px 2px',closeBoxURL:"<?php echo $theme_url; ?>assets/img/close.png",isHidden:!1,pane:'floatPane',enableEventPropagation:!0})}
                  });
              </script>
              <?php } ?>
            </div>
    </div>
    <div class="clearfix"></div>

    <div class="sharethis-inline-share-buttons"></div>
    <br />
    <div class="col-md-12 go-left">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading panel-green hidden-xs"><?php echo trans('0177'); ?></div>
                <div class="desc-scrol">
                    <div class="panel-body">
                        <div class="visible-lg visible-md RTL">
                         <?php require $themeurl.'views/includes/description.php';?>
                        </div>
                        <div class="visible-xs">
                            <div id="accordion">
                                <div class="panel-heading dn">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"></a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <p class="main-title go-right"><?php echo trans('046');?></p>
                                    <div class="clearfix"></div>
                                    <i class="tiltle-line  go-right"></i>
                                    <div class="clearfix"></div>
                                    <div class="mob-fs14 RTL"><?php echo character_limiter($module->desc, 88);?></div>
                                </div>
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong><?php echo trans('0286');?> <i class="lightcaret mt-2 go-leftt"></i></strong></a>
                                </h4>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <?php require $themeurl.'views/includes/description.php';?>
                                </div>
                                <div class="clearfix"></div>
                                <input type="hidden" id="loggedin" value="<?php echo $usersession;?>" />
                                <input type="hidden" id="itemid" value="<?php echo $module->id; ?>" />
                                <input type="hidden" id="module" value="<?php echo $appModule;?>" />
                                <input type="hidden" id="addtxt" value="<?php echo trans('029');?>" />
                                <input type="hidden" id="removetxt" value="<?php echo trans('028');?>" />
                                <!-- Start Add/Remove Wish list Review Section -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <script>
    $(function(){
      $(".changeInfo").on("change",function(){
        var tourid = "<?php echo $module->id; ?>";
        var adults = $("#selectedAdults").val();
        var child = $("#selectedChild").val();
        var infants = $("#selectedInfants").val();
          $.post("<?php echo base_url()?>tours/tourajaxcalls/changeInfo",{tourid: tourid, adults: adults, child: child, infants: infants},function(resp){
          var result = $.parseJSON(resp);
          $(".adultPrice").html(result.currSymbol+result.adultPrice);
          $(".childPrice").html(result.currSymbol+result.childPrice);
          $(".infantPrice").html(result.currSymbol+result.infantPrice);
          $(".totalCost").html(result.currCode+" "+result.currSymbol+result.totalCost);
          $(".totaldeposit").html(result.currCode+" "+result.currSymbol+result.totalDeposit);
        })
      }); //end of change info
    })// end of document ready
  </script>
  <!-- aside -->
</div>
<div class="container mob-row">
  <?php include 'includes/amenities.php';?>

  <div class="clearfix"></div>
  <div class="visible-lg visible-md">
  <?php require $themeurl.'views/modules/hotels/rooms_modify_dates.php'; ?>
   </div>
  <div class="hidden-sm hidden-md hidden-lg">
    <div class="col-xs-6">
      <label class="check_dates"><?php echo trans('07');?>: <?php echo $module->defcheckin;?></label>
      <div><?php echo $checkin;?></div>
    </div>
    <div class="col-xs-6 text-right">
      <label class="check_dates"><?php echo trans('07');?>: <?php echo $module->defcheckin;?></label>
      <div><?php echo $checkout;?></div>
    </div>
    <div class="clearfix"></div>
    <br>
  </div>
  <div class="clearfix"></div>
  <?php
    $modulelib->checkin = $checkin;
    $modulelib->checkout = $checkout;
    require $themeurl.'views/modules/hotels/rooms.php';
  ?>
<div class="container">
<div class="">
     <div class="clearfix"></div>
                      <?php if($appModule == "offers"){  }else if($appModule == "cars" || $appModule == "hotels" || $appModule == "ean" || $appModule == "tours"){ ?>
                      <!-- Start checkInInstructions -->
                      <?php if(!empty($checkInInstructions)){ ?>
                      <div class="panel panel-default">
                        <div class="panel-heading go-text-right panel-green">
                          <?php echo trans('0550'); ?>
                        </div>
                        <?php }  if(!empty($checkInInstructions)){ ?>
                        <div class="panel-body">
                          <span class="RTL">
                            <p>
                              <?php echo $checkInInstructions; ?>
                            </p>
                          </span>
                        </div>
                        </div>
                        <?php } ?>
                        <!-- End checkInInstructions -->
                        <!-- Start SpecialcheckInInstructions -->
                        <?php if(!empty($specialCheckInInstructions)){ ?>
                         <div class="panel panel-default">
                        <div class="panel-heading go-text-right panel-green">
                          <?php echo trans('0551'); ?>
                        </div>
                        <?php }  if(!empty($specialCheckInInstructions)){ ?>
                        <div class="panel-body">
                          <span class="RTL">
                            <p>
                              <?php echo $specialCheckInInstructions; ?>
                            </p>
                          </span>
                        </div>
                      </div>
                      <?php } ?>
                      <!-- End  SpecialcheckInInstructions -->
                      <?php if(!empty($module->policy)){ ?>
                      <p class="main-title go-right"><?php echo trans('0148');?></p>
                      <div class="clearfix"></div>
                      <i class="tiltle-line go-right"></i>
                      <div class="clearfix"></div>
                      <div class="form-group"></div>
                      <p class="RTL">
                      <?php echo $module->policy; } ?>
                      </p>
                      <?php } ?>
                      <div class="clearfix"></div>
                      <hr>
                      <?php if(!empty($module->paymentOptions)){ ?>
                      <p id="terms" class="main-title  go-right"><?php echo trans('0265');?></p>
                      <div class="clearfix"></div>
                      <i class="tiltle-line  go-right"></i>
                      <div class="clearfix"></div>
                      <div class="form-group"></div>
                      <p class="RTL">
                      <?php foreach($module->paymentOptions as $pay){ if(!empty($pay->name)){ ?>
                      <?php echo $pay->name;?> -
                      <?php } } ?>
                      </p>
                      <?php } ?>
                      <div class="hidden-xs">
                        <div class="clearfix"></div>
                        <hr>
                        <div class="go-right">
                          <p class="main-title  go-right"><?php echo trans('07');?></p>
                          <div class="clearfix"></div>
                          <i class="tiltle-line go-right"></i>
                          <div class="clearfix"></div>
                          <div class="form-group"></div>
                          <p class="RTL">
                            <i class="fa fa-clock-o text-success"></i> <strong> <?php echo trans('07');?> </strong> :   <?php echo $module->defcheckin;?>
                            <br>
                            <i class="fa fa-clock-o text-warning"></i> <strong> <?php echo trans('09');?> </strong> :  <?php echo $module->defcheckout;?>
                          </p>
                        </div>
                      </div>

</div>
</div>
<br>

      <!-- End Tour Form aside -->
  <div class="container hidden-xs">
      <?php require $themeurl.'views/includes/ratinigs.php';?>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
      <?php require $themeurl.'views/includes/review.php';?>
      <?php require $themeurl.'views/includes/reviews.php';?>
    <div class="clearfix"></div>
  </div>
</div>

<!------------------------  Related Listings   ------------------------------>
<?php if(!empty($module->relatedItems)){ ?>
<div class="featured-back hidden-xs hidden-sm">
  <div class="container">
    <div class="row">
      <h2 class="destination-title go-right">
        <?php if($appModule == "hotels" || $appModule == "ean"){ echo trans('0290'); }else if($appModule == "tours"){ echo trans('0453'); }else if($appModule == "cars"){ echo trans('0493'); } ?>
      </h2>
    </div>
    <div class="main_slider">
            <div class="set hotels-left fa-left"> <i class="icon-left-open-3"></i> </div>
            <div class="related" class="get">
        <?php foreach($module->relatedItems as $item){ ?>
                <div class="owl-item">
                    <div class="imgLodBg">
            <div class="load"></div>
            <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="<?php echo $item->thumbnail;?>">
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
<!------------------------  Related Listings   ------------------------------>

<script>
  //------------------------------
  // Write Reviews
  //------------------------------
    $(function(){
        $('.reviewscore').change(function(){
            var sum = 0;
            var avg = 0;
            var id = $(this).attr("id");
            $('.reviewscore_'+id+' :selected').each(function() {
            sum += Number($(this).val());
            });
            avg = sum/5;
            $("#avgall_"+id).html(avg);
            $("#overall_"+id).val(avg);
        });

        //submit review
        $(".addreview").on("click",function(){
            var id = $(this).prop("id");
            $.post("<?php echo base_url();?>admin/ajaxcalls/postreview", $("#reviews-form-"+id).serialize(), function(resp){
            var response = $.parseJSON(resp);
            // alert(response.msg);
            $("#review_result"+id).html("<div class='alert "+response.divclass+"'>"+response.msg+"</div>").fadeIn("slow");
            if(response.divclass == "alert-success"){
            setTimeout(function(){
            $("#ADDREVIEW").removeClass('in');
            $("#ADDREVIEW").slideUp();
            }, 5000);
            }
            });
            setTimeout(function(){
            $("#review_result"+id).fadeOut("slow");
            }, 3000);
        });
    })

  //------------------------------
  // Add to Wishlist
  //------------------------------
    $(function(){
        // Add/remove wishlist
        $(".wish").on('click',function(){
            var loggedin = $("#loggedin").val();
            var removelisttxt = $("#removetxt").val();
            var addlisttxt = $("#addtxt").val();
            var title = $("#itemid").val();
            var module = $("#module").val();
            if(loggedin > 0){ if($(this).hasClass('addwishlist')){
             var confirm1 = confirm("<?php echo trans('0437');?>");
             if(confirm1){
            $(".wish").removeClass('addwishlist btn-primary');
            $(".wish").addClass('removewishlist btn-warning');
            $(".wishtext").html(removelisttxt);
            $.post("<?php echo base_url();?>account/wishlist/add", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){ });
             }
             return false;
            }else if($(this).hasClass('removewishlist')){
            var confirm2 = confirm("<?php echo trans('0436');?>");
            if(confirm2){
            $(".wish").addClass('addwishlist btn-primary'); $(".wish").removeClass('removewishlist btn-warning');
            $(".wishtext").html(addlisttxt);
            $.post("<?php echo base_url();?>account/wishlist/remove", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){
            });
            }
            return false;
            } }else{ alert("<?php echo trans('0482');?>"); }
        });
        // End Add/remove wishlist
    })

  //------------------------------
  // Rooms
  //------------------------------

    $('.collapse').on('show.bs.collapse', function () {
        $('.collapse.in').collapse('hide');
    });
    <?php if($appModule == "hotels"){ ?>
        jQuery(document).ready(function($) {
        $('.showcalendar').on('change',function(){
        var roomid = $(this).prop('id');
        var monthdata = $(this).val();
        $("#roomcalendar"+roomid).html("<br><br><div id='rotatingDiv'></div>");
        $.post("<?php echo base_url();?>hotels/roomcalendar", { roomid: roomid, monthyear: monthdata}, function(theResponse){ console.log(theResponse);
        $("#roomcalendar"+roomid).html(theResponse);  }); }); });
    <?php } ?>

</script>