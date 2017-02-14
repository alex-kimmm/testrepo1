*** Settings ***

Library					Selenium2Library
Library					String
Library					Collections
Library					SSHLibrary
Library					OperatingSystem
Library					HttpLibrary.HTTP
Library					RequestsLibrary

Resource				Authorization.robot
Resource				Variables.robot
*** Variables ***
${SiteUrl}		http://zz-stag.atomateapps.com/
${Browser}		Firefox
		
*** Keywords ***
Check footer if exists
	Page Should Contain Element		//footer[contains(@class,"footer") and contains(@class,"hidden-xs")]

Footer sections
	# open browser 		${SiteUrl}			${Browser}
	# sleep 		3
		:FOR    ${i}    IN RANGE    1    3
	\	Page Should Contain Element		//div[@class="footer-menu"]/div[${i}]/ul

Footer links Insurange section
	# open browser 		${SiteUrl}			${Browser}
	Login User		${UsernameAdminStag}	${PasswordStag}
	${TitlesLis} =	Create List
	${URLs} =	Create List 	http://zz-stag.atomateapps.com/insurance/gadget-cover/about		http://zz-stag.atomateapps.com/insurance/xs-cover/about		http://zz-stag.atomateapps.com/about-us
	sleep 		3
		:FOR    ${i}    IN RANGE    2    5
	\	Page Should Contain Element		//div[@class="footer-menu"]/div[1]/ul/li[${i}]
	\	Click Element 					//div[@class="footer-menu"]/div[1]/ul/li[${i}]/a
	\	${url} =  Execute Javascript  return window.location.href;
	\	Append To List	${TitlesLis}	${url}
	\	Log to console 	${TitlesLis}
	Should be equal 	${TitlesLis} 	${URLs}

Footer links MyAccount section

	# Login User		${UsernameAdminStag}	${PasswordStag}
	${TitlesLis} =	Create List
	${URLs} =	Create List 	http://zz-stag.atomateapps.com/profile/my-policies		http://zz-stag.atomateapps.com/profile/my-details
		:FOR    ${i}    IN RANGE    2    4
	\	Page Should Contain Element		//div[@class="footer-menu"]/div[2]/ul/li[${i}]
	\	Click Element 					//div[@class="footer-menu"]/div[2]/ul/li[${i}]/a
	\	${url} =  Execute Javascript  return window.location.href;
	\	Append To List	${TitlesLis}	${url}
	\	Log to console 	${TitlesLis}
	Should be equal 	${TitlesLis} 	${URLs}
Footer links AnyIssue section
	# open browser 		${SiteUrl}			${Browser}
	# Login User		${UsernameAdminStag}	${PasswordStag}
	${TitlesLis} =	Create List
	${URLs} =	Create List 	http://zz-stag.atomateapps.com/contactz		http://zz-stag.atomateapps.com/faqs		http://zz-stag.atomateapps.com/profile/my-policies		http://zz-stag.atomateapps.com/complaintz
	sleep 		3
		:FOR    ${i}    IN RANGE    2    6
	\	Page Should Contain Element		//div[@class="footer-menu"]/div[3]/ul/li[${i}]
	\	Click Element 					//div[@class="footer-menu"]/div[3]/ul/li[${i}]/a
	\	${url} =  Execute Javascript  return window.location.href;
	\	Append To List	${TitlesLis}	${url}
	\	Log to console 	${TitlesLis}
	Should be equal 	${TitlesLis} 	${URLs}	


Check if Component contain Text
	[Arguments]		${ComponentLocator}
	${Textfromdiv} =	Get Text 		${ComponentLocator}
	Should Match Regexp		${Textfromdiv}		.
	Log to console 		${Textfromdiv}
Assert an image is visible
	[Arguments]		${ElementId}
	${img src}=  Get element attribute  ${ElementId}@style
	Log to console 	${img src}
	${desiredNumber}=    Remove String    ${img src}		");
	${desiredNumber1}=    Fetch From Right    ${desiredNumber}		"/
	Log to console 	${desiredNumber1}
	sleep 		3
	log to console 		${SiteUrl}${desiredNumber1}
	HttpLibrary.HTTP.GET 		${SiteUrl}${desiredNumber1}
	sleep 		3
	Response Status Code Should Equal	200
More great stuff Assert image is visible
	[Arguments]		${ElementId}
	${img src}=  Get element attribute  ${ElementId}@src
	Log to console 	${img src}
	${desiredNumber}=    Remove String    ${img src}		");
	${desiredNumber1}=    Fetch From Right    ${desiredNumber}		"/
	Log to console 	${desiredNumber1}
	sleep 		3
	log to console 		${desiredNumber1}
	HttpLibrary.HTTP.GET 		${desiredNumber1}
	sleep 		3
	Response Status Code Should Equal	200
TrustPilot section
	Page Should Contain Element	 	//section[@class="trustpilot-1024"]
	Click Element 			//section[@class="trustpilot-1024"]/div/div/div/div
	sleep 		5
	Select Window 	 url=https://uk.trustpilot.com/review/zugarznap.com 			
	${url} =  Execute Javascript  return window.location.href;
	
	Should be equal 	https://uk.trustpilot.com/review/zugarznap.com 	${url}	
