<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
<body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
<?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
<div class="container">
  <div class="row">
    <div class="col-12 p-3">
      <h4 class="text-primary fw-bolder">Traffic Heatmap</h4>
</div>
</div>
<div class="row">
    <div class="col-md-6 p-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="card-title">🕒 Active users in last 30 minutes</h5>
                <h2 class="text-primary mb-0"><?php echo $active_30min; ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-6 p-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="card-title">⏱ Active users in last 5 minutes</h5>
                <h2 class="text-success mb-0"><?php echo $active_5min; ?></h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 p-3">
      <canvas id="traffic_heatmap_chart" style="width:100%;"></canvas>
</div>
</div>
<?php if($visitors_data){ ?>
  <div class="row">
    <div class="col-12 p-3">
      <h4 class="text-primary fw-bolder">Last 100 Website Visitors</h4>
</div>
</div>
<div class="row">    
<table class="table table-striped table-bordered  table-hover">
             <thead>
              <tr>
                <th scope="col" class="text-center align-middle">ID</th>
                <th scope="col" class="align-middle">IP Address</th>
                <th scope="col" class="text-center align-middle">URL</th>
                <th scope="col" class="text-center align-middle">Pageviews</th>
                <th scope="col" class="text-center align-middle">Information</th>
                <th scope="col" class="text-center align-middle">Time</th>
              </tr>
          </thead>
          <tbody class="table-group-divider">

          <?php  foreach ($visitors_data as $row)
                    { 
                   $visitorData = json_decode($row['data'], true);
                  $url = $visitorData['url'] ?? 'N/A';
                  $userAgent = $visitorData['user_agent'] ?? 'Unknown';
                  $language = $visitorData['language'] ?? 'Unknown';
                  $cookies = $visitorData['cookies_enabled'] === 'true' ? 'Enabled' : 'Disabled';
                  $online = $visitorData['online_status'] === 'true' ? 'Online' : 'Offline';
                  $timezone = $visitorData['timezone'] ?? 'Unknown';
                  $screen = $visitorData['screen']['width'] . 'x' . $visitorData['screen']['height'] ?? 'Unknown';
                  $browserIcon = get_browser_fnc($userAgent);
                  $osIcon = get_os_fnc($userAgent);

                ?>
            <tr>
  <th scope="row" class="text-center align-middle"><?php echo $row['visitor_id']; ?></th>
  <td class="text-start align-middle ip-cell" data-ip="<?php echo $row['add_ip']; ?>"><?php echo $row['add_ip']; ?>
  <br><i class="fa-brands fa-<?php echo $browserIcon; ?>"></i></i>
<br><i class="fa-brands fa-<?php echo $osIcon; ?>"></i>
<br><span class="country-flag"></span>
<small>
<br><span class="country-continent"></span>
<br><span class="country-name"></span>
</small>
  </td>
  <td class="text-start align-middle"  data-bs-toggle="tooltip" data-bs-original-title="<?php echo htmlspecialchars($url); ?>" title="<?php echo htmlspecialchars($url); ?>
">
    <a href="<?php echo htmlspecialchars($url); ?>" target="_blank">
      <?php echo strlen($url) > 60 ? substr($url, 0, 60) . '...' : $url; ?>
    </a>
  </td>
  <td class="text-center align-middle"><?php echo $row['views']; ?></td>
  <td class="text-start align-middle">
    <small>
      <strong>Agent:</strong> <?php echo htmlspecialchars($userAgent); ?><br>
      <strong>Lang:</strong> <?php echo $language; ?><br>
      <strong>Cookies:</strong> <?php echo $cookies; ?><br>
      <strong>Status:</strong> <?php echo $online; ?><br>
      <strong>Timezone:</strong> <?php echo $timezone; ?><br>
      <strong>Screen:</strong> <?php echo $screen; ?>
    </small>
  </td>
  <td class="text-center align-middle">
   <small  data-bs-toggle="tooltip" data-bs-original-title=" 👣 Entry: <?php echo date('Y-m-d H:i:s', $row['add_time']); ?> 🚪 Exit: <?php echo date('Y-m-d H:i:s', $row['edit_time']); ?>" title=" 👣 Entry: <?php echo date('Y-m-d H:i:s', $row['add_time']); ?> 🚪 Exit: <?php echo date('Y-m-d H:i:s', $row['edit_time']); ?>
">
  🕒 <strong>Spend:</strong> <?php echo time_duration_fnc($row['add_time'], $row['edit_time']); ?>
<br>
<em class="text-muted"> 👣 Visit <?php echo time_difference_fnc(time(), $row['add_time']); ?></em>
</small>
  </td>
</tr>

            <?php } ?>
          </tbody>
          </table>
</div>
<?php } ?>
</div>
<?php echo view('backend/'.$cc['backend_theme'].'/common/footer');?>
<?php echo view('backend/'.$cc['backend_theme'].'/common/body_end');?>
<script data-src="<?php echo $cc['assets_url'].'public/assets/chart.js/3.9.1/dist/chart.min.js'; ?>"></script>
<script>
  
  function content_fnc() {

   p('.ip-cell').each(function(index) {
  const cell = p(this);
  const ip = cell.data('ip');

  if (ip === '127.0.0.1' || ip.startsWith('192.168')) {
    cell.find('.country-name').text('Localhost');
    return;
  }

  setTimeout(() => {
    p.getJSON(`https://api.ipinfo.io/lite/${ip}?token=<?php echo $cc['ip_info_token']; ?>`, function(data) {
      if (data && data.country) {
        const flagUrl = `https://flagcdn.com/24x18/${data.country_code.toLowerCase()}.png`;
        cell.find('.country-continent').text(data.continent || '');
        cell.find('.country-name').text(data.country || '');
        cell.find('.country-flag').html(`<img src="${flagUrl}" alt="${data.country}" width="24" height="18">`);
      } else {
        cell.find('.country-name').text('');
      }
    }).fail(function() {
      cell.find('.country-name').text('...');
    });
  }, index * 5000);
});


function try_int_chart_fnc() {
  if (typeof Chart === "undefined") {
    setTimeout(try_int_chart_fnc, 500);
} else {
   function skipped(ctx, value) {
    return ctx.p0.skip || ctx.p1.skip ? value : undefined;
  }

  function down(ctx, value) {
    return ctx.p1.parsed.y < ctx.p0.parsed.y ? value : undefined;
  }

  function up(ctx, value) {
    return ctx.p1.parsed.y > ctx.p0.parsed.y ? value : undefined;
  }

  const labels = [...Array(24)].map((_, i) => {
    const hour = new Date(Date.now() - ((23 - i) * 60 * 60 * 1000)).getHours();
    return `${hour.toString().padStart(2, '0')}:00`;
  });

  const traffic_heatmap = <?php echo $traffic_heatmap; ?>;

  const options = {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: '<?php echo $visitors; ?> Visitors in the Last 24 Hours'
      },
      tooltip: {
        mode: 'index',
        intersect: false
      }
    },
    interaction: {
      mode: 'nearest',
      axis: 'x',
      intersect: false
    },
    scales: {
      x: {
        title: {
          display: true,
          text: 'Hour'
        }
      },
      y: {
        title: {
          display: true,
          text: 'Visitor Count'
        },
        beginAtZero: true
      }
    }
  };

  const config = {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Visitors',
        data: traffic_heatmap,
        borderColor: 'rgb(75, 192, 192)',
        segment: {
          borderColor: ctx =>
            skipped(ctx, 'gray') ||
            down(ctx, 'red') ||
            up(ctx, 'green'),
          borderDash: ctx => skipped(ctx, [6, 6])
        },
        spanGaps: true,
        tension: 0.3,
        pointRadius: 3,
        pointHoverRadius: 5
      }]
    },
    options: options
  };

  const ctx = document.getElementById('traffic_heatmap_chart').getContext('2d');
  new Chart(ctx, config);
   
   }
}


try_int_chart_fnc();

}

</script>
</body>
<?php echo view('backend/'.$cc['backend_theme'].'/common/page_end');?>