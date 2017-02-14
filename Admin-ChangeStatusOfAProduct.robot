# 2.2.1.3
*** Settings ***
Resource            Authorization.robot
Resource            Variables.robot
Resource            UserActivity.robot

*** Variables ***
${SKU}  0011
${Price}  20.55

*** Test Cases ***
#Login to ZZ as Admin
Login to ZZ as Admin
# CREATE A PRODUCT
    Open SiteUrl    ${SiteUrl}auth/login
    Maximize Browser Window
    Login AS Admin
    Go To           ${SiteUrl}admin/products
    Click on Edit button
    Activate product checkbox
    Save and Close
    [Teardown]    Close Browser

*** Keywords ***
Click on Edit button
  Click Element   xpath=(//a[@class='btn btn-default btn-xs'])[1]
Activate product checkbox
  Execute Javascript   window.jQuery('input[type="checkbox"][name="en[status]"]').parent().click();
Save and Close
  Click Button  exit
Freeze a bit
  Sleep   ${Delay}
