#2nd TS - Login to ZZ
*** Settings ***
Resource            Authorization.robot
Resource            Variables.robot
Resource            UserActivity.robot
*** Variables ***


*** Test Cases ***
#001 - Open First Time
First Open
    Open SiteUrl  ${SiteUrl}
    [Teardown]    Close Browser

#002 - Register new user to ZZ
Register new User
    Open SiteUrl  ${SiteUrl}auth/register 
    RegisterUser
    Element Should Be Visible   //p[@id="status-message" and contains (.,'Your account has been created, check your email for the confirmation link.')]
    Deletion User Account
    [Teardown]    Close Browser

#004 - Admin - Activate User Account
# Activation User Account
    Open SiteUrl  ${SiteUrl}auth/register 
    RegisterUser
    Activate User Account
    Login User  ${UsernameUser}
    sleep   3
    Logout User
    Deletion User Account

    [Teardown]    Close Browser

#005 - Login with registered User
# Login as User
    Open SiteUrl  ${SiteUrl}auth/register 
    RegisterUser
    Go to   ${SiteUrl}auth/login
    Activate User Account
    Go to   ${SiteUrl}auth/login
    Login User  ${UsernameUser}
    Logout User
    Deletion User Account
 #   Logout User
    [Teardown]    Close Browser

# #006 - Delete registered user
# Delete registered user
#     Open SiteUrl   ${SiteUrl}auth/login
#     Deletion User Account
#     [Teardown]    Close Browser


# View User Account
    Open SiteUrl  ${SiteUrl}auth/register 
    RegisterUser
    Go to   ${SiteUrl}auth/login
    Activate User Account
    Go to   ${SiteUrl}auth/login
    Login User  ${UsernameUser}
    Page Should Contain Button  css=.btn.btn-yellow-save
    [Teardown]    Close Browser

# Make a Claime
    Open SiteUrl  ${SiteUrl}auth/login
    # Execute Javascript    window.jQuery('a[class="dropdown-toggle"][data-toggle="dropdown"]').click();
    Login User  ${UsernameAdmin}
    # Execute Javascript    window.jQuery("ul.dropdown-menu").find('a[href="/profile/my-details"]')[0].click();
    Make Claime

# Login Using Facebook Account
#     Open SiteUrl   ${SiteUrl}auth/login
#     Login Via Facebook

# Change User Details
    Open SiteUrl  ${SiteUrl}auth/register 
    RegisterUser
    Go to   ${SiteUrl}auth/login
    Activate User Account
    Go to   ${SiteUrl}auth/login
    Login User  ${UsernameUser}
    Change My-Detailes data
    Element Text Should Be    css=.zz-message.zz-message-white    Your profile has been updated
    Logout User
    Deletion User Account
    [Teardown]    Close Browser

Reset Password
    Open SiteUrl  ${SiteUrl}auth/resetpassword
    Forgot Password
    Element Text Should Be    css=.zz-message.zz-message-white    We have e-mailed your password reset link. Please check your email in a few minutes.
    Login On G-mail
    Found letter on G-mail
    Fill fields password textboxes
    Element Text Should Be    css=.zz-message.zz-message-white    You have successfully reset your password.

    [Teardown]    Close Browser

Add To Basket XS As Guest
    Open SiteUrl  ${SiteUrl}insurance/xs-cover/get-cover
    Add product to basket xs-insurance
    Get Price
    [Teardown]    Close Browser

Add To Basket Gadget As Guest
    Open SiteUrl  ${SiteUrl}insurance/gadget-cover/about
    Add product to basket gadget insurance
    Get Price
    [Teardown]    Close Browser

# Check if MyAcount and Logout links are displayed instead sign in
    Open SiteUrl  ${SiteUrl}auth/register 
    RegisterUser
    Go to   ${SiteUrl}auth/login
    Activate User Account
    Go to   ${SiteUrl}auth/login
    Login User  ${UsernameUser}
    Execute Javascript    window.jQuery('a[class="dropdown-toggle"][data-toggle="dropdown"]').click();
    # Element Text Should Be    css=.dropdown-menu    MY ACCOUNTSIGN OUT  
    Page Should Contain Element    xpath=//ul[@class="dropdown-menu"]/li[1]
    Page Should Contain Element    xpath=//ul[@class="dropdown-menu"]/li[2]
    Logout User
    Deletion User Account
    [Teardown]    Close Browser

View and accept cookie policy
    Open SiteUrl  ${SiteUrl}auth/login
    See cookie on page
    Accept cookie
    sleep   ${Delay}
    Element Should Not Be Visible    xpath=//a[@href="/cookie-policy"]
    [Teardown]    Close Browser

Open Failz Section
    Open SiteUrl  ${SiteUrl}failz
    Get page title
    sleep   ${Delay}
    ${countBeforeClickButton} =  Count Gifs
    Click Load More Gifs Button
    sleep   ${Delay}
    ${countAfterClickButton} =   Count Gifs
    Should Be True    ${countAfterClickButton} > ${countBeforeClickButton}
    Log To Console    ${countAfterClickButton}
    Log To Console    ${countBeforeClickButton}
    [Teardown]    Close Browser 

Check Play Gif
    Open SiteUrl  ${SiteUrl}failz
    ${StyleBefore} =    Get style   
    Click Play Button
    ${StyleAfter} =    Get style 
    Check if gif style changed      ${StyleBefore}      ${StyleAfter}
    [Teardown]    Close Browser 

Share Gif On Facebook

    Open SiteUrl  ${SiteUrl}failz
    Click Play Button
    Share gif   ${FbShareButton}    ${FacebookTitlePage}
    ${PagesTitle} =     Get Title from page    
    Should Be Equal   ${PagesTitle}   ${FacebookTitlePage}
     [Teardown]    Close Browser 

Share Gif On Twitter

    Open SiteUrl  ${SiteUrl}failz
    Click Play Button
    Share gif   ${TwShareButton}    ${TwitterTitlePage}
    ${PagesTitle} =     Get Title from page     
    Should Be Equal   ${PagesTitle}   ${TwitterTitlePage}
     [Teardown]    Close Browser 

Open insurance Page
    Open SiteUrl  ${SiteUrl}insurance
    ${Title} =  Get Title from page
    Should Match Regexp   ${Title}    ${InsuraanceTitleStartWith}
     [Teardown]    Close Browser 

Check if exists insurance products
    Open SiteUrl  ${SiteUrl}insurance
    ${numberOfCards} =  Count cards
    Log To Console     ${numberOfCards}
    Should Not Be Equal  ${numberOfCards}  0
     [Teardown]    Close Browser 


Check that is not posible to add two insurance to cart
    Open SiteUrl  ${SiteUrl}/insurance/gadget-cover/get-cover
    Add product to basket gadget insurance
    sleep   ${Delay}
    Go to   ${SiteUrl}/insurance/gadget-cover/get-cover
    sleep   ${Delay}
    Add product to basket gadget insurance
    Page Should Contain Element    xpath=//div[@id="id-insurance-view-steps-error"]

# Add to basket insurence product by user logded in
    
    Open SiteUrl  ${SiteUrl}auth/register 
    RegisterUser
    Go to   ${SiteUrl}auth/login
    Activate User Account
    Go to   ${SiteUrl}auth/login
    Login User  ${UsernameUser}
    Go to  ${SiteUrl}/insurance/gadget-cover/get-cover
    Add product to basket gadger insurance
    Go to   ${SiteUrl}/insurance/xs-cover/get-cover
    Add product to basket xs-insurance
    ${cartItem} =   Get Matching Xpath Count    //div[contains(@class,"cart-item")]
    Log To Console     {cartItem}
    ${basketCounter} =   Get Text    //div[contains(@class,"basket-counter")]
    Log To Console      ${basketCounter}
    Should Be Equal     ${cartItem}     ${basketCounter}
    ${IPTValue} =   Get Text    //div[contains(@class,"pay-detail")]/span[2]
    Log To Console  ${IPTValue}
    Should Not Be Empty     ${IPTValue} 
    Get total insurance prices
    Logout User
    Deletion User Account
    [Teardown]    Close Browser 

# Remove product from basket

    Open SiteUrl  ${SiteUrl}auth/register 
    RegisterUser
    Go to   ${SiteUrl}auth/login
    Activate User Account
    Go to   ${SiteUrl}auth/login
    Login User  ${UsernameUser}
    Go to  ${SiteUrl}/insurance/gadget-cover/get-cover
    Add product to basket gadger insurance
    Go to   ${SiteUrl}/insurance/xs-cover/get-cover
    Add product to basket xs-insurance
    ${totalPriceBeforeRemovingProduct}=     Get total insurance prices
    ${totalPriceBeforeRemovingProduct1}=     Fetch From Right  ${totalPriceBeforeRemovingProduct}   £
    ${totalPriceBeforeRemovingProduct2}=     Convert To Number  ${totalPriceBeforeRemovingProduct1}
    Remove product from cart
    Confirm Action
    sleep       ${Delay}
    ${totalPriceAfterRemovingProduct}=      Get total insurance prices
    ${totalPriceAfterRemovingProduct1}=     Fetch From Right  ${totalPriceAfterRemovingProduct}     £
    ${totalPriceAfterRemovingProduct2}=     Convert To Number   ${totalPriceAfterRemovingProduct1}
    Should Be True    ${totalPriceBeforeRemovingProduct2} > ${totalPriceAfterRemovingProduct2}
    [Teardown]    Close Browser 

# Buy product
    Open SiteUrl  ${SiteUrl}auth/register 
    RegisterUser
    Go to   ${SiteUrl}auth/login
    Activate User Account
    Go to   ${SiteUrl}auth/login
    Login User  ${UsernameUser}
    Go to  ${SiteUrl}/insurance/gadget-cover/get-cover
    Add product to basket gadger insurance
    Make Paymant
    Logout User
    Deletion User Account   
    [Teardown]    Close Browser    

 #==============
 # MyAcount 
 #==============
View purchased policies

    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    View policy
    Logout User 
    [Teardown]    Close Browser

View orders
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    View order
    Logout User 
    [Teardown]    Close Browser

View order details
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    sleep      ${Delay}
    View order
    View orders details
    Logout User 
    [Teardown]    Close Browser

Cancel order 
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    sleep      ${Delay}
    View order
    Cancel policy
    Logout User 
    [Teardown]    Close Browser

Amend order 
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    sleep      ${Delay}
    View order
    Amend policy
    Logout User 
    [Teardown]    Close Browser

# ==================================================================================================
# Admin
# ==================================================================================================

Admin view Claime
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/claims
    Sort claims by Date  
    View claim details
    [Teardown]    Close Browser

Admin view page quotes
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/quotes
    ${pageQuotes} =     Count element
    ${pageQuotesAfterSorting} =  Sort Page quotes
    Should Be True     ${pageQuotes} > ${pageQuotesAfterSorting}
    [Teardown]    Close Browser

Admin view orders
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/orders
    ${orders} =     Count element
    [Teardown]    Close Browser

Admin view users
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/users
    ${users} =     Count element
    [Teardown]    Close Browser

Admin view pages
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/pages
    View static pages
    [Teardown]    Close Browser

Manage quotes
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/quotes
    Create a quote
    Delete records
    # [Teardown]    Close Browser

Manage users
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/users
    Create user
    Edit user
    Remove user
    [Teardown]    Close Browser

Manage static pages
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/dashboard  
    Create static page
    Edit static page
    Change static page status
    Remove static page
    [Teardown]    Close Browser

Manage product size
     Open SiteUrl   ${SiteUrl}auth/login
        Login User  ${UsernameAdmin}
        Go to   ${SiteUrl}admin/dashboard
        sleep   ${delay}
        Go to product size
        View product sizes
        Create product size
        Edit product size
        Delete records
        Confirm Action
        [Teardown]    Close Browser


Manage product colors
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/dashboard
    sleep   ${delay}
    Go to product colors
    View product colors
    Create product color
    Edit product color
    Delete product color

Manage product categories
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/dashboard
    sleep   ${delay}
    Go to product categories
    View product types
#    Create product types
    Edit product types
#    Delete product types

Manage slideshow
    Open SiteUrl   ${SiteUrl}auth/login
    Login User  ${UsernameAdmin}
    Go to   ${SiteUrl}admin/dashboard
    sleep   ${delay}
    Go to   ${SiteUrl}admin/slideshows
    View slideshow
    Create slideshow
    Sort slideshows
    Edit slideshow
    Add items to slide show
    Edit slideshow
    Remove item from slideshow
#    Delete slideshow











































