#005 - Admin Panel - Activate Account
*** Settings ***
Library           Selenium2Library


*** Variables ***
${Username2}       admin@admin.com
${Password2}       11111111
${Browser2}        Firefox
${Url1a}           http://zz-dev.atomateapps.com/auth/login
${Url2a}           http://zz-dev.atomateapps.com/admin/users
${Delay2}          2s
${Email2}          test123456789@admin.com

# *** Test Cases ***
# LoginToAdmin
#     Open Browser Login Page
#     Enter Admin UserName
#     Enter The Password
#     Tap On Login
#     Do Sleep
#     Open Admin Dashboard
#     Search by Email2
#     Do Sleep
#     Click Edit
#     Do Sleep
#     Click Activate checkbox
#     Do Sleep
#     Click Save and Exit
#     Do Sleep
#     Make Close browser


*** Keywords ***
Open Browser Login Page
    open browser    ${Url1a}    ${Browser2}
#    Maximize Browser Window

Enter Admin UserName
    Input Text    login-input-email       ${Username2}

Enter The Password
    Input Text    login-input-password    ${Password2}

Tap On Login
    click button  login-input-submit

Open Admin Dashboard
    Go To                                 ${Url2a}

Search by Email2
    Input Text    css=.form-control.input-sm           ${Email2}

Click Edit
    Click Element  css=a.btn-xs

Click Activate checkbox
    Execute Javascript   window.jQuery('input[type="checkbox"][name="activated"]').parent().click();

Click Save and Exit
    click button  exit

Do Sleep
    sleep         ${Delay2}

Make Close browser
    Close Browser
