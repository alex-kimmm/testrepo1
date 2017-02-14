#2nd TS - Login to ZZ
*** Settings ***
Library           Selenium2Library

*** Variables ***
${Username01}       test123456789@admin.com
${Password01}       11111111
${Browser01}        Firefox
${Url01}            http://zz-dev.atomateapps.com/auth/login
${Delay01}          3s

#*** Test Cases ***
# LoginTest
#    Open Browser on Login Page
#    Enter User Name
#    Enter Password
#    Click Login
#    Freeze
#    Logout
#    Freeze
#    Exit from site
#    Freeze
#    Freeze
#    Close the browser

*** Keywords ***
Open Browser on Login Page
    open browser    ${Url01}    ${Browser01}
    Maximize Browser Window

Enter User UserName
    Input Text    login-input-email    ${Username01}

Enter User Password
    Input Text    login-input-password    ${Password01}

Press Login
    click button    login-input-submit

Freeze
    sleep         ${Delay01}

Logout
    Execute Javascript    window.jQuery('a[class="dropdown-toggle"][data-toggle="dropdown"]').click();
    

Exit from site
    Execute Javascript    window.jQuery("ul.dropdown-menu").find('a[href="/auth/logout"]')[0].click();

Close the browser
    Close Browser
