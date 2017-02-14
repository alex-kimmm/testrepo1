<?php
//Statuses
define('CART_OPTION_ACCOUNT_LOGIN',0);
define('CART_OPTION_ACCOUNT_CREATE_ACCOUNT',1);

//Urls
define('ROOT_URL_INSURANCE','/insurance');
define('ROOT_URL_CLOTHING','/clothing');

//Categories
define('CATEGORY_INSURANCE','1');
define('CATEGORY_CLOTHING','2');
define('CATEGORY_GADGET_INSURANCE','3');
define('CATEGORY_XS_COVER','7');
define('CATEGORY_GENERAL','8');
define('CATEGORY_ZHIT','9');

//Categories IWEP equivalents
define('IWEP_CATEGORY_GADGET_INSURANCE','17');
define('IWEP_CATEGORY_XS_COVER','4');

//Statuses
define('STATUS_ERROR',0);
define('STATUS_SUCCESS',1);

//Define ALIASES FOR POLICY STATUSES IDS
define("POLICY_STATUS_NEW",1);
define("POLICY_STATUS_PENDING",2);
define("POLICY_STATUS_APPROVED",3);
define("POLICY_STATUS_PAID",4);
define("POLICY_STATUS_UNPAID",5);
define("POLICY_STATUS_CANCELED",6);
define("POLICY_STATUS_END",7);
define("POLICY_STATUS_RENEWED",8);
define("POLICY_STATUS_DELETED",9); //can be deleted only policies with status 1 (new created)

//Define ALIASES FOR TRANSACTION STATUSES
define("TRANSACTION_STATUS_START",1);
define("TRANSACTION_STATUS_FINISH",2);
define("TRANSACTION_STATUS_FAIL",3);

//Payments periods types
define("PAY_PER_PERIOD", 'month');
define("PAY_PER_YEAR",  'year');

//Quote aligns
define("QUOTE_ALIGN_LEFT", 1);
define("QUOTE_ALIGN_RIGHT", 2);

//$likeZhitPhoneOptions
define("LIKE_ZHIT_PHONE_YES", 1);
define("LIKE_ZHIT_PHONE_NO", 0);

// payment
<<<<<<< HEAD
define("PAYMENT_INSURANCE_INITIAL_PRICE", 72.0);
define("PAYMENT_RECUR_UNIT", "MONTH"); // DAY, MONTH
define("PAYMENT_RECUR_FINAL", 4); // 2, 4 - PAYMENT_RECUR_FINAL + 1; 1 is initial payment + recurring payments

define("B1G1", 569);
=======
define("PAYMENT_INSURANCE_INITIAL_PRICE", 66.0);
define("PAYMENT_TYPE", "MOTO");
define("PAYMENT_RECUR_UNIT", "MONTH"); // DAY, MONTH
define("PAYMENT_RECUR_FINAL", 4); // 2, 4 - PAYMENT_RECUR_FINAL + 1; 1 is initial payment + recurring payments
>>>>>>> test
