
# 2.2.1.3
*** Settings ***
Resource            Authorization.robot
Resource            Variables.robot
Resource            UserActivity.robot

*** Variables ***
# ${Title} test1
*** Test Cases ***
#Login to ZZ as Admin
Login to ZZ as Admin
    Open SiteUrl    ${SiteUrl}auth/login
    Login AS Admin
    Go To           ${SiteUrl}admin/colors/create
    Maximize Browser Window
    Fill Color Title
    Freeze a bit
    Select The Color
    Freeze a bit
    Activate The Color



    # [Teardown]    Close Browser

*** Keywords ***
Fill Color Title
  Input Text  //input[@name="en[title]"]  test1

Select The Color
    # Click Element //input[@id="color_code"]
    Execute Javascript    window.jQuery("li.color-item").find('a[class="purple color-link"]').click()

Activate The Color
    Execute Javascript   window.jQuery('input[type="checkbox"][data-language="en"]').click();

Freeze a bit
    Sleep   ${Delay}
