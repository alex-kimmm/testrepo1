
*** Settings ***
Library           Selenium2Library

*** Variables ***
${Login}              admin@admin.com
${Pwd}                11111111
${Fox}                Firefox
${SiteUrl}            http://zz-dev.atomateapps.com/auth/login
${Freeze}             2s
${HomeURL}            http://zz-dev.atomateapps.com/

*** Test Cases ***
LoginTest
  #  Open Browser to the Login Page
  #  Enter User Name
  #  Enter Admin Password
  #  Click Login Button
   Open Firefox Browser
  #  Open Home page
   Press Gadget Insurance
   Do Freeze
   Do Freeze

*** Keywords ***
# Open Browser To The Login Page
#     open browser    ${SiteUrl}    ${Fox}
#     # Maximize Browser Window
#
# Enter User Name
#     Input Text    login-input-email    ${Login}
#
# Enter Admin Password
#     Input Text    login-input-password    ${Pwd}
#
# Click Login Button
#     click button    login-input-submit

Open Firefox Browser
  Open Browser    ${HomeURL}

# Open Home page
#   Go To           ${HomeURL}

Press Gadget Insurance
  Execute Javascript   window.jQuery('a[href="/insurance/gadget-insurance"]').parent().click();
    # Click Element xpath=/x:html/x:body/x:div[1]/x:div/x:section[3]/x:div/x:div[3]/x:div/x:div/x:div/x:div[1]/x:div/x:a

Do Freeze
    sleep   ${Freeze}

    # window.jQuery("div.account-card").find('a[href="/claims/create/32757"]' and contains(.,"Make a claim"))[0].click()
    # Click Logout
    #     Execute Javascript    window.jQuery('a[class="dropdown-toggle"][data-toggle="dropdown"]').click();
    #
    # Exit from site
    #     Execute Javascript   window.jQuery('ul[class="dropdown-menu"]).find('a[href="/auth/logout"']).click();
    #     Execute Javascript    window.jQuery("ul.dropdown-menu").find('a[href="/auth/logout"]')[0].click();
    # Click Activate checkbox
    #     Execute Javascript   window.jQuery('input[type="checkbox"][name="activated"]').parent().click();
