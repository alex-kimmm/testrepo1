*** Settings ***
Library					Selenium2Library
Library					String
Library					Collections
Library					SSHLibrary
Library					OperatingSystem
Library					HttpLibrary.HTTP
Library					RequestsLibrary
Library 				Selenium2LibraryExt
Resource			Variables.robot

*** Keywords ***
Make Claime
	Execute Javascript    window.jQuery("li.list-group-item ").find('a[href="/profile/my-policies"]')[0].click();
	Execute Javascript    window.jQuery("ul.policy-buttons").find('a[href="/claims/create/32777"]')[0].click();
# Fill Make claime fields
	# window.jQuery("form.form").find('select[name="claim_gadget_id"]')[0].click();
	Click Element	//select[@id="create-claim-product"]
	sleep	5
	Click Element	//select[@id="create-claim-product"]/optgroup[@label="Tablets"]/option[@value="1" and contains(.,"Acer - Iconia A1")]
	sleep	5
	Click Element	//select[@id="create-claim-was"]
	sleep	5
	Click Element	//select[@id="create-claim-was"]/option[@value="lost" and contains(.,"lost")]
	Input Text	//textarea[@id="create-claim-description"]	TestDescription
	sleep	5
	Input Text	//input[@id="create-claim-contact-number"]	12345678910
	sleep	5
	 # Click Element	//div[@class="file-upload-wrapper"]/button[@class="file-upload-button"]
	 # sleep	5
	Choose File		xpath=//input[@class="file-upload-input"]	${CURDIR}/pastel-pink-ivory-scented-chelsea-garden.jpg 
	# Input Text	//div[@class="file-upload-wrapper"]/input[@class="file-upload-input"]	${CURDIR}/pastel-pink-ivory-scented-chelsea-garden.jpg 
	# ${CURDIR}/pastel-pink-ivory-scented-chelsea-garden.jpg 
	sleep	5
	# Click Button  //button[@id="create-claim-submit"]
	sleep	5

View Account
	Execute Javascript    window.jQuery('a[class="dropdown-toggle"][data-toggle="dropdown"]').click();
	Execute Javascript    window.jQuery("ul.dropdown-menu").find('a[href="/profile/my-details"]')[0].click();

Forgot Password
	Input Text	//input[@id="pass-input-email"]	${ForgotPasswordEmail}
	Click Element	//button[@id="pass-input-submit"]
	sleep	${Delay}
Login On G-mail
	Open SiteUrl  https://accounts.google.com/ServiceLogin?service=mail&passive=true&rm=false&continue=https://mail.google.com/mail/&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1#identifier
	Input Text 	//input[@id="Email"]	${ForgotPasswordEmail}
	Click Element	//input[@id="next"]
	sleep	${Delay}
	Input Text 	//input[@id="Passwd"]	${ForgotPasswordPassword}
	Click Element	//input[@id="signIn"]
	sleep	${Delay}
Found letter on G-mail
	Click Element	xpath=//b[contains(text(),"ZugarZnap Your Password Reset Link")]
	sleep	${Delay}
	# click forgot password button from letter
	Click Element	 partial link=http://zz-dev.atomateapps.com/auth/changepassword
	sleep	${Delay}
Fill fields password textboxes
	Select Window	Title=Reset your password - ZugarZnap
	Input Text 	//input[@name="password"]	${ForgotPasswordPassword}
	Input Text 	//input[@name="password_confirmation"]	${ForgotPasswordPassword}
	Click Element	//button[@type="submit"]

Add product to basket xs-insurance

	Click on cover isurance dropdown
	Select first option from insurance dropdown
	Fill car fields xs-insurance
	Fill first name and last name fields
	sleep	${Delay}
	Fill postalcode field
	sleep	${Delay}
	Click on postalcode search button
	sleep	${Delay}
	Click on dropdown to select address
	sleep	${Delay}
	Select first option from address dropdown
	Fill phonenumber and email fields
	Accept terms and conditions
	sleep 	${Delay}
	Submit insurance form
	sleep 	${Delay}
	# Element Text Should Be    css=.checkout-title    total to pay now

Click on cover isurance dropdown
	Click Element	css=.btn.btn-default.dropdown-toggle
Select first option from insurance dropdown
	Click Element	//div[contains(@class,"dropDownSelect")]/ul[@class="dropdown-menu"]/li[1]/a
Fill first name and last name fields
	Input Text 	//input[@id="first-name"]	${Firstname}  
	Input Text 	//input[@id="last-name"]	${Lastname}	
Fill postalcode field
	Input Text 	//input[@id="IAddressPostcode"]	${PostalCode}
Click on postalcode search button
	Click Element	//div[@class="getcaver-inputs"]/div[1]/div/span
Click on dropdown to select address
	Click Element       //button[@id="cover_my" and contains(.,"Select an address")]
Select first option from address dropdown
	Click Element	//a[@data-value="0"]
Fill phonenumber and email fields
	Input Text	//input[@id="phone-number"]	${PhoneNumber}
	Input Text	//input[@id="email"]	${Email}
Accept terms and conditions
	Execute Javascript    window.jQuery("div.checkbox").find('input[id="accept_terms"]')[0].click();
Submit insurance form
	Focus		//button[@id="insuranceFormSubmit"]
	Click Element	//button[@id="insuranceFormSubmit"]

Add product to basket gadget insurance

	Click on cover isurance dropdown
	Select first option from insurance dropdown
	Fill first name and last name fields
	sleep	${Delay}
	Fill postalcode field
	sleep	${Delay}
	Click on postalcode search button
	sleep	${Delay}
	Click on dropdown to select address
	sleep	${Delay}
	Select first option from address dropdown
	Fill phonenumber and email fields
	Accept terms and conditions
	sleep 	${Delay}
	Submit insurance form
	sleep 	${Delay}

Fill car fields xs-insurance
	Go to   ${SiteUrl}/insurance/xs-cover/get-cover
	Input Text 	//input[@id="carNumber"]	Xs 123 

See cookie on page
	Page Should Contain Element    xpath=//a[@href="/cookie-policy"]

Accept cookie
	Click Element   xpath=//img[@onclick="acceptCookies();"]

Get page title
	${PagesTitle} =    Get Title
    Should Be Equal   ${PagesTitle}   Failz - ZugarZnap

Count Gifs
	${countGifs} =   Get Matching Xpath Count    //*[@data-playgif]
	[return]	${countGifs}

Click Load More Gifs Button
	Click Element     //button[@class="load-more" and contains (., "Load More")]

Get style
	${StyleBefore}=	Get Element Attribute		${Gif}/div@style
	[return]	${StyleBefore}

Click Play Button
	Click Element	${Gif}

Check if gif style changed
	[Arguments]		${StyleBefore}		${StyleAfter}
	Log To Console		${StyleBefore}
	Log To Console		${StyleAfter}
	Should Not Be Equal    ${StyleBefore}		${StyleAfter}
		

Get Title from page 
	${PagesTitle} =    Get Title
	[return]	${PagesTitle}
    # Should Be Equal   ${PagesTitle}   ${Title}

Share gif
	[Arguments]	${ShareButton}	${Title}

	Click Element	${ShareButton}
	Select Window 	${Title}

Count cards
	${numberOfCards} =   Get Matching Xpath Count    //div[contains(@class,"cover-me-card")]/a
	[return] 	${numberOfCards}

Get total insurance prices
	${totalPrice} =   Get Text    //div[@class="total-to-pay"]/span[2]
    Log To Console      ${totalPrice}
     Should Not Be Empty     ${totalPrice}
     [return]	${totalPrice}
    # [return]	${totalPrice}
# Get gadget insurance prices
#     ${gadgetPolicyPrice} =   Get Text    //div[@class="policy-card-body"]/p[3]
#     Log To Console      ${gadgetPolicyPrice}
#     [return]	${gadgetPolicyPrice}

Remove product from cart
	Execute Javascript    window.jQuery("div.green-to-yellow-diagonal-gradient").find('a[class="basket-remove"]')[0].click();

Make Paymant
	Click Element	//button[@type="submit"]
	sleep 		${Delay}
	Input Text 	//input[@name="cardNumber"]	${CardVisaNumber}
	Click Element	//select[@id="cardExpireMonth"]
	Click Element	//select[@id="cardExpireMonth"]/option[@value="1"]
	Click Element	//select[@id="cardExpireYear"]
	Click Element	//select[@id="cardExpireYear"]/option[@value="2024"]
	Input Text 	//input[@name="cardUserName"]	${Firstname}
	Input Text 		${CardNumber}		123
	Click Element	//button[@type="submit"]


View policy
	Click Element	//div[@class="account-list"]/ul/li[2]/a[@href="/profile/my-policies"]
	${policyBox} =   Get Matching Xpath Count    //div[@class="policy-item"]
	Should Be True 	${policyBox} > 0

View order
	Click Element	//div[@class="account-list"]/ul/li[3]/a[@href="/profile/my-orders"]
	${policyBox} =   Get Matching Xpath Count    //tr[@class="profile-orders-table-delimiter-first"]
	Should Be True 	${policyBox} > 0

View orders details
	Click Element 	//div[@class="account-tab-container"]/div/table/tbody/tr[1]/td[1]
	Page Should Contain Element		//a[@href="/cancel-policy"]

Cancel policy
	Click Element 	//div[@class="account-tab-container"]/div/table/tbody/tr[2]/td[1]/div/a[@href="/cancel-policy"]
	Page Should Contain		Cancel Policy 


Amend policy
	Click Element 	//div[@class="account-tab-container"]/div/table/tbody/tr[2]/td[1]/div/a[@href="/amend-policy"]
	Page Should Contain		Amend Policy

# ==================================================================================================
# Admin
# ==================================================================================================

	
	
Sort claims by Date
	sleep 	${Delay}
	${claimsBeforeSorting} =   Get Matching Xpath Count    //tr[@ng-repeat="model in displayedModels"]
	Input Text 		//input[@st-search="created_at"]	${Date}
	sleep 	${Delay}
	${claimsAfterSorting} =   Get Matching Xpath Count    //tr[@ng-repeat="model in displayedModels"]
	Should Be True 	${claimsBeforeSorting} > ${claimsAfterSorting}

View claim details
	Click Element	//div[@class="table-responsive"]/table/tbody/tr[1]/td/a[contains(@class,"btn")]
	Element Should Contain 	//div[contains(@class,"col-md-offset-2")]		Claim info

Sort Page quotes
	Input Text 		//input[@st-search="title"]	insurance age
	sleep 	${Delay}
	${pageQuotesAfterSort} =   Get Matching Xpath Count    //tr[@ng-repeat="model in displayedModels"]
	[return]	${pageQuotesAfterSort}

Count element
	${orders} =   Get Matching Xpath Count    //tr[@ng-repeat="model in displayedModels"]
	Should Be True 	${orders} > 0
	[return]	${orders}

View static pages
	sleep 	${Delay}
	${pages} =   Get Matching Xpath Count    //li[@ng-repeat="model in models"]
	sleep 	${Delay}
	Should Be True 	${pages} > 0

Create a quote
	sleep 	${Delay}
	Focus 		//a[@class="btn-add" and @href="http://zz-dev.atomateapps.com/admin/quotes/create"]
	Click Element 	//a[@class="btn-add" and @href="http://zz-dev.atomateapps.com/admin/quotes/create"]
	sleep 	${Delay}
	Fill textboxes		title
	Fill textboxes		uri
	Fill textboxes		redirect_url
	Input Text 		//textarea[@id="en[summary]"]	Test
	Click Element 	//select[@id="position"]
	Click Element 	//select[@id="position"]/option[@value="1"]
	Click save and submit button
	Page Should Contain		Test	

Fill textboxes
	[Arguments]		${partOfID}
	Input Text 		//input[@id="en[${partOfID}]"]	Test
Click Create Button
	[Arguments]		${partOfID}
	Click Element			//a[@class="btn-add" and @href="http://zz-dev.atomateapps.com/admin/${partOfID}/create"]
Create user
	# Click Element			//a[@class="hasAppend" and @href="http://zz-dev.atomateapps.com/admin/users"]
	Click Create Button 	users
	# Click Element			//a[@class="btn-add" and @href="http://zz-dev.atomateapps.com/admin/users/create"]
	Click Element			//select[@id="usertitle_id"]
	Click Element			//select[@id="usertitle_id"]/option[@value="4"]
	Input Text 				//input[@id="email"]		${Email} 
	Input Text 				//input[@id="password"]		${Password} 
	Input Text 				//input[@id="password_confirmation"]		${Password} 
	Input Text 				//input[@id="first_name"]		${Firstname} 
	Input Text 				//input[@id="last_name"]		${Lastname} 
	Execute Javascript   	window.jQuery('input[type="checkbox"][name="activated"]').parent().click();
	Execute Javascript   	window.jQuery('input[type="checkbox"][name="groups[2]"]').parent().click();
	Execute Javascript   	window.jQuery('input[type="checkbox"][name="superuser"]').parent().click();
	sleep 					${Delay}
	Focus					//div[@class="btn-toolbar"]/button[@id="exit"]
	sleep 					${Delay}
	Scroll to save button
	Click save and submit button
	Input Text 				//input[@type="text"]		${Email}
	sleep 					${Delay}
	Page Should Contain		${Email}
Scroll to save button
	Execute Javascript		window.scrollTo(508.66668701171875,17.600006103515625)
Edit user
	Click Element 			//div[@class="table-responsive"]/table/tbody/tr/td[2]
	Click Element			//select[@id="usertitle_id"]
	Click Element			//select[@id="usertitle_id"]/option[@value="2"]
	Scroll to save button
	Click save and submit button
	Element Text Should Be 		//div[@class="table-responsive"]/table/tbody/tr/td[3]		Mr.

Remove user
	Click Element 			//div[@class="table-responsive"]/table/tbody/tr/td[1]/div
	Confirm Action
	Input Text 				//input[@type="text"]		${Email}
	sleep 					${Delay}
	Page Should Not Contain Element		//div[@class="table-responsive"]/table/tbody/tr/td[1]/div

Create static page
	# Click Element 	//a[@class="hasAppend" and @href="http://zz-dev.atomateapps.com/admin/pages"]
	Click Create Button 	pages
	Choose File		xpath=//input[@type="file"]	${CURDIR}/pastel-pink-ivory-scented-chelsea-garden.jpg 
	Fill textboxes		title
	Fill textboxes		slug
	Click save and submit button
	sleep 					${Delay}
	Page Should Contain 		Test

Edit static page
	Click Element		//div[@class="ng-scope"]/div[2]/ul/li[16]/div/a[contains(@class,"btn")]
	Input Text 		    //input[@id="en[title]"]	TestTest
    Click Element			//div[@class="btn-toolbar"]/button[@id="exit" and @type="submit"]
    Element Text Should Be	//div[@class="ng-scope"]/div[2]/ul/li[16]/div[contains(@class,"title")]	TestTest

Remove static page
    Click Element		//div[@class="ng-scope"]/div[2]/ul/li[16]/div[2]
    Confirm Action
    sleep 					${Delay}
    Page Should Not Contain Element	    //div[@class="ng-scope"]/div[2]/ul/li[16]/div[2]

Change static page status
    Click Element		//div[@class="ng-scope"]/div[2]/ul/li[16]/div[4]/div/span[contains(@class,"fa")]
    sleep 					${Delay}
    Element Text Should Be    //div[@class="alertify-logs"]/div   Item is online.

Go to product size
    Go to   ${SiteUrl}admin/sizes

View product sizes
    ${pages} =   Get Matching Xpath Count    //tr[@class="ng-scope" and @ng-repeat="model in displayedModels"]
    sleep 	${Delay}
    Should Be True 	${pages} > 0

Create product size
    Click Element	//a[@class="btn-add" and @href="http://zz-dev.atomateapps.com/admin/sizes/create"]
    Input Text 		//input[@id="en[title]"]	Test
    Click save and submit button
    Element Text Should Be	//div[@class="table-responsive"]/table/tbody/tr[1]/td[5]	Test

Click save and submit button
	Click Element			//div[@class="btn-toolbar"]/button[@id="exit" and @type="submit"]

Edit product size
    Click Element       //table[contains(@class,"table-condensed")]/tbody/tr[1]/td/a
    Input Text 		//input[@id="en[title]"]	TestTest
    Click save and submit button
    Element Text Should Be	//div[@class="table-responsive"]/table/tbody/tr[1]/td[5]	TestTest
Delete records
	Click Element       //table[contains(@class,"table-condensed")]/tbody/tr[1]/td[1]/div/span
	Confirm Action
	sleep 	${Delay}
    Page Should Not Contain 	Test
Delete product size
    Click Element       //table[contains(@class,"table-condensed")]/tbody/tr[1]/td[1]/div/span
    Page Should Not Contain Element		//div[@class="table-responsive"]/table/tbody/tr/td[1]/div

Go to product colors
    Go to   ${SiteUrl}admin/colors

View product colors
    ${pages} =   Get Matching Xpath Count    //tr[@class="ng-scope" and @ng-repeat="model in displayedModels"]
    sleep 	${Delay}
    Should Be True 	${pages} > 0

Create product color
    Click Element	//a[@class="btn-add" and @href="http://zz-dev.atomateapps.com/admin/colors/create"]
    Input Text 		//input[@id="en[title]"]	Test
    Click save and submit button
    Element Text Should Be	//div[@class="table-responsive"]/table/tbody/tr[1]/td[4]	Test

Edit product color
    Click Element       //table[contains(@class,"table-condensed")]/tbody/tr[1]/td/a
    Input Text 		//input[@id="en[title]"]	TestTest
    Click save and submit button
    Element Text Should Be	//div[@class="table-responsive"]/table/tbody/tr[1]/td[4]	TestTest

Delete product color
    sleep 	${Delay}
    Click Element       //table[contains(@class,"table-condensed")]/tbody/tr[1]/td[1]/div/span
    sleep 	${Delay}
    Confirm Action
    Element Should Not Contain		//div[@class="table-responsive"]/table/tbody/tr/td[1]/div   TestTest

Go to product categories
    Go to   ${SiteUrl}admin/categories

View product types
    ${pages} =   Get Matching Xpath Count    //a[contains(text(),"Edit")]
    sleep 	${Delay}
    Should Be True 	${pages} > 0

Create product types
    Click Element	//a[@class="btn-add" and @href="http://zz-dev.atomateapps.com/admin/categories/create"]
    Input Text 		//input[@id="en[title]"]	Test
    Click save and submit button
    Page Should Contain     Test

Edit product types
    Click Element       //a[@href="categories/15/edit"]
    Input Text 		//input[@id="en[title]"]	TestTest

    Execute Javascript   window.jQuery('input[type="checkbox"][name="en[status]"]').parent().click();
    Click save and submit button
    sleep   ${Delay}
    Page Should Contain	    TestTest

#Delete product types
#    sleep 	${Delay}
#    Click Element       //table[contains(@class,"table-condensed")]/tbody/tr[1]/td[1]/div/span
#    sleep 	${Delay}
#    Confirm Action
#    Element Should Not Contain		//div[@class="table-responsive"]/table/tbody/tr/td[1]/div   TestTest

View slideshow
    ${pages} =   Get Matching Xpath Count    //tr[@class="ng-scope" and @ng-repeat="model in displayedModels"]
    sleep 	${Delay}
    Should Be True 	${pages} > 0

Create slideshow
    Click Element	//a[@class="btn-add" and @href="http://zz-dev.atomateapps.com/admin/slideshows/create"]
    Input Text 		//input[@id="en[title]"]	Test
    Click save and submit button
    Page Should Contain     Test

Edit slideshow
    Click Element       //table[contains(@class,"table-condensed")]/tbody/tr[1]/td/a
    Input Text 		//input[@id="en[title]"]	TestTest
    Click save and submit button
    sleep   ${Delay}
    Page Should Contain	    TestTest

Delete slideshow
    sleep 	${Delay}
    Click Element       //table[contains(@class,"table-condensed")]/tbody/tr[1]/td[1]/div/span
    sleep 	${Delay}
    Confirm Action
    sleep 	${Delay}
    Clear Element Text  //input[@type="text"]


Sort slideshows
	sleep 	${Delay}
	${slideshowsBeforeSorting} =   Get Matching Xpath Count    //tr[@ng-repeat="model in displayedModels"]
	Input Text 		//input[@type="text"]	Test
	sleep 	${Delay}
	${slideshowsAfterSorting} =   Get Matching Xpath Count    //tr[@ng-repeat="model in displayedModels"]
	Should Be True 	${slideshowsBeforeSorting} > ${slideshowsAfterSorting}

Add items to slide show
    Click Element       //table[contains(@class,"table-condensed")]/tbody/tr[1]/td/a
    Click Element       //div[contains(@class,"selectize-input")]
    Click Element       //div[contains(@class,"selectize-control")]/div[2]/div/div[@data-value="1"]
    Click Element       //div[contains(@class,"selectize-input")]
    Click Element       //div[contains(@class,"selectize-control")]/div[2]/div/div[@data-value="2"]
    Click Element       //div[contains(@class,"selectize-input")]
    Click Element       //div[contains(@class,"selectize-control")]/div[2]/div/div[@data-value="3"]
#    Click Element       //div[contains(@class,"selectize-control")]/div[2]/div/div[@data-value="4"]
    Click Element       //div[contains(@class,"selectize-input")]
    Click Element       //div[contains(@class,"selectize-control")]/div[2]/div/div[@data-value="5"]
    Click Element       //div[contains(@class,"selectize-input")]
    Click Element       //div[contains(@class,"selectize-control")]/div[2]/div/div[@data-value="6"]
    Click Element       //div[contains(@class,"selectize-input")]
    Click Element       //div[contains(@class,"selectize-control")]/div[2]/div/div[@data-value="7"]
    Click Element       //div[contains(@class,"selectize-input")]
    Click Element       //div[contains(@class,"selectize-control")]/div[2]/div/div[@data-value="8"]
    Click Element       //div[contains(@class,"selectize-input")]
    Click Element       //div[contains(@class,"selectize-control")]/div[2]/div/div[@data-value="9"]
    Click save and submit button


Remove item from slideshow
    Click Element       //div[contains(@class,"selectize-control")]/div[1]/div[@data-value="5"]
    Execute Javascript      window.jQuery("div.selectize-input").find('div[class="item active"]')[0].remove();
    Element Should Not Contain		//div[contains(@class,"selectize-input")]   girlz 1

Get Price
     ${Value} =   Get Text    //div[@class="total-to-pay"]/span[2]
     Log To Console  ${Value}
     Should Not Be Empty     ${Value}


