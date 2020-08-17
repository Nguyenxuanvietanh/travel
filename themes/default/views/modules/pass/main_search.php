<style>
    .select2-results {
        max-height: 200px;
        position: relative;
        overflow-x: hidden;
        overflow-y: auto;
        background-color: #ffffff;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    }
    .input-sm {
        padding: 5px 5px;
    }
</style>
<form name="fCustomHotelSearch" autocomplete="off" action="<?=base_url($module.'/search')?>" method="GET" role="search">
    <div class="col-md-4 col-xs-12 go-text-right go-right form-group bgwhite h60">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-41"></i>
            <input style="border:0px solid" type="text" name="hotel_s2_text" value="<?=$_SESSION['hotel_select2']['id']?>" class="hotelsearch locationlist<?=$module?>">
        </div>
    </div>
    <div class="bgfade col-md-2 form-group go-right col-xs-6 focusDateInput" id="dpd1">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('07'); ?>"  value="<?=$_SESSION['hotel_checkin']?>" name="checkin" class="form input-lg dpd1" required >
        </div>
    </div>
    <div id="dpd2" class="bgfade col-md-2 form-group go-right col-xs-6 focusDateInput">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('09'); ?>"  value="<?=$_SESSION['hotel_checkout']?>" name="checkout" class="form input-lg dpd2" required >
        </div>
    </div>
    <div class="bgfade col-md-2 form-group go-right col-xs-12">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-70"></i>
            <input data-toggle="collapse" data-target="#options" aria-expanded="false" aria-controls="options" type="text" value="<?=($_SESSION['hotel_adults'])?$_SESSION['hotel_adults']:'2'?> Adult 0 Child" id="travellersInput" name="travellers" class="form form-control input-lg">
        </div>
        <div style="position: absolute; max-width: 100%;z-index:9999;margin-left: -15px;" class="collapse wow fadeIn" id="options">
            <div class="">
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
                                    <input name="adults" id="adultInput" type="text" class="form-control input-sm text-center" value="<?=($_SESSION['hotel_adults'])?$_SESSION['hotel_adults']:'2'?>" placeholder="<?=($_SESSION['hotel_adults'])?$_SESSION['hotel_adults']:'2'?>">
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
                                    <input type="text" name="child" id="childInput" class="form-control input-sm text-center" value="<?=($_SESSION['hotel_child'])?$_SESSION['hotel_child']:'0'?>" placeholder="<?=($_SESSION['hotel_child'])?$_SESSION['hotel_child']:'0'?>">
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
    <div class="col-md-2 form-group go-right col-xs-12 search-button">
        <input type="hidden" name="module_type"/>
        <input type="hidden" name="slug"/>
        <button type="submit"  class="btn btn-lg btn-block btn-primary pfb0 loader"><i class="icon_set_1_icon-66"></i> <?php echo trans('012'); ?></button>
    </div>
</form>
<script>
    $(document).ready(function(){
        var fCustomHotelSearch = $("form[name=fCustomHotelSearch]");
        var adultPlusBtn = document.getElementById('adultPlusBtn');
        var adultMinusBtn = document.getElementById('adultMinusBtn');
        var childPlusBtn = document.getElementById('childPlusBtn');
        var childMinusBtn = document.getElementById('childMinusBtn');
        var adultInput = document.getElementById('adultInput');
        var childInput = document.getElementById('childInput');
        var travellersInput = document.getElementById('travellersInput'); // Input label field
        var select2_default_text = "<?=$_SESSION['hotel_select2']['text']?>" || "<?php echo trans('026');?>";

        var updateGuestsInput = function ($adult, $child) {
            var value = $adult+' Adult '+$child+' Child';
            travellersInput.value = value;
        }
        adultPlusBtn.onclick = function() {
            adultInput.value = parseInt(adultInput.value) + 1;
            updateGuestsInput(adultInput.value, childInput.value);
        };
        adultMinusBtn.onclick = function() {
            var value = parseInt(adultInput.value) - 1;
            adultInput.value = (value < 1) ? 0 : value;
            updateGuestsInput(adultInput.value, childInput.value);
        };
        childPlusBtn.onclick = function() {
            childInput.value = parseInt(childInput.value) + 1;
            updateGuestsInput(adultInput.value, childInput.value);
        };
        childMinusBtn.onclick = function() {
            var value = parseInt(childInput.value) - 1;
            childInput.value = (value < 1) ? 0 : value;
            updateGuestsInput(adultInput.value, childInput.value);
        };
        updateGuestsInput(parseInt(adultInput.value), parseInt(childInput.value));

        $(".locationlisthotels").select2({
            minimumInputLength: 3,
            width: '100%',
            maximumSelectionSize: 1,
            ajax:{
                url: "<?php echo base_url(); ?>home/suggestions_v2/hotels",
                dataType: 'json',
                data: function(term) {
                    return { q:term }
                },
                results:function(data) {
                    return { results: data }
                }
            }
        });
        // default value
        $("form[name=fCustomHotelSearch] .select2-choice .select2-chosen").text(select2_default_text);
        // Select2 on dropdown element select event handler
        $(".locationlisthotels").on("select2-selecting",function(e){
            $("input[name=module_type]").val(e.object.module);
            $("input[name=hotel_s2_text]").val(e.object.id);
            $("input[name=slug]").val(e.object.id);
        });

        function create_slug(data) {
            var p_1 = data['hotel_s2_text']; p_1 = (p_1) ? p_1 : "null";
            var p_2 = data['checkin'];       p_2 = (p_2) ? p_2.replace(/\/+/g, '-') : "null";
            var p_3 = data['checkout'];      p_3 = (p_3) ? p_3.replace(/\/+/g, '-') : "null";
            var p_4 = data['adults'];        p_4 = (p_4) ? p_4 : 0;
            var p_5 = data['child'];         p_5 = (p_5) ? p_5 : 0;
            var url = "";
            if(p_1 != "null") { url += "/"+p_1; }
            return url+"/"+p_2+"/"+p_3+"/"+p_4+"/"+p_5;
        }
        fCustomHotelSearch.on("submit", function(e) {
            e.preventDefault();
            let values = {};
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            let slug = $("input[name=slug]").val();
            if(slug != '' && slug != undefined) {
                values['hotel_s2_text'] = slug;
            }
            if($("input[name=module_type]").val() == 'hotel') {
                window.location.href = '<?=base_url("hotels/detail")?>'+create_slug(values);
            } else {
                window.location.href = $(this).attr('action')+create_slug(values);
            }
        });
    });
</script>