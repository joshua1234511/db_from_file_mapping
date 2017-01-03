<?php

require 'spreadsheet-reader-master/SpreadsheetReader.php';
require_once(dirname(__FILE__) . '/includes/config.php');
require_once(dirname(__FILE__) . '/includes/class.database.php');
require_once(dirname(__FILE__) . '/includes/class.functions.php');
require_once(dirname(__FILE__) . '/includes/fields.php');

$GLOBALS['db'] = new database($servername, $username, $password, $dbname);
$db =& $GLOBALS['db'];
$db->connect();

$etf_id = 1; // Currently only 1 ETF

$ReaderSS            = new SpreadsheetReader(FILES_PATH . 'ssProvide.csv');
$ReaderOwlnav        = new SpreadsheetReader(FILES_PATH . 'OWLnav.xlsx');
$ReaderOwlSharesTest = new SpreadsheetReader(FILES_PATH . 'OwlSharesTest.csv');

$countSS = 0;
foreach ($ReaderSS as $RowSS) {
    if ($countSS != 0 && $RowSS[0] != '' && $countSS < 2) {
        //performance
        $countOwlnav = 0;
        foreach ($ReaderOwlnav as $RowOwlnav) {
            if ($countOwlnav != 0 && $RowOwlnav[0] != '' && $countOwlnav < 2) {
                $countOwlSharesTest = 0;
                foreach ($ReaderOwlSharesTest as $RowOwlSharesTest) {
                    if ($countOwlSharesTest != 0 && $RowOwlSharesTest[0] != '' && $countOwlSharesTest < 2) {
                        
                        // etf_performance
                        //$price = $RowOwlSharesTest[];
                        $price                               = 0;
                        //$ytd_returns = $RowOwlSharesTest[];
                        $ytd_returns                         = 0;
                        $nav_change_percent                  = (functions::valueCheck($RowOwlSharesTest[8]) / functions::valueCheck($RowOwlSharesTest[7])) * 100;
                        $nav_change                          = functions::valueCheck($RowOwlSharesTest[8]);
                        $nav                                 = functions::valueCheck($RowOwlSharesTest[7]);
                        $market_price_change_percent         = (functions::valueCheck($RowOwlSharesTest[10]) / functions::valueCheck($RowOwlSharesTest[9])) * 100;
                        $market_price_change                 = functions::valueCheck($RowOwlSharesTest[10]);
                        $market_price                        = functions::valueCheck($RowOwlSharesTest[9]);
                        $nav_returns_1yr                     = functions::valueCheck($RowOwlSharesTest[22]);
                        $market_returns_1yr                  = functions::valueCheck($RowOwlSharesTest[23]);
                        $nav_returns_3yr                     = functions::valueCheck($RowOwlSharesTest[26]);
                        $market_returns_3yr                  = functions::valueCheck($RowOwlSharesTest[27]);
                        $nav_returns_5yr                     = functions::valueCheck($RowOwlSharesTest[30]);
                        $market_returns_5yr                  = functions::valueCheck($RowOwlSharesTest[31]);
                        $nav_returns_10yr                    = functions::valueCheck($RowOwlSharesTest[34]);
                        $market_returns_10yr                 = functions::valueCheck($RowOwlSharesTest[35]);
                        $nav_change_since_inception          = functions::valueCheck($RowOwlSharesTest[11]);
                        $market_price_change_since_inception = functions::valueCheck($RowOwlSharesTest[12]);
                        $total_net_assets                    = functions::valueCheck($RowOwlnav[10]); // OWLnav
                        $dist_rate_at_nav                    = functions::valueCheck($RowOwlnav[8]); // OWLnav
                        //$standard_yield_30d = functions::valueCheck($RowOwlSharesTest[]);//ss Not Resolved
                        $standard_yield_30d                  = 0;
                        $gross_expense_ratio                 = functions::valueCheck($RowOwlSharesTest[16]);
                        $net_expense_ration                  = functions::valueCheck($RowOwlSharesTest[17]);
                        $shares_outstanding                  = functions::valueCheck($RowOwlnav[9]); // OWLnav
                        //$tickers = functions::valueCheck($RowOwlSharesTest[]);// static Not Resolved
                        $tickers                             = "";
                        $no_of_holdings                      = 0; //cc Update
                        $ltcg_amount                         = functions::valueCheck($RowOwlSharesTest[43]);
                        $ltcg_record_date                    = functions::valueCheckDate($RowOwlSharesTest[38]);
                        $ltcg_ex_date                        = functions::valueCheckDate($RowOwlSharesTest[39]);
                        $ltcg_reinvestment_date              = functions::valueCheckDate($RowOwlSharesTest[40]);
                        $ltcg_payable_date                   = functions::valueCheckDate($RowOwlSharesTest[41]);
                        $ltcg_reinvestment_price             = functions::valueCheck($RowOwlSharesTest[42]);
                        $stcg_amount                         = functions::valueCheck($RowOwlSharesTest[44]);
                        $stcg_record_date                    = functions::valueCheckDate($RowOwlSharesTest[38]);
                        $stcg_ex_date                        = functions::valueCheckDate($RowOwlSharesTest[39]);
                        $stcg_reinvestment_date              = functions::valueCheckDate($RowOwlSharesTest[40]);
                        $stcg_payable_date                   = functions::valueCheckDate($RowOwlSharesTest[41]);
                        $stcg_reinvestment_price             = functions::valueCheck($RowOwlSharesTest[42]);
                        $income_amount                       = functions::valueCheck($RowOwlSharesTest[50]);
                        $income_record_date                  = functions::valueCheckDate($RowOwlSharesTest[45]);
                        $income_ex_date                      = functions::valueCheckDate($RowOwlSharesTest[46]);
                        $income_reinvestment_date            = functions::valueCheckDate($RowOwlSharesTest[47]);
                        $income_payable_date                 = functions::valueCheckDate($RowOwlSharesTest[48]);
                        $income_reinvestment_price           = functions::valueCheck($RowOwlSharesTest[49]);
                        //$tdps_amount = functions::valueCheck($RowOwlSharesTest[]);//ss
                        $tdps_amount                         = 0;
                        //$tdps_record_date = functions::valueCheckDate($RowOwlSharesTest[]);//ss
                        $tdps_record_date                    = date("Y-m-d");
                        //$tdps_ex_date = functions::valueCheckDate($RowOwlSharesTest[]);//ss
                        $tdps_ex_date                        = date("Y-m-d");
                        //$tdps_reinvestment_date = functions::valueCheckDate($RowOwlSharesTest[]);//ss
                        $tdps_reinvestment_date              = date("Y-m-d");
                        //$tdps_payable_date = functions::valueCheckDate($RowOwlSharesTest[]);//ss
                        $tdps_payable_date                   = date("Y-m-d");
                        //$tdps_reinvestment_price = functions::valueCheck($RowOwlSharesTest[]);//ss
                        $tdps_reinvestment_price             = 0;
                        $bid_ask_spread                      = functions::valueCheck($RowOwlSharesTest[13]);
                        $avg_mp_nav_inception                = functions::valueCheck($RowOwlSharesTest[14]);
                        $avg_mp_nav_close                    = functions::valueCheck($RowOwlSharesTest[15]);
                        $nav_high                            = 0; //cc Update
                        $nav_low                             = 0; //cc Update
                        $mp_high                             = 0; //cc Update
                        $mp_low                              = 0; //cc Update
                        $total_period_days                   = 0; //cc Update
                        $nav_days                            = 0; //cc Update
                        $premium_days                        = 0; //cc Update
                        $discount_days                       = 0; //cc Update
                        $greatest_premium                    = 0; //Not Resolved
                        $greatest_discount                   = 0; //Not Resolved
                        $sp_benchmark_return_1yr             = functions::valueCheck($RowOwlSharesTest[24]);
                        $owl500_index_return_1yr             = functions::valueCheck($RowOwlSharesTest[25]);
                        $sp_benchmark_return_3yr             = functions::valueCheck($RowOwlSharesTest[28]);
                        $owl500_index_return_3yr             = functions::valueCheck($RowOwlSharesTest[29]);
                        $sp_benchmark_return_5yr             = functions::valueCheck($RowOwlSharesTest[32]);
                        $owl500_index_return_5yr             = functions::valueCheck($RowOwlSharesTest[33]);
                        $sp_benchmark_return_10yr            = functions::valueCheck($RowOwlSharesTest[36]);
                        $owl500_index_return_10yr            = functions::valueCheck($RowOwlSharesTest[37]);
                        $sp500_each_yr                       = functions::valueCheck($RowOwlSharesTest[20]);
                        $owl500_index_each_yr                = functions::valueCheck($RowOwlSharesTest[21]);
                        $cytd_nav                            = functions::valueCheck($RowOwlSharesTest[18]);
                        $cytd_mp                             = functions::valueCheck($RowOwlSharesTest[19]);
                        
                        
                        $sql_etf_performance = "INSERT INTO etf_performance (etf_id, price, ytd_returns, nav_change_percent, nav_change, nav, market_price_change_percent, market_price_change, market_price, nav_returns_1yr, market_returns_1yr, nav_returns_3yr, market_returns_3yr, nav_returns_5yr, market_returns_5yr, nav_returns_10yr, market_returns_10yr, nav_change_since_inception, market_price_change_since_inception, total_net_assets, dist_rate_at_nav, standard_yield_30d, gross_expense_ratio, net_expense_ration, shares_outstanding, tickers, no_of_holdings, ltcg_amount, ltcg_record_date, ltcg_ex_date, ltcg_reinvestment_date, ltcg_payable_date, ltcg_reinvestment_price, stcg_amount, stcg_record_date, stcg_ex_date, stcg_reinvestment_date, stcg_payable_date, stcg_reinvestment_price, income_amount, income_record_date, income_ex_date, income_reinvestment_date, income_payable_date, income_reinvestment_price, tdps_amount, tdps_record_date, tdps_ex_date, tdps_reinvestment_date, tdps_payable_date, tdps_reinvestment_price, bid_ask_spread, avg_mp_nav_inception, avg_mp_nav_close, nav_high, nav_low, mp_high, mp_low, total_period_days, nav_days, premium_days, discount_days, greatest_premium, greatest_discount, sp_benchmark_return_1yr, owl500_index_return_1yr, sp_benchmark_return_3yr, owl500_index_return_3yr, sp_benchmark_return_5yr, owl500_index_return_5yr, sp_benchmark_return_10yr, owl500_index_return_10yr, sp500_each_yr, owl500_index_each_yr, cytd_nav, cytd_mp) VALUES (" . $etf_id . "," . $price . "," . $ytd_returns . "," . $nav_change_percent . "," . $nav_change . "," . $nav . "," . $market_price_change_percent . "," . $market_price_change . "," . $market_price . "," . $nav_returns_1yr . "," . $market_returns_1yr . "," . $nav_returns_3yr . "," . $market_returns_3yr . "," . $nav_returns_5yr . "," . $market_returns_5yr . "," . $nav_returns_10yr . "," . $market_returns_10yr . "," . $nav_change_since_inception . "," . $market_price_change_since_inception . "," . $total_net_assets . "," . $dist_rate_at_nav . "," . $standard_yield_30d . "," . $gross_expense_ratio . "," . $net_expense_ration . "," . $shares_outstanding . ",'" . $tickers . "'," . $no_of_holdings . "," . $ltcg_amount . ",'" . $ltcg_record_date . "','" . $ltcg_ex_date . "','" . $ltcg_reinvestment_date . "','" . $ltcg_payable_date . "'," . $ltcg_reinvestment_price . "," . $stcg_amount . ",'" . $stcg_record_date . "','" . $stcg_ex_date . "','" . $stcg_reinvestment_date . "','" . $stcg_payable_date . "'," . $stcg_reinvestment_price . "," . $income_amount . ",'" . $income_record_date . "','" . $income_ex_date . "','" . $income_reinvestment_date . "','" . $income_payable_date . "'," . $income_reinvestment_price . "," . $tdps_amount . ",'" . $tdps_record_date . "','" . $tdps_ex_date . "','" . $tdps_reinvestment_date . "','" . $tdps_payable_date . "'," . $tdps_reinvestment_price . "," . $bid_ask_spread . "," . $avg_mp_nav_inception . "," . $avg_mp_nav_close . "," . $nav_high . "," . $nav_low . "," . $mp_high . "," . $mp_low . "," . $total_period_days . "," . $nav_days . "," . $premium_days . "," . $discount_days . "," . $greatest_premium . "," . $greatest_discount . "," . $sp_benchmark_return_1yr . "," . $owl500_index_return_1yr . "," . $sp_benchmark_return_3yr . "," . $owl500_index_return_3yr . "," . $sp_benchmark_return_5yr . "," . $owl500_index_return_5yr . "," . $sp_benchmark_return_10yr . "," . $owl500_index_return_10yr . "," . $sp500_each_yr . "," . $owl500_index_each_yr . "," . $cytd_nav . "," . $cytd_mp . ")";
                        
                        if ($db->query($sql_etf_performance) === TRUE) {
                        	//Update Calculations After Insertion
                            $last_id_etf_performance = $db->lastId();
                            //Get Nav
                            $queryNav                = $db->query("SELECT nav  FROM etf_performance WHERE id =" . $last_id_etf_performance);
                            $total                   = $db->getRow($queryNav);
                            $nav                     = (isset($total['nav']) ? $total['nav'] : 0);
                            //Number of Holdings
                            //We calculate based on holdings file provided by State Street
                            $queryNumberOfHoldings   = $db->query("SELECT COUNT(id) as count FROM etf_performance");
                            $total                   = $db->getRow($queryNumberOfHoldings);
                            $no_of_holdings          = (isset($total['count']) ? $total['count'] : 0);
                            
                            //Nav High/Low
                            $queryNavHighLow = $db->query("SELECT MIN(nav) AS low, MAX(nav) AS high FROM etf_performance WHERE created_on >= curdate() - INTERVAL DAYOFWEEK(curdate())+52 WEEK AND created_on <= curdate()");
                            $total           = $db->getRow($queryNavHighLow);
                            $nav_high        = (isset($total['high']) ? $total['high'] : 0);
                            $nav_low         = (isset($total['low']) ? $total['low'] : 0);
                            
                            //Market Price High/Low
                            $queryMarketPriceHighLow = $db->query("SELECT MIN(market_price) AS low, MAX(market_price) AS high FROM etf_performance WHERE created_on >= curdate() - INTERVAL DAYOFWEEK(curdate())+52 WEEK AND created_on <= curdate()");
                            $total                   = $db->getRow($queryMarketPriceHighLow);
                            $mp_high                 = (isset($total['high']) ? $total['high'] : 0);
                            $mp_low                  = (isset($total['low']) ? $total['low'] : 0);
                            
                            //Count Days 52 Week Range
                            $queryCountDays             = $db->query(" SELECT (SELECT COUNT(id) FROM etf_performance WHERE created_on >= curdate() - INTERVAL DAYOFWEEK(curdate())+52 WEEK AND created_on <= curdate() AND nav = " . $nav . " ) AS nav_days,(SELECT COUNT(id) FROM etf_performance WHERE created_on >= curdate() - INTERVAL DAYOFWEEK(curdate())+52 WEEK AND created_on <= curdate() AND nav > " . $nav . ") AS premium_days,  COUNT(id) AS discount_days FROM etf_performance WHERE created_on >= curdate() - INTERVAL DAYOFWEEK(curdate())+52 WEEK AND created_on <= curdate() AND nav < " . $nav . "");
                            $total                      = $db->getRow($queryCountDays);
                            $nav_days                   = (isset($total['nav_days']) ? $total['nav_days'] : 0);
                            $premium_days               = (isset($total['premium_days']) ? $total['premium_days'] : 0);
                            $discount_days              = (isset($total['discount_days']) ? $total['discount_days'] : 0);
                            $sql_etf_performance_update = "UPDATE etf_performance SET no_of_holdings =" . $no_of_holdings . ", nav_high =" . $nav_high . ", nav_low =" . $nav_low . ", mp_high =" . $mp_high . ", mp_low =" . $mp_low . ", nav_days =" . $nav_days . ", premium_days =" . $premium_days . ", discount_days =" . $discount_days . " WHERE id =" . $last_id_etf_performance . " ";
                            
                            $db->query($sql_etf_performance_update);
                            
                        } else {
                            echo "Error: " . $sql_etf_performance . "<br>" . $db->error;
                        }
                    }
                    $countOwlSharesTest++;
                }
                
            }
            $countOwlnav++;
            
        }
        //securities
        $ticker          = functions::valueCheck($RowSS[12]);
        $name_securities = functions::valueCheck($RowSS[13]);
        $asset_class     = functions::valueCheck($RowSS[15]);
        $currency        = functions::valueCheck($RowSS[68]);
        $sql_securities  = "INSERT INTO securities (ticker, name, asset_class, currency)
					VALUES (" . $ticker . "," . $name_securities . "," . $asset_class . "," . $currency . ")";
        
        if ($db->query($sql_securities) === TRUE) {
            $last_id_securities   = $db->lastId();
            //etf_portfolio
            $security_id          = $last_id_securities;
            //$weight_etf_portfolio = functions::valueCheck($RowSS[]);//calc
            $weight_etf_portfolio = 0;
            $shares               = functions::valueCheck($RowSS[45]);
            $market_value_base    = functions::valueCheck($RowSS[58]);
            $market_value_local   = functions::valueCheck($RowSS[59]);
            $sql_etf_portfolio    = "INSERT INTO etf_portfolio (security_id, weight, shares, market_value_base, market_value_local, etf_id)
						VALUES (" . $security_id . "," . $weight_etf_portfolio . "," . $shares . "," . $market_value_base . "," . $market_value_local . "," . $etf_id . ")";
            
            if ($db->query($sql_etf_portfolio) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql_etf_portfolio . "<br>" . $db->error;
            }
        } else {
            echo "Error: " . $sql_securities . "<br>" . $db->error;
        }
        
        //etf_sectors
        // $name_etf_sectors = functions::valueCheck($RowSS[]);
        // $weight_etf_sectors = functions::valueCheck($RowSS[]);
        // $sql_etf_sectors = "INSERT INTO etf_sectors (etf_id, name, weight)
        // VALUES ("$etf_id.",".$name_etf_sectors.",".$weight_etf_sectors.")";
        
        // if ($db->query($sql_etf_sectors) === TRUE) {
        //     echo "New record created successfully";
        // } else {
        //     echo "Error: " . $sql_etf_sectors . "<br>" . $db->error;
        // }
    }
    $countSS++;
}
