*** Settings ***
Library           Selenium2Library

*** Variables ***
${Browser}        Firefox
${SiteUrl}        http://zz-dev.atomateapps.com/
${Delay}          5s


#*** Test Cases1 ***
#OpenZZTest
#    Open Browser to the Start Page
#    sleep    ${Delay}
#    [Teardown]    Close Browser

*** Keywords ***
Open Browser to the Start Page
    open browser    ${SiteUrl}    ${Browser}
