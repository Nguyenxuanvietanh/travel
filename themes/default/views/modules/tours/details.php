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
      <style>
        .fotorama__wrap .fotorama__wrap--css3 .fotorama__wrap--slide .fotorama__wrap--toggle-arrows .fotorama__wrap--no-controls { width:100%; }
        .fotorama__loaded--img img { width:100%; }
      </style>
      <!-- slider -->
      <div style="width:100%" class="fotorama bg-dark" data-width="1000" data-height="490" data-allowfullscreen="true" data-autoplay="true" data-nav="thumbs">
        <?php foreach($module->sliderImages as $img){ ?>
        <img style="width:100%;height:450px !important" src="<?php echo $img['fullImage']; ?>" />
        <?php } ?>
      </div>
      <div class="clearfix form-group"></div>
    </div>

    <div class="col-md-4 hidden-xs">
            <div class="row">
              <iframe id="mapframe" width="100%" height="558" style="position: static; background: #eee;" src="" frameborder="0"></iframe>
              <script>
                // $('#collapseMap').on('shown.bs.collapse', function(e){
                $(document).ready(function(e){
                  $("#mapframe").prop("src","<?php echo base_url();?>tours/tourmap/<?php echo $module->id; ?>");
                });
              </script>
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
                  <div class="panel-heading"><?php echo trans('0158');?> <?php echo trans('08');?></div>
                  <div class="panel-body">
                    <input name="date" type="text" class="form-control form-group tchkin" placeholder="<?php echo trans('012');?>" value="<?php echo $module->date; ?>" >
                    <button type="submit" class="btn btn-block btn-lg btn-danger pull-right loader"><?php echo trans('0454');?></button>
                  </div>
                </div>
              </form>
            </div>
            <form  action="<?php echo base_url().$appModule;?>/book/<?php echo $module->bookingSlug;?>" method="GET" role="search">
              <div class="col-md-8">
                <input type="hidden" name="date" value="<?php echo $module->date;?>">
                <table style="width:100%" class="table table-bordered">
                  <?php if(!empty($modulelib->error)){ ?>
                  <div class="alert alert-danger go-text-right">
                    <?php echo trans($modulelib->errorCode); ?>
                  </div>
                  <?php } ?>
                  <thead>
                    <tr>
                      <th  style="line-height: 1.428571;"><?php echo trans('068');?></th>
                      <th style="line-height: 1.428571;"><?php echo trans('0450');?></th>
                      <th  style="line-height: 1.428571;" class="text-center"><?php echo trans('070');?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($module->adultStatus){ ?>
                    <tr>
                      <th scope="row"><?php echo trans('010');?> <span class="weak"><?php echo $module->currSymbol;?><?php echo $module->perAdultPrice;?></span></th>
                      <td>
                        <select style="min-width:50px" name="adults" class="selectx changeInfo input-sm" id="selectedAdults">
                          <?php for($adults = 1; $adults <= $module->maxAdults; $adults++){ ?>
                          <option value="<?php echo $adults;?>" <?php echo makeSelected($selectedAdults, $adults); ?>><?php echo $adults;?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td class="text-center adultPrice"><?php echo $module->currSymbol;?><?php echo $module->adultPrice;?></td>
                    </tr>
                    <?php } if($module->childStatus){ ?>
                    <tr>
                      <th scope="row"><?php echo trans('011');?> <span class="weak"><?php echo $module->currSymbol;?><?php echo $module->perChildPrice;?></span></th>
                      <td>
                        <select name="child" class="selectx changeInfo input-sm" id="selectedChild">
                          <option value="0">0</option>
                          <?php for($child = 1; $child <= $module->maxChild; $child++){ ?>
                          <option value="<?php echo $child;?>" <?php echo makeSelected($selectedChild, $child); ?> ><?php echo $child;?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td class="text-center childPrice"><?php echo $module->currSymbol;?><?php echo $module->childPrice;?></td>
                    </tr>
                    <?php } if($module->infantStatus){  ?>
                    <tr>
                      <th scope="row"><?php echo trans('0282');?> <span class="weak"><?php echo $module->currSymbol;?><?php echo $module->perInfantPrice;?></span></th>
                      <td>
                        <select name="infant" class="selectx changeInfo input-sm" id="selectedInfants">
                          <option value="0">0</option>
                          <?php for($infant = 1; $infant <= $module->maxInfant; $infant++){ ?>
                          <option value="<?php echo $infant;?>" <?php echo makeSelected($selectedInfants, $infant); ?> ><?php echo $infant;?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td class="text-center infantPrice"><?php echo $module->currSymbol;?><?php echo $module->infantPrice;?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="clearfix"></div>
              <hr>
              <div class="col-md-6">
                <h4 class="well well-sm text-center strong" style="margin-top: 4px; margin-bottom: 14px;"> <?php echo trans('0334'); ?> <span style="color:#333333;" class="totalCost"><?php echo $module->currCode;?> <?php echo $module->currSymbol;?><strong><?php echo $module->totalCost;?></strong></span><br>
                  <small style="font-size: 12px;"> <?php echo trans('0126');?> <span class="totaldeposit"> <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><?php echo $module->totalDeposit;?></span> </small>
                </h4>
              </div>
              <div class="col-md-6">
                <button style="height: 59px; margin: 3px;" type="submit" class="btn btn-block btn-action btn-lg loader"><?php echo trans('0142');?></button>
              </div>
            </form>
          </div>
        </div>
      </div>




<div class="container">
<div class="">
     <div class="clearfix"></div>
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
                      <!-- Start Tours Inclusions / Exclusions -->
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