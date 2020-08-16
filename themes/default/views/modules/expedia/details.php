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
      <?php require $themeurl.'views/includes/rooms_modify.php';?>
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
      <iframe id="map" src="//maps.google.com/maps?q=<?php echo $module->latitude;?>,<?php echo $module->longitude;?>&z=15&output=embed" width="360" height="270" frameborder="0" style="border:0"></iframe>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="container">
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
        console.log(result);
      })
    }); //end of change info
  })// end of document ready
</script>
<!-- aside -->
<div class="container mob-row">
  <?php include 'amenities.php';?>
  <div class="clearfix"></div>
  <div class="visible-lg visible-md">
    <?php include 'rooms_modify.php';?>
  </div>
  <?php if($appModule == "hotels") {?>
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
  <?php } ?>
  <div class="clearfix"></div>
  <?php require $themeurl.'views/modules/expedia/expedia_rooms.php';?>
  <div class="">
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
      <i class="tiltle-line  go-right"></i>
      <div class="clearfix"></div>
      <?php echo $module->policy; } ?>
      <?php } ?>
      <?php if($appModule != "cars" && $appModule != "ean"){ ?>
      <div class="clearfix"></div>
      <hr>
      <?php if(!empty($module->paymentOptions)){ ?>
      <p id="terms" class="main-title  go-right"><?php echo trans('0265');?></p>
      <div class="clearfix"></div>
      <i class="tiltle-line  go-right"></i>
      <div class="clearfix"></div>
      <span class="RTL">
      <?php foreach($module->paymentOptions as $pay){ if(!empty($pay->name)){ ?>
      <?php echo $pay->name;?> -
      <?php } } ?>
      </span>
      <br><br>
      <?php } ?>
      <div class="hidden-xs">
        <?php if($appModule == "hotels"){ ?>
        <?php } ?>
      </div>
      <!-- Start Tours Inclusions / Exclusions -->
      <?php if($appModule == "tours"){ ?>
      <p class="go-text-left"><i class="fa fa-sun-o text-success"></i> <strong> <?php echo trans('0275');?> </strong> :   <?php echo $module->tourDays;?> | <i class="fa fa-moon-o text-warning"></i>   <strong> <?php echo trans('0276');?> </strong> :  <?php echo $module->tourNights;?> </p>
      <div class="row">
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-6" id="INCLUSIONS">
          <h4 class="main-title go-right"><?php echo trans('0280');?></h4>
          <div class="clearfix"></div>
          <i class="tiltle-line go-right"></i>
          <div class="clearfix"></div>
          <br>
          <?php foreach($module->inclusions as $inclusion){ if(!empty($inclusion->name)){  ?>
          <ul class="list_ok col-md-12 RTL" style="margin: 0 0 5px 0;">
            <li class="go-right"><?php echo $inclusion->name; ?></li>
          </ul>
          <?php } } ?>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-6" id="EXCLUSIONS">
          <h4 class="main-title go-right"><?php echo trans('0281');?></h4>
          <div class="clearfix"></div>
          <i class="tiltle-line go-right"></i>
          <div class="clearfix"></div>
          <br>
          <?php foreach($module->exclusions as $exclusion){ if(!empty($exclusion->name)){  ?>
          <ul class="col-md-12" style="margin: 0 0 5px 0;list-style:none;">
            <li class="go-right"><i style="font-size: 13px; color: #E25A70; margin-left: -16px;" class="icon-cancel-5 go-right"></i> &nbsp;&nbsp;&nbsp; <?php echo $exclusion->name; ?> &nbsp;&nbsp;&nbsp;</li>
          </ul>
          <?php } } ?>
          <div class="clearfix"></div>
        </div>
      </div>
      <?php } } ?>
    </div>
  </div>
  <br>
  <!-- End Tour Form aside -->
  <div class="container hidden-xs">
    <?php include 'includes/ratinigs.php';?>
    <div class="clearfix"></div>
    <?php if($appModule != "cars" && $appModule != "ean"){ include 'includes/review.php'; } ?>
    <div class="clearfix"></div>
    <?php include 'includes/review.php';?>
    <?php include 'includes/reviews.php';?>
    <div class="clearfix"></div>
  </div>
</div>
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
<!------------------------  Related Listings   ------------------------------>
<div class="container">
  <div class="col-md-12">
    <!-- Start Offers Contact Form -->
    <?php if($appModule == "offers"){ ?>
    <?php if(!empty($module->email)){ ?>
    <form class="panel panel-default" action="" method="POST">
      <fieldset>
        <?php if(!empty($success)){ ?>
        <div class="alert alert-success successMsg"><?php echo trans('0479');?></div>
        <?php } ?> <br>
        <div class="col-md-12 go-right form-group">
          <label class="go-right"><?php echo trans('0350');?></label>
          <input class="form-control" placeholder="<?php echo trans('0350');?>" type="text" name="name" value="" required>
        </div>
        <div class="col-md-12 go-left form-group">
          <label class="go-right"><?php echo trans('092');?></label>
          <input class="form-control" placeholder="<?php echo trans('092');?>" type="text" name="phone" value="" required>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
          <label class="go-right"><?php echo trans('0262');?></label>
          <textarea class="form-control" placeholder="<?php echo trans('0262');?>" name="message" rows="4" cols="25" required></textarea><br>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
          <input type="hidden" name="toemail" value="<?php echo $module->email;?>">
          <input type="hidden" name="sendmsg" value="1">
          <input class="btn btn-success btn-success btn-block btn-lg" type="submit" name="" value="<?php echo trans('0439');?>">
          <br>
        </div>
        <br>
        <!-- END CONTACT FORM -->
      </fieldset>
    </form>
    <?php } if(!$module->offerForever){ ?>
    <!-- Start Offers countdown -->
    <i class="fa fa-clock-o go-right"></i>
    <h4><?php echo trans('0269');?></h4>
    <p href="#" class="phone"><span class="wow fadeInLeft animated" id="countdown"></span></p>
    <!-- End Offers countdown -->
    <?php } ?>
    <div class="clearfix"></div>
    <script type="text/javascript">
      // set the date we're counting down to
      var target_date = new Date('<?php echo $module->fullExpiryDate; ?>').getTime();

      // variables for time units
      var days, hours, minutes, seconds;

      // get tag element
      var countdown = document.getElementById('countdown');

      // update the tag with id "countdown" every 1 second
      setInterval(function () {

      // find the amount of "seconds" between now and target
      var current_date = new Date().getTime();
      var seconds_left = (target_date - current_date) / 1000;

      // do some time calculations
      days = parseInt(seconds_left / 86400);
      seconds_left = seconds_left % 86400;

      hours = parseInt(seconds_left / 3600);
      seconds_left = seconds_left % 3600;

      minutes = parseInt(seconds_left / 60);
      seconds = parseInt(seconds_left % 60);

      // format countdown string + set tag value
      countdown.innerHTML = '<span class="days">' + days +  ' <b><?php echo trans("0440");?></b></span> <span class="hours">' + hours + ' <b><?php echo trans("0441");?></b></span> <span class="minutes">'
      + minutes + ' <b><?php echo trans("0442");?></b></span> <span class="seconds">' + seconds + ' <b><?php echo trans("0443");?></b></span>';

      }, 1000);

      $(function(){
          setTimeout(function(){
      $(".successMsg").fadeOut("slow");
      }, 7000);

      });

    </script>
    <?php } ?>
    <!-- End Offers Contact Form -->
  </div>
</div>
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
    } }else{ alert("<?php echo trans('0482');?>"); } });
    // End Add/remove wishlist
    })

  //------------------------------
  // Rooms
  //------------------------------

    $('.collapse').on('show.bs.collapse', function () {
    $('.collapse.in').collapse('hide');  });
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