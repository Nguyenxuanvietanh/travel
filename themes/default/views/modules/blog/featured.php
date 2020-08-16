<?php if(isModuleActive( 'blog')){ if($showOnHomePage !="No" ){ ?>
<div class="container mt35 promotions hidden-xs">
    <?php foreach($posts as $p){ ?>
    <a href="<?php echo $p->slug;?>">
        <div class="col-md-4">
            <div class="probox">
                <img src="<?php echo $p->thumbnail;?>" class="img-responsive" alt="" />
                <div class="panel-body">
                    <h4><strong><?php echo character_limiter($p->title,25);?></strong></h4>
                    <h4 class="text-muted"><?php echo trans( '0286');?></h4>
                    <p><?php echo $p->shortDesc;?></p>
                </div>
            </div>
        </div>
    </a>
    <?php } ?>
</div>
<?php } ?>
<?php } ?>