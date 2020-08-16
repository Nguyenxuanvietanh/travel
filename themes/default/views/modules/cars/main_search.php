<form autocomplete="off" action="<?php echo base_url() . $module; ?>/search" method="GET" role="search">
        <div class="col-md-2 form-group go-right col-xs-12 xxl">
         <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-21"></i>
            <select name="pickupLocation" class="carsearch chosen-select RTL" id="carlocations" required>
                <option value="">
                <?php echo trans( '0210'); ?>
                <?php echo trans( '032'); ?>
                </option>
                <?php foreach ($data['carspickuplocationsList'] as $locations) : ?>
                <option value="<?php echo $locations->id; ?>" <?php makeSelected($data['selectedpickupLocation'], $locations->id); ?> >
                    <?php echo $locations->name; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
      </div>

        <div class="col-md-2 form-group go-right col-xs-12 xxl">
    <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-21"></i>
            <select name="dropoffLocation" class="carsearch chosen-select RTL" id="carlocations2" required>
                <option value="">
                    <?php echo trans( '0211'); ?>
                    <?php echo trans( '032'); ?>
                </option>
                <?php foreach ($data['carsdropofflocationsList'] as $locations) : ?>
                <option value="<?php echo $locations->id; ?>" <?php makeSelected($data['selecteddropoffLocation'], $locations->id); ?> >
                    <?php echo $locations->name; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        </div>

        <div class="col-md-2 form-group go-right col-xs-6 chkin chkin">
    <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" class="form input-lg RTL" id="departcar" name="pickupDate" placeholder="<?php echo trans( '0210'); ?> <?php echo trans( '08'); ?>" value="<?php echo $themeData->checkin; ?>" required>
        </div>
        </div>
        <div class="col-md-1 form-group go-right col-xs-6 chkin">
          <div class="row">
            <div class="clearfix"></div>
            <select class="text-center input-lg form-control car_tab form" name="pickupTime">
                <option value="<?php echo trans( '0259'); ?>"><?php echo trans( '0259'); ?></option>
                <?php foreach ($data['carModTiming'] as $time) { ?>
                <option value="<?php echo $time; ?>" <?php makeSelected($data['pickupTime'], $time); ?> >
                    <?php echo $time; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        </div>
        <div class="col-md-2 form-group go-right col-xs-6 chkin chkout">
            <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" class="form input-lg RTL" id="returncar" name="dropoffDate" placeholder="<?php echo trans( '0211'); ?> <?php echo trans( '08'); ?>" value="<?php echo $themeData->checkout; ?>" required>
        </div>
        </div>
        <div class="col-md-1 form-group go-right col-xs-6 chkin">
        <div class="row">
            <div class="clearfix"></div>
            <select class="text-center input-lg form-control car_tab form" name="dropoffTime">
                <option><?php echo trans( '0259'); ?></option>
                <?php foreach ($data['carModTiming'] as $time) { ?>
                <option value="<?php echo $time; ?>" <?php makeSelected($data['dropoffTime'], $time); ?> >
                    <?php echo $time; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        </div>
    <div class="bgfade col-md-2 form-group go-right col-xs-12 search-button">
            <div class="clearfix"></div>
            <button type="submit" class="btn-primary btn btn-lg btn-block pfb0 loader"><i class="icon_set_1_icon-66"></i>
            <?php echo trans( '012'); ?> </button>
     </div>
</form>