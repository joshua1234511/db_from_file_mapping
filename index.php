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

//Overview
$queryDetails     = $db->query(" SELECT * FROM etf_details  WHERE id=".$etf_id." ORDER BY id DESC LIMIT 1");
$totalDetails     = $db->getRows($queryDetails);
var_dump($totalDetails);

//Performance
$queryPerformance     = $db->query(" SELECT * FROM etf_performance  WHERE id=".$etf_id." ORDER BY id DESC LIMIT 1");
$totalPerformance     = $db->getRows($queryPerformance);
var_dump($totalPerformance);

//Portfolio
$queryPortfolio     = $db->query(" SELECT * FROM etf_portfolio  WHERE id=".$etf_id." ORDER BY id DESC LIMIT 1");
$totalPortfolio     = $db->getRows($queryPortfolio);
var_dump($totalPortfolio);

if(isset($totalPortfolio[0]['security_id'])){
//Securities
$querySecurities     = $db->query(" SELECT * FROM securities  WHERE id=".$totalPortfolio[0]['security_id']."  ORDER BY id DESC LIMIT 1");
$totalSecurities     = $db->getRows($querySecurities);
var_dump($totalSecurities);
}
?>

PRICE AND YTD RETURN<br>
PRICE: <?php echo $totalPerformance[0]['price'] ?><br>
YTD RETURN: <?php echo $totalPerformance[0]['ytd_returns']?><br>
<br>
NAV<br>
<?php echo $totalPerformance[0]['nav_change_percent'] ?>% 
(<?php echo $totalPerformance[0]['nav_change'] ?>)<br>
$<?php echo $totalPerformance[0]['nav'] ?><br>
<br>
MARKET PRICE<br>
<?php echo $totalPerformance[0]['market_price_change_percent'] ?>% 
(<?php echo $totalPerformance[0]['market_price_change'] ?>)<br>
$<?php echo $totalPerformance[0]['market_price'] ?><br>
<br>
YTD TOTAL RETURN AT NAV<br>
Not Found<br>
<br>
AVERAGE ANNUAL TOTAL RETURNS<br>
NAV<br>
1 YEAR RETURN <?php echo $totalPerformance[0]['nav_returns_1yr'] ?>
5 YEAR RETURN <?php echo $totalPerformance[0]['nav_returns_5yr'] ?>
SINCE INCEPTION RETURN <?php echo $totalPerformance[0]['nav_change_since_inception'] ?><br>
Market<br>
1 YEAR RETURN <?php echo $totalPerformance[0]['market_returns_1yr'] ?>
5 YEAR RETURN <?php echo $totalPerformance[0]['market_returns_5yr'] ?>
SINCE INCEPTION RETURN <?php echo $totalPerformance[0]['market_price_change_since_inception'] ?><br>
<br>
<br>
FUND INFORMATION<br>
CUSIP       :<?php echo $totalDetails[0]['cusip'] ?><br>
Inception Date      :<?php echo $totalDetails[0]['inception_date'] ?><br>
Fiscal Year End     :<?php echo $totalDetails[0]['fiscal_year_end'] ?><br>
Exchange        :<?php echo $totalDetails[0]['exchange'] ?><br>
ETF Type        :<?php //echo $totalDetails[0][''] ?>Not Found<br>
Asset Class     :<?php echo $totalDetails[0]['asset_class'] ?><br>
Frequency of Index Reconstitution       :<?php echo $totalDetails[0]['index_recon_freq'] ?><br>
Total Net Assets
As of 12/30/2016 (updated daily) :<?php echo $totalPerformance[0]['total_net_assets'] ?><br>
Distribution Rate at NAV        :<?php echo $totalPerformance[0]['dist_rate_at_nav'] ?><br>
30-Day Standardized Yield       :<?php echo $totalPerformance[0]['standard_yield_30d'] ?><br>

<br><br>
EXPENSES<br>
As of 06/01/2016 (updated annually)<br>
Gross Expense Ratio3    :<?php echo $totalPerformance[0]['gross_expense_ratio'] ?><br>
Net Expense Ratio   :<?php echo $totalPerformance[0]['net_expense_ration'] ?><br>
INVESTMENT UNIVERSE<br>
MSCI Emerging Markets Index :Not Found<br>
UNDERLYING INDEX4<br>
LibertyQ Emerging Markets Index :<?php echo $totalDetails[0]['underlying_index'] ?><br>
TRADING CHARACTERISTICS<br>
As of 12/30/2016 (updated daily)<br>
Shares Outstanding  :<?php echo $totalPerformance[0]['shares_outstanding'] ?><br>
Daily Volume    :Not Found<br>
20-Day Avg. Volume  :Not Found<br>
TICKERS<br>
NYSE    :Not Found<br>
Intraday NAV    :Not Found<br>
<br><br>
PORTFOLIO

STATISTICS1<br>
Total Net Assets<br>
As of 12/30/2016 (updated daily)
<?php echo $totalPerformance[0]['total_net_assets'] ?><br>
Number of Holdings
As of 12/30/2016 (updated daily)
<?php echo $totalPerformance[0]['no_of_holdings'] ?><br>
Weighted Average Market Cap
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
P/B Ratio
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
P/B Ratio of Investment Universe
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
P/E Ratio (Trailing 12 months)
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
P/E Ratio of Investment Universe (Trailing 12 months)
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
P/E Ratio (Forward 12 months)
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
P/E Ratio of Investment Universe (Forward 12 months)
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br><br><br><br>

Return on Equity
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
Return on Equity of Investment Universe
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
Return on Assets
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
Return on Assets of Investment Universe
As of 11/30/2016 (updated monthly)
<?php echo $totalPerformance[0][''] ?><br>
Debt to Assets
As of 11/30/2016 (updated daily)
<?php echo $totalPerformance[0][''] ?><br>
Debt to Assets of Investment Universe
As of 11/30/2016 (updated daily)
<?php echo $totalPerformance[0][''] ?><br>




PORTFOLIO DETAILS1




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