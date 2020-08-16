<style>
    .btn-enable {
        background-color: #00bd00;
        color: white;
    }
    .btn-enable:hover {
        background-color: #00A300;
        color: white;
    }
    .btn-disable {
        color: #ffffff;
        background-color: #f70000;
        border-color: #cc0000;
    }
    .btn-disable:hover {
        color: #ffffff;
        background-color: #E60000;
        border-color: #cc0000;
    }
    td {
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
    }

</style>
<div class="panel panel-default">
    <div class="panel-heading">Primary Modules</div>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped table-bordered">
            <thead>
            <tr>
                <th class="col-md-1 text-center">No</th>
                <th class="col-md-7"><i class="fa fa-laptop"></i> Sub Modules</th>
                <th class="col-md-3"><i class="fa fa-wrench"></i> Action</th>
                <th class="col-md-1"><i class="fa fa-wrench"></i> Order</th>
            </tr>
            </thead>
            <tbody>
            <?php $index = 1; ?>
            <?php foreach($modules as $module): ?>
                <?php
                $label = 'Disabled';
                $statusClass = 'btn btn-xs btn-disable';
                if($module->active) {
                    $label = 'Enabled';
                    $statusClass = 'btn btn-xs btn-enable';
                }
                ?>
                <tr>
                    <td class="text-center"><?=$module->order?></td>
                    <td><?=$module->label?></td>
                    <td>
                        <button class="<?= $statusClass ?>" id="moduleStatus" data-modulename="<?php echo $module->name;?>">
                            <i class="fa fa-external-link"></i> <span class="moduleStatusText"><?= $label ?></span>
                        </button>
                        <?php if( ! empty($module->slug) ): ?>|
                        <a href="<?php echo base_url(); ?>admin/<?php echo $module->slug;?>/settings/">
                                <button class="btn btn-xs btn-primary"><i class="fa fa-gear"></i> Settings</button>
                            </a><?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-xs btn-default" id="moduleOrder" data-order="up" data-modulename="<?php echo $module->name;?>">
                            <span class="fa fa-arrow-up"></span>
                        </button> |
                        <button class="btn btn-xs btn-default" id="moduleOrder" data-order="down" data-modulename="<?php echo $module->name;?>">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </td>
                </tr>
                <?php $index += 1; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('[id=moduleStatus]').on("click", function() {
        var btnStatus = $(this);
        var statusText = btnStatus.find('span.moduleStatusText').text();
        statusText = (statusText == 'Enabled') ? 'Disable' : 'Enable';
        $.alert.open('confirm', 'Are you sure you want to '+statusText+' it', function(answer) {
            if (answer == 'yes') {
                var payload = { 'modulename': btnStatus.data('modulename') };
                $.post('<?=base_url("admin/modules/ajaxController/updateStatus")?>', payload, function(response) {
                    // console.log(btnStatus.attr('class'));
                    // if(response.status == 'enabled') {
                    //     btnStatus.removeClass("btn-disable").addClass("btn-enable");
                    //     btnStatus.find('span.moduleStatusText').text('Enabled');
                    // } else if(response.status == 'disabled') {
                    //     btnStatus.removeClass("btn-enable").addClass("btn-disable");
                    //     btnStatus.find('span.moduleStatusText').text('Disabled');
                    // }
                    window.location.reload();
                });
            }
        });
    });
    $('[id=moduleOrder]').on('click', function() {
        var orderButton = $(this);
        var payload = { 'modulename': orderButton.data('modulename'), 'order': orderButton.data('order') };
        $.post('<?=base_url("admin/modules/ajaxController/updateOrder")?>', payload, function(response) {
            window.location.reload();
        });
    });
</script>