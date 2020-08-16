<style>
  .item { max-height: 55px !important; }
  .parallax-window { min-height: 220px; position: relative; }
</style>
<div style="margin-top:25px" class="container sections-wrapper">
  <div class="row">
    <div class="primary col-md-8 col-sm-12 col-xs-12" style="position: static">
      <div class="panel panel-default">
        <div class="panel-body">
           <div class="panel-body go-right RTL">
             <h3 style="margin-top:0px" class="wow fadeInUp animated title go-right ttu bold"><?php echo $title;?>
            <small class="go-left pull-right" style="margin-top:10px;font-size: 14px;"><?php echo $date;?></small>
             </h3>
             <div class="clearfix"></div>
             <hr>
             <img src="<?php echo $thumbnail;?>" class="img-responsive" />
             <div class="row">
             <!--//desc-->
             <div class="clearfix"></div>
             <br>
             <div class="col-md-12">
             <div class="sharethis-inline-share-buttons"></div>
             <hr>
              <?php echo $desc; ?>
            </div>
            </div>
            <!--//desc-->
          </div>
          <!--//item-->
        </div>
      </div>
    </div>
    <div class="secondary col-md-4 add_bottom_30 go-left">
    <?php include('sidebar.php'); ?>
  </div>
  <div class="clearfix"></div>
  <div class="container">
   <?php if(!empty($related_posts)){ ?>
      <h3 class="go-right ttu bold"><?php echo trans('0289');?></h3>
      <div class="clearfix"></div>
      <div class="row">
        <?php
          foreach($related_posts as $post):
           $bloglib->set_id($post->post_id);
           $bloglib->post_short_details(); ?>
        <div class="col-md-3">
          <a href="<?php echo base_url().'blog/'.$post->post_slug;?>" class="thumbnail">
          <img src="<?php echo pt_post_thumbnail($post->post_id); ?>" class="img responsive img-fade" style="height: 130px;" />
          <div class="panel-body">
          <strong><?php echo character_limiter(strip_tags($bloglib->title), 60);?></strong>
          </div>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
      <?php  } ?>
  </div>
  </div>
  <!--//row-->
</div>