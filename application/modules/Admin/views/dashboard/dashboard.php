<style>
.delete_button {right: 0px; top: 44px;}
@media screen{body div,p,b,ul,li{margin:0;padding:0;border:0;outline:0;font-weight:normal;font-size:100%;letter-spacing:0;vertical-align:baseline;background:transparent}
ul{list-style:none}
b{font-weight:bold}
.serverHeader a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent;color:inherit;text-decoration:none;line-height:1;margin:0}
.serverHeader a:hover,a:active{outline:0}
.serverHeader a{outline:0}
.bar{background:#3c4249;border-radius:10px;display:inline-block;height:5px;width:100%;overflow:hidden}
.bar__inner{background:#0e69d5;display:inline-block;border-radius:10px;height:5px;width:50%}
.serverHeader{overflow: hidden;background:#3c4249;padding:15px;display:-webkit-box;display:-ms-flexbox;display:flex;color:#fff;position:relative}
.serverHeader__stripe{right:-40px;margin-top:0px;background:#636363;font-size:10px;font-weight:600;text-transform:uppercase;text-align:center;width:130px;padding:4px 0;-webkit-transform:rotate(45deg);transform:rotate(45deg);position:absolute}
.serverHeader__info{-webkit-box-flex:1;-ms-flex:1 0 auto;flex:1 0 auto;padding:8px}
.serverHeader__stats{background-color:#2b2e32;width:180px;-webkit-box-flex:0;-ms-flex:0 0 auto;flex:0 0 auto;padding:15px;border-radius:4px}
.serverHeader__stats a:hover{text-decoration:underline}
.serverHeader__usage{background:green;width:320px;padding:15px;margin-left:10px;background-color:#2b2e32;-webkit-box-flex:0;-ms-flex:0 0 auto;flex:0 0 auto;border-radius:4px}
.serverHeader__title{font-size:18px;font-weight:700;margin-bottom:10px}
.serverHeader__list{line-height:1.5;font-size:12px}
.serverHeader__list--ok{color:#76c83b}
.serverHeader__statsList{line-height:1.8;font-size:12px}
.serverHeader__statsList li{padding-left:2px;font-weight:300}
.serverHeader__stat-held{background:url(<?php echo base_url(); ?>assets/img/dash/1.svg) no-repeat 0 4px/13px;padding-left:22px}
.serverHeader__stat-queue{background:url(<?php echo base_url(); ?>assets/img/dash/2.svg) no-repeat 0 4px/13px}
.serverHeader__stat-size{background:url(<?php echo base_url(); ?>assets/img/dash/3.svg) no-repeat 0 4px/13px}
.serverHeader__stat-bounces{background:url(<?php echo base_url(); ?>assets/img/dash/4.svg) no-repeat 0 4px/13px}
.serverHeader__usageTitle{color:#566576;font-size:12px;font-weight:600;margin-bottom:5px}
.serverHeader__usageLine{display:-webkit-box;display:-ms-flexbox;display:flex;font-size:12px;-webkit-box-align:center;-ms-flex-align:center;align-items:center}
.serverHeader__usageLine+.serverHeader__usageLine{margin-top:6px}
.serverHeader__usageLineLabel{-webkit-box-flex:1;-ms-flex:1 0 auto;flex:1 0 auto}
.serverHeader__usageLineBar{width:100px;line-height:0}
.serverHeader__usageLineValue{width:60px;text-align:right;font-weight:600}
.serverHeader__usageLineValueLarge{width:300px;text-align:right;color:#909db0}
.serverHeader__usageLineValueLarge b{color:#fff}
.serverHeader button .h5{ font-size: 10px;margin: 0px;}
.serverHeader button { padding: 15px 0px}
.serverHeader .pad{ padding-left: 5px; padding-right: 5px; }
}
.delete_button {right: 0px;top: 9px !important;}
</style>

<?php $UriSegment = $this->uri->segment(1); ?>

<div class="serverHeader">
    <?php if($app_settings[0]->site_offline): ?>
    <div class="serverHeader__stripe serverHeader__stripe--live" style="background-color: #FF3333;">Offline</div>
    <?php else: ?>
    <div class="serverHeader__stripe serverHeader__stripe--live" style="background-color: limegreen;">Live</div>
    <?php endif; ?>
    <div class="serverHeader__info">
    <p class="serverHeader__title">DASHBOARD</p>
    <ul class="serverHeader__list">
      <li class="serverHeader__list--ok">Please make sure you have submitted your sitemap</li>
      <li><a style="color:#ffffff" target="_blank" href="https://phptravels.com/documentation/sitemap/">To undersstand how to do that click <strong>HERE.</strong></a></li>
    </ul>
<div style="max-width:680px">
<div style="margin-left: -5px; margin-right: -5px; margin-top: 10px; margin-bottom: -8px;display: table; width: 100%;">
  <!-- BEGIN ICON BUTTONS SET-->
  <?php if($canQuickBook){ ?>
  <div class="col-xs-6 col-sm-6 col-md-2 pad">
    <button data-toggle="modal" data-target="#quickbook" class="btn btn-danger btn-block">
      <div class="h5"><i class="fa fa-dashboard fa-lg"></i> Quick Book</div>
    </button>
  </div>
  <?php } ?>
  <div class="col-xs-6 col-sm-6 col-md-2 pad">
    <form action="<?php echo base_url().$this->uri->segment(1); ?>/bookings/" method="post">
      <button type="submit" class="btn btn-primary btn-block">
        <div class="h5"><i class="fa fa-bar-chart-o fa-lg"></i> Bookings</div>
      </button>
    </form>
  </div>
  <?php if($isadmin){ ?>
  <div class="col-xs-6 col-sm-6 col-md-2 pad">
    <form action="<?php echo base_url(); ?>admin/cms/" method="post">
      <button type="submit" class="btn btn-info btn-block">
        <div class="h5"><i class="fa fa-list-alt fa-lg"></i> &nbsp; CMS Pages</div>
      </button>
    </form>
  </div>
  <?php if($blogenabled){ ?>
  <div class="col-xs-6 col-sm-6 col-md-2 pad">
    <form action="<?php echo base_url(); ?>admin/blog/" method="post">
      <button type="submit" class="btn btn-success btn-block">
        <div class="h5"><i class="glyphicon glyphicon-th-large fa-lg"></i> Blog</div>
      </button>
    </form>
  </div>
  <?php } if($newsletterEnabled){ ?>
  <div class="col-xs-6 col-sm-6 col-md-2 pad">
    <form action="<?php echo base_url(); ?>admin/newsletter/" method="post">
      <button type="submit" role="button" class="btn btn-warning btn-block">
        <div class="h5"><i class="fa fa-envelope fa-lg"></i> Newsletter</div>
      </button>
    </form>
  </div>
  <?php } ?>
  <div class="col-xs-6 col-sm-6 col-md-2 pad">
    <form action="<?php echo base_url(); ?>admin/backup/" method="post">
      <button type="submit" role="button" class="btn btn-default btn-block">
        <div class="h5"><i class="fa fa-inbox fa-lg"></i> Backup</div>
      </button>
    </form>
  </div>
  <?php } ?>
  <!-- END ICON BUTTONS SET-->
</div>
</div>
  </div>

  <!--<div class="serverHeader__stats">
    <ul class="serverHeader__statsList">
      <li class="serverHeader__stat-held">
        <a class="js-held-count" href="#">0 messages held</a>
      </li>
      <li class="serverHeader__stat-queue">
        <a class="js-queue-size" href="#">0 queued messages</a>
      </li>
      <li class="serverHeader__stat-bounces">
        <a class="js-bounce-rate" href="#">0.0% bounce rate</a>
      </li>
      <li class="serverHeader__stat-size">
        <a class="js-disk-size" href="#">0 Bytes used</a>
      </li>
    </ul>
  </div>-->

  <div class="serverHeader__stats">
    <ul class="serverHeader__statsList">
      <li><a class="" href="<?php echo base_url(); ?>admin/accounts/admins/"><i class="fa fa-user"></i> Total Admins <b><?=$adminAccountsCount?></b></a></li>
      <li><a class="" href="<?php echo base_url(); ?>admin/accounts/suppliers/"><i class="fa fa-user"></i> Total Suppliers <b><?=$supplierAccountsCount?></b></a></li>
      <li><a class="" href="<?php echo base_url(); ?>admin/accounts/customers/"><i class="fa fa-users"></i> Total Customers <b><?=$customersAccountsCount?></b></a></li>
      <li><a class="" href="<?php echo base_url(); ?>admin/accounts/guest/"><i class="fa fa-users"></i> Total Guests <b><?=$guestAccountsCount?></b></a></li>
      <li><a class="" href="<?php echo base_url(); ?>admin/bookings/"><i class="fa fa-tag"></i> Total Bookings <b><?=$totalBookings?></b></a></li>
    </ul>
  </div>
  <style>
  .serverHeader__usage img {padding:5px;border-radius:10px}
  .serverHeader__usage img:hover {opacity:0.8}
  </style>
  <div class="serverHeader__usage">
    <p class="serverHeader__usageTitle" style="margin-bottom: 0px; margin-top: -12px;">Marketing Tools and Widgets</p>
    <a href="https://accounts.google.com" target="_blank" class="col-md-4"><img src="<?php echo base_url(); ?>assets/img/tools/adwords.jpg" target="_blank" alt="adwords" class="img-responsive img-rounded"/></a>
    <a href="https://analytics.google.com/" target="_blank" class="col-md-4"><img src="<?php echo base_url(); ?>assets/img/tools/analytics.jpg" target="_blank" alt="analytics" class="img-responsive img-rounded"/></a>
    <a href="https://developers.google.com/speed/pagespeed/insights/?url=<?php echo base_url(); ?>" target="_blank" class="col-md-4"><img src="<?php echo base_url(); ?>assets/img/tools/googlepagespeed.jpg" alt="googlepagespeed" class="img-responsive img-rounded"/></a>
    <a href="https://lc.chat/9DXgj" target="_blank" class="col-md-4"><img src="<?php echo base_url(); ?>assets/img/tools/livechatinc.jpg" target="_blank" alt="livechatinc" class="img-responsive img-rounded"/></a>
    <a href="https://www.sendinblue.com/" target="_blank" class="col-md-4"><img src="<?php echo base_url(); ?>assets/img/tools/sendinblue.jpg" target="_blank" alt="sendinblue" class="img-responsive img-rounded"/></a>
    <a href="https://www.inmotionhosting.com/" target="_blank" class="col-md-4"><img src="<?php echo base_url(); ?>assets/img/tools/inmotionhosting.jpg" target="_blank" alt="inmotionhosting" class="img-responsive img-rounded"/></a>
    <!--<div class="serverHeader__usageLine">
      <div class="serverHeader__usageLineLabel">Calls</div>
      <div class="serverHeader__usageLineBar">
        <div class="bar">
          <div class="bar__inner js-outgoing-bar" style="width:25%;"></div>
        </div>
      </div>
      <div class="serverHeader__usageLineValue js-outgoing-count" title="">
        640
      </div>
    </div>
    <div class="serverHeader__usageLine">
      <div class="serverHeader__usageLineLabel">Bandwidth / Traffic</div>
       <div class="serverHeader__usageLineBar">
        <div class="bar">
          <div class="bar__inner js-outgoing-bar" style="width:60%;"></div>
        </div>
      </div>
      <div class="serverHeader__usageLineValue js-incoming-count">
        7440
      </div>
    </div>
    <div class="serverHeader__usageLine">
      <div class="serverHeader__usageLineLabel">Todays Visits</div>
      <div class="serverHeader__usageLineValueLarge">
        <b class="js-message-rate">34</b> Last 24/H
      </div>
    </div>-->
  </div>
</div>

<!-- Reports section -->
<?php if(!empty($isadmin)){ ?>
    <div class="panel panel-default">
      <div class="panel-heading">Booking Summary </div>
      <div class="panel-body">
        <div class="row">
        <div class="col-md-4">
        <div class="block">
          <div class="pad8 rev-bg">
            <div class="col-md-5 row col-sm-5">
              <div class="tempStatBox" style="margin-left:-10px;" >
                <div class="tempStat" style="border-color: rgb(0, 204, 51);"><?php echo $today->totalCount + $todayExpedia->totalCount + $travelportCurrentDaySale->total_booking;?></div>
              </div>
            </div>
            <div class="col-md-7 col-sm-7">
              <div class="text-left">
                <h4><strong>Today's Booking</strong></h4>
                <p>Yesterday's : <?php echo $yesterday->totalCount + $yesterdayExpedia->totalCount;?></p>
                <hr class="mtb04">
                <span class="text-success"><strong>Paid :</strong> <?php echo $today->paidAmount + $todayExpedia->paidAmount + $travelportCurrentDaySale->total_price;?></span>
                <div class="clearfix"></div>
                <span class="text-danger"><strong>Unpaid :</strong> <?php echo $today->unpaidAmount;?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="block">
          <div class="pad8 rev-bg">
            <div class="col-md-5 row col-sm-5">
              <div class="tempStatBox" style="margin-left:-10px;" >
                <div class="tempStat" style="border-color: rgb(255, 153, 51);"><?php echo $thirtyDays->totalCount + $thirtyDaysExpedia->totalCount + $travelportLastThirtyDays->total_booking;?></div>
              </div>
            </div>
            <div class="col-md-7 col-sm-7">
              <div class="text-left">
                <h4><strong>Last 30 Day's</strong></h4>
                <p>Last 60 Day's : <?php echo $sixtyDays->totalCount + $sixtyDaysExpedia->totalCount;?></p>
                <hr class="mtb04">
                <span class="text-success"><strong>Paid :</strong> <?php echo $thirtyDays->paidAmount + $thirtyDaysExpedia->paidAmount + $travelportLastThirtyDays->total_price;?></span>
                <div class="clearfix"></div>
                <span class="text-danger"><strong>Unpaid :</strong> <?php echo $thirtyDays->unpaidAmount;?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="block hidden-md hiddin-sm hidden-xs">
          <div class="pad8 rev-bg">
            <div class="col-md-5 row col-sm-5">
              <div class="tempStatBox" style="margin-left:-10px;" >
                <div class="tempStat" style="border-color: rgb(204, 0, 51);"><?php echo $nintyDays->totalCount + $nintyDaysExpedia->totalCount + $travelportLastNinghtyDays->total_booking;?></div>
              </div>
            </div>
            <div class="col-md-7 col-sm-7">
              <div class="text-left">
                <h4><strong>Last 90 Day's</strong></h4>
                <p>Last 180 Day's : <?php echo $oneEightyDays->totalCount + $oneEightyDaysExpedia->totalCount;?></p>
                <hr class="mtb04">
                <span class="text-success"><strong>Paid :</strong> <?php echo $nintyDays->paidAmount + $nintyDaysExpedia->paidAmount + $travelportLastNinghtyDays->total_price;?></span>
                <div class="clearfix"></div>
                <span class="text-danger"><strong>Unpaid :</strong> <?php echo $nintyDays->unpaidAmount;?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>


<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Revenue Chart</div>
      <div class="panel-body">
        <style>
          td span {width: 100%;font-weight: bold;}
          .rev-but { padding: 8px 16px; background-color:#f7f7f7; }
          .rev-bg { border: 1px solid #eee;background-color:#f9f9f9;border-radius:5px }
          .pad8 { padding: 8px; }
          .pad8 h4 { margin-bottom: 5px; }
          .pad8 p { color: #8e8e8e }
          .mlr0 { padding-right: 0px; padding-left: 0px; }
          .mtb10 { margin-top: 15px;margin-bottom: 15px; }
          .mtb04 { margin-top: 0px;margin-bottom: 5px; }
          .mb0 { margin-bottom: 0px; }
          .tempStatBox { width: 120px; -webkit-box-sizing: content-box; -moz-box-sizing: content-box; box-sizing: content-box; margin: 0 auto; }
          .tempStatBox .tempStat { position: relative; font-size: 27px; line-height: 80px; -webkit-border-radius: 50em; -moz-border-radius: 50em; border-radius: 50em; border: 10px solid #FFF; background: #f9f9f9; height: 80px; width: 80px; text-align: center; margin: 0 auto; -webkit-box-sizing: content-box; -moz-box-sizing: content-box; box-sizing: content-box; }
          .tempStatBox .tempStat:before { content: ""; top: -10px; left: -10px; height: 100px; width: 100px; position: absolute; -webkit-border-radius: 50em; -moz-border-radius: 50em; border-radius: 50em; background: transparent; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.3),0px 1px 0 #fff; -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.3),0px 1px 0 #fff; box-shadow: inset 0 1px 1px rgba(0,0,0,0.3),0px 1px 0 #fff; -webkit-box-sizing: content-box; -moz-box-sizing: content-box; box-sizing: content-box;}
        </style>
        <div class="row">
          <div class="col-md-12">
            <div id="container" style="min-width: 310px; height: 335px; margin: 0 auto"></div>
          </div>
          <!-- Line Chart JS -->
          <script type="text/javascript">
            $(function () {
                $('#container').highcharts({
                    title: {
                        text: 'Last 30 Days Bookings Report',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: <?php echo json_encode($graphReport['days']); ?>
                    },
                    yAxis: {
                        title: {
                            text: 'Booking Amount'
                        },
                        min: 0,
                        plotLines: [{value: 0, width: 1, color: '#808080'}]
                    },
                    tooltip: {
                        valueSuffix: ' <?php echo $currCode; ?>'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: <?php echo $resArray;?>
                });
            });
          </script>
          <!-- End Line Chart JS -->
          <div class="col-md-4">
            <div class="block">
              <div class="panel panel-default mb0">
                <div class="pad8">
                  <button class="btn btn-default btn-block rev-but">
                  Today
                  </button>
                  <div class="pad8 text-center">
                    <h4><strong><?php echo $currCode;?> <?php echo ($todayPaid->totalPaidAmount + $todayExpedia->totalAmount + $travelportCurrentDaySale->total_price);?></strong></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="block">
              <div class="panel panel-default mb0">
                <div class="pad8">
                  <button class="btn btn-default btn-block rev-but">
                  Last 30 Days
                  </button>
                  <div class="pad8 text-center">
                    <h4><strong><?php echo $currCode;?> <?php echo ($thirtyDaysPaid->totalPaidAmount + $thirtyDaysExpedia->totalAmount + $travelportLastThirtyDays->total_price); ?></strong></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="block">
              <div class="panel panel-default mb0">
                <div class="pad8">
                  <button class="btn btn-default btn-block rev-but">
                  Last 90 Days
                  </button>
                  <div class="pad8 text-center">
                    <h4><strong><?php echo $currCode;?> <?php echo ($nintyDaysPaid->totalPaidAmount + $nintyDaysExpedia->totalAmount + $travelportLastNinghtyDays->total_price); ?></strong></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr>
</div>

<?php } ?>
<!-- Reports section -->


<!-- Recent Bookings -->
<?php if(pt_permissions('booking',@$userloggedin)){ ?>
<?php  echo modules::run($UriSegment.'/bookings/dashboardBookings'); ?>
<?php } ?>
<!--Recent Bookings -->

<!-- Expedia Recent Bookings -->
<?php 
  if(!empty($isadmin)) {
      $chkExpedia = isModuleActive("ean");
      if($chkExpedia) {
        echo modules::run('ean/eanback/dashboardBookings');
      }
  }
?>


<?php 
  if( ! empty($isadmin) ) {
    $travelport_flight = isModuleActive("travelport_flight");
    if($travelport_flight) {
?>
<!-- Travelport -->
<div class="col-md-12">
  <div class="panel panel-default">
  <div class="panel-body">
      <div id="tpcontainer" style="min-width: 310px; height: 335px; margin: 0 auto"></div>
  </div>
</div>

<!-- Line Chart JS -->
<script type="text/javascript">
  $(function () {
      $('#tpcontainer').highcharts({
          title: {
              text: 'Last 30 Days Travelport Bookings Report',
              x: -20 //center
          },
          xAxis: {
              categories: <?php echo json_encode($xaxis); ?>
          },
          yAxis: {
              title: {
                  text: 'Booking Amount'
              },
              min: 0,
              plotLines: [{value: 0, width: 1, color: '#808080'}]
          },
          tooltip: {
              valueSuffix: ' <?php echo $currCode; ?>'
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
          },
          series: <?php echo $travelportSeries; ?>
      });
  });
</script>
<?php
        echo modules::run('travelport_flight/flightback/bookings');
      }
  }
?>

<!--Expedia Recent Bookings -->
<div class="row">
  <div class="col-md-12">
    <?php if(!empty($isadmin)){ ?>
    <div class="panel panel-default">
      <div class="panel-heading">
       <div class="pull-left"> <span class="fa fa-bar-chart-o"></span> Visit Statistics of <?php echo date('F', time()); ?></div>
       <div class="pull-right btn btn-xs btn-danger resetChart"> <span class="fa fa-bar-chart-o"></span> Reset Chart </div>
      <div class="clearfix"></div>
     </div>

      <div class="panel-body">
        <br>
        <!-- <canvas id="canvasbar" height="237" width="750"></canvas>-->
        <div id="resgraph" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(".resetChart").on("click",function() {
            $.alert.open('confirm', 'Are you sure you want to reset visits data?', function(answer) {
                if(answer == 'yes') {
                    $.post("<?php echo base_url();?>admin/resetVisits",{isAjax: "yes"},function(resp){
                        location.reload();
                    });
                } else {
                    return false;
                }
            });
        });

        $('#resgraph').highcharts({
            chart: {
                type: 'column',
                zoomType: 'x'
            },
            title: {
                text: ''
            },
            xAxis: {
                title: {
                    text: "<?php echo date('F', time()); ?>"
                },
                categories: [<?php for($day =1;$day <= $totalDays;$day++){echo $day.","; }?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Visits'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -70,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y + '<br/>' +
                        'Total: ' + this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        }
                    }
                }
            },
            series: [{
                name: 'Unique',
                data: [<?php echo implode(",", $uniqueVisits); ?>],
                stack: 'male'
            }, {
                name: 'Total Hits',
                data: [<?php echo implode(",", $totalHits); ?>],
                stack: 'female'
            }]
        });
    });
</script>

<!---quick booking modal-->
<div class="modal fade" id="quickbook" tabindex="-1" role="dialog" aria-labelledby="ADD_BLOG_CAT" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url().$this->uri->segment(1); ?>/quickbooking/" method="GET">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Quick Booking</h4>
        </div>
        <div class="modal-body form-horizontal">
          <div class="form-group">
            <label class="col-md-3 control-label" >Apply Tax</label>
            <div class="col-md-4">
              <select name="applytax" class="form-control" id="apply" >
                <option value="yes" >Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" id="service" >Service</label>
            <div class="col-md-4">
              <select required name="service" data-placeholder="Select" class="form-control" id="servicetype" tabindex="1">
                <option value="">Select</option>
                <?php
                  foreach($quickmodules as $mod):
                    if(pt_permissions($mod->name, $userloggedin)){
                  ?><option value="<?php echo $mod->name;?>"><?php echo ucfirst($mod->name);?></option>
                <?php } endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Next</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->
