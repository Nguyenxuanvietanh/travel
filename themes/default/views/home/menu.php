<?php
foreach($modulesList as $module): 
if(isModuleActive($module->name) && ! empty(count((array) $module->frontend)) && ! in_array($module->name, ['Blog','Offers'])):
?>
    <li role="presentation" class="<?=(($active_menu == strtolower($module->frontend->slug)))?'active':''?> text-center" data-title="<?=strtolower($module->frontend->slug)?>">
        <?php
            if(!$is_home):
                $slug = strtolower($module->frontend->slug);
                $href = base_url('m-'.$slug);
                $target = "_self";
                if ($slug == "viator") {
                    $href = "https://www.partner.viator.com/en/{$module->settings->affid}";
                    $target = "_blank";
                }
            ?>
            <a class="text-center" href="<?=$href?>" target="<?=$target?>">
                <i class="<?=$module->menus->icon?>"></i>
                <div class="visible-xs visible-md clearfix"></div>
                <span class="hidden-xs"><?php echo trans($module->frontend->label);?></span>
            </a>
        <?php else: ?>
            <?php 
                $slug = strtolower($module->frontend->slug);
                $href = '#'.$slug;
                if ($slug == "flightst") {
                    $href = base_url($slug);
                }
                if ($slug == "viator") {
                    $href = "https://www.partner.viator.com/en/{$module->settings->affid}";
                }
            ?>
            <?php if(in_array($slug, ["flightst","viator"])): ?>
                <a class="text-center" href="<?=$href?>" title="<?=$module->frontend->label?>" target="_blank">
                    <i class="<?=$module->menus->icon?>"></i>
                    <span class="hidden-xs"><?php echo trans($module->frontend->label);?></span>
                </a>
            <?php else: ?>
                <a class="text-center" href="<?=$href?>" data-toggle="tab" aria-controls="home" aria-expanded="true" title="<?=$module->frontend->label?>">
                    <i class="<?=$module->menus->icon?>"></i>
                    <div class="visible-xs visible-md clearfix"></div>
                    <span class="hidden-xs"><?php echo trans($module->frontend->label);?></span>
                </a>
            <?php endif; ?>
        <?php endif; ?>
    </li>
<?php
    endif; 
endforeach; 
?>
