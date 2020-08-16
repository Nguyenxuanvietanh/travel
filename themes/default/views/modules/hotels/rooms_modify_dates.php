
    <div class="panel panel-default">
                            <div class="panel-heading panel-default ttu"><span class="go-right"><?php echo trans('0197'); ?></span>
                            <?php if(!empty($rooms)){ ?>
                            <span class="pull-right go-left"><strong><i class="icon_set_1_icon-83"></i> <?php echo trans('0122');?></strong> <?php echo $modulelib->stay; ?> </span>
                            <?php } ?>
                            <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
        <form name="fModifySearch" class="row" action="" method="GET">
           <div class="col-md-3 col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
                        <input type="text" placeholder="<?php echo trans('07');?>" name="checkin" class="form-control dpd1rooms" value="<?=$checkin?>" required>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
                        <input type="text" placeholder="<?php echo trans('09');?>" name="checkout" class="form-control dpd2rooms" value="<?=$checkout?>" required>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
                        <select class="mySelectBoxClass form-control" name="adults" id="adults" value="<?php echo $modulelib->adults;?>">
                            <?php for($Selectadults = 1; $Selectadults < 11;$Selectadults++){ ?>
                            <option value="<?php echo $Selectadults;?>" <?php if($Selectadults == $modulelib->adults){ echo "selected"; } ?> > <?php echo $Selectadults;?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12 go-right">
                    <div class="form-group">
                        <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
                        <select class="mySelectBoxClass form-control" name="child" id="child" value="<?php echo $modulelib->children;?>">
                            <?php for($Selectchild = 0; $Selectchild < 6;$Selectchild++){ ?>
                            <option value="<?php echo $Selectchild;?>" <?php if($Selectchild == $modulelib->children){ echo "selected"; } ?> > <?php echo $Selectchild;?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12 go-right">
                <label class="hidden-xs">&nbsp;</label>
                <input type="hidden" name="hotelname" value="<?php echo $hotelname; ?>" />
                <input type="hidden" name="city" value="<?php echo $city; ?>" />
                <input class="btn btn-block btn-success-small textupper loader" type="submit" value="<?php echo trans('0106');?>">
            </div>
        </form>
            <script>
                $("form[name=fModifySearch]").submit(function (e) {
                    e.preventDefault();
                    let values = {};
                    $.each($(this).serializeArray(), function(i, field) {
                        values[field.name] = field.value;
                    });
                    redirectUrl = values.city+'/'+values.hotelname+'/'+values.checkin.replace(/\//g,'-')+'/'+values.checkout.replace(/\//g,'-')+'/'+values.adults+'/'+values.child;
                    window.location.href = '<?=base_url('hotels/detail/')?>'+redirectUrl;
                });
            </script>
     </div>
     </div>
