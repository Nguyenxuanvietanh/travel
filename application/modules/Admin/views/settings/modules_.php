<style>
    .btn-enable {
    background-color: #00bd00;
    color: white;
    }
    .btn-enable:hover {
    background-color: #00A300;
    color: white;
    }
    .btn-info {
    color: #ffffff;
    background-color: #f70000;
    border-color: #cc0000;
    }
    .btn-info:hover {
    color: #ffffff;
    background-color: #E60000;
    border-color: #cc0000;
    }
    .btn-warning {
    color: #ffffff;
    background-color: #007af3;
    border-color: #0963bb;
    }
    .btn-warning:hover {
    color: #ffffff;
    background-color: #0073E6;
    border-color: #0963bb;
    }
    table td {
    text-transform: uppercase;
    }
    td {
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: bold;
    }

</style>
<script>
    $(function(){
    slideout();
    var baseurl = $('base').attr('href');
    // disable selected Module
    $('.disable_selected').click(function(){
    var modules = new Array();
    $("input:checked").each(function() {
    modules.push($(this).val());
    });
    var count_checked = $("[name='module_ids[]']:checked").length;
    if(count_checked == 0) {
    $.alert.open('info', 'Please select a Module to Disable.');
    return false;
    }
    $.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
    if (answer == 'yes')
    $.post("<?php echo base_url();?>admin/ajaxcalls/disable_multiple_modules", { modulelist: modules }, function(theResponse){
    window.location = baseurl+"admin/settings/redirectSettings/modules";

    });});});
    // enable selected Module
    $('.enable_selected').click(function(){
    var modules = new Array();
    $("input:checked").each(function() {
    modules.push($(this).val());
    });
    var count_checked = $("[name='module_ids[]']:checked").length;
    if(count_checked == 0) {
    $.alert.open('info', 'Please select a Module to Enable.');
    return false;
    }
    $.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
    if (answer == 'yes')
    $.post("<?php echo base_url();?>admin/ajaxcalls/enable_multiple_modules", { modulelist: modules }, function(theResponse){
    window.location = baseurl+"admin/settings/redirectSettings/modules";
    });});});
    // Enable single Module
    $(".enable_single").click(function(){
    var id = $(this).attr('id');
    $.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
    if (answer == 'yes')
    $.post("<?php echo base_url();?>admin/ajaxcalls/enable_single_module", { moduleid: id }, function(theResponse){
    window.location = baseurl+"admin/settings/redirectSettings/modules";
    });});});
    // Disable single Module
    $(".disable_single").click(function(){
    var id = $(this).attr('id');
    $.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
    if (answer == 'yes')
    $.post("<?php echo base_url();?>admin/ajaxcalls/disable_single_module", { moduleid: id }, function(theResponse){
    window.location = baseurl+"admin/settings/redirectSettings/modules";
    });});});
    // Enable Main Module
    $(".enable_main").click(function(){
        var id = $(this).attr('id');
        if (id == 'travelpayoutshotels') {
            $.alert.open('alert', 'Please go to settings page', function(answer) {});
        } else {
            $.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
                if (answer == 'yes') {
                    $.post("<?php echo base_url();?>admin/ajaxcalls/enable_main_module", { modulename: id }, function(theResponse){
                        window.location = baseurl+"admin/settings/redirectSettings/modules";
                    });
                }
            });
        }
    });
    // Disable Main Module
    $(".disable_main").click(function(){
        var id = $(this).attr('id');
        if (id == 'travelpayoutshotels') {
            $.alert.open('alert', 'Please go to settings page', function(answer) {});
        } else {
            $.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
                if (answer == 'yes') {
                    $.post("<?php echo base_url();?>admin/ajaxcalls/disable_main_module", { modulename: id }, function(theResponse){
                        window.location = baseurl+"admin/settings/redirectSettings/modules";
                    });
                }
            });
        }
    });
});
</script>
<div class="panel panel-default">
    <div class="panel-heading"> Modules Management</div>
    <div class="panel-body">
        <?php if($this->session->flashdata('flashmsgs')){ echo NOTIFY; } ?>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <!-- <th class="col-md-1" style="text-align:center;"><i class="fa fa-picture-o"></i></th> -->
                    <th class="col-md-9"><i class="fa fa-laptop"></i> Primary Modules</th>
                    <th class="col-md-2"><i class="fa fa-wrench"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $moduleslist = $this->ptmodules->read_config();
                    foreach($moduleslist as $modlist){
                        if(strtolower($modlist['Name']) == 'travelpayoutshotels') {
                            $isenabled = module_status_check('travelpayoutshotels');
                        } else {
                            $isenabled = $this->ptmodules->is_main_module_enabled(strtolower($modlist['Name']));
                        }
                    ?>
                <tr>
                    <!-- <td align="center" class="zoom_img"><?php echo $modlist['Icon']; ?>  </td> -->
                    <td><?php echo $modlist['DisplayName'];?></td>
                    <td align="">
                        <?php if(!$isenabled){ ?>
                        <button class="btn btn-xs btn-enable enable_main" id="<?php echo strtolower($modlist['Name']);?>"><i class="fa fa-external-link"></i> enable</button>
                        <?php }
                        else{ ?><button class="btn btn-xs btn-info disable_main" id="<?php echo strtolower($modlist['Name']);?>" ><i class="fa fa-minus-square"></i> disable</button>
                        <?php } ?>

                        <?php if(strtolower($modlist['Name']) != 'flights'): ?>
                        <a href="<?php echo base_url(); ?>admin/<?php echo strtolower($modlist['Name']);?>/settings/"> <button class="btn btn-xs btn-warning"><i class="fa fa-table"></i> settings</button> </a>
                        <?php endif; ?>

                        <?php if (strtolower($modlist['Name']) == "ean" && $isenabled) { ?>
                        <a href="<?php echo base_url();?>admin/<?php echo strtolower($modlist['Name']);?>/bookings/"> <button class="btn btn-xs btn-success"><i class="fa fa-gavel"></i> Bookings</button> </a>
                        <?php }?>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>

        <br/>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th class="col-md-9"><i class="fa fa-laptop"></i> Sub Modules</th>
                    <th class="col-md-2"><i class="fa fa-wrench"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($modules as $module): ?>
                <tr>
                    <?php
                        $label = 'enable';
                        $statusClass = 'btn btn-xs btn-enable';
                        if($module->module_status) {
                            $label = 'disable';
                            $statusClass = 'btn btn-xs btn-info';
                        }
                    ?>
                    <td><?= str_replace('_',' ',$module->module_name) ?></td>
                    <td>
                        <button class="btn btn-xs <?= $statusClass ?>" id="moduleStatus" data-modulename="<?php echo $module->module_name;?>">
                            <i class="fa fa-external-link"></i> <span class="moduleStatusText"><?= $label ?></span>
                        </button> |
                        <a href="<?php echo base_url(); ?>admin/<?php echo $module->module_name;?>/settings/">
                            <button class="btn btn-xs btn-warning"><i class="fa fa-table"></i> settings</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('[id=moduleStatus]').on("click", function() {
        var btnStatus = $(this);
        var statusText = btnStatus.find('span.moduleStatusText').text();
            statusText = (statusText == 'enable') ? 'Disable' : 'Enable';
        $.alert.open('confirm', 'Are you sure you want to '+statusText+' it', function(answer) {
            if (answer == 'yes') {
                var payload = { 'modulename': btnStatus.data('modulename') };
                $.post('<?=base_url("modulesController/updateStatus")?>', payload, function(response) {
                    // if(response.status == 'enabled') {
                    //     btnStatus.removeClass("btn btn-xs btn-info").addClass("btn btn-xs btn-enable");
                    //     btnStatus.find('span.moduleStatusText').text('enable');
                    // } else {
                    //     btnStatus.removeClass("btn btn-xs btn-enable").addClass("btn btn-xs btn-info");
                    //     btnStatus.find('span.moduleStatusText').text('disable');
                    // }
                    window.location.reload();
                });
            }
        });
    });
</script>