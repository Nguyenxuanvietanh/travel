<style>
    .input-sm {
        padding: 5px 5px;
    }
</style>
<form name="fCustomPassSearch" autocomplete="off" action="<?=base_url($module.'/search')?>" method="GET" role="search">
    <div class="bgfade col-md-4 form-group go-right col-xs-6" id="name">
        <div class="row">
            <div class="clearfix"></div>
            <input type="text" placeholder="Search pass by name" name="name" class="form input-lg" >
        </div>
    </div>
    <div class="bgfade col-md-2 form-group go-right col-xs-6" id="ammount">
        <div class="row">
            <div class="clearfix"></div>
            <input type="number" placeholder="Amount" name="ammount" value="0" class="form input-lg" >
        </div>
    </div>
    <div class="col-md-2 form-group go-right col-xs-12">
        <div class="row">
            <div class="clearfix"></div>
            <select name="type" id="type" class="input-lg form selectx">
                <option value="0">National</option>
                <option value="1">International</option>
            </select>
        </div>
    </div>
    <div class="col-md-2 form-group go-right col-xs-12">
        <div class="row">
            <!--<label class="hidden-xs go-right"><?php echo trans('0222'); ?> </label>-->
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-8"></i>
            <select class="input-lg form selectx" name="category_id" id="category_id">
                <option value="" selected>
                    <?php echo trans('0158'); ?>
                </option>
                <?php foreach ($data['moduleTypes'] as $ttype) { ?>
                    <option value="<?php echo $ttype->id; ?>" <?php makeSelected($pass_category, $ttype->id); ?> >
                        <?php echo $ttype->name; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-2 form-group go-right col-xs-12 search-button">
        <div class="clearfix"></div>
        <button type="submit" class="btn-primary btn btn-lg btn-block pfb0 loader"><i class="icon_set_1_icon-66"></i>
            <?php echo trans('012'); ?> </button>
    </div>
</form>
<script>
    $(document).ready(function(){
        let fCustomPassSearch = $("form[name=fCustomPassSearch]");
        fCustomPassSearch.on("submit", function(e) {
            e.preventDefault();
            let values = {};
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            console.log($(this).attr('action') + create_slug(values));
            window.location.href = $(this).attr('action') + create_slug(values);
        });
        function create_slug(data) {
            let p_1 = data['name'];p_1 = (p_1) ? p_1 : "null";
            // let p_2 = data['pass_sales_date']; (p_2) ? p_2.replace(/\/+/g, '-') : "null";
            let p_3 = data['ammount'];p_3 = (p_3) ? p_3 : 0;
            let p_4 = data['type'];p_4 = (p_4) ? p_4 : 0;
            let p_5 = data['category_id'];p_5 = (p_5) ? p_5 : "null";
            let url = "";
            if(p_1 !== "null") { url += "/"+p_1; }
            return url+"/"+p_1+"/"+p_3+"/"+p_4+"/"+p_5;
        }
    });
</script>