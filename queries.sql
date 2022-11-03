#payment per day metric
SELECT 
	aaccounts.`Accounts Angaza ID` AS Account_ID,
    aaccounts.`Accounts Country`,
    (SELECT 
     	COUNT(data_portfolio.`Portfolio Derived Amount`) 
     FROM
     	data_portfolio
     WHERE
     data_portfolio.`Portfolio Derived Account Angaza ID` =  aaccounts.`Accounts Angaza ID`
     AND 
     	data_portfolio.`Portfolio Derived Amount` >= aaccounts.`Accounts Price per Day`) AS as_expected,
            (SELECT 
     	COUNT(data_portfolio.`Portfolio Derived Amount`) 
     FROM
     	data_portfolio
     WHERE
     data_portfolio.`Portfolio Derived Account Angaza ID` =  aaccounts.`Accounts Angaza ID`
     AND 
     	data_portfolio.`Portfolio Derived Amount` > 0
            AND 
             data_portfolio.`Portfolio Derived Amount` < aaccounts.`Accounts Price per Day`
            ) AS paid_any_amount,
         (SELECT 
     	COUNT(data_portfolio.`Portfolio Derived Amount`) 
     FROM
     	data_portfolio
     WHERE
     data_portfolio.`Portfolio Derived Account Angaza ID` =  aaccounts.`Accounts Angaza ID`
     AND 
     	data_portfolio.`Portfolio Derived Amount` = 0) AS failed_to_pay,
        	(REPLACE(aaccounts.`Accounts Unlock Price`, ',', '') - REPLACE(aaccounts.`Accounts Upfront Price`, ',', '')) / 			      (aaccounts.`Accounts Price per Day`) AS No_of_times_expected_to_pay
FROM
	`aaccounts` 
LEFT JOIN
	`data_portfolio`
ON 
	`aaccounts`.`Accounts Angaza ID` = `data_portfolio`.`Portfolio Derived Account Angaza ID`
LIMIT 200

#FRR
SELECT
		aaccounts.`Accounts Country`,
	  	aaccounts.`Accounts Angaza ID` AS Account_ID,
  	 ((SELECT
    	 MAX(data_portfolio.`Portfolio Derived Previous Cumulative Paid`)
     FROM 
     		data_portfolio 
     WHERE
    		data_portfolio.`Portfolio Derived Account Angaza ID` =  aaccounts.`Accounts Angaza ID`)
      /
      (REPLACE(aaccounts.`Accounts Unlock Price`, ',', '') - REPLACE(aaccounts.`Accounts Upfront Price`, ',', '') ) * 100) AS FRR
    FROM 
    	aaccounts 
    LEFT JOIN 
    	data_portfolio
    ON 
    	aaccounts.`Accounts Angaza ID`= data_portfolio.`Portfolio Derived Account Angaza ID`

   
    LIMIT 3
    
	
	#number of times expected to pay 
	SELECT
	aaccounts.`Accounts Angaza ID` AS Account_ID,
	(REPLACE(aaccounts.`Accounts Unlock Price`, ',', '') - REPLACE(aaccounts.`Accounts Upfront Price`, ',', '')) / 			      (aaccounts.`Accounts Price per Day`) AS No_of_days
FROM 
  aaccounts
  LIMIT 100
  
  #cutoff as a performance metric 
  SELECT
	aaccounts.`Accounts Country` AS country,
	aaccounts.`Accounts Angaza ID`,
	aaccounts.`Accounts Days to Cutoff` AS registered_cutoff,
    (SELECT MIN(data_portfolio.`Portfolio Derived Days to Cutoff`) FROM data_portfolio WHERE data_portfolio.`Portfolio Derived Account Angaza ID` =  aaccounts.`Accounts Angaza ID` ) AS Minimum_cutoff_days
FROM
	`aaccounts`
LEFT JOIN
	`data_portfolio`
ON
	`aaccounts`.`Accounts Angaza ID` = `data_portfolio`.`Portfolio Derived Account Angaza ID`
LIMIT 20
  
  
  #times reached not reached and payments
  SELECT
	`data_portfolio`.`Portfolio Derived Account Angaza ID`,
	`data_portfolio`.`Portfolio Derived Most Recent Payment Date`,
	`data_portfolio`.`Portfolio Derived Amount`,
    `call_cente`.`April Collections Calls List Date Called Date`, 
    `call_cente`.`April Collections Calls List Reachability`,
    (SELECT COUNT(`call_cente`.`April Collections Calls List Reachability`) FROM `call_cente` WHERE `call_cente`.`April Collections Calls List Angaza ID` = `data_portfolio`.`Portfolio Derived Account Angaza ID`) AS Not_Reached,
    (SELECT COUNT(`data_portfolio`.`Portfolio Derived Amount`) FROM `data_portfolio` WHERE data_portfolio.`Portfolio Derived Account Angaza ID` =  `call_cente`.`April Collections Calls List Angaza ID` AND  `data_portfolio`.`Portfolio Derived Amount` > 0) AS Times_paid
    
FROM
	`call_cente`
LEFT JOIN 
	`data_portfolio` 
ON
	 `call_cente`.`April Collections Calls List Angaza ID` = `data_portfolio`.`Portfolio Derived Account Angaza ID`
  WHERE 
  	    `call_cente`.`April Collections Calls List Reachability` = 'Not Reached'
 LIMIT 2000