<?php if($pagination == false): ?>
    <style>
    .summary  { border-right: solid 2px rgb(0, 93, 247); color: #ffffff; background: #4285f4; padding: 14px; float: left; font-size: 14px; }
    .sideline { margin-top: 15px; margin-bottom: 15px; padding-left: 15px; display: table-cell; border-left: solid 1px #e7e7e7; }
    .localarea { margin-top: 15px; margin-bottom: 15px; padding-left: 15px; }
    .captext  { display: block; font-size: 14px; font-weight: 400; color: #23527c; line-height: 1.2em; text-transform: capitalize; }
    .ellipasis { max-width: 250px; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; }
    .noResults { right: 30px; top: 26px; color: #008cff; font-size: 16px; }
    .table { margin-bottom: 5px; }
    .filter {
        background: #fff;
    }
    .filter label {
        color: #0f0f0f;
    }
    </style>

    <div class="search_head">
    <div class="container"><br>
    <?php require $themeurl. 'views/modules/hotelbeds/main_search.php';?>
    <div class="clearfix"></div>
    </div>
    </div>
    <div class="listingbg">
    <div class="container offset-0">

  <div class="clearfix"></div>
  <?php if(!$ismobile): ?>
    <div class="col-md-3 hidden-sm hidden-xs filter">
      <!-- FILTERS -->
      <form name="fFilters" action="<?php echo base_url($uri.'/filter'); ?>" method="GET" role="search">
        <div style="padding:10px 10px 10px 10px">
            <div class="textline">
                <span class="filterstext"><span><i class="icon_set_1_icon-95"></i>Filter Search</span></span>
            </div>
        </div>
        <div class="clearfix"></div>

          <!-- Price range -->
          <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#priceOrderFilter">
              Price Order <span class="collapsearrow"></span>
          </button>
          <div id="priceOrderFilter" class="collapse in">
              <div class="panel-body">
                  <div class="go-right"><input type="radio" id="priceOrderDes" name="priceOrder" value="des">&nbsp;&nbsp;<label class="go-left" for="priceOrderDes">High to Low</label></div>
                  <div class="go-right"><input type="radio" id="priceOrderAsc" name="priceOrder" value="acs">&nbsp;&nbsp;<label class="go-left" for="priceOrderAsc">Love to High</label></div>
              </div>
          </div>

          <form name="fFilters" action="<?php echo base_url().$appModule;?>/search" method="GET" role="search">
              <!-- Star ratings -->
              <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
                  <?php echo trans('0137');?> <?php echo trans('069');?> <span class="collapsearrow"></span>
              </button>
              <div id="collapse1" class="collapse in">
                  <div class="hpadding20">
                      <br>
                      <?php for($radios = 0; $radios < 5; $radios++): ?>
                          <?php $checked = ($radios+1 == $input->stars)?'checked':''; ?>
                          <div class="rating" style="font-size: 14px;">
                              <div class="go-right">
                                  <div class="iradio_square-grey <?=$checked?>" style="position: relative;">
                                      <input type="radio" <?=$checked?> id="<?=$radios+1?>" name="stars" class="go-right radio" value="<?=$radios+1?>" style="position: absolute; opacity: 0;">
                                      <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                  </div>
                                  <label class="go-left" for="<?=$radios+1?>">
                                      <i class="fa <?=($radios >= 0)?'star fa-star':'fa-star-o'?>"></i>
                                      <i class="fa <?=($radios >= 1)?'star fa-star':'fa-star-o'?>"></i>
                                      <i class="fa <?=($radios >= 2)?'star fa-star':'fa-star-o'?>"></i>
                                      <i class="fa <?=($radios >= 3)?'star fa-star':'fa-star-o'?>"></i>
                                      <i class="fa <?=($radios >= 4)?'star fa-star':'fa-star-o'?>"></i>
                                  </label>
                              </div>
                          </div>
                      <?php endfor; ?>
                  </div>
                  <div class="clearfix"></div>
                  <br>
              </div>
              <!-- End of Star ratings -->

              <!-- Start Concept Filters -->
              <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#conceptFilter">
                  Concept <span class="collapsearrow"></span>
              </button>
              <div id="conceptFilter" class="hpadding20">
                  <br>
                  <div class="clearfix"></div>
                  <?php foreach($concepts as $facilitie): ?>
                      <?php $checked = (in_array($facilitie->facilityGroupCode.':'.$facilitie->facilityTypologyCode.':'.$facilitie->code, $input->fFacilities)) ? 'checked': ''; ?>
                      <div class="go-right">
                          <input type="checkbox" <?=$checked?> name="facilities[]" value="<?=$facilitie->facilityGroupCode.':'.$facilitie->facilityTypologyCode.':'.$facilitie->code?>" class="checkbox go-right"/>
                          <label for="all" class="css-label go-left"><span class="ellipsis" style="max-width: 150px;"><?=$facilitie->description?></span></label>
                      </div><div class="clearfix"></div>
                  <?php endforeach; ?>
              </div>
              <div class="clearfix"></div>
              <br>
              <!-- End of Concept Filters -->

          <!-- Accommodations -->
          <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse4">
              <?php echo trans('0478');?> <span class="collapsearrow"></span>
          </button>
          <div id="collapse4" class="collapse in">
              <div class="scroll-400">
                  <div class="hpadding20">
                      <br>
                      <?php foreach($accommodations as $index => $accommodation): ?>
                          <?php $checked = (in_array($accommodation->code, $input->fAccommodations)) ? 'checked': ''; ?>
                          <div class="go-right">
                              <input type="checkbox" <?=$checked?> name="accommodation[<?=$index?>]" value="<?=$accommodation->code?>" class="checkbox go-right"/>
                              <label for="all" class="css-label go-left"><?=$accommodation->description?></label>
                          </div><div class="clearfix"></div>
                      <?php endforeach; ?>
                      <br>
                  </div>
              </div>
              <div class="clearfix"></div>
          </div>
          <!-- End of Accommodations -->
          <div class="clearfix"></div>
          <br>
        <!-- Price Range -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
         <?php echo trans('0301');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse2" class="collapse in">
          <div class="panel-body text-center">
              <?php
                  list($minprice, $maxprice) = explode('-', $input->price);
                  if(!empty($input->price)){
                      $selectedprice = str_replace('-',',', $input->price);
                  }else{
                      $selectedprice =  "10,5000";
                  }
              ?>
              <input type="text" id="sl2" name="price" class="col-md-12" value="<?=$selectedprice?>" data-slider-min="<?=$minprice?>" data-slider-max="<?=$maxprice?> " data-slider-step="10" data-slider-value="[<?=$selectedprice?>]">
          </div>
        </div>
        <!-- End of Price Range -->
        <!-- Facilities -->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse3">
          <?php echo trans('0249');?> <span class="collapsearrow"></span>
        </button>
        <div id="collapse3" class="collapse in">
            <div class="scroll-400">
                <div class="hpadding20">
                    <br>
                    <?php foreach($facilities as $facilitie): ?>
                        <?php $checked = (in_array($facilitie->facilityGroupCode.':'.$facilitie->facilityTypologyCode.':'.$facilitie->code, $input->fFacilities)) ? 'checked': ''; ?>
                    <div class="go-right">
                      <input type="checkbox" <?=$checked?> name="facilities[]" value="<?=$facilitie->facilityGroupCode.':'.$facilitie->facilityTypologyCode.':'.$facilitie->code?>" class="checkbox go-right"/>
                      <label for="all" class="css-label go-left"><span class="ellipsis" style="max-width: 150px;"><?=$facilitie->description?></span></label>
                    </div><div class="clearfix"></div>
                    <?php endforeach; ?>
                    <br>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End of Facilities -->
        <br>
          <button style="border-radius:0px;margin-bottom:0px;" type="submit" class="btn btn-primary br25 btn-lg btn-block loader" id="searchform">Search</button>
      </form>
    </div>
  <?php endif; ?>

  <div class="col-md-9 col-xs-12">
    <div class="itemscontainer">

      <table class="bgwhite table table-striped" id="listing">
        <?php endif; ?>

        <?php if(isset($hotels) && ! empty($hotels)): ?>
        <?php foreach($hotels as $hotel): ?>
        <tr data-price="<?=$vfHotelbedsMarkup($hotel->minRate, $markupPercentage)?>">
          <td class="wow fadeIn p-10-0">
            <div class="col-md-3 col-xs-5 go-right rtl_pic">
              <div class="img_list">
                <div class="review text-center size18 hidden-xs"><?=$hotel->categoryCode[0].' / 5'?></div>
                <a href="<?=base_url(sprintf($detailpage_uri, strtolower(trim($hotel->name))))?>">
                  <img src="<?= $hotel->image ?>" class="center-block loader" alt="<?= $hotel->name ?>">
                  <div class="short_info"></div>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-xs-4 g0-left">
              <div class="row">
                <h4 class="RTL go-text-right mt0 list_title">
                    <a href="<?=base_url(sprintf($detailpage_uri, strtolower(trim($hotel->name))))?>"><b><?= $hotel->name ?></b></a>
                </h4>
                <a class="go-right ellipsisFIX go-text-right mob-fs14" href="javascript:void(0);" title="<?=$hotel->destinationName?>">
                 <i style="margin-left: -3px;" class="mob-fs14 icon-location-6 go-right"></i><?=$hotel->destinationName?>  </a>
                 <?php for($star = 1; $star <= 5; $star++): ?>  
                    <?php if($hotel->categoryCode[0] < $star): ?>
                      <i class="star star fa fa-star-o"></i>
                    <?php else: ?>
                      <i class="star fa fa-star"></i>
                    <?php endif; ?>
                <?php endfor; ?>

                <p style="margin: 7px 0px 7px 0px;" class="grey RTL fs12 hidden-xs">
                  <?=strlen($hotel->description) > 250 ? substr($hotel->description,0,250)."..." : $hotel->description;?>
                </p>
              </div>
            </div>
            <div class="col-md-3 col-xs-4 col-sm-4 go-left pull-right price_tab">
              <div class="fs26 text-center"><small><?= $hotel->currency ?></small> <strong><?= $vfHotelbedsMarkup($hotel->minRate, $markupPercentage) ?></strong></div>
              <a href="<?=base_url(sprintf($detailpage_uri, strtolower(trim($hotel->name))))?>">
                <button class="btn btn-primary br25 loader loader btn-block"><?php echo trans('0177');?></button>
              </a>
            </div>
          </td>
        </tr>
        <div class="clearfix"></div>
        <?php endforeach; ?>
        <?php endif; ?>
       <?php if($pagination == false): ?>
      </table>
      <div class="clearfix"></div>
    </div>
    <!-- END OF LIST CONTENT-->
  </div>
  <!-- END OF container-->
</div>
</div>
<!-- END OF CONTENT -->

<script>
    // Sorting according to prices.
    $("[name^=priceOrder]").click(function() {
        var order = $(this).val();
        var tb = $('#listing');

        var rows = tb.find('tr');
        rows.sort(function(a, b) {
            var keyA = $(a).data('price');
            var keyB = $(b).data('price');

            if (order == 'acs') {
                return keyA - keyB;
            } else {
                return keyB - keyA;
            }
        });

        $.each(rows, function(index, row) {
            tb.append(row);
        });
    });

    function create_slug(data) {
        var facilities = [];
        var accommodation = [];
        $('.icheckbox_square-grey.checked input[name^="facilities"]').each(function() {
            facilities.push($(this).val());
        });
        $('.icheckbox_square-grey.checked input[name^="accommodation"]').each(function() {
            accommodation.push($(this).val());
        });
        var p_1 = data['stars'] || 0;
        var p_2 = data['price'] || 0;
        var p_3 = facilities.join('-') || 34;
        var p_4 = accommodation.join('-') || 0;
        return "/"+p_1+"/"+p_2+"/"+p_3+"/"+p_4;
    }
    $("form[name=fFilters]").on("submit", function(e) {
        e.preventDefault();
        var values = {};
        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        window.location.href = $(this).attr('action')+create_slug(values);
    });
    var count = 1;
    function bindScroll(){
       if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
           $("#listing").after( "<div class='loading' style='margin: 30px auto;'></div>" );
           $(window).unbind('scroll');
           loadHotels(count);
           count++;
       }
    }
    $(window).scroll(bindScroll);
    function loadHotels(pageNumber) {
        $.get("<?=base_url('hotelb/pagination/')?>"+pageNumber, function(response) {
          if(response.status == 'success') {
              $(".loading").remove();
              $('#listing').find('tbody').append( response.listHtml );
              $(window).bind('scroll', bindScroll);
          } else {
            scrolling = false;
          }
        });
    }
</script>
<?php endif; ?>
