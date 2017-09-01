<?php
exec(__DIR__ . '/service-account.py', $output);
$access_token = $output[2];

$date = strtotime('-1 day');
$dateAges = [7, 28, 90];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Embed API Demo</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="./css/style.css">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script>
(function(w,d,s,g,js,fs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));
</script>
<script>
var view_ids = 'ga:44262736'; // <-- Replace with the ids value for your view.
gapi.analytics.ready(function() {

  /**
   * Authorize the user with an access token obtained server side.
   */
  gapi.analytics.auth.authorize({
    'serverAuth': {
      'access_token': '<?= $access_token ?>'
    }
  });
  
  var dataChart1 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': view_ids,
      'metrics': 'ga:sessions,ga:users,ga:pageviews',
      'dimensions': 'ga:date'
    },
    chart: {
      'container': 'chart-1-container',
      'type': 'LINE',
      'options': {
        'width': '100%'
      }
    }
  });
  
  var dataChart2 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': view_ids,
      'metrics': 'ga:sessions',
      'dimensions': 'ga:pagePath',
      'sort': '-ga:sessions',
      'filters': 'ga:pagePathLevel1==/blog/',
      'max-results': 6
    },
    chart: {
      'container': 'chart-2-container',
      'type': 'TABLE',
      'options': {
        'width': '100%'
      }
    }
  });
  
  var dataChart3 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': view_ids,
      'metrics': 'ga:sessions',
      'dimensions': 'ga:userAgeBracket',
      'sort': '-ga:sessions',
      'filters': 'ga:pagePathLevel1==/blog/',
      'max-results': 7
    },
    chart: {
      'container': 'chart-3-container',
      'type': 'PIE',
      'options': {
        'title': 'セッション数（年齢別）',
        'width': '100%',
        'pieHole': 4/9,
        'is3D': true
      }
    }
  });
  
  var dataChart4 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': view_ids,
      'metrics': 'ga:sessions',
      'dimensions': 'ga:regionIsoCode, ga:region',
      'filters': 'ga:pagePathLevel1==/blog/',
      'max-results': 1000
    },
    chart: {
      'container': 'chart-4-container',
      'type': 'GEO',
      'options': {
        'width': '100%',
        'region': 'JP',
        'resolution': 'provinces'
      }
    }
  });
  
  var execute = function(start, end) {
    dataChart1.set({
      query: {
        'start-date': start,
        'end-date': end,
      }
    });
    dataChart1.execute();
    
    dataChart2.set({
      query: {
        'start-date': start,
        'end-date': end,
      }
    });
    dataChart2.execute();
    
    dataChart3.set({
      query: {
        'start-date': start,
        'end-date': end,
      }
    });
    dataChart3.execute();
    
    dataChart4.set({
      query: {
        'start-date': start,
        'end-date': end,
      }
    });
    dataChart4.execute();
  }
  
  var $menu = $('#rangeMenu');
  var $label = $menu.find('#rangeLabel');
  var $item = $menu.find('button.dropdown-item');
  $item.on('click',function(){
    var $this = $(this);
    $item.removeClass('active');
    $this.addClass('active');
    var start = $this.data('start');
    var end = $this.data('end');
    $label.text(start.replace(/\-/g , '/') + ' - ' + end.replace(/\-/g , '/'));
    execute(start, end);
  });
  $item.first().trigger('click');
});
</script>
</head>
<body>
<?php require __DIR__ . '/_inc_header.php'; ?>
<main role="main">
  <div class="container">
    <div class="dashboard">
      <p class="address">http://syake-labo.com</p>
      <div id="rangeMenu" class="dropdown">
        期間：<a href="javascript:void(0)" class="dropdown-toggle" id="rangeLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php $age = $dateAges[0] ?><?= date('Y/m/d', strtotime("-{$age} day", $date)) ?> - <?= date('Y/m/d', $date) ?></a>
        <div class="dropdown-menu" aria-labelledby="rangeLabel">
<?php foreach ($dateAges as $i => $age) : ?>
          <button class="dropdown-item" data-start="<?= date('Y-m-d', strtotime("-{$age} day", $date)) ?>" data-end="<?= date('Y-m-d', $date) ?>" type="button">過去 <?= $age ?> 日前</button>
<?php endforeach; ?>
        </div>
      </div>
    </div><!-- /.dashboard -->
    <div id="chart-1-container" class="dashboard"></div>
    <div class="row">
      <div class="col-sm-12">
        <div id="chart-2-container" class="dashboard"></div>
      </div>
      <div class="col-sm-6">
        <div id="chart-3-container" class="dashboard"></div>
      </div>
      <div class="col-sm-6">
        <div id="chart-4-container" class="dashboard"></div>
      </div>
    </div>
  </div>
</main>
<footer>
  <div class="container">
    <p>参考 : <a href="https://ga-dev-tools.appspot.com/embed-api/server-side-authorization/" target="_blank">Server-side Authorization</a></p>
    <p>参考 : <a href="https://developers.google.com/analytics/devguides/reporting/embed/v1/component-reference" target="_blank">組み込みコンポーネント リファレンス</a></p>
    <p>参考 : <a href="https://developers.google.com/analytics/devguides/reporting/core/dimsmets" target="_blank">Dimensions & Metrics Explorer</a></p>
    <p>&copy; 2017 Hiroaki Komatsu</p>
  </div>
</footer>
</body>
</html>
