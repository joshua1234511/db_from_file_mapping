<?php

require_once(dirname(__FILE__) . '/includes/config.php');
require_once(dirname(__FILE__) . '/includes/class.database.php');
require_once(dirname(__FILE__) . '/includes/class.functions.php');

$GLOBALS['db'] = new database($servername, $username, $password, $dbname);
$db =& $GLOBALS['db'];
$db->connect();

$etf_id = 1; // Currently only 1 ETF

$querySector     = $db->query(" SELECT name,weight FROM sectors s,etf_sectors es WHERE es.id IN (SELECT MAX(id) FROM etf_sectors GROUP BY sector_id) AND s.id = sector_id");
$totalSector     = $db->getRows($querySector);
$totalSectorHtml = "";
$color_array     = array();
foreach ($totalSector as $key => $value) {
    $color         = functions::random_color($color_array);
    $color_array[] = $color;
    $totalSectorHtml .= "{y:" . $value['weight'] . ",color:'#" . $color . "',name:'" . $value['name'] . "'},";
}
$totalSectorHtml = rtrim($totalSectorHtml, ',');

$queryGeo     = $db->query(" SELECT name,weight FROM countries c,etf_countries ec WHERE ec.id IN (SELECT MAX(id) FROM etf_countries GROUP BY country_id) AND c.id = country_id");
$totalGeo     = $db->getRows($queryGeo);
$totalGeoHtml = "";
$color_array  = array();
foreach ($totalGeo as $key => $value) {
    $color         = functions::random_color($color_array);
    $color_array[] = $color;
    $totalGeoHtml .= "{y:" . $value['weight'] . ",color:'#" . $color . "',name:'" . $value['name'] . "'},";
}
$totalGeoHtml = rtrim($totalGeoHtml, ',');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>OWLshares</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script type="text/javascript">
      $(function () {
        Highcharts.chart('container-sector', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'SECTOR ALLOCATION'
            },
            subtitle: {
                text: 'As of 12/21/2016 (% of Total) (updated daily)'
            },
            exporting: {
                     enabled: false
            },
            xAxis: {
              title: {
                text: null
            },
            },
            yAxis: {
                min: 0,
                title: {
                    text: null
                },
                decmal: true,
            },
            legend: {
                enabled: false
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            series: [{
                name :'% of Total',
                data: [<?php
echo $totalSectorHtml;
?>]
            }]
        });
    });
  </script>
  <script type="text/javascript">
      $(function () {
        Highcharts.chart('container-geo', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'GEO ALLOCATION'
            },
            subtitle: {
                text: 'As of 12/21/2016 (% of Total) (updated daily)'
            },
            exporting: {
                     enabled: false
            },
            xAxis: {
              title: {
                text: null
            },
            },
            yAxis: {
                min: 0,
                title: {
                    text: null
                },
                decmal: true,
            },
            legend: {
                enabled: false
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            series: [{
                name :'% of Total',
                data: [<?php
echo $totalGeoHtml;
?>]
            }],
        });
    });
  </script>
</head>
<body>
<div class="container">
  <div class="row">
    <div id="container-sector" class="col-md-12" style="min-width: 310px; max-width: 100%; height: 400px; margin: 0 auto"></div>
    <div id="container-geo" class="col-md-12" style="min-width: 310px; max-width: 100%; height: 400px; margin: 0 auto"></div>

  </div>
</div>
</body>
</html>