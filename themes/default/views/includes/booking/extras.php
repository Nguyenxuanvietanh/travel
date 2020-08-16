<?php if(!empty($module->extras)){ ?>
<div class="panel panel-default guest">
<div class="panel-heading">
<?php echo trans('0156');?>
</div>
<table style="margin-bottom:0px" class="table table-striped cart-list add_bottom_30 RTL">
<thead>
<tr>
<th><?php echo trans('0376');?></th>
<th><?php echo trans('077');?></th>
<th><?php echo trans('070');?></th>
<th class="text-center"><?php echo trans('0399');?></th>
</tr>
</thead>
<tbody>
<?php foreach($module->extras as $extra){ ?>
<tr>
<td>
<div class="thumb_cart">
<img style="height:40px;width:40px" src="<?php echo $extra->thumbnail;?>" alt="<?php echo $extra->extraTitle;?>">
</div>
</td>
<td>
<span class="item_cart"><?php echo $extra->extraTitle;?></span>
</td>
<td>
<?php echo $room->currCode;?> <?php echo $room->currSymbol;?><?php echo $extra->extraPrice;?>
</td>
<td>
<label class="switch-light switch-ios">
<input type="checkbox" id="<?php echo $extra->id;?>" name="extras[]" value="<?php echo $extra->id;?>" onclick="updateBookingData('<?php echo $extraChkUrl;?>')">
<span>
<span><?php echo trans('0363');?></span>
<span><?php echo trans('0364');?></span>
</span>
<a></a>
</label>
</td>
</tr>
<?php } ?>
</tbody>
</table>
<script>
$(function () {
"use strict";
$(".numbers-row").append('<div class="inc button_inc">+</div><div class="dec button_inc">-</div>');
$(".button_inc").on("click", function () {
var $button = $(this);
var oldValue = $button.parent().find("input").val();
if ($button.text() == "+") {
var newVal = parseFloat(oldValue) + 1;
} else {
// Don't allow decrementing below zero
if (oldValue > 1) {
var newVal = parseFloat(oldValue) - 1;
} else {
newVal = 1;
}
}
$button.parent().find("input").val(newVal);
});
});
</script>
</div>
<?php } ?>