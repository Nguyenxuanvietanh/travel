<form action="<?php echo base_url(); ?>car/" method="GET" target="_self" autocomplete="off">
    <div class="col-md-2 form-group go-right col-xs-12 xxl">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-21"></i>
            <input class='car-startlocation' name="startlocation" type='text' placeholder="<?php echo trans('0210'); ?>" />
        </div>
    </div>
    <div class="col-md-2 form-group go-right col-xs-12 xxl">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-21"></i>
            <input class='car-endlocation' name="endlocation" type='text' placeholder="<?php echo trans('0211'); ?>" />
        </div>
    </div>
    <div class="col-md-2 form-group go-right col-xs-6 chkin chkin">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" class="form-control form-control-icon input-lg checkinsearch RTL icon-calendar dpcd1" name="pickupdate" value="<?=$data['checkin']?>" placeholder="<?php echo trans('0210'); ?> <?php echo trans('08');?>" required />
        </div>
    </div>
    <div class="col-md-1 form-group go-right col-xs-6 chkin">
        <div class="row">
            <div class="clearfix"></div>
            <select class="form-control input-lg" name="timeDepart">
                <?php foreach($data['timing'] as $time){ ?>
                <option value="<?php echo $time; ?>" <?php makeSelected('10:00',$time); ?> ><?php echo $time; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-2 form-group go-right col-xs-6 chkin chkout">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" class="form-control form-control-icon input-lg checkinsearch RTL icon-calendar dpcd2" name="dropoffdate" value="<?=$data['checkout']?>" placeholder="<?php echo trans('0211'); ?> <?php echo trans('08');?>" required />
        </div>
    </div>
    <div class="col-md-1 form-group go-right col-xs-6 chkin">
        <div class="row">
            <div class="clearfix"></div>
            <select class="form-control input-lg" name="timeReturn">
                <?php foreach($data['timing'] as $time){ ?>
                <option value="<?php echo $time; ?>" <?php makeSelected('10:00',$time); ?> ><?php echo $time; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="bgfade col-md-2 form-group go-right col-xs-12 search-button">
        <input type="hidden" id="pickuplocation" name="pickupLocationId" value="">
        <input type="hidden" id="returnlocation" name="returnLocationId" value="">
        <input type="hidden" name="clientId" value="<?php echo $data['cartrawlerid'];?>">
        <input type="hidden" name="residencyId" value="US">
        <input type="submit" value="<?php echo trans('012');?>" style="color:#fff" class="btn btn-lg btn-primary green btn-block loader">
    </div>
</form>