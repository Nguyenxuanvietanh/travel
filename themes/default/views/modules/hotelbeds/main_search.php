<form name="fHotelbedsSearch" autocomplete="off" action="<?=base_url('hotelb/search')?>" method="GET" role="search">
    <div class="col-md-4 col-xs-12 go-text-right go-right form-group">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-41"></i>
            <input type="text" id="location" name="destination" value="<?=$_SESSION['hb_s2_id']?>" class="hotelsearch locationlist<?=$module?>" placeholder="<?php echo trans('026'); ?>">
        </div>
    </div>
    <div class="bgfade col-md-2 form-group go-right col-xs-6 focusDateInput" id="dpd1">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('07'); ?>"  value="<?=$_SESSION['hb_checkin']?>" name="checkin" class="form form-control input-lg hcheckin" required >
        </div>
    </div>
    <div id="dpd2" class="bgfade col-md-2 form-group go-right col-xs-6 focusDateInput">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('09'); ?>"  value="<?=$_SESSION['hb_checkout']?>" name="checkout" class="form form-control input-lg hcheckout" required >
        </div>
    </div>
    <div class="bgfade col-md-2 form-group go-right col-xs-12">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-70"></i>
            <?php $adults = ($_SESSION['hb_adults'])?$_SESSION['hb_adults']:'2'; ?>
            <?php $childs = ($_SESSION['hb_children'])?$_SESSION['hb_children']:'0'; ?>
            <?php $passengersLabels = $adults.' Adult '.$childs.' Child'; ?>
            <input data-toggle="collapse" data-target="#hoptions" aria-expanded="false" aria-controls="hoptions" type="text" value="<?=$passengersLabels?>" id="htravellersInput" name="travellers" class="form form-control input-lg">
        </div>
        <div class="collapse wow fadeIn" id="hoptions">
            <div class="row">
                <div class="col-md-12 col-xs-6">
                    <div class="row hoptions form-horizontal">
                        <div class="col-md-5">
                            <div class="row text-center pt5">
                                <strong><?php echo trans('010');?></strong>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                    <button class="btn btn-secondary btn-sm" type="button" id="hadultMinusBtn"><i class="fa fa-minus"></i></button>
                                    </span>
                                    <input name="adults" id="hadultInput" type="text" class="form-control input-sm text-center" value="<?=$adults?>" placeholder="2">
                                    <span class="input-group-btn">
                                    <button class="btn btn-secondary btn-sm" type="button" id="hadultPlusBtn"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xs-6">
                    <div class="row hoptions form-horizontal">
                        <div class="col-md-5">
                            <div class="row text-center pt5">
                                <strong><?php echo trans('011');?></strong>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                    <button class="btn btn-secondary btn-sm" type="button" id="hchildMinusBtn"><i class="fa fa-minus"></i></button>
                                    </span>
                                    <input type="text" name="child" id="hchildInput" class="form-control input-sm text-center" value="<?=$childs?>" placeholder="<?=$childs?>">
                                    <span class="input-group-btn">
                                    <button class="btn btn-secondary btn-sm" type="button" id="hchildPlusBtn"><i class="fa fa-plus"></i></button>
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
        <button type="submit"  class="btn btn-lg btn-block btn-danger pfb0 loader"><i class="icon_set_1_icon-66"></i> <?php echo trans('012'); ?></button>
    </div>
</form>
<script>
    $(document).ready(function(){
        var nowTemp6 = new Date();
        var now6 = new Date(nowTemp6.getFullYear(),nowTemp6.getMonth(),nowTemp6.getDate(),0,0,0,0);
        var checkin6 = $(".hcheckin").datepicker({
            format:"dd/mm/yyyy",
            onRender:function(e){
                return e.valueOf()<now6.valueOf()?"disabled":"";
            }
        }).on("changeDate",function(e){
            var a = new Date(e.date);
            a.setDate(a.getDate() + 0);
            checkout6.setValue(a)
            checkin6.hide();
            $(".hcheckout")[0].focus()
        }).data("datepicker");
        var checkout6 = $(".hcheckout").datepicker({
            format:"dd/mm/yyyy",
            onRender:function(e){
                return e.valueOf()<checkin6.date.valueOf()?"disabled":"";
            }}).on("changeDate",function(ev){
            var cnDate = new Date(ev.date);
            checkout6.hide();
        }).data("datepicker");

        var hadultPlusBtn = document.getElementById('hadultPlusBtn');
        var hadultMinusBtn = document.getElementById('hadultMinusBtn');
        var hchildPlusBtn = document.getElementById('hchildPlusBtn');
        var hchildMinusBtn = document.getElementById('hchildMinusBtn');
        var hadultInput = document.getElementById('hadultInput');
        var hchildInput = document.getElementById('hchildInput');
        var htravellersInput = document.getElementById('htravellersInput'); // Input label field
        var select2_default_text = "<?=$_SESSION['hb_s2_text']?>" || "<?php echo trans('026');?>";

        var updateGuestsInput = function ($adult, $child) {
            var value = $adult+' Adult '+$child+' Child';
            htravellersInput.value = value;
        }
        hadultPlusBtn.onclick = function() {
            hadultInput.value = parseInt(hadultInput.value) + 1;
            updateGuestsInput(hadultInput.value, hchildInput.value);
        };
        hadultMinusBtn.onclick = function() {
            var value = parseInt(hadultInput.value) - 1;
            hadultInput.value = (value < 1) ? 0 : value;
            updateGuestsInput(hadultInput.value, hchildInput.value);
        };
        hchildPlusBtn.onclick = function() {
            hchildInput.value = parseInt(hchildInput.value) + 1;
            updateGuestsInput(hadultInput.value, hchildInput.value);
        };
        hchildMinusBtn.onclick = function() {
            var value = parseInt(hchildInput.value) - 1;
            hchildInput.value = (value < 1) ? 0 : value;
            updateGuestsInput(hadultInput.value, hchildInput.value);
        };

        $(".locationlist<?=$module?>").select2({
            minimumInputLength: 3,
            width: '100%',
            maximumSelectionSize: 1,
            initSelection: function(element,callback){
                callback({
                    id: "carlton-palace-hotel/dubai",
                    text: "Carlton Palace Hotel (Dubai)"
                });
            },
            ajax:{
                url: "<?php echo base_url('suggestions/hotelbedsHotels'); ?>",
                dataType: 'json',
                data: function(term, page) {
                    return { q:term }
                },
                results:function(data, page) {
                    var results = [];
                    data.forEach(function(d) {
                        var id = d.title.replace(/\s+/g, '-').toLowerCase();
                        var text = d.title;
                        if(d.country != undefined && d.country != "") {
                            id = d.title.replace(/\s+/g, '-').toLowerCase()+"/"+d.city.replace(/\s+/g, '-').toLowerCase();
                            text = d.title+" ("+d.city+")";
                        }
                        results.push({
                            id: id,
                            text: text,
                            data: d
                        });
                    });
                    return { results: results }
                }
            }
        });
        $("form[name=fHotelbedsSearch] .select2-choice .select2-chosen").text(select2_default_text);
        $(".locationlist<?=$module?>").on("select2-selecting",function(e){
            $("[name=hotel_s2_text]").val(e.object.text);
        });
        function create_slug(data) {
            var p_1 = data['destination'];   p_1 = (p_1) ? p_1 : "null";
            var p_2 = data['checkin'];       p_2 = (p_2) ? p_2 : "null";
            var p_3 = data['checkout'];      p_3 = (p_3) ? p_3 : "null";
            var p_4 = data['adults'];        p_4 = (p_4) ? p_4 : 0;
            var p_5 = data['child'];         p_5 = (p_5) ? p_5 : 0;
            var url = "";
            if(p_1 != "null") {
                url += "/"+p_1.replace(/-\/-|-{2,}/g, '-');
            }
            return url+"/"+p_2.replace(/\/+/g, '-')+"/"+p_3.replace(/\/+/g, '-')+"/"+p_4+"/"+p_5;
        }
        $("form[name=fHotelbedsSearch]").on("submit", function(e) {
            e.preventDefault();
            var values = {};
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            window.location.href = $(this).attr('action')+create_slug(values);
        });
    });
</script>