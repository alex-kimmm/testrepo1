*** Settings ***

Library					Selenium2Library
Library					String
Library					Collections
Library					SSHLibrary
Library					OperatingSystem
Library					HttpLibrary.HTTP
Library					RequestsLibrary
Resource				Keywords.robot
Resource				Authorization.robot
Resource				Variables.robot
*** Variables ***
${SiteUrl}		http://zz-stag.atomateapps.com/
${Browser}		Firefox
		

*** Test Cases ***


Insurance Page

	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}insurance
	Check if Component contain Text 		//div[@id="headerBlock"]
	Assert an image is visible				//div[contains(@class,"row")]/div[1]/div[2]/div[contains(@class,"benefits-img")]
	Check if Component contain Text 		//div[@class="white-div-content"]
	Check if Component contain Text 		//div[contains(@class,"row")]/div[2]/span
	Assert an image is visible				//div[contains(@class,"row")]/div[1]/div[@class="music-musician-bg"]
	Check if Component contain Text 		//div[contains(@class,"row")]/div[1]/div[@class="music-musician-bg"]
	Check if Component contain Text 		//div[contains(@class,"row")]/div[1]/a[contains(@class,"btn")]
	Assert an image is visible				//div[contains(@class,"row")]/div[2]/div[@class="music-musician-bg"]
	Check if Component contain Text 		//div[contains(@class,"row")]/div[2]/div[@class="music-musician-bg"]
	Check if Component contain Text 		//div[contains(@class,"row")]/div[2]/a[contains(@class,"btn")]
	Assert an image is visible				//div[contains(@class,"row")]/div[3]/div[@class="music-musician-bg"]
	Check if Component contain Text 		//div[contains(@class,"row")]/div[3]/div[@class="music-musician-bg"]
	Check if Component contain Text 		//div[contains(@class,"row")]/div[3]/div[contains(@class,"btn-cover-me ")]
	Assert an image is visible				//div[contains(@class,"row")]/div[4]/div[@class="music-musician-bg"]
	Check if Component contain Text 		//div[contains(@class,"row")]/div[4]/div[@class="music-musician-bg"]
	Check if Component contain Text 		//div[contains(@class,"row")]/div[4]/div[contains(@class,"btn-cover-me ")]
	Check if Component contain Text 		//div[@class="great-stuff-content"]
	Check if Component contain Text 		//div[contains(@class,"container")]/h3/..
	More great stuff Assert image is visible 		//div[contains(@class,"container")]/div[1]/div/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[1]/div/div/div[1]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[2]/div/div/div[1]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[3]/div/div/div[1]/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section

Competitions Page
	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}face-of-zz
	Check if Component contain Text 		//div[@id="headerBlock"]
	Check if Component contain Text 		//div[@class="nav-points"]
	Check if Component contain Text 		//div[contains(@class,"row") and contains(@class,"musician")]
	Assert an image is visible				//div[@class="musician-img"]/img[contains(@class,"img-responsive")]

	Check if Component contain Text 		//div[@class="white-div-content"]
	Assert an image is visible				//div[@class="white-div"]/div[2]/div[@class="benefits-img"]
	Check if Component contain Text 		//div[contains(@class,"row") and contains(@class,"benefits-content")]/a
	More great stuff Assert image is visible 		//div[contains(@class,"container")]/div[1]/div/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[1]/div/div/div[1]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[2]/div/div/div[1]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[3]/div/div/div[1]/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section

Music Page
	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}music
	Check if Component contain Text 		//div[@id="headerBlock"]
	Check if Component contain Text 		//div[@class="white-div-content"]
	Assert an image is visible				//div[contains(@class,"benefits-img")]
	Check if Component contain Text 		//div[@id="b3"]
	Check if Component contain Text 		//div[contains(@class,"musician") and contains(@class,"main-artist")]
	More great stuff Assert image is visible				//div[contains(@class,"musician-img")]/img[contains(@class,"img-responsive")]
	Check if Component contain Text 		//div[contains(@class,"row") and contains(@class,"cover-me")]/div[1]
	Check if Component contain Text 		//div[contains(@class,"row") and contains(@class,"cover-me")]/div[2]
	Check if Component contain Text 		//div[contains(@class,"row") and contains(@class,"cover-me")]/div[3]
	Check if Component contain Text 		//div[contains(@class,"row") and contains(@class,"cover-me")]/div[4]
	Check if Component contain Text 		//div[contains(@class,"row") and contains(@class,"cover-me")]/div[5]
	Check if Component contain Text 		//div[contains(@class,"row") and contains(@class,"cover-me")]/div[6]
	Check if Component contain Text 		//div[contains(@class,"row") and contains(@class,"cover-me")]/div[7]
	Assert an image is visible				//div[contains(@class,"row") and contains(@class,"cover-me")]/div[1]/div[1]
	Assert an image is visible				//div[contains(@class,"row") and contains(@class,"cover-me")]/div[2]/div[1]
	Assert an image is visible				//div[contains(@class,"row") and contains(@class,"cover-me")]/div[3]/div[1]
	Assert an image is visible				//div[contains(@class,"row") and contains(@class,"cover-me")]/div[4]/div[1]
	Assert an image is visible				//div[contains(@class,"row") and contains(@class,"cover-me")]/div[5]/div[1]
	Assert an image is visible				//div[contains(@class,"row") and contains(@class,"cover-me")]/div[6]/div[1]
	Assert an image is visible				//div[contains(@class,"row") and contains(@class,"cover-me")]/div[7]/div[1]
	More great stuff Assert image is visible 		//div[contains(@class,"container")]/div[1]/div/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[1]/div/div/div[1]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[2]/div/div/div[1]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[3]/div/div/div[1]/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section

StupidHappenz Page
	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}failz
	Check if Component contain Text 		//div[@id="headerBlock"]
	More great stuff Assert image is visible 		//div[@class="row"]/div[contains(@class,"col-xs-12")]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[1]/div/div/div[1]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[2]/div/div/div[1]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[@class="great-stuff-content"]/div[2]/div[3]/div/div/div[1]/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section


Insurance Gadget About
	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}insurance/gadget-cover/about
	Check if Component contain Text 		//div[@class="insurance-about"]/section[contains(@class,"insurance-landing")]/div/div/div
	Check if Component contain Text 		//div[@class="nav-points"]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[1]/div[2]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[2]/div[2]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[3]/div[2]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[1]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[2]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[3]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[contains(@class,"container")]/div[1]/div/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section

Insurance Gadget Rewards
	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}insurance/gadget-cover/rewards
	Check if Component contain Text 		//div[@class="insurance-about"]/section[contains(@class,"insurance-landing")]/div/div/div
	Check if Component contain Text 		//div[@class="nav-points"]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[1]/div[2]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[2]/div[2]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[3]/div[2]	
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[1]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[2]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[3]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[contains(@class,"container")]/div[1]/div/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section

Insurance Gadget GetCover
	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}insurance/gadget-cover/get-cover
	Check if Component contain Text 		//div[@class="insurance-about"]/section[contains(@class,"insurance-landing")]/div/div/div
	Check if Component contain Text 		//div[@class="cover-me"]/div[1]/div
	Check if Component contain Text 		//div[@class="cover-me"]/div[2]/div
	Assert an image is visible 				//div[@class="cover-me"]/div[1]/div/div
	Assert an image is visible 				//div[@class="cover-me"]/div[2]/div/div
	More great stuff Assert image is visible 		//div[contains(@class,"container")]/div[1]/div/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section

Insurance Xs About
	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}insurance/xs-cover/about
	Check if Component contain Text 		//div[@class="insurance-about"]/section[contains(@class,"insurance-landing")]/div/div/div
	Check if Component contain Text 		//div[@class="nav-points"]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[1]/div[2]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[2]/div[2]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[3]/div[2]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[1]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[2]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[3]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[contains(@class,"container")]/div[1]/div/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section

Insurance Xs Rewards
	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}insurance/xs-cover/rewards
	Check if Component contain Text 		//div[@class="insurance-about"]/section[contains(@class,"insurance-landing")]/div/div/div
	Check if Component contain Text 		//div[@class="nav-points"]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[1]/div[2]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[2]/div[2]
	Check if Component contain Text 		//div[contains(@class,"container")]/div[contains(@class,"benefits-content")]/div[3]/div[2]	
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[1]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[2]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 	//div[contains(@class,"benefits-content")]/div[3]/div/div[@class="insurance-about-img"]/img[contains(@class,"img-responsive")]
	More great stuff Assert image is visible 		//div[contains(@class,"container")]/div[1]/div/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section

Insurance Xs GetCover
	open browser 		${SiteUrl}			${Browser}
	Go to 	${SiteUrl}insurance/xs-cover/get-cover
	Check if Component contain Text 		//div[@class="insurance-about"]/section[contains(@class,"insurance-landing")]/div/div/div
	Check if Component contain Text 		//div[@class="cover-me"]/div[1]/div
	Check if Component contain Text 		//div[@class="cover-me"]/div[2]/div
	Assert an image is visible 				//div[@class="cover-me"]/div[1]/div/div
	Assert an image is visible 				//div[@class="cover-me"]/div[2]/div/div
	More great stuff Assert image is visible 		//div[contains(@class,"container")]/div[1]/div/img[contains(@class,"img-responsive")]
	Check footer if exists
	Footer sections
	Footer links Insurange section
	Footer links MyAccount section
	Footer links AnyIssue section
	TrustPilot section


















