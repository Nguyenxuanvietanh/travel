 <form autocomplete="off" action="<?php echo base_url(); ?>visa" method="GET" role="search">
        <div class="go-text-right">
            <div class="col-md-4 form-group go-right col-xs-12">
              <div class="row">
                <!--<label class="go-right">
                    <?php echo trans( '0273'); ?>
                    <?php echo trans( '0105'); ?>
                </label>-->
                <div class="clearfix"></div> <i class="iconspane-lg icon_set_1_icon-41"></i>
                <select name="nationality_country" id="" class="chosen-select" required>
                    <option value="">
                        <?php echo trans( '0158'); ?>
                        <?php echo trans( '0105'); ?>
                    </option>
                    <?php foreach($data['allcountries'] as $c){ ?>
                    <option value="<?php echo $c->iso2;?>">
                        <?php echo $c->short_name;?></option>
                    <?php } ?> </select>
            </div>
        </div>
        </div>

        <div class="go-text-right">
            <div class="col-md-4 form-group go-right col-xs-12">
              <div class="row">
                <!--<label class="go-right">
                    <?php echo trans( '0274'); ?>
                    <?php echo trans( '0105'); ?>
                </label>-->
                <div class="clearfix"></div> <i class="iconspane-lg icon_set_1_icon-41"></i>
                <select name="destination_country" id="" class="chosen-select" required>
                    <option value="">
                        <?php echo trans( '0158'); ?>
                        <?php echo trans( '0105'); ?>
                    </option>
                    <?php foreach($data['allcountries'] as $c){ ?>
                    <option value="<?php echo $c->iso2;?>">
                        <?php echo $c->short_name;?></option>
                    <?php } ?> </select>
            </div>
        </div>
    </div>
        <div class="col-md-4 form-group go-right col-xs-12 search-button">
            <div class="clearfix"></div>
            <button type="submit" class="btn-primary btn btn-lg btn-block loader"><i class="icon_set_1_icon-66"></i>
                <?php echo trans( '012'); ?>
            </button>
    </div>
</form>
        <!------------------------------------------------------------------->
        <!-- ********************     VISA MODULE    ********************  -->
        <!------------------------------------------------------------------->