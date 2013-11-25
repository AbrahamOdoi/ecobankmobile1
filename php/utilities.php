<?php
			session_start();
			// $phone = $_POST['phone'];
			$phone = $_SESSION['phone'];

			$obtained = $_POST['utility'];
			$amount = $_POST['amount'];
			$charge = 0.05;

			$dbc = mysql_connect("localhost", "heart", "F0undAti0n#1");
			mysql_select_db("db_heart_foundation");

			$query = mysql_query("SELECT * FROM account WHERE phoneNumber = $phone ");
			while ($row = mysql_fetch_array($query)) {
				$ecode = $row['electricityCode'];
				$wcode = $row['waterCode'];
				$senderAccountNumber = $row['accountNumber'];
				//$paymentAccount = $row[''];
				$availableBalance = $row['abalance'];
				$currentBalance = $row['cbalance'];
				$name = $row['name'];
			}
			if ($obtained == 'electricity') {
				if ($amount < $currentBalance)
					electricity($amount, $availableBalance, $currentBalance, $ecode, $senderAccountNumber, $name);
				else {
					print "<p> You do not have enough balance in your account to make this transaction </p>";
					print "<p> Your balance is " . $currentBalance . " cedis</p>";
				}
			} elseif ($obtained == 'water') {
				if ($amount < $currentBalance)
					water($amount, $availableBalance, $currentBalance, $wcode, $senderAccountNumber, $name);
				else {
					print "<p> You do not have enough balance in your account to make this transaction </p>";
					print "<p> Your balance is " . $currentBalance . " cedis</p>";
				}
			} elseif ($obtained == 'phoneCredits') {

			} else {
				print "<p>You did not select any utility</p>";
			}

			function electricity($amount, $availableBalance, $currentBalance, $ecode, $senderAccountNumber, $name) {
				$availableBalance = $availableBalance - $amount;
				$currentBalance = $currentBalance - $amount - $charge;
				mysql_query("UPDATE test.account SET cbalance = $currentBalance,abalance = $availableBalance WHERE account.accountNumber = $senderAccountNumber");
				$insert=mysql_query("INSERT INTO test.electricity (name,accountNumber,amount,code) VALUES ('$name','$senderAccountNumber','$amount','$ecode')");
				print "<p style='color:skyblue; font-size:20px;'>Your remaining balance is " . $currentBalance . " cedis </p>";
				print "<p style='color:skyblue; font-size:15px;'>You paid " . $amount . " cedis for Electricity Bill </p>";
			}

			function water($amount, $availableBalance, $currentBalance, $wcode, $senderAccountNumber, $name) {
				$availableBalance = $availableBalance - $amount;
				$currentBalance = $currentBalance - $amount - $charge;
				mysql_query("UPDATE test.account SET cbalance = $currentBalance,abalance = $availableBalance WHERE account.accountNumber = $senderAccountNumber");
				mysql_query("INSERT INTO test.water (name,accountNumber,amount,code) VALUES ('$name','$senderAccountNumber','$amount','$wcode')");
				print "<p>Your remaining balance is " . $currentBalance . " cedis</p>";
				print "<p>You paid " . $amount . " cedis for Water Bill </p>";
			}
			?>