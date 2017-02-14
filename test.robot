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
    Search by Category
    Sleep 3

*** Keywords ***
Match Produtcs Title
    ${PagesTitle}   Get Title
    Should Be Equal   ${PagesTitle}   [admin] Products – Untitled website

Match Products List
    Get Matching Xpath Count	//tr[@class="ng-scope" and @ng-repeat="model in displayedModels"]

Search by Category
    Input Text    css=.input-sm   Cover
