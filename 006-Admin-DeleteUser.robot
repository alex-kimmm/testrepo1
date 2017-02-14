#004 - Login to ZZ Admin Panel
*** Settings ***
Library           Selenium2Library
#Resource          003-Register_to_ZZ.robot

*** Variables ***
${Username1}       admin@admin.com
${Password1}       11111111
${Browser1}        Firefox
${Url1}           http://zz-dev.atomateapps.com/auth/login
${Url2}           http://zz-dev.atomateapps.com/admin/users
${Delay1}          2s
${Email1}         test123456789@admin.com

# *** Test Cases ***
# LoginToAdmin
#     Open Browser with Login Page
#     Enter User Admin Name
#     Fill Password
#     Click The Login
#     Make Sleep
#     Open Admin Dashboard Page
#     Search by Email
#     Make Sleep
#     Click Remove
#     Close popup
#     Make Sleep
#     Make Close browser


*** Keywords ***
Open Browser With Login Page
    open browser    ${Url1}    ${Browser1}
#    Maximize Browser Window

Enter User Admin Name
    Input Text    login-input-email       ${Username1}

Fill Password
    Input Text    login-input-password    ${Password1}

Click The Login
    click button  login-input-submit

Open Admin Dashboard Page
    Go To                                 ${Url2}

Search by Email
    Input Text    css=.input-sm           ${Email1}

Click Remove
    Click Element  css=.btn-link

Close popup
  Confirm Action

Make Sleep
    sleep         ${Delay1}

Do Close browser
    Close Browser
