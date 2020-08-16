<script type="text/javascript">
  $(function () {
    var slug = $("#slug").val();
    $(".submitfrm").click(function () {
      var submitType = $(this).prop('id');
      for (instance in CKEDITOR.instances) {

        CKEDITOR.instances[instance].updateElement();

      }
      $(".output").html("");
      $('html, body').animate({

        scrollTop: $('body').offset().top

      }, 'slow');
      if (submitType == "add") {
        url = "<?php echo base_url();?>admin/pass/add";

      } else {
        url = "<?php echo base_url();?>admin/pass/manage/" + slug;

      }

      $.post(url, $(".pass-form").serialize(), function (response) {
        if ($.trim(response) != "done") {
          $(".output").html(response);
        } else {
          window.location.href = "<?php echo base_url().$adminsegment." / pass / "?>";
        }

      });

    })

  })
</script>
<h3 class="margin-top-0"><?php echo $headingText;?></h3>
<div class="output"></div>
<form action="" method="POST" class="pass-form" enctype="multipart/form-data" onsubmit="return false;">
  <div class="panel panel-default">
    <ul class="nav nav-tabs nav-justified" role="tablist">
      <li class="active"><a href="#GENERAL" data-toggle="tab">General</a></li>
      <li class=""><a href="#TRANSLATE" data-toggle="tab">Translate</a></li>
    </ul>
    <div class="panel-body">
      <br>
      <div class="tab-content form-horizontal">
        <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="clearfix"></div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Pass Name</label>
            <div class="col-md-4">
              <input name="name" type="text" placeholder="Pass Name" class="form-control"
                value="<?php echo @$hdata[0]->name;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Ammount</label>
            <div class="col-md-4">
              <input name="ammount" type="text" placeholder="Ammount" class="form-control"
                value="<?php echo @$hdata[0]->name;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Status</label>
            <div class="col-md-2">
              <select data-placeholder="Select" class="form-control" name="status">
                <option value="Yes" <?php if(@$hdata[0]->status == "yes"){ echo 'selected'; } ?>>Enabled</option>
                <option value="No" <?php if(@$hdata[0]->status == "no"){ echo 'selected'; } ?>>Disabled</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <?php if($isadmin){ ?>
            <label class="col-md-2 control-label text-left">Pass Type</label>
            <div class="col-md-2">
              <select data-placeholder="Select" class="form-control" name="type">
                <option value="0" <?php if(@$hdata[0]->type == "0"){ echo 'selected'; } ?>>National</option>
                <option value="1" <?php if(@$hdata[0]->type == "1"){ echo 'selected'; } ?>>InterNational</option>
              </select>
            </div>
            <?php } ?>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Pass Category</label>
            <div class="col-md-2">
              <select data-placeholder="Select" class="form-control" name="category_id">
                <?php foreach($pass_categories as $category){ ?>
                <option value="<?php echo $category->id;?>" <?php if(@$hdata[0]->category_id == $category->id){ echo 'selected'; } ?>>
                  <?php echo $category->name;?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <?php if($isadmin){ ?>
            <label class="col-md-2 control-label text-left">Sales date</label>
            <div class="col-md-2">
              <input name="sales_date" type="text" placeholder="Sales date" class="form-control dpd1"
                value="<?php echo @$hdata[0]->sales_date; ?>" />
            </div>
            <?php } ?>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Notes</label>
            <div class="col-md-10">
              <textarea id="note" name="note" rows="5" cols="100" placeholder="Note"><?php echo @$hdata[0]->note; ?></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">HTML Notes</label>
            <div class="col-md-10">
              <?php $this->ckeditor->editor('html_note', @$hdata[0]->html_note, $ckconfig,'html_note'); ?>
            </div>
          </div>
        </div>

        <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">
          <?php foreach($languages as $lang => $val){ if($lang != "en"){ @$trans = getBackPassTranslation($lang,$passid); ?>
          <div class="panel panel-default">
            <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" />
              <?php echo $val['name']; ?></div>
            <div class="panel-body">
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Pass Name</label>
                <div class="col-md-4">
                  <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Pass Name"
                    class="form-control" value="<?php echo @$trans[0]->trans_title;?>" />
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Pass Description</label>
                <div class="col-md-10">
                  <?php $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->trans_desc, $ckconfig,"translated[$lang][desc]"); ?>
                  <!--    <textarea name='<?php echo "translated[$lang][desc]"; ?>' placeholder="Description..." class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->trans_desc;?></textarea>   -->
                </div>
              </div>
              <hr>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Meta Title</label>
                <div class="col-md-6">
                  <input name='<?php echo "translated[$lang][metatitle]"; ?>' type="text" placeholder="Title"
                    class="form-control" value="<?php echo @$trans[0]->metatitle;?>" />
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Meta Keywords</label>
                <div class="col-md-6">
                  <textarea name='<?php echo "translated[$lang][keywords]"; ?>' placeholder="Keywords"
                    class="form-control" id="" cols="30" rows="2"><?php echo @$trans[0]->metakeywords;?></textarea>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Meta Description</label>
                <div class="col-md-6">
                  <textarea name='<?php echo "translated[$lang][metadesc]"; ?>' placeholder="Description"
                    class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->metadesc;?></textarea>
                </div>
              </div>
              <hr>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Policy And Terms</label>
                <div class="col-md-8">
                  <textarea name='<?php echo "translated[$lang][policy]"; ?>' placeholder="Policy..."
                    class="form-control" id="" cols="15" rows="4"><?php echo @$trans[0]->trans_policy;?></textarea>
                </div>
              </div>
            </div>
          </div>
          <?php } } ?>
        </div>
      </div>

      <div class="panel-footer">
        <input type="hidden" id="slug" value="<?php echo @$hdata[0]->pass_slug;?>" />
        <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
        <input type="hidden" name="passid" value="<?php echo @$passid;?>" />
        <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Submit</button>
      </div>
    </div>
</form>