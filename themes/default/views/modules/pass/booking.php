<br><br>
<style>
    body {
        background: #eee
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:hover,
    .nav-tabs>li.active>a:focus {
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
    .btn-circle {
        border-radius: 50%;
        font-size: 54px;
        padding: 10px 20px;
    }
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
                        <!-- Start Other Modules Booking left section -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">Personals Details</div>
                            <ul class="nav nav-tabs RTL nav-justified">
                                <li role="presentation" class="active" data-title="">
                                    <a class="text-center" href="#Guest" id="guesttab" data-toggle="tab"><span
                                            class="ink animate"
                                            style="height: 365px; width: 365px; top: -174.781px; left: 122px;"></span>
                                        <i class="icon-user-7"></i>
                                        <div class="visible-xs clearfix"></div>
                                        <span class="hidden-xs"></span>
                                    </a>
                                </li>
                                <li role="presentation" class="text-center" data-title="">
                                    <a class="text-center" href="#Sign-In" id="signintab" data-toggle="tab">
                                        <i class="icon-key-4"></i>
                                        <div class="visible-xs clearfix"></div>
                                        <span class="hidden-xs"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="clearfix"></div>
                                    <!-- PHPTRAVELS Booking tabs ending  -->
                                    <div class="tab-content" style="height: inherit;">
                                        <!-- PHPTRAVELS Guest Booking Starting  -->
                                        <div class="tab-pane fade in active" id="Guest">
                                            <form action="" id="guestform" method="post" class="booking_page">
                                                <input type="hidden" name="pass_id" value="<?php echo $pass_id; ?>">
                                                <div class="form-group">
                                                    <div class="col-md-2"> <label style="margin-top: 0px;">First Name <br /> Last Name</label>
                                                    </div>
                                                    <div class="col-md-5 col-xs-12">
                                                        <input class="form-control" type="text" placeholder="First Name"
                                                            name="firstname" value="">
                                                    </div>
                                                    <div class="col-md-5 col-xs-12">
                                                        <input class="form-control" type="text" placeholder="Last Name"
                                                            name="lastname" value="">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-2"> <label>Email</label> </div>
                                                    <div class="col-md-5 col-xs-12">
                                                        <input class="form-control" type="email" type="text" placeholder="Email"
                                                            name="email" value="">
                                                    </div>
                                                    <div class="col-md-5 col-xs-12">
                                                        <input class="form-control" type="email" placeholder="Confirm Email"
                                                            name="confirmemail" value="">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-2"> <label>Mobile</label> </div>
                                                    <div class="col-md-10 col-xs-10">
                                                        <input class="form-control" type="text" placeholder="Phone"
                                                            name="phone" value="">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-2"> <label>Address</label> </div>
                                                    <div class="col-md-10 col-xs-10">
                                                        <input class="form-control" type="text" placeholder="Address"
                                                            name="address" value="">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <label class="required go-right hidden-xs">Country</label>
                                                    </div>
                                                    <div class="col-md-10 col-xs-10">
                                                        <div style="border: 2px solid #ccc;">
                                                            <input class="form-control" type="text" placeholder="Country"
                                                            name="country" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="panel-body">
                                                    <div class="panel panel-default guest" style="margin-bottom:-15px">
                                                        <div class="panel-heading">
                                                            <label data-toggle="collapse" data-target="#special"
                                                                aria-expanded="false" aria-controls="special"
                                                                class="control control--checkbox ellipsis fs14">
                                                                <input type="checkbox">
                                                                <div class="control__indicator"></div>
                                                                Notes
                                                            </label>
                                                        </div>
                                                        <div id="special" aria-expanded="false" class="collapse">
                                                            <div class="panel-body">
                                                                <textarea class="form-control" placeholder="" rows="4"
                                                                    name="note"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- PHPTRAVELS Guest Booking Ending  -->
                                        <!-- PHPTRAVELS Sign in Starting  -->
                                        <div class="tab-pane fade" id="Sign-In">
                                            <form action="" method="POST" id="loginform" class="booking_page">
                                                <div class="form-group">
                                                    <div class="col-md-2"> <label>Email</label> </div>
                                                    <div class="col-md-10 col-xs-10">
                                                        <input class="form-control" type="text" placeholder="Email"
                                                            name="username" id="username" value="">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-2"> <label>Password</label> </div>
                                                    <div class="col-md-10 col-xs-10">
                                                        <input class="form-control" type="password" placeholder="Password"
                                                            name="password" id="password" value="">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="panel-body">
                                                    <div class="panel panel-default guest" style="margin-bottom:-15px">
                                                        <div class="panel-heading">
                                                            <label data-toggle="collapse" data-target="#special2"
                                                                aria-expanded="false" aria-controls="special"
                                                                class="control control--checkbox ellipsis fs14">
                                                                <input type="checkbox">
                                                                <div class="control__indicator"></div>
                                                                Notes
                                                            </label>
                                                        </div>
                                                        <div id="special2" aria-expanded="false" class="collapse">
                                                            <div class="panel-body">
                                                                <textarea class="form-control" placeholder="Notes" rows="4"
                                                                    name="nptes"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- PHPTRAVELS Sign in Ending  -->
                                </div>
                            </div>
                        </div>
                        <p class="RTL"></p>
                        <div class="form-group">
                            <span id="waiting"></span>
                            <button type="submit" class="btn btn-success btn-lg btn-block completebook" name="guest"
                                onclick="pass_booking()">Booking</button>
                        </div>
                        <!-- End Other Modules Booking left section -->
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
                            <img src="<?php if($appModule == "flights") echo PT_FLIGHTS_AIRLINES.$module->thumbnail;else echo $module->thumbnail; ?>"
                                class="img-responsive" alt="<?php echo $module->title;?>">
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <h6 class="m0"><strong> <?php echo $module->title;?></strong></h6>
                                <p class="m0"> <i class="fa fa-map-marker RTL"></i> <?php echo $module->location;?></p>
                                <p class="m0">
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
                                <li><b> <?php echo trans('07');?></b><span
                                        class="pull-right"><?php echo $module->checkin;?></span></li>
                                <li><b> <?php echo trans('09');?></b><span
                                        class="pull-right"><?php echo $module->checkout;?></span></li>
                                <li><b> <?php echo trans('060');?> </b> <span
                                        class="pull-right"><?php echo $stay;?></span></li>
                                <!-- <li><b> <?php echo trans('0412');?> </b> <span class="pull-right"><?php echo $room->currCode;?> <?php echo $room->currSymbol;?> <?php echo $room->perNight;?></span></li> -->
                                <?php if($room->extraBedsCount > 0){ ?>
                                <li>
                                    <b> <?php echo trans('0429');?> </b>
                                    <span class="pull-right">
                                        <?php echo $room->currCode;?>
                                        <?php echo $room->currSymbol;?><?php echo $room->extraBedCharges; ?>
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
                                <strong><?php echo $room->title;?></strong>
                                <?=$room->currCode.' '.$room->currSymbol.' '.$room->Info['totalPrice']?>
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
                                                <span
                                                    id="extrabedcharges"><?php echo $extrabedcharges?></span></span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="booking-deposit-font">
                                        <strong><?php echo trans('0126');?></strong>
                                    </td>
                                    <td class="pull-right">
                                        <strong><span class="booking-deposit-font go-left">
                                                <?php echo $currCode;?> <?php echo $currSymbol;?>
                                                <span
                                                    id="displaydeposit"><?php echo $depositAmount?></span></span></strong>
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
                                        <strong><?php echo $currCode;?> <?php echo $currSymbol;?><span
                                                id="displaytotal"><?php echo $price;?></span></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!--  *****************************************************  -->
                    <!--                      HOTELS MODULE                      -->
                    <!--  *****************************************************  -->

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
                            <?php if(!empty($phone)){ ?><p> <i class="fa fa-phone"></i> <?php echo $phone; ?> </p>
                            <?php } ?>
                            <hr>
                            <p><i class="fa fa-envelope-o"></i> <?php echo $contactemail; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Final Starting -->
        <div class="col-md-12 offset-0 final_section go-right" style="display:none;">
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
        <br />
    </div>
</div>
</div>
</div>

<style>
    #rotatingImg {
        display: none;
    }

    .booking-bg {
        padding: 10px 0 5px 0;
        width: 100%;
        background-image: url('<?php echo $theme_url; ?>assets/images/step-bg.png');
        background-color: #222;
        text-align: center;
    }

    .bookingFlow__message {
        color: white;
        font-size: 18px;
        margin-top: 5px;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    .select2-choice {
        font-size: 13px !important;
        padding: 0 0 0 10px !important;
    }
</style>
<script src="<?php echo base_url(); ?>assets/js/booking.js"></script>
<script>
    function pass_booking(){
        $('#guestform').submit()
    }
</script>
<div class="clearfix"></div>