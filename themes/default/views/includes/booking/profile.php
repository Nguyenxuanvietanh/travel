<div class="panel panel-primary">
    <div class="panel-heading"><?php echo trans('088');?></div>
    <?php if(empty($usersession)){ ?>
    <!--<div class="panel-body">
        <div class="col-md-4 form-groupt"> <label for="email">Payment Method*</label></div>
        <div class="col-md-8 form-group">
                <div class="col-md-6">
                        <label for="guesttab" class="control control--radio">
                                <i class="icon-user-7"></i>
                                <?php echo trans('0167');?>
                                <input checked type="radio" name="" href="#Guest" id="guesttab" data-toggle="tab" value="Credit Card" />
                                <div class="control__indicator"></div>
                        </label>
                </div>
                <?php if($app_settings[0]->allow_registration == "1"){ ?>
                <div class="col-md-6">
                        <label for="signintab" class="control control--radio">
                                <i class="icon-key-4"></i>
                                <?php echo trans('0168');?>
                                <input type="radio" name="" id="signintab" value="Paypal" />
                                <div class="control__indicator"></div>
                        </label>
                </div>
                <?php } ?>
        </div>
        </div>-->
    <ul class="nav nav-tabs RTL nav-justified">
        <li role="presentation" class="active" data-title="">
            <a class="text-center" href="#Guest" id="guesttab" data-toggle="tab">
                <i class="icon-user-7"></i>
                <div class="visible-xs clearfix"></div>
                <span class="hidden-xs"><?php echo trans('0167');?></span>
            </a>
        </li>
        <!--  <li role="presentation" class="text-center" data-title="flight">
            <a href="#flight" data-toggle="tab" aria-controls="home" aria-expanded="true">
            <i class="icon_set_1_icon-16"></i>
            <div class="visible-xs clearfix"></div>
            <span class="hidden-xs">Register and Book</span>
            </a>
            </li>-->
        <?php if($app_settings[0]->allow_registration == "1"){ ?>
        <li role="presentation" class="text-center" data-title="">
            <a class="text-center" href="#Sign-In" id="signintab" data-toggle="tab" >
                <i class="icon-key-4"></i>
                <div class="visible-xs clearfix"></div>
                <span class="hidden-xs"><?php echo trans('0168');?></span>
            </a>
        </li>
        <?php } ?>
    </ul>
    <div class="panel-body">
        <div class="row">
            <div class="clearfix"></div>
            <!-- PHPTRAVELS Booking tabs ending  -->
            <div class="tab-content" style="height: inherit;">
                <!-- PHPTRAVELS Guest Booking Starting  -->
                <div class="tab-pane fade in active" id="Guest">
                    <form id="guestform" class="booking_page">
                        <div class="form-group">
                            <div class="col-md-2"> <label style="margin-top: 0px;"><?php echo trans('0171');?> <?php echo trans('0172');?></label> </div>
                            <div class="col-md-5 col-xs-12">
                                <input class="form-control" type="text" placeholder="<?php echo trans('0171');?>" name="firstname"  value="">
                            </div>
                            <div class="col-md-5 col-xs-12">
                                <input class="form-control" type="text" placeholder="<?php echo trans('0172');?>" name="lastname"  value="">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"> <label><?php echo trans('094');?></label> </div>
                            <div class="col-md-5 col-xs-12">
                                <input class="form-control" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="">
                            </div>
                            <div class="col-md-5 col-xs-12">
                                <input class="form-control" type="email" placeholder="<?php echo trans('0175');?> <?php echo trans('094');?>" name="confirmemail"  value="">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"> <label><?php echo trans('0130');?></label> </div>
                            <div class="col-md-10 col-xs-10">
                                <input class="form-control" type="text" placeholder="<?php echo trans('0414');?>" name="phone"  value="">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"> <label><?php echo trans('098');?></label> </div>
                            <div class="col-md-10 col-xs-10">
                                <input class="form-control" type="text" placeholder="<?php echo trans('098');?>" name="address"  value="">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label  class="required go-right hidden-xs"><?php echo trans('0105');?></label>
                            </div>
                            <div class="col-md-10 col-xs-10">
                               <div style="border: 2px solid #ccc;">
                                <select  class="chosen-select" name="country">
                                    <option value=""><?php echo trans('0484');?></option>
                                    <?php
                                        foreach($allcountries as $country){
                                        ?>
                                    <option value="<?php echo $country->iso2;?>" <?php if($profile[0]->ai_country == $country->iso2){echo "selected";}?> ><?php echo $country->short_name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-body">
                            <div class="panel panel-default guest" style="margin-bottom:-15px">
                                <div class="panel-heading">
                                    <label data-toggle="collapse" data-target="#special" aria-expanded="false" aria-controls="special" class="control control--checkbox ellipsis fs14">
                                        <?php echo trans('0178');?>
                                        <input type="checkbox" />
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                                <div id="special" aria-expanded="false" class="collapse">
                                    <div class="panel-body">
                                        <textarea class="form-control" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
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
                            <div class="col-md-2"> <label><?php echo trans('094');?></label> </div>
                            <div class="col-md-10 col-xs-10">
                                <input class="form-control" type="text" placeholder="Email" name="username" id="username"  value="">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"> <label><?php echo trans('095');?></label> </div>
                            <div class="col-md-10 col-xs-10">
                                <input class="form-control" type="password" placeholder="<?php echo trans('095');?>" name="password" id="password"  value="">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-body">
                            <div class="panel panel-default guest" style="margin-bottom:-15px">
                                <div class="panel-heading">
                                    <label data-toggle="collapse" data-target="#special2" aria-expanded="false" aria-controls="special" class="control control--checkbox ellipsis fs14">
                                        <?php echo trans('0178');?>
                                        <input type="checkbox" />
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                                <div id="special2" aria-expanded="false" class="collapse">
                                    <div class="panel-body">
                                        <textarea class="form-control" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- PHPTRAVELS Sign in Ending  -->
            <?php }else{ ?>
            <!-- PHPTRAVELS LoggeIn Booking Starting  -->
            <div id="loggeduserdiv">
                <form id="loggedform">
                    <div class="panel-body">
                        <div class="col-md-6  go-right">
                            <div class="form-group ">
                                <label  class="required go-right"><?php echo trans('0171');?></label>
                                <input class="form-control" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_first_name?>" disabled="disabled" style="background-color: #DEDEDE !important"/>
                            </div>
                        </div>
                        <div class="col-md-6  go-left">
                            <div class="form-group ">
                                <label  class="required go-right"><?php echo trans('0172');?></label>
                                <input class="form-control" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_last_name?>" disabled="disabled" style="background-color: #DEDEDE !important">
                            </div>
                        </div>
                        <div class="col-md-6 go-right">
                            <div class="form-group ">
                                <label  class="required  go-right"><?php echo trans('094');?></label>
                                <input class="form-control" type="text" placeholder="" name=""  value="<?php echo $profile[0]->accounts_email?>" disabled="disabled" style="background-color: #DEDEDE !important">
                            </div>
                        </div>
                        <div class="col-md-12  go-right">
                            <div class="form-group ">
                                <label  class="required go-right"><?php echo trans('0178');?></label>
                                <textarea class="form-control" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
            <!-- PHPTRAVELS LoggedIn User Booking Ending  -->
            <?php } ?>
        </div>
    </div>
    <?php  if(!empty($customerloggedin)){ ?>
    <?php }else{ if($allowreg == "1"){ ?>
    </div>
    <?php } } ?>