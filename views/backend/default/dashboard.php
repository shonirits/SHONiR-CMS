<!doctype html>
<html lang="en">
  <head>
  <?php require_once('common/head.php');?>
  <title><?php echo $SHONiR_Main['meta_title'] ?></title>
<meta name="description" content="<?php echo $SHONiR_Main['meta_description'] ?>">
<meta name="keywords" content="<?php echo $SHONiR_Main['meta_keyword'] ?>" />
  </head>

  <body id="page-top"><?php require_once('common/start.php');?>

<!-- Page Wrapper -->
<div id="wrapper">

<?php require_once('common/top.php');?>

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          <?php if(SHONiR_SETTINGS['config_cache'] == 'TRUE'){ ?>
          <a href="<?php echo SHONiR_APANEL.'Dashboard/Cache'; ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-lg text-white-50"></i> &nbsp; Delete Cache</a>
            <?php } ?>
        </div>

        <!-- Content Row -->
        <div class="row">

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Online</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $GLOBALS['SHONiR_ONLINE'];?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-satellite-dish fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Yesterday</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $SHONiR_Main['1dayago'];?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-history fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Visitors</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $GLOBALS['SHONiR_SETTINGS']['counter_visitors']?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Page Views</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $GLOBALS['SHONiR_SETTINGS']['counter_pageviews']?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-eye fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">News & Updates</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body updates">
    <?php

$SHONiR_Updates = $SHONiR_Main['Updates'];

if($SHONiR_Updates){

foreach($SHONiR_Updates->children() as $update) {

  echo "<a href='".$update->url."' target='_blank'> ".$update->title . "</a><br/>";
  echo "<span>".$update->date . "</span><br/>";
  echo "<p>".$update->description . "</p> ";

 }

}


?>
    </div>
  </div>
</div>

<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Devices</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-pie pt-4 pb-2">
        <canvas id="mypieChart"></canvas>
      </div>
      </div>
  </div>
</div>
</div>

        <!-- Content Row -->

        <div class="row">

          <!-- Area Chart -->
          <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
              <!-- Card Header - Dropdown -->
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Visitors Overview</h6>

              </div>
              <!-- Card Body -->
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="myAreaChart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Pie Chart -->
          <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
              <!-- Card Header - Dropdown -->
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Visitors Flow</h6>
              </div>
              <!-- Card Body -->
              <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                  <canvas id="mydoughnutChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>




        <!-- Content Row -->
        <div class="row">

          <!-- Content Column -->
          <div class="col-lg-12 mb-12">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Visitors History</h6>
              </div>
              <div class="card-body">
              <?php

$SHONiR_Records = $SHONiR_Main['SHONiR_Pagination'];

              $SHONiR_Visitors = $SHONiR_Records['Rows'];
              foreach($SHONiR_Visitors as $key => $val){
                $referer = $SHONiR_Visitors[$key]['referer'];

                $referer = ($referer)?' referral from  <a target="_blank"  href="'.$referer.'">'.SHONiR_Domain_Fnc($referer).'<a>':'';
                ?>
             <p <?php echo ((SHONiR_IDLE - (time() - $SHONiR_Visitors[$key]['edit_time'])) <= 0)?'':'class="online"'; ?>> A visitor [<?php echo SHONiR_User_Type_Fnc($SHONiR_Visitors[$key]['user_type']); ?>] <?php echo $SHONiR_Visitors[$key]['add_ip'] ?> from <?php echo $SHONiR_Visitors[$key]['country'].' - '.$SHONiR_Visitors[$key]['city'] ?> using <?php echo $SHONiR_Visitors[$key]['agent'] ?> <?php echo $referer; ?> viewed <a target="_blank" href="<?php echo $SHONiR_Visitors[$key]['url'] ?>"><?php echo $SHONiR_Visitors[$key]['url'] ?></a> <?php echo SHONiR_Time_Difference_Fnc(time(), $SHONiR_Visitors[$key]['add_time'], TRUE); ?> </p>
                <hr/>
<?php }?>


 <div class="clearfix"></div>
 <div class="row">
 <div class="col-sm-12 col-md-5">Showing <?php echo $SHONiR_Records['Start_Records']?> to <?php echo $SHONiR_Records['End_Records']?> of <?php echo $SHONiR_Records['Total_Records']?> entries</div>
 <div class="col-sm-12 col-md-7 ">
 <?php echo $SHONiR_Records['Pagination']?>
</div>
</div>

              </div>
            </div>

          </div>


        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php require_once('common/footer.php');?>

</div>
<?php require_once('common/end.php');?>
<script>// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("mydoughnutChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Direct", "Bot", "Referral"],
    datasets: [{
      data: [<?php echo $SHONiR_Main['Direct'];?>, <?php echo $SHONiR_Main['Bot'];?>, <?php echo $SHONiR_Main['Referer'];?>],
      backgroundColor: ['#1cc88a', '#ef2b79', '#4e73df'],
      hoverBackgroundColor: ['#17a673', '#a61750', '#2e59d9'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      caretPadding: 10,
    },

    cutoutPercentage: 50,
  },
});


Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("mypieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Desktop", "Mobile"],
    datasets: [{
      data: [<?php echo $SHONiR_Main['Desktop'];?>, <?php echo $SHONiR_Main['Mobile'];?>],
      backgroundColor: ['#5508b3', '#d78606'],
      hoverBackgroundColor: ['#30016a', '#8b5603'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      caretPadding: 10,
    },

  },
});



// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["<?php echo date('D ',strtotime("-7 days"))?>", "<?php echo date('D',strtotime("-6 days"))?>", "<?php echo date('D',strtotime("-5 days"))?>", "<?php echo date('D',strtotime("-4 days"))?>", "<?php echo date('D',strtotime("-3 days"))?>", "<?php echo date('D',strtotime("-2 days"))?>", "<?php echo date('D',strtotime("-1 days"))?>"],
    datasets: [{
      label: "Visitors",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo $SHONiR_Main['7dayago'];?>, <?php echo $SHONiR_Main['6dayago'];?>, <?php echo $SHONiR_Main['5dayago'];?>, <?php echo $SHONiR_Main['4dayago'];?>, <?php echo $SHONiR_Main['3dayago'];?>, <?php echo $SHONiR_Main['2dayago'];?>, <?php echo $SHONiR_Main['1dayago'];?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});

</script>
  </body>
</html><?php
require_once('common/clear.php');
?>
