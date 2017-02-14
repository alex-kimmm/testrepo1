#2nd TS - Login to ZZ
*** Settings ***
Resource            Authorization.robot
Resource            Variables.robot
Resource            UserActivity.robot
*** Variables ***


*** Test Cases ***
#001 - Open First Time
First Open
    Open SiteUrl  ${SiteUrl}
    [Teardown]    Close Browser

#002 - Register new user to ZZ
Register new User
    Open SiteUrl  ${SiteUrl}auth/register
    RegisterUser
    Element Should Be Visible   //p[@id="status-message" and contains (.,'Your account has been created, check your email for the confirmation link.')]
    Deletion User Account
    [Teardown]    Close Browser

#003 - Login to ZZ as Admin
Login to ZZ as Admin
    Open SiteUrl   ${SiteUrl}auth/login
    Login User      ${UsernameAdmin}
    Element Should Be Visible   //a[@href="/profile/my-details" and contains (.,'my details')]
    Logout User

    [Teardown]    Close Browser

#004 - Admin - Activate User Account
Activation User Account
    Open SiteUrl  ${SiteUrl}auth/register
    RegisterUser
    Activate User Account
    Go to         ${SiteUrl}auth/login
    Login User    ${UsernameUser}
    sleep   3
    Logout User
    Deletion User Account
    [Teardown]    Close Browser

#005 - Login with registered User
Login as User
    Open SiteUrl  ${SiteUrl}auth/register
    RegisterUser
    Go to         ${SiteUrl}auth/login
    Activate User Account
    Go to         ${SiteUrl}auth/login
    Login User    ${UsernameUser}
    Logout User
    Deletion User Account
 #   Logout User
    [Teardown]    Close Browser

# #006 - Delete registered user
# Delete registered user
#     Open SiteUrl   ${SiteUrl}auth/login
#     Deletion User Account
#     [Teardown]    Close Browser


View User Account
    Open SiteUrl  ${SiteUrl}auth/register
    RegisterUser
    Go to         ${SiteUrl}auth/login
    Activate User Account
    Go to         ${SiteUrl}auth/login
    Login User    ${UsernameUser}
    Page Should Contain Button  css=.btn.btn-yellow-save
    [Teardown]    Close Browser

# Make a Claime
#     View Account
#     Make Claime

# Login Using Facebook Account
#     Open SiteUrl   ${SiteUrl}auth/login
#     Login Via Facebook

Change User Details
    Open SiteUrl  ${SiteUrl}auth/register
    RegisterUser
    Go to         ${SiteUrl}auth/login
    Activate User Account
    Go to         ${SiteUrl}auth/login
    Login User    ${UsernameUser}
    Change My-Detailes data
    Element Text Should Be    css=.zz-message.zz-message-white    Your profile has been updated
    Logout User
    Deletion User Account
    [Teardown]    Close Browser

Reset Password
    Open SiteUrl  ${SiteUrl}auth/resetpassword
    Forgot Password
    Element Text Should Be    css=.zz-message.zz-message-white    We have e-mailed your password reset link. Please check your email in a few minutes.
    Login On G-mail
    Found letter on G-mail
    Fill fields password textboxes
    Element Text Should Be    css=.zz-message.zz-message-white    You have successfully reset your password.

    [Teardown]    Close Browser

Add To basket As Guest
    Open SiteUrl  ${SiteUrl}insurance/xs-cover/get-cover
    Add product to basket as guest
    [Teardown]    Close Browser

Check if MyAcount and Logout links are displayed instead sign in
    Open SiteUrl  ${SiteUrl}auth/register
    RegisterUser
    Go to         ${SiteUrl}auth/login
    Activate User Account
    Go to         ${SiteUrl}auth/login
    Login User    ${UsernameUser}
    Execute Javascript    window.jQuery('a[class="dropdown-toggle"][data-toggle="dropdown"]').click();
    # Element Text Should Be    css=.dropdown-menu    MY ACCOUNTSIGN OUT
    Page Should Contain Element    xpath=//ul[@class="dropdown-menu"]/li[1]
    Page Should Contain Element    xpath=//ul[@class="dropdown-menu"]/li[2]
    Logout User
    Deletion User Account
    [Teardown]    Close Browser

View and accept cookie policy
    Open SiteUrl  ${SiteUrl}auth/login
    Page Should Contain Element    xpath=//a[@href="/cookie-policy"]
    Click Element   xpath=//img[@onclick="acceptCookies();"]
    sleep   ${Delay}
    Element Should Not Be Visible    xpath=//a[@href="/cookie-policy"]
