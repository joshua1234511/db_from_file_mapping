<?php
    
    require 'spreadsheet-reader-master/SpreadsheetReader.php';

    require_once 'config.php';
    require_once 'fields.php';
    $etf_id = 1;

    $Reader = new SpreadsheetReader(FILES_PATH . 'OWLnav.xlsx');
    $count = 0;
    foreach ($Reader as $Row) {
    	print_r("<pre>");
        print_r($Row);
        print_r("</pre>");
        if($count != 0){
			$Reader1 = new SpreadsheetReader(FILES_PATH . 'OwlSharesTest.csv');
		    $count1 = 0;
		    foreach ($Reader1 as $Row1) {
		    	print_r("<pre>");
		        print_r($Row1);
		        print_r("</pre>");
		        if($count1 != 0){
					// etf_performance
					//$price = $Row1[];
					$price = 0;
					$ytd_returns = $Row1[5];
					$nav_change_percent = ($Row1[8]/$Row1[7])*100;
					$nav_change = $Row1[8];
					$nav = $Row1[7];
					$market_price_change_percent = ($Row1[10]/$Row1[9])*100;
					$market_price_change = $Row1[10];
					$market_price = $Row1[9];
					$nav_returns_1yr = $Row1[22];
					$market_returns_1yr = $Row1[23];
					$nav_returns_3yr = $Row1[26];
					$market_returns_3yr = $Row1[27];
					$nav_returns_5yr = $Row1[30];
					$market_returns_5yr = $Row1[31];
					$nav_returns_10yr = $Row1[34];
					$market_returns_10yr = $Row1[35];
					$nav_change_since_inception = $Row1[11];
					$market_price_change_since_inception = $Row1[12];
					$total_net_assets = $Row[10]; // OWLnav
					$dist_rate_at_nav = $Row[8];  // OWLnav
					//$standard_yield_30d = $Row1[];//ss
					$standard_yield_30d = 0;
					$gross_expense_ratio = $Row1[16];
					$net_expense_ration = $Row1[17];
					$shares_outstanding = $Row[9]; // OWLnav
					//$tickers = $Row1[];// static
					$tickers = "";
					//$no_of_holdings = $Row1[];//ss
					$no_of_holdings = 0;
					$ltcg_amount = $Row1[43];
					$ltcg_record_date = $Row1[38];
					$ltcg_ex_date = $Row1[39];
					$ltcg_reinvestment_date = $Row1[40];
					$ltcg_payable_date = $Row1[41];
					$ltcg_reinvestment_price = $Row1[42];
					$stcg_amount = $Row1[44];
					$stcg_record_date = $Row1[38];
					$stcg_ex_date = $Row1[39];
					$stcg_reinvestment_date = $Row1[40];
					$stcg_payable_date = $Row1[41];
					$stcg_reinvestment_price = $Row1[42];
					$income_amount = $Row1[50];
					$income_record_date = $Row1[45];
					$income_ex_date = $Row1[46];
					$income_reinvestment_date = $Row1[47];
					$income_payable_date = $Row1[48];
					$income_reinvestment_price = $Row1[49];
					//$tdps_amount = $Row1[];//ss
					$tdps_amount = 0;
					//$tdps_record_date = $Row1[];//ss
					$tdps_record_date = date("Y-m-d");
					//$tdps_ex_date = $Row1[];//ss
					$tdps_ex_date = date("Y-m-d");
					//$tdps_reinvestment_date = $Row1[];//ss
					$tdps_reinvestment_date = date("Y-m-d");
					//$tdps_payable_date = $Row1[];//ss
					$tdps_payable_date = date("Y-m-d");
					//$tdps_reinvestment_price = $Row1[];//ss
					$tdps_reinvestment_price = 0;
					$bid_ask_spread = $Row1[13];
					$avg_mp_nav_inception = $Row1[14];
					$avg_mp_nav_close = $Row1[15];
					//$nav_high = $Row1[];//cc
					$nav_high = 0;
					//$nav_low = $Row1[];//cc
					$nav_low = 0;
					//$mp_high = $Row1[];//cc
					$mp_high = 0;
					//$mp_low = $Row1[];//cc
					$mp_low = 0;
					//$total_period_days = $Row1[];//cc
					$total_period_days = 0;
					//$nav_days = $Row1[];//cc
					$nav_days = 0;
					//$premium_days = $Row1[];//cc
					$premium_days = 0;
					//$discount_days = $Row1[];//cc
					$discount_days = 0;
					//$greatest_premium = $Row1[];//cc
					$greatest_premium = 0;
					//$greatest_discount = $Row1[];//cc
					$greatest_discount = 0;
					//$premium_discount_range_days_1 = $Row1[];//cc
					$premium_discount_range_days_1 = 0;
					//$premium_discount_range_days_2 = $Row1[];//cc
					$premium_discount_range_days_2 = 0;
					//$premium_discount_range_days_3 = $Row1[];//cc
					$premium_discount_range_days_3 = 0;
					//$premium_discount_range_days_4 = $Row1[];//cc
					$premium_discount_range_days_4 = 0;
					$sp_benchmark_return_1yr = $Row1[24];
					$owl500_index_return_1yr = $Row1[25];
					$sp_benchmark_return_3yr = $Row1[28];
					$owl500_index_return_3yr = $Row1[29];
					$sp_benchmark_return_5yr = $Row1[32];
					$owl500_index_return_5yr = $Row1[33];
					$sp_benchmark_return_10yr = $Row1[36];
					$owl500_index_return_10yr = $Row1[37];
					$sp500_each_yr = $Row1[20];
					$owl500_index_each_yr = $Row1[21];
					$cytd_nav = $Row1[18];
					$cytd_mp = $Row1[19];
	        

		    		$sql_etf_performance = "INSERT INTO etf_performance (etf_id, price, ytd_returns, nav_change_percent, nav_change, nav, market_price_change_percent, market_price_change, market_price, nav_returns_1yr, market_returns_1yr, nav_returns_3yr, market_returns_3yr, nav_returns_5yr, market_returns_5yr, nav_returns_10yr, market_returns_10yr, nav_change_since_inception, market_price_change_since_inception, total_net_assets, dist_rate_at_nav, standard_yield_30d, gross_expense_ratio, net_expense_ration, shares_outstanding, tickers, no_of_holdings, ltcg_amount, ltcg_record_date, ltcg_ex_date, ltcg_reinvestment_date, ltcg_payable_date, ltcg_reinvestment_price, stcg_amount, stcg_record_date, stcg_ex_date, stcg_reinvestment_date, stcg_payable_date, stcg_reinvestment_price, income_amount, income_record_date, income_ex_date, income_reinvestment_date, income_payable_date, income_reinvestment_price, tdps_amount, tdps_record_date, tdps_ex_date, tdps_reinvestment_date, tdps_payable_date, tdps_reinvestment_price, bid_ask_spread, avg_mp_nav_inception, avg_mp_nav_close, nav_high, nav_low, mp_high, mp_low, total_period_days, nav_days, premium_days, discount_days, greatest_premium, greatest_discount, premium_discount_range_days_1, premium_discount_range_days_2, premium_discount_range_days_3, premium_discount_range_days_4, sp_benchmark_return_1yr, owl500_index_return_1yr, sp_benchmark_return_3yr, owl500_index_return_3yr, sp_benchmark_return_5yr, owl500_index_return_5yr, sp_benchmark_return_10yr, owl500_index_return_10yr, sp500_each_yr, owl500_index_each_yr, cytd_nav, cytd_mp) VALUES (".$etf_id.",".$price.",".$ytd_returns.",".$nav_change_percent.",".$nav_change.",".$nav.",".$market_price_change_percent.",".$market_price_change.",".$market_price.",".$nav_returns_1yr.",".$market_returns_1yr.",".$nav_returns_3yr.",".$market_returns_3yr.",".$nav_returns_5yr.",".$market_returns_5yr.",".$nav_returns_10yr.",".$market_returns_10yr.",".$nav_change_since_inception.",".$market_price_change_since_inception.",".$total_net_assets.",".$dist_rate_at_nav.",".$standard_yield_30d.",".$gross_expense_ratio.",".$net_expense_ration.",".$shares_outstanding.",".$tickers.",".$no_of_holdings.",".$ltcg_amount.",".$ltcg_record_date.",".$ltcg_ex_date.",".$ltcg_reinvestment_date.",".$ltcg_payable_date.",".$ltcg_reinvestment_price.",".$stcg_amount.",".$stcg_record_date.",".$stcg_ex_date.",".$stcg_reinvestment_date.",".$stcg_payable_date.",".$stcg_reinvestment_price.",".$income_amount.",".$income_record_date.",".$income_ex_date.",".$income_reinvestment_date.",".$income_payable_date.",".$income_reinvestment_price.",".$tdps_amount.",".$tdps_record_date.",".$tdps_ex_date.",".$tdps_reinvestment_date.",".$tdps_payable_date.",".$tdps_reinvestment_price.",".$bid_ask_spread.",".$avg_mp_nav_inception.",".$avg_mp_nav_close.",".$nav_high.",".$nav_low.",".$mp_high.",".$mp_low.",".$total_period_days.",".$nav_days.",".$premium_days.",".$discount_days.",".$greatest_premium.",".$greatest_discount.",".$premium_discount_range_days_1.",".$premium_discount_range_days_2.",".$premium_discount_range_days_3.",".$premium_discount_range_days_4.",".$sp_benchmark_return_1yr.",".$owl500_index_return_1yr.",".$sp_benchmark_return_3yr.",".$owl500_index_return_3yr.",".$sp_benchmark_return_5yr.",".$owl500_index_return_5yr.",".$sp_benchmark_return_10yr.",".$owl500_index_return_10yr.",".$sp500_each_yr.",".$owl500_index_each_yr.",".$cytd_nav.",".$cytd_mp.")";

					if ($conn->query($sql_etf_performance) === TRUE) {
					    $last_id_etf_performance = $conn->insert_id;
					} else {
					    echo "Error: " . $sql_etf_performance . "<br>" . $conn->error;
					}
				}
				$count1++;

		    }
		    
		}
		$count++;
        
    }
    
    
	// $sql_securities = "INSERT INTO securities (ticker, name, asset_class, currency)
	// VALUES (".$ticker.",".$name_securities.",".$asset_class.",".$currency.")";

	// if ($conn->query($sql_securities) === TRUE) {
	//     $last_id_securities = $conn->insert_id;
	// } else {
	//     echo "Error: " . $sql_securities . "<br>" . $conn->error;
	// }

	// $sql_etf_portfolio = "INSERT INTO etf_portfolio (security_id, weight, shares, market, value, etf_id)
	// VALUES (".$security_id.",".$weight_etf_portfolio.",".$shares.",".$market.",".$value.",".$etf_id.")";

	// if ($conn->query($sql_etf_portfolio) === TRUE) {
	//     echo "New record created successfully";
	// } else {
	//     echo "Error: " . $sql_etf_portfolio . "<br>" . $conn->error;
	// }

	// $sql_etf_sectors = "INSERT INTO etf_sectors (etf_id, name, weight)
	// VALUES ("$etf_id.",".$name_etf_sectors.",".$weight_etf_sectors.")";

	// if ($conn->query($sql_etf_sectors) === TRUE) {
	//     echo "New record created successfully";
	// } else {
	//     echo "Error: " . $sql_etf_sectors . "<br>" . $conn->error;
	// }