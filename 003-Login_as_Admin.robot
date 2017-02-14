
*** Settings ***
Library           Selenium2Library

*** Variables ***
${Username}       admin@admin.com
${Password}       11111111
${Browser}        Firefox
${Url}            http://zz-dev.atomateapps.com/auth/login
${Delay}          5s

#*** Test Cases ***
#LoginTest
#    Open Browser to the Login Page
#    Enter User Name
#    Enter Password
#    Click Login
#    sleep    ${Delay}
#    [Teardown]    Close Browser

*** Keywords ***
Open Browser To The Login Page
    open browser    ${Url}    ${Browser}
    Maximize Browser Window

Enter User Name
    Input Text    login-input-email    ${Username}

Enter Admin Password
    Input Text    login-input-password    ${Password}

Click Login Button
    click button    login-input-submit

Sleep and Close browser
    sleep         ${Delay}
    [Teardown]    Close Browser
