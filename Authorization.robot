*** Settings ***
Library				Selenium2Library
Resource			Variables.robot

*** Keywords ***

Open SiteUrl
	[Arguments]		${SiteUrl}
    open browser    ${SiteUrl}    ${Browser}
    # Maximize Browser Window


Login AS Admin
#Enter User Name
    Input Text    login-input-email    ${UsernameAdmin}
#Enter Admin Password
    Input Text    login-input-password    ${Password}
#Click Login Button
    click button    login-input-submit
#Sleep and Close browser
    sleep         ${Delay}


Login User
	[Arguments]	${UsernameUser}
#Enter User UserName
    Input Text    login-input-email    ${UsernameUser}
#Enter User Password
    Input Text    login-input-password    ${Password}
#Press Login
    click button    login-input-submit
    sleep         ${Delay}




RegisterUser
#Enter First Name
	    Input Text    register-input-first-name         ${Firstname}
	    sleep         2
#Enter Last Name
	    Input Text    register-input-last-name          ${Lastname}
	    sleep         2
#Enter Email
	    Input Text    register-input-email              ${Email}
	    sleep         2
#Enter Register Password
	    Input Text    register-input-password           ${Password}
	    sleep         2
#Enter Confirm Password
	    Input Text    register-input-password_confirm   ${Password}
	    sleep         2
#Click Create Account
    click button  register-input-submit
    sleep         ${Delay}
    Element Should Be Visible	//p[@id="status-message" and contains (.,'Your account has been created, check your email for the confirmation link.')]


Activate User Account
        Maximize Browser Window
        sleep         ${Delay}
        Login User 	${UsernameAdmin}
   # Open Admin Dashboard
        Go To                                 ${SiteUrl}admin/users
   # Search by Email2
        Input Text    css=.form-control.input-sm           ${Email}
        sleep         ${Delay}
   # Click Edit
        Click Element  css=a.btn-xs
        sleep         ${Delay}
   # Click Activate checkbox
        Execute Javascript   window.jQuery('input[type="checkbox"][name="activated"]').parent().click();
        sleep         ${Delay}
   # Click Save and Exit
        click button  exit
        sleep         ${Delay}
        Logout User


  # -----------------------------------------------------------------------------
# Login Via Facebook
# 	Click Element	//button[@onclick="goToPage('/auth/facebook')"]
  # -----------------------------------------------------------------------------

 Change My-Detailes data
 	# Change user status to Miss.
 	Click Element	//select[@name="usertitle_id"]
 	Click Element	//select[@name="usertitle_id"]/option[@value="4"]
 	# Change userName
 	Input Text	//input[@name="first_name"]	${NewUaserFirstName}
 	Input Text	//input[@name="last_name"]	${NewUserLastName}
 	# Tape old password
 	Input Text	//input[@name="old_password"]	${Password}
 	Input Text	//input[@name="password"]	${NewPassword}
 	Input Text	//input[@name="password_confirmation"]	${NewPassword}
 	Click Element	css=.btn.btn-yellow-save

Logout User
# Logout
	Go To                                 ${SiteUrl}
   Execute Javascript    window.jQuery('a[class="dropdown-toggle"][data-toggle="dropdown"]').click();
# Exit from site
   Execute Javascript    window.jQuery("ul.dropdown-menu").find('a[href="/auth/logout"]')[0].click();
   sleep         ${Delay}

   # Click Element	html/body/div[1]/div/section[2]/div/nav/div/div[3]/ul/li


Deletion User Account
    Maximize Browser Window
    Go To                                 ${SiteUrl}auth/login
	Login User 	${UsernameAdmin}
    sleep   ${Delay}
#Open Admin Dashboard Page
    Go To                                 ${SiteUrl}admin/users
#Search by Email
    Input Text    css=.input-sm           ${Email}
    sleep         ${Delay}
#Click Remove
    Click Element  css=.btn-link
    sleep         ${Delay}
#Close popup
    Confirm Action
    sleep         ${Delay}
