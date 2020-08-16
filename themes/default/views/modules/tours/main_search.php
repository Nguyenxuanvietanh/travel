<form autocomplete="off" action="<?php echo base_url() . $module; ?>/search" method="GET" role="search">
    <div class="go-text-right">
        <div class="col-md-4 form-group go-right col-xs-12">
            <div class="row">
<!--                <input type="text" id="myInputEle"/>-->
<!--                <script>-->
<!--                $(document).ready(function() {-->
<!--                $('#myInputEle').select2({-->
<!--                width: '100%',-->
<!--                allowClear: true,-->
<!--                multiple: true,-->
<!--                maximumSelectionSize: 1,-->
<!--                placeholder: "Start typing",-->
<!--                data: [-->
<!--                { id: 1, text: "Nikhilesh"},-->
<!--                { id: 2, text: "Raju"    }-->
<!--                ]-->
<!--                });-->
<!--                });-->
<!--                </script>-->
                <div class="clearfix"></div>
                <i class="iconspane-lg icon_set_1_icon-41"></i>
                <input type="text" data-module="<?php echo $module; ?>"
                       class="hotelsearch locationlist<?php echo $module; ?>"
                       placeholder="<?php if ($module == 'hotels') {
                           echo trans('026');
                       } elseif ($module == 'tours') {
                           echo trans('0526');
                       } ?>" value="<?php echo $_GET['txtSearch']; ?>">
                <input type="hidden" id="txtsearch" name="txtSearch" value="<?php echo $_GET['txtSearch']; ?>">
            </div>
        </div>
    </div>
    <div id="<?php if ($module == 'hotels') {
        echo 'dpd1';
    } elseif ($module == 'ean') {
        echo 'dpean1';
    } elseif ($module == 'tours') {
        echo 'tchkin';
    } ?>" class="col-md-2 form-group go-right col-xs-12 focusDateInput">
        <div class="row">
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-53"></i>
            <input type="text" placeholder="<?php echo trans('07'); ?>"
                   name="<?php if ($module == 'hotels' || $module == 'ean') {
                       echo 'checkin';
                   } elseif ($module == 'tours') {
                       echo 'date';
                   } ?>" class="form input-lg <?php if ($module == 'hotels') {
                echo 'dpd1';
            } elseif ($module == 'ean') {
                echo 'dpean1';
            } elseif ($module == 'tours') {
                echo 'tchkin';
            } ?>" value="<?php if ($module == 'ean') {
                echo $themeData->eancheckin;
            } else {
                echo $themeData->checkin;
            } ?>" required>
        </div>
    </div>
    <div class="col-md-2 form-group go-right col-xs-12">
        <div class="row">
            <div class="clearfix"></div>
            <select name="adults" id="adults" class="input-lg form selectx">
                <option value="1">1 <?php echo trans('0446'); ?></option>
                <option value="2" selected>2 <?php echo trans('0446'); ?></option>
                <option value="3">3 <?php echo trans('0446'); ?></option>
                <option value="4">4 <?php echo trans('0446'); ?></option>
                <option value="5">5 <?php echo trans('0446'); ?></option>
            </select>
        </div>
    </div>
    <div class="col-md-2 form-group go-right col-xs-12">
        <div class="row">
            <!--<label class="hidden-xs go-right"><?php echo trans('0222'); ?> </label>-->
            <div class="clearfix"></div>
            <i class="iconspane-lg icon_set_1_icon-8"></i>
            <select class="input-lg form selectx" name="type" id="tourtype">
                <option value="" selected>
                    <?php echo trans('0158'); ?>
                </option>
                <?php foreach ($data['moduleTypes'] as $ttype) { ?>
                    <option value="<?php echo $ttype->id; ?>" <?php makeSelected($tourType, $ttype->id); ?> >
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
    <input type="hidden" name="searching" class="searching" value="<?php echo $_GET['searching']; ?>">
    <input type="hidden" class="modType" name="modType" value="<?php echo $_GET['modType']; ?>">
    <script>
        $(function () {
            $(".locationlist<?php echo $module; ?>").select2({
                width: '100%',
                allowClear: true,
                maximumSelectionSize: 1,
                placeholder: "Start typing",
                data: JSON.parse('<?=$data['defaultToursListForSearchField']?>')
            }).select2("val", <?=@$_GET['searching']?>);

            $(".locationlist<?php echo $module; ?>").on("select2-open",
                function (e) {
                    $(".select2-drop-mask");
                    $(".formSection").trigger("click")
                });
            $(".locationlist<?php echo $module; ?>").on("select2-selecting", function (e) {
                $(".modType").val(e.object.module);
                $(".searching").val(e.object.id);
                $("#txtsearch").val(e.object.text);
            })
        })
    </script>
</form>
<!------------------------------------------------------------------->
<!-- ********************    TOURS MODULE    ********************  -->
<!------------------------------------------------------------------->