<br><br>
<style>
    body { background:#eee}
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
        color: white !important;
        cursor: default;
        background: #76ce85;
    }
    .nav-tabs>li>a {
        background: rgba(0, 0, 0, 0.09);
        border-radius: 0px;
        color: #000 !important;
        padding: 10px;
        font-size: 14px;
    }

    .switch-ios.switch-light {
        margin-top: 5px !important;
    }

</style>

<style>
    .btn-circle {border-radius: 50%;font-size: 54px;padding: 10px 20px;}
</style>

<div class="container booking">
    <!-- End Fail Result of Expedia booking for submit -->
    <div class="container offset-0">
        <div class="loadinvoice">
            <div class="acc_section">
                <!-- RIGHT CONTENT -->
                <div class="col-md-8 offset-0 go-right" style="margin-bottom:50px;">
                    <div class="clearfix"></div>
                    <div class="">
                        <div class="result"></div>
                        <?php if(!empty($error)){ ?>
                            <h1 class="text-center strong"><?php echo trans('0432');?></h1>
                            <h3 class="text-center"><?php echo trans('0431');?></h3>
                        <?php }else{ ?>
                        <!-- Start Other Modules Booking left section -->
                        <?php if($appModule != "ean") { ?>
                            <?php include $themeurl.'views/includes/booking/profile.php'; ?>

                            <form id="bookingdetails" class="hidden-xs hidden-sm" action="" onsubmit="return false">
                                <?php if(!empty($module->extras)){ ?>
                                    <div class="clearfix"></div>

                                    <?php include $themeurl.'views/includes/booking/extras.php'; ?>
                                    <!--End step -->
                                <?php } ?>
                                <script type="text/javascript">
                                    $(function(){
                                        $('.popz').popover({ trigger: "hover" });
                                    });
                                </script>
                                <!-- Complete This booking button only starting -->
                                <div class="panel panel-default btn_section" style="display:none;">
                                    <div class="panel-body">
                                        <center>
                                    </div>
                                </div>
                                <!-- End Complete This booking button only -->
                                <input type="hidden" id="itemid" name="itemid" value="<?php echo $module->id;?>" />
                                <input type="hidden" name="checkout" value="<?php echo $module->checkout;?>" />
                                <input type="hidden" name="checkin" value="<?php echo $module->checkin;?>" />
                                <input type="hidden" name="adults" value="<?php echo $module_adults;?>" />
                                <input type="hidden" id="couponid" name="couponid" value="" placeholder="coupon id"/>
                                <input type="hidden" id="btype" name="btype" value="<?php echo $appModule;?>" />
                                <input type="hidden" name="subitemid" value="<?php echo implode(',',$subitemid);?>" />
                                <input type="hidden" name="roomscount" value="<?php echo implode(',',$roomscount);?>" />
                                <input type="hidden" name="taxAmount" value="<?php echo $taxAmount;?>" />
                                <input type="hidden" name="bedscount" value='<?php echo $bedscount;?>' placeholder="bedscount"/>
                            
                                <?php  include $themeurl.'views/includes/booking/coupon.php';  ?>
                                <div class="clearfix"></div>
                            </form>
                            <?php if(!empty($module->policy)){ ?>
                                <div class="alert alert-info">
                                    <strong class="RTL go-right"><?php echo trans('045');?></strong><br>
                                    <p class="RTL" style="font-size:12px"><?php echo $module->policy;?></p>
                                </div>
                            <?php } ?>
                            <p class="RTL"><?php echo trans('0416');?></p>
                            <div class="form-group">
                                <span id="waiting"></span>
                                <button type="submit" class="btn btn-success btn-lg btn-block completebook" name="<?php if(empty($usersession)){ echo "guest";}else{ echo "logged"; } ?>"  onclick="return completebook('<?php echo base_url();?>','<?php echo trans('0159')?>');"><?php echo trans('0306');?></button>
                            </div>
                            <!-- End Other Modules Booking left section -->
                        <?php }else{ if($nonRefundable){ ?>
                            <div class="alert alert-info"> This rate is non-refundable and cannot be changed or cancelled - if you do choose to change or cancel this booking you will not be refunded any of the payment. </div>
                        <?php } ?>
                            <!-- Start Expedia Booking Form -->
                            <div class="panel panel-primary">
                                <div class="panel-heading"><?php echo trans('088');?></div>
                                <div class="panel-body">
                                    <form role="form" action="" method="POST">
                                        <div class="step">
                                            <div class="col-md-6  go-right">
                                                <div class="form-group ">
                                                    <label  class="required go-right"><?php echo trans('0171');?></label>
                                                    <input class="form-control" id="card-holder-firstname" type="text" placeholder="<?php echo trans('0171');?>" name="firstName"  value="<?php echo @@$profile[0]->ai_first_name?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6  go-left">
                                                <div class="form-group ">
                                                    <label  class="required go-right"><?php echo trans('0172');?></label>
                                                    <input class="form-control" id="card-holder-lastname" type="text" placeholder="<?php echo trans('0172');?>" name="lastName"  value="<?php echo @$profile[0]->ai_last_name?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 go-right">
                                                <div class="form-group ">
                                                    <label  class="required  go-right"><?php echo trans('094');?></label>
                                                    <input class="form-control" id="card-holder-email" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="<?php echo @$profile[0]->accounts_email; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 go-right">
                                                <div class="form-group ">
                                                    <label  class="required go-right"><?php echo trans('0173');?></label>
                                                    <input class="form-control" id="card-holder-phone" type="text" placeholder="<?php echo trans('0414');?>" name="phone"  value="<?php echo @$profile[0]->ai_mobile; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6  go-right">
                                                <div class="form-group ">
                                                    <label  class="required go-right"><?php echo trans('0105');?></label>
                                                    <select data-placeholder="Select" id="country" name="country" class="form-control go-text-right RTL">
                                                        <option value=""> <?php echo trans('0158');?> <?php echo trans('0105');?> </option>
                                                        <?php foreach($allcountries as $c){ ?>
                                                            <option value="<?php echo $c->iso2;?>" <?php makeSelected($c->iso2, @$profile[0]->ai_country); ?> ><?php echo $c->short_name;?></option>
                                                        <?php }  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6  go-left">
                                                <div class="form-group ">
                                                    <label  class="required go-right"><?php echo trans('0101');?></label>
                                                    <input id="card-holder-state" class="form-control" type="text" placeholder="<?php echo trans('0101');?>" name="province"  value="<?php if(!empty($profile[0]->ai_state)){ echo @$profile[0]->ai_state; } ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 go-right">
                                                <div class="form-group ">
                                                    <label  class="required  go-right"><?php echo trans('0100');?></label>
                                                    <input id="card-holder-city" class="form-control" type="text" placeholder="<?php echo trans('0100');?>" name="city"  value="<?php echo @$profile[0]->ai_mobile; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 go-left">
                                                <div class="form-group">
                                                    <label  class="required go-right"><?php echo trans('0103');?></label>
                                                    <input id="card-holder-postalcode" class="form-control" type="text" placeholder="<?php echo trans('0104');?>" name="postalcode"  value="<?php if(!empty($profile[0]->ai_postal_code)){ echo @$profile[0]->ai_postal_code; } ?>">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12  go-right">
                                                <div class="form-group ">
                                                    <label  class="required go-right"><?php echo trans('098');?></label>
                                                    <textarea class="form-control" placeholder="<?php echo trans('098');?>" rows="4"  name="address"><?php echo @$profile[0]->ai_address_1; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <!--End step -->
                                        <script type="text/javascript">
                                            $(function(){
                                                $('.popz').popover({ trigger: "hover" });
                                            });
                                        </script>
                                        <!-- Complete This booking button only starting -->
                                        <div class="panel panel-default btn_section" style="display:none;">
                                            <div class="panel-body">
                                                <center>
                                            </div>
                                        </div>
                                        <!-- End Complete This booking button only -->
                                        <input type="hidden" name="pay" value="1" />
                                        <input type="hidden" name="adults" value="<?php echo $_GET['adults'];?>" />
                                        <input type="hidden" name="sessionid" value="<?php echo $_GET['sessionid']; ?>" />
                                        <input type="hidden" name="hotel" value="<?php echo $_GET['hotel']; ?>" />
                                        <input type="hidden" name="hotelname" value="<?php echo $HotelSummary['name'];?>" />
                                        <input type="hidden" name="hotelstars" value="<?php echo $hotelStars;?>" />
                                        <input type="hidden" name="location" value="<?php echo $HotelSummary['city'];?>" />
                                        <input type="hidden" name="thumbnail" value="<?php echo $HotelImages['HotelImage'][0]['url']; ?>" />
                                        <input type="hidden" name="roomname" value="<?php echo $roomname; ?>" />
                                        <input type="hidden" name="roomtotal" value="<?php echo $roomtotal; ?>" />
                                        <input type="hidden" name="checkin" value="<?php echo $_GET['checkin']; ?>" />
                                        <input type="hidden" name="checkout" value="<?php echo $_GET['checkout']; ?>" />
                                        <input type="hidden" name="roomtype" value="<?php echo $_GET['roomtype']; ?>" />
                                        <input type="hidden" name="ratecode" value="<?php echo $_GET['ratecode']; ?>" />
                                        <input type="hidden" name="currency" value="<?php echo $currency; ?>" />
                                        <input type="hidden" name="affiliateConfirmationId" value="<?php echo $eanlib->cid.$affiliateConfirmationId; ?>" />
                                        <input type="hidden" name="total" value="<?php echo $total; ?>" />
                                        <input type="hidden" name="tax" value="<?php echo $tax; ?>" />
                                        <input type="hidden" name="nights" value="<?php echo $nights; ?>" />
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="col-md-6  go-right">
                                            <div class="form-group ">
                                                <label  class="required go-right"><?php echo trans('0330');?></label>
                                                <select class="form-control" name="cardtype" id="cardtype">
                                                    <option value="">Select Card</option>
                                                    <?php foreach($payment as $pay){ ?>
                                                        <option value="<?php echo $pay['code'];?>"> <?php echo $pay['name'];?> </option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6  go-left">
                                            <div class="form-group ">
                                                <label  class="required go-right"><?php echo trans('0316');?></label>
                                                <input type="text" class="form-control" name="cardno" id="card-number" pattern=".{12,}" required title="12 characters minimum" placeholder="Credit Card Number" onkeypress="return isNumeric(event)" value="<?php echo set_value('cardno');?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-3 go-right">
                                            <div class="form-group ">
                                                <label  class="required  go-right"><?php echo trans('0329');?></label>
                                                <select class="form-control" name="expMonth" id="expiry-month">
                                                    <option value="01"><?php echo trans('0317');?> (01)</option>
                                                    <option value="02"><?php echo trans('0318');?> (02)</option>
                                                    <option value="03"><?php echo trans('0319');?> (03)</option>
                                                    <option value="04"><?php echo trans('0320');?> (04)</option>
                                                    <option value="05"><?php echo trans('0321');?> (05)</option>
                                                    <option value="06"><?php echo trans('0322');?> (06)</option>
                                                    <option value="07"><?php echo trans('0323');?> (07)</option>
                                                    <option value="08"><?php echo trans('0324');?> (08)</option>
                                                    <option value="09"><?php echo trans('0325');?> (09)</option>
                                                    <option value="10"><?php echo trans('0326');?> (10)</option>
                                                    <option value="11"><?php echo trans('0327');?> (11)</option>
                                                    <option value="12"><?php echo trans('0328');?> (12)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 go-left">
                                            <div class="form-group">
                                                <label  class="required go-right">&nbsp;</label>
                                                <select class="form-control" name="expYear" id="expiry-year">
                                                    <?php for($y = date("Y");$y <= date("Y") + 10;$y++){?>
                                                        <option value="<?php echo $y?>"><?php echo $y; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 go-left">
                                            <div class="form-group">
                                                <label  class="required go-right"><?php echo trans('0331');?></label>
                                                <input type="text" class="form-control" name="cvv" id="cvv" placeholder="<?php echo trans('0331');?>" value="<?php echo set_value('cvv');?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3 go-left">
                                            <label  class="required go-right">&nbsp;</label>
                                            <img src="<?php echo base_url(); ?>assets/img/cc.png" class="img-responsive" />
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p style="padding:10px;"><input type="checkbox" name="" id="policy" value="1">
                                                    <?php echo trans('0416');?>  <br><br>
                                                    <a href="http://developer.ean.com/terms/en/" target="blank">Terms and Conditions</a>
                                                </p>
                                                <div class="form-group">
                                                    <div class="alert alert-danger submitresult"></div>
                                                    <span id="waiting"></span>
                                                    <div class="col-md-12"><button type="submit" class="btn btn-success btn-lg btn-block paynowbtn" onclick="return expcheck();" name="<?php if(empty($usersession)){ echo "guest";}else{ echo "logged"; } ?>" ><?php echo trans('0306');?></button></div>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <div class="panel-body">
                                                        <p style="font-size:12px" class="go-right RTL"> <?php echo $checkInInstructions; ?></p>
                                                        <?php if(!empty($specialCheckInInstructions)){ ?>
                                                            <p style="font-size:12px" class="go-right RTL"> <?php echo $specialCheckInInstructions; ?></p>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Expedia Booking Form -->
                        <?php } ?>
                    </div>
                </div>


                <div class="col-md-4 summary">

                    <h4><?php echo trans('0558');?></h4>
                    <hr>

                    <!--  *****************************************************  -->
                    <!--                      HOTELS MODULE                      -->
                    <!--  *****************************************************  -->

                   

                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?php if($appModule == "flights") echo PT_FLIGHTS_AIRLINES.$module->thumbnail;else echo $module->thumbnail; ?>" class="img-responsive" alt="<?php echo $module->title;?>">
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <h6 class="m0"><strong> <?php echo $module->title;?></strong></h6>
                                    <p  class="m0"> <i class="fa fa-map-marker RTL"></i> <?php echo $module->location;?></p>
                                    <p  class="m0">
                                        <?php echo $module->stars;?>
                                    </p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="no-margin no-padding">
                                    <li><b> <?php echo trans('07');?></b><span class="pull-right"><?php echo $module->checkin;?></span></li>
                                    <li><b> <?php echo trans('09');?></b><span class="pull-right"><?php echo $module->checkout;?></span></li>
                                    <li><b> <?php echo trans('060');?> </b> <span class="pull-right"><?php echo $stay;?></span></li>
                                    <!-- <li><b> <?php echo trans('0412');?> </b> <span class="pull-right"><?php echo $room->currCode;?> <?php echo $room->currSymbol;?> <?php echo $room->perNight;?></span></li> -->
                                    <?php if($room->extraBedsCount > 0){ ?>
                                        <li>
                                            <b> <?php echo trans('0429');?> </b> 
                                            <span class="pull-right">
                                            <?php echo $room->currCode;?> <?php echo $room->currSymbol;?><?php echo $room->extraBedCharges; ?>
                                            </span>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <br>

                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo trans('016');?></div>
                            <div class="panel-body m0">
                                <?php foreach($rooms as $room): ?>
                                <p class="m0">
                                    <i class="fa fa-bed"></i> <?php echo $room->roomscount;?> 
                                    <strong><?php echo $room->title;?></strong> <?=$room->currCode.' '.$room->currSymbol.' '.$room->Info['totalPrice']?>
                                    <span class="pull-right">For <?php echo $room->maxAdults;?> Adults</span>
                                </p>
                                <?php endforeach; ?>
                                <!--<hr><p class="m0">Bed and Breakfast BB</p>
                                <?php if ($detail->room->refundable == 0) { ?>
                                    <p  class="m0 text-danger strong">Non-refundable</p>
                                <?php } else { ?>
                                    <p  class="m0 text-success strong">Refundable</p>
                                <?php } ?>-->
                            </div>
                        </div>

                        <div class="total_table">
                            <table class="table table_summary">
                                <tbody>
                                <tr class="beforeExtraspanel">
                                    <td>
                                        <?php echo trans('0153');?>
                                    </td>
                                    <td class="text-right">
                                        <?php echo $currCode;?> <?php echo $currSymbol;?><span id="displaytax">
                                        <?php echo $taxAmount;?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="booking-extrabed-font">
                                        <strong>Extrabeds</strong>
                                    </td>
                                    <td class="pull-right">
                                        <strong><span class="booking-extrabed-font go-left">
                                        <?php echo $currCode;?> <?php echo $currSymbol;?>
                                        <span id="extrabedcharges"><?php echo $extrabedcharges?></span></span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="booking-deposit-font">
                                        <strong><?php echo trans('0126');?></strong>
                                    </td>
                                    <td class="pull-right">
                                        <strong><span class="booking-deposit-font go-left">
                                        <?php echo $currCode;?> <?php echo $currSymbol;?>
                                        <span id="displaydeposit"><?php echo $depositAmount?></span></span></strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table style="margin-bottom:0px" class="table table_summary">
                                <tbody>
                                <tr style="border-top: 1px dotted white;">
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="tr10">
                                    <td class="booking-deposit-font">
                                        <strong><?php echo trans('0124');?></strong>
                                    </td>
                                    <td class="text-right">
                                        <strong><?php echo $currCode;?> <?php echo $currSymbol;?><span id="displaytotal"><?php echo $price;?></span></strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                  
                    <!--  *****************************************************  -->
                    <!--                      HOTELS MODULE                      -->
                    <!--  *****************************************************  -->

                            
                        <?php } ?>
                            <!--  *****************************************************  -->
                            <!--                    Expedia MODULE                       -->
                            <!--  *****************************************************  -->

                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong><?php echo trans('0382');?></strong></h3>
                                </div>
                                <div class="panel-body text-chambray">
                                    <p><?php echo trans('0381');?></p>
                                    <hr>
                                    <?php if(!empty($phone)){ ?><p> <i class="fa fa-phone"></i> <?php echo $phone; ?> </p><?php } ?>
                                    <hr>
                                    <p><i class="fa fa-envelope-o"></i> <?php echo $contactemail; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Final Starting -->
                <div class="col-md-12 offset-0 final_section go-right"  style="display:none;">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="step-pane" id="step4">
                                <div id="rotatingDiv" class="show"></div>
                                <h2 class="text-center"><?php echo trans('0179');?></h2>
                                <p class="text-center"><?php echo trans('0180');?></p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <br/>
            </div>
        </div>
    </div>
</div>

<style>
    #rotatingImg { display: none; }
    .booking-bg { padding: 10px 0 5px 0; width: 100%; background-image: url('<?php echo $theme_url; ?>assets/images/step-bg.png'); background-color: #222; text-align: center; }
    .bookingFlow__message { color: white; font-size: 18px; margin-top: 5px; margin-bottom: 15px; letter-spacing: 1px; }
    .select2-choice { font-size: 13px !important; padding: 0 0 0 10px!important; }
</style>
<script src="<?php echo base_url(); ?>assets/js/booking.js"></script>
<div class="clearfix"></div>