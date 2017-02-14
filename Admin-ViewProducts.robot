# 2.2.1.1
*** Settings ***
Resource            Authorization.robot
Resource            Variables.robot
Resource            UserActivity.robot

# *** Variables ***
# ${PagesTitle}   Products

*** Test Cases ***
#Login to ZZ as Admin
Login to ZZ as Admin
    Open SiteUrl    ${SiteUrl}auth/login
    Login AS Admin
    Go To           ${SiteUrl}admin/products
    Match Produtcs Title
    Match Products List
    Freeze a bit
    Sort by Category up
    Freeze a bit
    Sort by Category down
    Freeze a bit
    Search by Category
    Freeze a bit

    [Teardown]    Close Browser


*** Keywords ***
Match Produtcs Title
    ${PagesTitle}   Get Title
    Should Be Equal   ${PagesTitle}   [admin] Products – Untitled website

Match Products List
    Get Matching Xpath Count	//tr[@class="ng-scope" and @ng-repeat="model in displayedModels"]

Search by Category
    Input Text    css=.input-sm   Cover

Freeze a bit
  Sleep   ${Delay}

Sort by Category up
  Click Element  xpath=//th[@class="category_name st-sort"]
  #and @st-sort="category_name"

Sort by Category down
    Click Element  xpath=//th[@class="category_name st-sort st-sort-ascent"]

Clear input search
  Clear Element Text  css=.input-sm
