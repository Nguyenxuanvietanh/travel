<?php if(isset($errorMessage) && ! empty($errorMessage)) {
     echo $errorMessage; die(); }
?>
<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet">
<script src="<?php echo $theme_url; ?>assets/js/details.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>

<div style="margin-top:25px" class="container form-group">
<div class="mob-trip-info-head ttu">
  <h3><strong class="ellipsis ttu"><span><?=$hotel->name?></span></strong></h3>
  <span class="RTL">
  <i style="margin-left:-5px" class="icon-location-6"></i>
  <?=$hotel->city?>  <small class="hidden-xs">, <?=$hotel->address?></small></span>
  <div class="clearfix"></div>
  <div>
      <small>
          <?php for($i = 0; $i < 5; $i++): ?>
            <?php if($i < $hotel->ratingStars): ?>
                  <i class="star fa fa-star"></i>
            <?php else: ?>
                  <i class="star star fa fa-star-o"></i>
            <?php endif; ?>
          <?php endfor; ?>
      </small>
  </div>
</div>
</div>

<div id="OVERVIEW" class="container mob-row">
 <div class="col-xs-12 col-md-8 go-right mob-row mt-15 pl0">
  <style>
    .fotorama__wrap .fotorama__wrap--css3 .fotorama__wrap--slide .fotorama__wrap--toggle-arrows .fotorama__wrap--no-controls { width:100%; }
    .fotorama__loaded--img img { width:100%; }
  </style>
  <div style="width:100%" class="fotorama bg-dark" data-width="1000" data-height="490" data-allowfullscreen="true" data-autoplay="true" data-nav="thumbs">
   <?php  foreach(array_slice(json_decode($hotel->images), 0, 10) as $image) { ?>
       <img style="width:100%;height:450px !important" src="//photos.hotelbeds.com/giata/<?=$image->path?>" alt="<?=$hotel->imageTypeCode?>" title="<?=$hotel->imageTypeCode?>"/>
   <?php } ?>
  </div>
<div class="clearfix form-group"></div>
</div>

  <div class="col-md-4 hidden-xs">
    <div class="row">
        <div id="map" class="map hidden-xs"></div>
        <script>
            $(document).ready(function(){
                var myLatLng = {lat: <?=$hotel->latitude?>, lng: <?=$hotel->longitude?>};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 4,
                    center: myLatLng
                });
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: '<?=$hotel->name?>'
                });
            });
        </script>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-12 go-left">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading panel-green hidden-xs"><?php echo trans('0177');?></div>
        <div class="desc-scrol">
          <div class="panel-body">
            <div class="visible-lg visible-md RTL">
              <p class="main-title go-right"><?php echo trans('046');?></p>
              <div class="clearfix"></div>
              <i class="tiltle-line  go-right"></i>
              <div class="clearfix"></div>
              <p><?=$hotel->description?></p>
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
                  <div class="mob-fs14 RTL">
                    <p><?=$hotel->name?> is located in the <?=$hotel->city?> City</p>
                  </div>
                </div>
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong><?php echo trans('0286');?> <i class="lightcaret mt-2 go-leftt"></i></strong></a>
                </h4>
                <div id="collapse2" class="panel-collapse collapse">
                  <p class="main-title go-right">Description</p>
                  <div class="clearfix"></div>
                  <i class="tiltle-line  go-right"></i>
                  <div class="clearfix"></div>
                  <p><?=$hotel->description?></p>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- aside -->
</div>
<div class="container mob-row">
  <div class="clearfix"></div>
  <div class="visible-lg visible-md">
    <div class="panel panel-default">
      <div class="panel-heading panel-default ttu">
        <span class="go-right"><?php echo trans('0197');?></span>
        <span class="pull-right go-left"><strong><i class="icon_set_1_icon-83"></i> <?php echo trans('0276');?></strong> <?=$input->totalStay?> </span>
        <div class="clearfix"></div>
      </div>
      <div class="panel-body">
        <form name="fRecheckForm" class="row" action="<?=base_url('hotelb/detail/')?>" method="POST">
          <div class="col-md-3 col-xs-12 go-right">
            <div class="form-group">
              <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
              <input type="text" placeholder="<?php echo trans('07');?>" name="checkin" class="form-control dpd1rooms" value="<?=$_SESSION['checkIn']?>" required>
            </div>
          </div>
          <div class="col-md-3 col-xs-12 go-right">
            <div class="form-group">
              <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
              <input type="text" placeholder="<?php echo trans('09');?>" name="checkout" class="form-control dpd2rooms" value="<?=$_SESSION['checkOut']?>" required>
            </div>
          </div>
          <div class="col-md-2 col-xs-12 go-right">
            <div class="form-group">
              <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
              <select class="mySelectBoxClass form-control" name="adults" id="adults">
                <?php for($i = 1; $i <= 10; $i++): ?>
                  <option value="<?=$i?>" <?=($i == $input->adult)?'selected':''?>><?=$i?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="col-md-2 col-xs-12 go-right">
            <div class="form-group">
              <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
              <select class="mySelectBoxClass form-control" name="child" id="child">
                  <?php for($i = 0; $i < 5; $i++): ?>
                      <option value="<?=$i?>" <?=($i == $input->children)?'selected':''?>><?=$i?></option>
                  <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="col-md-2 col-xs-12 go-right">
            <label class="hidden-xs">&nbsp;</label>
              <input type="hidden" name="hotelname" value="<?=strtolower(str_replace(' ','-',trim($hotel->name)))?>">
            <button type="submit" class="btn btn-block btn-success-small textupper loader"><?php echo trans('0106');?></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="hidden-sm hidden-md hidden-lg">
    <div class="col-xs-6">
      <label class="check_dates"><?php echo trans('07');?></label>
      <div><?=$sessionHotel['checkIn']?></div>
    </div>
    <div class="col-xs-6 text-right">
      <label class="check_dates"><?php echo trans('09');?></label>
      <div><?=$sessionHotel['checkOut']?></div>
    </div>
    <div class="clearfix"></div>
    <br>
  </div>
  <div class="clearfix"></div>
  <section id="ROOMS">
    <div class="panel panel-default">
      <div class="panel-heading go-text-right panel-default ttu"><?php echo trans('0372');?></div>
      <div class="clearfix"></div>
      <div class="clearfix"></div>
      <div class="clearfix"></div>
      <table class="bgwhite table table-striped">
        <tbody>
        <?php foreach($sessionHotel['rooms'] as $index => $room): ?>
        <tr>
            <td class="wow fadeIn p-10-0 animated" style="visibility: visible; animation-name: fadeIn;">
              <div class="col-md-2 col-xs-5 go-right rtl_pic">
                <div class="img_list_rooms">
                  <div class="zoom-gallery52">
                    <a href="<?=base_url()?>uploads/images/hotels/rooms/thumbs/hotelbeds-room-default.jpg" data-source="<?=base_url()?>uploads/images/hotels/rooms/thumbs/hotelbeds-room-default.jpg" title="Hyatt Regency Perth">
                        <img style="max-height:180px" class="img-responsive" src="<?=base_url()?>uploads/images/hotels/rooms/thumbs/hotelbeds-room-default.jpg">
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-md-10 col-xs-7 g0-left">
                <div class="col-md-4" style="margin-top: 15px;">
                  <div class="row">
                    <h4 class="RTL go-text-right mt0 list_title ttu">
                      <a href="javascript:void(0)">
                        <b><?=$room->name?></b>
                        <!--<div class="clearfix"></div>
                        <small>
                        <strong>Adults</strong> 4 <strong>Child</strong> 3</small>-->
                      </a>
                    </h4>
                  </div>
                  <!--<div class="row" style="margin-top: -15px;">
                    <div class="row">
                      <div class="col-xs-6 col-md-5 go-right">
                        <h5 class="fs14">No. Rooms</h5>
                      </div>
                      <div class="col-xs-6 col-md-4 go-left">
                        <select class="selectx input-sm none" name="roomscount">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                      <div class="col-xs-6 col-md-5 go-right">
                        <h5 class="fs14 mt5">Extra Beds</h5>
                      </div>
                      <div class="col-xs-6 col-md-4 go-left">
                        <select name="extrabeds" class="selectx input-sm none" id="">
                          <option value="0">0</option>
                          <option value="1"> 1 USD $55</option>
                          <option value="2"> 2 USD $110</option>
                          <option value="3"> 3 USD $165</option>
                          <option value="4"> 4 USD $220</option>
                          <option value="5"> 5 USD $275</option>
                        </select>
                      </div>
                    </div>
                  </div>-->
                </div>
                <div class="col-md-8 book_area">
                  <div class="row">
                    <div class="col-md-3 book_buttons hidden-xs hidden-sm">
                      <button data-toggle="collapse" data-parent="#accordion" class="hidden-xs btn btn-default btn-block btn-sm" href="#details_<?=$index?>"><?php echo trans('0246');?></button>
                    </div>
                    <div class="col-md-5">
                      <h2 class="book_price text-center mob-fs18 rooms-book-button go-right">
                          <small>
                          <?php
                              $min_price = min(array_column($room->rates, 'net'));
                              echo current(array_filter($room->rates, function($arr) use($min_price) {
                                 return ($arr->net == $min_price);
                              }))->hotelCurrency;
                          ?></small> <strong><?=$vfHotelbedsMarkup($min_price, $markupPercentage)?></strong>
                      </h2>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                          <form name="fBookNow" action="#" method="post">
                              <input type="hidden" name="hotelname" value="<?=$hotel->name?>"/>
                              <input type="hidden" name="rateKey" value=""/><!-- set value onclick radion button -->
                              <input type="hidden" name="checkIn" value="<?=$sessionHotel['checkIn']?>"/>
                              <input type="hidden" name="checkOut" value="<?=$sessionHotel['checkOut']?>"/>
                              <input type="hidden" name="adults" value="<?=$input->adult?>"/>
                              <input type="hidden" name="childrens" value="<?=$input->children?>"/>
                              <button type="button" id="fBookNow" class="book_button btn btn-md btn-danger btn-block btn-block chk mob-fs10 loader">Book Now</button>
                          </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
              <div style="color:#333333 !important" id="details_<?=$index?>" class="panel-body panel-collapse collapse in">
               <div class="clearfix"></div>
               <div class="panel panel-default">
                  <div class="panel-body">
                      <!-- room rates -->
                      <table class="table table-striped">
                          <thead>
                            <tr>
                                <td><?php echo trans('070');?></td>
                                <td><?php echo trans('0350');?></td>
                                <td><?php echo trans('016');?></td>
                                <td><?php echo trans('010');?></td>
                                <td><?php echo trans('011');?></td>
                                <td><?php echo trans('0586');?></td>
                                <td><?php echo trans('0265');?></td>
                                <td><?php echo trans('0340');?> <?php echo trans('00');?></td>
                                <td><?php echo trans('0181');?></td>
                                <td><?php echo trans('0155');?></td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($room->rates as $rate): ?>
                              <tr>
                                  <?php $hotelCurrency = (array_key_exists('hotelCurrency', $rate))?$rate->hotelCurrency:$sessionHotel['hotel']->currency;?>
                                  <td><?=$hotelCurrency.$rate->net?></td>
                                  <td><?=$rate->boardName?></td>
                                  <td><?=$rate->rooms?></td>
                                  <td><?=$rate->adults?></td>
                                  <td><?=$rate->children?></td>
                                  <td><?=$rate->rateClass?></td>
                                  <td><?=$rate->paymentType?></td>
                                  <td><?=$rate->rateType?></td>
                                  <td><?=$rate->allotment?></td>
                                  <td>
                                      <input type="radio" value="<?=$rate->rateKey?>" name="rRateKey"/>
                                  </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
  <div class="container">
    <div class="">
      <p id="terms" class="main-title  go-right"><?php echo trans('0265');?></p>
      <div class="clearfix"></div>
      <i class="tiltle-line  go-right"></i>
      <div class="clearfix"></div>
      <span class="RTL">
          <?php echo implode(', ', array_column($sessionHotel['creditCards'], 'name')); ?>
      </span>
      <br><br>
      <div class="hidden-xs">
        <div class="clearfix"></div>
        <hr>
        <div class="go-right">
          <p class="main-title  go-right">Check in</p>
          <div class="clearfix"></div>
          <i class="tiltle-line go-right"></i>
          <div class="clearfix"></div>
          <p class="RTL">
            <i class="fa fa-clock-o text-success"></i> <strong> <?php echo trans('07');?></strong> :   <?=$sessionHotel['checkIn']?> <br>
            <i class="fa fa-clock-o text-warning"></i> <strong> <?php echo trans('09');?> </strong> :  <?=$sessionHotel['checkOut']?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<br/>

<!------------------------  Related Listings   ------------------------------>

<div class="featured-back hidden-xs hidden-sm">
  <div class="container">
    <div class="row">
      <h2 class="destination-title go-right">
        <?php echo trans('0290');?>
      </h2>
    </div>
    <div class="main_slider">
            <div class="set hotels-left fa-left"> <i class="icon-left-open-3"></i> </div>
            <div class="related" class="get">
          <?php foreach($featuredHotels as $fHotel): ?>
                <div class="owl-item">
                    <div class="imgLodBg">
            <div class="load"></div>
            <?php $image = json_decode($fHotel->images)[0]->path; ?>
            <img data-wow-duration="0.2s" data-wow-delay="1s" class="wow fadeIn" src="//photos.hotelbeds.com/giata/<?=$image?>">
            <div class="country-name wow fadeIn">
                <h4 class="ellipsis go-text-right"><?=$fHotel->name?></h4>
                <p class="go-text-right"><i class="icon-location-6 go-text-right go-right"></i>
                    <?=$fHotel->city?> &nbsp;
                </p>
            </div>
            <div class="overlay">
                <div class="textCenter">
                    <div class="textMiddle">
                        <a class="loader" href="<?=sprintf($featuredHotelsUrl,strtolower(str_replace(' ', '-', $fHotel->name)))?>">
                        <?php echo trans( '0142');?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
                    <div class="additional-info">
                        <div class="pull-left rating-passive"> <span class="stars">
                         <?php for($star = 1; $star <= 5; $star++): ?>
                          <?php if($fHotel->ratingStars < $star): ?>
                            <i class="star star fa fa-star-o"></i>
                          <?php else: ?>
                            <i class="star fa fa-star"></i>
                          <?php endif; ?>
                      <?php endfor; ?>

                        </span> </div>
                        <div class="pull-right"> <i data-toggle="tooltip" title="Price" class="icon-tag-6"></i>
                            <?php if($item->price > 0){ ?> <span class="text-center">
                            <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                            </span>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="set fa-right hotels-right"> <i class="icon-right-open-3"></i> </div>
        </div>
  </div>
</div>
<!------------------------  Related Listings   ------------------------------>




<script>
    function create_slug(data) {
        var checkin = data['checkin'].replace(/\/+/g, '-');
        var checkout = data['checkout'].replace(/\/+/g, '-');
        return data['hotelname']+"/"+checkin+"/"+checkout+"/"+data['adults']+"/"+data['child'];
    }
    $("form[name=fRecheckForm]").on("submit", function(e) {
        e.preventDefault();
        var values = {};
        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        window.location.href = $(this).attr('action')+'recheck/'+create_slug(values);
    });

    $("button[id=fBookNow]").on("click", function (e) {
        var fBookNow = $("form[name=fBookNow]");
        var rRateKey = $("input[name=rRateKey]:checked").val();
        $("input[name=rateKey]").val(rRateKey);
        if($("input[name=rateKey]").val() != "") {
            fBookNow.attr('action', "<?=base_url('hotelb/checkout')?>");
            fBookNow.submit();
        } else {
            e.preventDefault();
        }
    })
</script>