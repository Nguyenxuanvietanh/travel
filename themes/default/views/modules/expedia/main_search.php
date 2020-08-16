<style> .modal-backdrop { z-index: 9; } </style>
<form autocomplete="off" action="<?php echo base_url(); ?>properties/search" method="GET" role="search">
  <div class="col-md-4 col-xs-12 go-text-right go-right">
    <div class="row">
      <div class="clearfix"></div>
      <i class="iconspane-lg icon_set_1_icon-41"></i>
      <input required id="citiesInput" name="city" type="text" class="form-control form input-lg RTL" placeholder="<?php echo trans('026'); ?>" value="<?php echo @ $_GET['city']; ?>" required />
      <input type="hidden" id="txtsearch" name="txtSearch" value="<?php echo $_GET['txtSearch']; ?>">
    </div>
  </div>
  <div class="bgfade col-md-2  go-right col-xs-6 focusDateInput" id="<?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?>">
    <div class="row">
      <div class="clearfix"></div>
      <i class="iconspane-lg icon_set_1_icon-53"></i>
      <input type="text" placeholder="<?php echo trans('07'); ?>" name="<?php if ($module == 'hotels' || $module == 'ean') { echo 'checkin'; } elseif ($module == 'tours') { echo 'date'; } ?>" class="form-control form input-lg <?php if ($module == 'hotels') { echo 'dpd1'; } elseif ($module == 'ean') { echo 'dpean1'; } elseif ($module == 'tours') { echo 'tchkin'; } ?>" value="<?php if ($module == 'ean') { echo $themeData->eancheckin; } else { echo $themeData->checkin; } ?>" required >
    </div>
  </div>
  <div id="dpd2" class="bgfade col-md-2 go-right col-xs-6 focusDateInput">
    <div class="row">
      <div class="clearfix"></div>
      <i class="iconspane-lg icon_set_1_icon-53"></i>
      <input type="text" placeholder="<?php echo trans('09'); ?>" name="checkout" class="form-control form input-lg <?php if ($module == 'hotels') { echo 'dpd2'; } elseif ($module == 'ean') { echo 'dpean2'; } ?>" value="<?php if ($module == 'ean') { echo $themeData->eancheckout; } else { echo $themeData->checkout; } ?>" required >
    </div>
  </div>
  <div class="bgfade col-md-2 go-right col-xs-12">
    <div class="row">
      <div class="clearfix"></div>
      <i class="iconspane-lg icon_set_1_icon-70"></i>
      <input data-toggle="collapse" data-target="#optionsexpedia" aria-expanded="false" aria-controls="optionsexpedia" type="text" value="2 Adults 0 Child" id="totalGuestsInput" name="passengers" class="form form-control input-lg">
    </div>
    <div class="collapse wow fadeIn" id="optionsexpedia">
      <div class="row">
        <div class="col-md-12 col-xs-6">
          <div class="row options form-horizontal">
            <div class="col-md-5">
              <div class="row text-center pt5">
                <strong><?php echo trans('010');?></strong>
              </div>
            </div>
            <div class="col-md-7">
              <div class="row">
                <div class="input-group">
                  <span class="input-group-btn">
                  <button class="btn btn-secondary btn-sm" type="button" id="adultMinusBtn"><i class="fa fa-minus"></i></button>
                  </span>
                  <input name="adults" id="adultInput" type="text" class="form-control input-sm text-center" value="2" placeholder="2">
                  <span class="input-group-btn">
                  <button class="btn btn-secondary btn-sm" type="button" id="adultPlusBtn"><i class="fa fa-plus"></i></button>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xs-6">
          <div class="row options form-horizontal">
            <div class="col-md-5">
              <div class="row text-center pt5">
                <strong><?php echo trans('011');?></strong>
              </div>
            </div>
            <div class="col-md-7">
              <div class="row">
                <div class="input-group">
                  <span class="input-group-btn">
                  <button class="btn btn-secondary btn-sm" type="button" id="childMinusBtn"><i class="fa fa-minus"></i></button>
                  </span>
                  <input type="text" name="child" id="childInput" class="form-control input-sm text-center" value="0" placeholder="0">
                  <span class="input-group-btn">
                  <button class="btn btn-secondary btn-sm" type="button" id="childPlusBtn"><i class="fa fa-plus"></i></button>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="bgfade col-md-2 go-right col-xs-12 search-button">
    <div class="clearfix"></div>
    <button type="submit"  class="btn-primary btn btn-lg btn-block pfb0 loader"><i class="icon_set_1_icon-66"></i> <?php echo trans('012'); ?></button>
  </div>
  <!-- Start Modal child ages -->
  <div style="color:black;margin-top:150px" class="modal fade" id="ages" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="z-index: 9999;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><?php echo trans('011'); ?></h4>
        </div>
        <div class="modal-body">
          <div class="form-horizontal ageselect"></div>
        </div>
        <div class="clearfix"></div>
        <br><br>
        <div class="clearfix"></div>
        <div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo trans('0233'); ?></button> </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="ages" tabindex="1" role="dialog" aria-hidden="true" style="margin-top:-70px">
    <div class="modal-dialog modal-sm" style="z-index: 9999;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><?php echo trans('011'); ?></h4>
        </div>
        <div class="modal-body">
          <div class="form-group form-horizontal ageselect"> </div>
        </div>
        <div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo trans('0233'); ?></button> </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="childages" id="childages" value="<?php echo $themeData->childages; ?>">
  <input type="hidden" name="search" value="search" >
</form>
<script>
  var loading = false;//to prevent duplicate
    function loadNewContent() {

        // get the current cache location and key..
        var moreResultsAvailable = $("#moreResultsAvailable").val();
        var cacheKey = $("#cacheKey").val();
        var cacheLocation = $("#cacheLocation").val();
        var cachePaging = $("#cachePaging").val();
        var checkin = $(".dpean1").val();
        var checkout = $(".dpean2").val();
        var agesappend = $("#agesappendurl").val();
        var adultsCount = $("#adultsCount").val();

        $('#loader_new').html("<div id='rotatingDiv'></div>");
        var url_to_new_content = '<?php echo base_url(); ?>ean/loadMore';

        $.ajax({
            type: 'POST',
            data: {'moreResultsAvailable': moreResultsAvailable, 'cacheKey': cacheKey, 'cacheLocation': cacheLocation, 'checkin': checkin, 'checkout': checkout,'agesappendurl': agesappend,'adultsCount': adultsCount },
            url: url_to_new_content,
            success: function (data) {

                // document.getElementById('loadNewdata').value = 1;

                if (data != "" && data != "404") {

                    $('#loader_new').html('');
                    loading = false;

                   // $("#latest_record_para").html(data);

                      var newData = data.split("###");

                      $("#latest_record_para").html(newData[0]);

                      $("#New_data_load").append(newData[1]);
                }
                else
                {
                    $('#loader_new').html('');
                    $("#message_noResult").html('');
                }
            }
        });
    }

    //scroll to PAGE's bottom
    var winTop = $(window).scrollTop();
    var docHeight = $(document).height();
    var winHeight = $(window).height();

    $(window).scroll(function () {

        var moreResultsAvailable = $("#moreResultsAvailable").val();
        var foot = $("#footer").offset().top - 500;
        // console.log($(window).scrollTop()+" == "+foot);
        if (moreResultsAvailable != '' && moreResultsAvailable == 1) {
            if ($(window).scrollTop() > foot) {
                if (!loading) {
                    loading = true;
                    loadNewContent();
                }
            }
        }
    });

  $(function() {
      var adultPlusBtn = document.getElementById('adultPlusBtn');
      var adultMinusBtn = document.getElementById('adultMinusBtn');
      var childPlusBtn = document.getElementById('childPlusBtn');
      var childMinusBtn = document.getElementById('childMinusBtn');
      var adultInput = document.getElementById('adultInput');
      var childInput = document.getElementById('childInput');
      var travellersInput = document.getElementById('totalGuestsInput'); // Input label field

      var updateGuestsInput = function ($adult, $child) {
          var value = $adult + ' Adult ' + $child + ' Child';
          travellersInput.value = value;
      }
      adultPlusBtn.onclick = function () {
        console.log("hello");
          adultInput.value = parseInt(adultInput.value) + 1;
          updateGuestsInput(adultInput.value, childInput.value);
      };
      adultMinusBtn.onclick = function () {
          var value = parseInt(adultInput.value) - 1;
          adultInput.value = (value < 1) ? 0 : value;
          updateGuestsInput(adultInput.value, childInput.value);
      };
      childPlusBtn.onclick = function () {
          childInput.value = parseInt(childInput.value) + 1;
          updateGuestsInput(adultInput.value, childInput.value);
      };
      childMinusBtn.onclick = function () {
          var value = parseInt(childInput.value) - 1;
          childInput.value = (value < 1) ? 0 : value;
          updateGuestsInput(adultInput.value, childInput.value);
      };
  });
</script>