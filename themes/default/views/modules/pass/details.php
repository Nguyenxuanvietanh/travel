<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/js/details.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>
<?php require $themeurl.'views/socialshare.php';?>

<div class="header-mob">
  <div class="container">
    <div class="row">
      <div class="col-xs-2 col-sm-1 text-left">
        <a data-toggle="tooltip" data-placement="right" title="<?php echo trans('0533');?>" class="mt10 icon-angle-left pull-left mob-back" onclick="goBack()"></a>
      </div>
      <div class="col-xs-8 col-sm-7 ">
        <div class="mob-trip-info-head ttu">
          <span><strong class="ellipsis ttu"><span><?php echo character_limiter($module->title, 28);?></span></strong></span>
          <span class="RTL">
          <i style="margin-left:-5px" class="icon-location-6"></i>
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
    </div>
  </div>
</div>

<div id="OVERVIEW" class="container mob-row">
  <div class="col-xs-12 col-md-8 go-right mob-row mt-15 pl0">
      <div style="width:100%" class="fotorama bg-dark" data-width="1000" data-height="490" data-allowfullscreen="true" data-autoplay="true" data-nav="thumbs">
      <img style="width:100%;height:450px !important" src="http://travel.local/uploads/images/tours/slider/294159_nile.jpg" />
      </div>
      <div class="clearfix form-group"></div>
    </div>

    <div class="clearfix"></div>
     <div class="sharethis-inline-share-buttons"></div>
    <br />
    <div class="col-md-12 go-left">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading panel-green hidden-xs">DETAILS</div>
                <div class="desc-scrol">
                    <div class="panel-body">
                        <div class="visible-lg visible-md RTL">
                            <?php echo $pass->note;?>
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
          console.log(result);
        })
      }); //end of change info
    })// end of document ready
  </script>
  <!-- aside -->
</div>
<div class="container mob-row">
  <?php include 'includes/amenities.php';?>

  <div class="clearfix"></div>

  <!-- Start Tour Form aside -->
      <div class="panel panel-default">
        <div class="panel-heading panel-default hidden-xs"><span class="go-right"><?php echo trans('0463'); ?></span>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
              <form action="" method="GET" >
                <div class="panel panel-default">
                  <div class="panel-heading">Sales Date</div>
                  <div class="panel-body">
                    <?php echo pt_show_date_php($pass->sales_date); ?>
                  </div>
                </div>
              </form>
            </div>
            <form  action="<?php echo base_url().$appModule;?>/book/<?php echo $module->bookingSlug;?>" method="GET" role="search">
              <div class="col-md-8">
                <div class="panel panel-default">
                  <div class="panel-heading">Price</div>
                  <div class="panel-body">
                    <?php echo $pass->ammount_text; ?>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <hr>
              <div class="col-md-6">
                  <small style="font-size: 12px;"> <?php echo trans('0126');?> <span class="totaldeposit"> <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><?php echo $module->totalDeposit;?></span> </small>
                </h4>
                <input type="hidden" name="pass_id" value="<?php echo $pass->id; ?>">
              </div>
              <div class="col-md-6">
                <button style="height: 59px; margin: 3px;" type="submit" class="btn btn-block btn-action btn-lg loader">BOOKING</button>
              </div>
            </form>
          </div>
        </div>
      </div>

<?php if(!empty($module->relatedItems)){ ?>
<div class="featured-back hidden-xs hidden-sm">
  <div class="container">
    <div class="row">
      <h2 class="destination-title go-right">
        <?php echo trans('0453'); ?>
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
</script>