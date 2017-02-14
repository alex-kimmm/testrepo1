#2nd TS - Login to ZZ
*** Settings ***
Library           Selenium2Library

*** Variables ***
${Firstname}      Alex
${Lastname}       Testing1
${Email}          test123456789@admin.com
${Password1}      11111111
${Browser}        Firefox
${RegisterUrl}        http://zz-dev.atomateapps.com/auth/register
${Delay}          5s

#*** Test Cases ***
#LoginTest
#    Open Browser to the Register Page
#    Enter First Name
#    Enter Last Name
#    Enter Email
#    Enter Password
#    Enter Confirm Password
#    Click Create Account
#    sleep    ${Delay}
#    [Teardown]    Close Browser

*** Keywords ***
Open Browser to the Register Page
    open browser    ${RegisterUrl}    ${Browser}
    Maximize Browser Window

Enter First Name
    Input Text    register-input-first-name         ${Firstname}

Enter Last Name
    Input Text    register-input-last-name          ${Lastname}

Enter Email
    Input Text    register-input-email              ${Email}

Enter Register Password
    Input Text    register-input-password           ${Password1}

Enter Confirm Password
    Input Text    register-input-password_confirm   ${Password1}

Click Create Account
    click button  register-input-submit
