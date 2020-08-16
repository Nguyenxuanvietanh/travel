<?php
    $query = new StdClass();
    $query->triptype = 'oneway';
    $query->cabinclass = 'economy';
    $query->origin = "";
    $query->destination = "";
    $query->departure = "";
    $query->arrival = "";
    $query->passenger = array('total' => 1, 'adult' => 1, 'children' => 0, 'infant' => 0);
?>
<form autocomplete="off" name="flightmanualSearch" action="<?php echo base_url('flights'); ?>" method="GET" role="search">
    <div class="col-md-2 form-group go-right col-xs-12">
        <div class="row">
            <div class="clearfix"></div>
            <input type="text" name="" value="" id="location_from">
            <input type="hidden" name="origin" value="" id="location_from_code">
        </div>
    </div>
    <div class="col-md-2 form-group go-right col-xs-12">
        <div class="row">
            <div class="clearfix"></div>
            <input type="text" name="" value="" id="location_to">
            <input type="hidden" name="destination" value="" id="location_to_code">
        </div>
    </div>
    <div class="bgfade col-md-2 form-group go-right col-xs-6 focusDateInput">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input autocomplete="false" type="date" placeholder="<?php echo trans('0472'); ?>" name="departure" value="<?php echo $query->departure; ?>" class="form form-control input-lg departureTime" required>
        </div>
    </div>
    <div class="bgfade col-md-2 form-group go-right col-xs-6 focusDateInput">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input autocomplete="false" type="date" placeholder="<?php echo trans('0473'); ?>" name="arrival" value="<?php echo $query->arrival; ?>" class="form form-control input-lg arrivalTime">
        </div>
    </div>
    <div class="col-md-1 form-group go-right col-xs-12">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-70"></i>
            <input type="text" name="totalManualPassenger" value="<?php echo $query->passenger['total']; ?>" placeholder="0" class="form form-control input-lg" data-toggle="modal" data-target="#manual_flightTravelers" required>
        </div>
    </div>
    <div class="bgfade col-md-3 col-xs-12 search-button">
        <div class="clearfix"></div>
        <button type="submit"  class="btn-primary btn btn-lg btn-block pfb0">
        <?php echo trans('012'); ?>
        </button>
    </div>
    <!--/ .row -->
    <div class="modal fade" id="manual_flightTravelers" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm wow flipInY" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo trans('0446');?></h4>
                </div>
                <div class="modal-body">
                    <section>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="form-input" class="col-sm-3 col-xs-3 control-label"><?php echo trans('010');?></label>
                                <div class="col-sm-5 col-xs-5">
                                    <select class="travellercount form-control" name="madult">
                                        <option value="1" <?php echo ($query->passenger['adult'] == 1) ? "selected" : ""; ?>>1</option>
                                        <option value="2" <?php echo ($query->passenger['adult'] == 2) ? "selected" : ""; ?>>2</option>
                                        <option value="3" <?php echo ($query->passenger['adult'] == 3) ? "selected" : ""; ?>>3</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <label class="help-block">(12+yrs)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-input" class="col-sm-3 col-xs-3 control-label"><?php echo trans('011');?></label>
                                <div class="col-sm-5 col-xs-5">
                                    <select class="travellercount form-control" name="mchildren" value="<?php echo $query->passenger['children']; ?>">
                                        <option value="0" <?php echo ($query->passenger['children'] == 0) ? "selected" : ""; ?>>0</option>
                                        <option value="1" <?php echo ($query->passenger['children'] == 1) ? "selected" : ""; ?>>1</option>
                                        <option value="2" <?php echo ($query->passenger['children'] == 2) ? "selected" : ""; ?>>2</option>
                                        <option value="3" <?php echo ($query->passenger['children'] == 3) ? "selected" : ""; ?>>3</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <label class="help-block">(4+yrs)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-input" class="col-sm-3 col-xs-3 control-label"><?php echo trans('0282');?></label>
                                <div class="col-sm-5 col-xs-5">
                                    <select class="travellercount form-control" name="minfant" value="<?php echo $query->passenger['infant']; ?>">
                                        <option value="0" <?php echo ($query->passenger['infant'] == 0) ? "selected" : ""; ?>>0</option>
                                        <option value="1" <?php echo ($query->passenger['infant'] == 1) ? "selected" : ""; ?>>1</option>
                                        <option value="2" <?php echo ($query->passenger['infant'] == 2) ? "selected" : ""; ?>>2</option>
                                        <option value="3" <?php echo ($query->passenger['infant'] == 3) ? "selected" : ""; ?>>3</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <label class="help-block">(2+yrs)</label>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block btn-lg bb" data-dismiss="modal" id="sumManualPassenger"><?php echo trans('0233');?></button>
                </div>
            </div>
        </div>
    </div>
    <!--/ .modal -->
    <div class="clearfix"></div>
    <div class="trip-check">
        <div class="col-md-2 col-xs-6 w120">
            <div class="pure-checkbox">
                <input id="oneway" name="triptype" type="radio" class="checkbox triptype" value="oneway" data-type="oneway" <?php if($query->triptype == "oneway") { ?> checked <?php } ?>>
                <label for="oneway" data-type="oneway">&nbsp;<?php echo trans('0384');?></label>
            </div>
        </div>
        <div class="col-md-2 col-xs-6 w120">
            <div class="pure-checkbox">
                <input id="round" name="triptype" type="radio" class="checkbox triptype" value="round" data-type="round" <?php if($query->triptype == "round") { ?> checked <?php } ?>>
                <label for="round" data-type="round">&nbsp;<?php echo trans('0385');?> </label>
            </div>
        </div>
        <div class="go-text-right form-horizontal">
            <div class="col-md-2 form-group go-right col-xs-12">
                <div class="clearfix"></div>
                <select class="form-control fs12 class" name="cabinclass">
                    <option value="economy" <?php echo ($query->cabinclass == "economy") ? "selected" : ""; ?>><?php echo trans('0552');?></option>
                    <option value="business" <?php echo ($query->cabinclass == "business") ? "selected" : ""; ?>><?php echo trans('0553');?></option>
                    <option value="first" <?php echo ($query->cabinclass == "first") ? "selected" : ""; ?>><?php echo trans('0554');?></option>
                </select>
            </div>
        </div>
    </div>
</form>
