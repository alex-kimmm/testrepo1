*** Settings ***
Resource			  Settings.robot
Resource        Variables.robot

*** Test Cases ***
# ***********************
# ZugarZnap Sprint v.2.7
#************************

Create simpleuser and buy a gadget insurance
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Create Simple User
  Buy gadget insurance with a simple user
  Sleep   5
  [Teardown]    Close Browser

# # # ZZ-933 -> I want to be able to create and manage users with Claim Handler role
Create Claim Handler User
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login with Admin account
  Register new CH user
  Sleep   5
  [Teardown]    Close Browser

Create a claim with CH Account
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Create new claim on last bought policy
  Sleep   5
  [Teardown]    Close Browser

### ZZ-934 -> I want to be able to login and logout as a Claim Handler
### ZZ-935 -> I want to be able to have access to Claims and Policies
## BEGIN
CH account settings
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  CH - check displayed categories
  Sleep   5
  [Teardown]    Close Browser

Check displayed limited info of a policy
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Check that is displayed limited info about a policy
  Sleep   5
  [Teardown]    Close Browser
# # ## END
# #
# # ### ZZ-936 -> I want to be able to have access to my account settings
Check displayed limited info of policy
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  CH - check and change profile settings
  Sleep   5
  [Teardown]    Close Browser

# ZZ-937 -> I want to be able to find a policy by searching with some parameters
### BEGIN
Search policy by Policy ID
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  ${PolicyIDnumber} =     Get Policy ID from Policies page
  Find a policy by Policy ID      ${PolicyIDnumber}
  Sleep   5
  [Teardown]    Close Browser
# #
Search policy by Customer Name
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Find a policy by Customer Name
  Sleep   5
  [Teardown]    Close Browser
# # #
Search policy by Address
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Find a policy by Customer Address
  Sleep   5
  [Teardown]    Close Browser
#
Search policy by Phone
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Find a policy by Phone
  Sleep   5
  [Teardown]    Close Browser
### END

# ### ZZ-938 -> When opening a policy order details, I want to see more payments information
Verify payments instalments
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Check payments instalments
  Sleep   5
  [Teardown]    Close Browser
#
# ### ZZ-940 -> I want to be able to update a claim on behalf of the user, for any of the policies he has active
Update the claim
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Check claims options from CH dashboard
  Sleep   5
  [Teardown]    Close Browser
#
# ### ZZ-941 -> I want to be able to see all the claims for a policy
Claims section from a policy
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Check Claims section from a policy
  Sleep   5
  [Teardown]    Close Browser

# =======>>
# ### ZZ-942 -> I want to be able to see all the claims for a user
Claims of a user
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Check All claims of a user
  Sleep   5
  [Teardown]    Close Browser
# =====>>
# ### ZZ-943 -> I want to see all the claims, and filter them by various parameters
All claims - search by title
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Check All claims and search by claim title
  Sleep   5
  [Teardown]    Close Browser
All claims - search by claim code
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Check All claims - search by claim code
  Sleep   5
  [Teardown]    Close Browser
All claims - search by claim id
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  ${ValueClaim} =    Get claim id from CH dashboard
  Fill claim id     ${ValueClaim}
  Sleep   5
  [Teardown]    Close Browser
All claims - search by policy id
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  ${ValuePolicyID} =    Get Policy ID from Policies page
  Fill policy id     ${ValuePolicyID}
  Sleep   5
  [Teardown]    Close Browser
All claims - search by User
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Claims - search by User
  Sleep   5
  [Teardown]    Close Browser
All claims - search by PhoneNumber
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  ${PhoneValue} =     Claims - search by PhoneNumber
  Fill Phone Number     ${PhoneValue}
  Sleep   5
  [Teardown]    Close Browser
All claims - search by Address
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  ${AddressValue} =     Get address from created Policy
  Fill address value     ${AddressValue}
  Sleep   5
  [Teardown]    Close Browser
All claims - press Edit and Search
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login as a Claim Handler
  Press Edit and View buttons of a selected claim
  Sleep   5
  [Teardown]    Close Browser
#
# # ZZ-945 -> Chech XS reasons for a claim
XS - check reasons for a Claim
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Check XS reasons for a Claim
  Sleep   5
  [Teardown]    Close Browser
#
Deactivate Created Claim Handler User
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login with Admin account
  Deactivate Claim Holder Account details
  # Suspend Claim Holder Account
  Sleep   5
  [Teardown]    Close Browser

Deactivate Created Simple User Account
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login with Admin account
  Deactivate Simple Account details
  Sleep   5
  [Teardown]    Close Browser

Update created claim
# Is needed to avoid the crash of test for next running time
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login with Admin account
  Deactivate last created claim
  Sleep   5
  [Teardown]    Close Browser

*** Keywords ***
# keyword is created to use it multiple times in all tests
Login as a Claim Handler
  ##### Login as a Claim Handler
  Sleep   1
  Input Text    //input[@id="login-input-email"]      ${UsernameUser}
  Sleep   1
  Input Text    //input[@id="login-input-password"]     ${PasswordUser}
  Sleep   1
  Click Button    //button[@id="login-input-submit"]
  Sleep   1
  ##############

Login with Admin account
  Input Text      login-input-email    ${UsernameAdmin}
  Sleep   1
  Input Text      login-input-password    ${Password}
  Sleep   1
  Click Button    login-input-submit
  Sleep   5

Create Simple User
  Input Text    //input[@id="login-input-email"]      ${UsernameAdmin}
  Sleep   1
  Input Text    //input[@id="login-input-password"]     ${Password}
  Sleep   1
  Click Button    //button[@id="login-input-submit"]
  Sleep   1
  Go To   ${CreateUserPage}
  Sleep   2
  Click Element   //select[@id="usertitle_id"]
  Sleep   1
  Click Element   //option[@value="2"]
  Sleep   1
  Input Text      //input[@id="email"]      ${SimpleUserName}
  Sleep   1
  Input Text      //input[@id="password"]      ${SimpleUserPassword}
  Sleep   1
  Input Text      //input[@id="password_confirmation"]      ${SimpleUserPassword}
  Sleep   1
  Input Text      //input[@id="first_name"]     ${SimpleUserFirstname}
  Sleep   1
  Input Text      //input[@id="last_name"]      ${SimpleUserLastname}
  Sleep   1
  Click Element   xpath=(//input[@name="activated"])[2]
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 0)
  Sleep   1
  Click Button      //button[@id="exit"]
  Sleep   1
  Click Element     //li[@class="dropdown"]
  Sleep   1
  Click Element     //a[@href="http://zz-stag.atomateapps.com/auth/logout"]
  Sleep   1

Buy gadget insurance with a simple user
  Go To     ${SiteUrl}/auth/login
  Sleep   1
  Click Element     //img[@id="cookie-policy-accept"]
  Sleep   1
  Input Text    //input[@id="login-input-email"]      ${SimpleUserName}
  Sleep   1
  Input Text    //input[@id="login-input-password"]     ${SimpleUserPassword}
  Sleep   1
  Click Button    //button[@id="login-input-submit"]
  Sleep   2
  #########################
  Go To         ${SiteUrl}/insurance/gadget-cover/get-cover
  Sleep   1
  Input Text    //input[@id="deliveryPostcode"]   w22nl
  Sleep   1
  Click Element     //span[@id="deliveryLookForAddress"]
  Sleep   1
  Click Element     //button[@id="btn-dd-postCodeDropDown"]
  Sleep   1
  Click Element     //a[@data-value="11"]
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 2000)
  Sleep   1
  Input Text      //input[@id="deliveryPhone"]    ${PhoneNumber}
  Sleep   1
  ### new part
  Input Text    //input[@id="cardNumber"]     ${CardNumber}
  Sleep   1
  Input Text    //input[@id="cardUserName"]      ${HolderName}
  Sleep   1
  Input Text      //input[@id="cardCVV"]      ${CardCVV}
  Sleep   1
  Click Element     xpath=(//div[@class="checkbox"])[2]
  Sleep   1
  Click Button    //button[@id="insuranceFormSubmit"]
  Sleep   2
  Click Button      //button[@id="orderSummaryFormSubmit"]
  Sleep   5
  Input Text      //input[@name="st_username"]      sty
  Sleep   2
  Click Element     //input[@type="submit"]
  Sleep   10
  Confirm Action
  Sleep   5
  Wait Until Element Is Visible      xpath=(//div[@class="payment-info"]/h5)[1]
  Sleep   2
  ${secondValue}      Get Text      xpath=(//div[@class="payment-info"]/h5)[1]
  Sleep   1
  Should Be Equal As Strings   ${firstValue}      ${secondValue}
  Sleep   2
  Click Element     //a[@data-toggle="dropdown"]
  Sleep   1
  Click Element     xpath=//*[text()[contains(.,'Sign out')]]
  Sleep   1

Create new claim on last bought policy
  ### Create a Claim ###
  Click Element     //input[@st-search="user_name"]
  Sleep   1
  Input Text      //input[@st-search="user_name"]     alexsimple
  Sleep   1
  Click Element     xpath=(//*[text()[contains(.,'View')]])[3]
  Sleep   1
  Click Element     xpath=//*[text()[contains(.,'Make a claim')]]
  Sleep   1
  Input Text      //input[@id="name"]     test_claim
  Sleep   5
  Click Element     //span[@class="fa fa-calendar"]
  Sleep   2
  Click Element     //span[@class="fa fa-calendar"]
  Sleep   2
  Click Element     //textarea[@id="description"]
  Sleep   1
  Input Text      //textarea[@id="description"]     test_claim
  Sleep   1
  Input Text      //input[@id="reference_number"]    111222333
  Sleep   1
  Input Text    //input[@id="device_serial_number"]     444222555
  Sleep   1
  Input Text    //input[@id="crime_reference_number"]     777888999
  Sleep   1
  Choose File	xpath=//input[@type="file"]	${CURDIR}/attachment.jpg
  Sleep   1
  Click Button     //button[@id="exit"]
  Sleep   8

# ### ZZ-933 -> AC1. Admins should be able to create users with Claim Handler Role
Register new CH user
  Sleep   2
  Go To   ${CreateUserPage}
  Sleep   2
  Click Element   //select[@id="usertitle_id"]
  Sleep   1
  Click Element   //option[@value="2"]
  Sleep   1
  Input Text      //input[@id="email"]      ${UsernameUser}
  Sleep   1
  Input Text      //input[@id="password"]      ${PasswordUser}
  Sleep   1
  Input Text      //input[@id="password_confirmation"]      ${PasswordUser}
  Sleep   1
  Input Text      //input[@id="first_name"]     ${Firstname}
  Sleep   1
  Input Text      //input[@id="last_name"]      ${Lastname}
  Sleep   1
  Click Element   xpath=(//input[@name="activated"])[2]
  Sleep   1
  Click Element   //input[@data-group-id="3"]
  Sleep   1
  Click Element     //div[@class="selectize-input items full has-options has-items"]
  Sleep   1
  Click Element     //div[@data-value="15"]
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 0)
  Sleep   1
  Click Button      //button[@id="exit"]
  # ???? think that is not needed, impact other tests

# ### ZZ-933 -> AC2. Admins should be able to suspend a CH, if they leave the organisation and access is no longer required.
Suspend Claim Holder Account
  Sleep   1
  Go To   ${SiteUrl}/admin/users
  Sleep   1
  Click Element     //input[@class="form-control input-sm"]
  Sleep   1
  Input Text      //input[@class="form-control input-sm"]     ${UsernameUser}
  Sleep   1
  Click Element    xpath=//*[text()[contains(.,'Edit')]]
  Sleep   1
  Click Element   xpath=(//input[@name="activated"])[2]
  Sleep   1
  Click Element   //input[@data-group-id="3"]
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 0)
  Sleep   1
  Click Button      //button[@type="submit"]
  Sleep   5
  Click Element     //li[@class="dropdown"]
  Sleep   1
  Click Element     //a[@href="http://zz-stag.atomateapps.com/auth/logout"]
  Sleep   5
  ### check that suspended account can't login
  Go To     ${SiteUrl}/auth/login
  Sleep   2
  Input Text    //input[@id="login-input-email"]      ${UsernameUser}
  Sleep   1
  Input Text    //input[@id="login-input-password"]     ${PasswordUser}
  Sleep   1
  Click Button    //button[@id="login-input-submit"]
  Sleep   2
  Element Should Contain    xpath=//*[text()[contains(.,'User not activated')]]       ${errMSG}
  Sleep   3
  ### activate CH account back
  Go To     ${SiteUrl}/auth/login
  Sleep   1
  Input Text    login-input-email    ${UsernameAdmin}
  Sleep   1
  Input Text    login-input-password    ${Password}
  Sleep   1
  Click Button    login-input-submit
  Sleep   3
  Go To   ${SiteUrl}/admin/users
  Sleep   1
  Click Element     //input[@class="form-control input-sm"]
  Sleep   1
  Input Text      //input[@class="form-control input-sm"]     ${UsernameUser}
  Sleep   1
  Click Element    xpath=//*[text()[contains(.,'Edit')]]
  Sleep   1
  Click Element   xpath=(//input[@name="activated"])[2]
  Sleep   1
  Click Element   //input[@data-group-id="3"]
  Sleep   1
  Click Element     //div[@class="selectize-input items full has-options has-items"]
  Sleep   1
  Click Element     //div[@data-value="15"]
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 0)
  Sleep   1
  Click Button      //button[@id="exit"]
  Sleep   2

# ZZ-934 -> a) AC1. A Claimer should only see Policies and Claims Sections
#           b) Also is checking if is not displayed categories from Admin panel
# ZZ-935 -> I want to be able to have access to Claims and Policies
CH - check displayed categories
  ##### AC1. A Claimer should only see Policies and Claims Sections
  Element Should Be Visible     //a[@href="#policies-claims"]
  Sleep   1
  Element Should Be Visible     //a[@href="http://zz-stag.atomateapps.com/claimhandler/policies"]
  Sleep   1
  Element Should Be Visible     //a[@href="http://zz-stag.atomateapps.com/claimhandler/users-with-claims"]
  Sleep   1
  Click Element     //a[@class="dropdown-toggle"]
  Sleep   1
  Element Should Contain    xpath=(//*[text()[contains(.,'Profile')]])[1]     Profile
  Sleep   1
  Element Should Be Visible     //a[@href="http://zz-stag.atomateapps.com/claimhandler/claims"]
  Sleep   1
  Element Should Be Visible     //a[@href="#users-and-groups"]
  Sleep   1
  Element Should Not Be Visible     //a[@href="#content"]
  Sleep   1
  Element Should Not Be Visible     //a[@href="#media"]
  Sleep   1
  Element Should Not Be Visible     //a[@href="#landing-pages"]
  Sleep   1
  Element Should Not Be Visible     //a[@href="#blocks"]
  Sleep   1
  Element Should Not Be Visible     //a[@href="#others"]
  Sleep   1
  Element Should Not Be Visible     //a[@href="http://zz-stag.atomateapps.com/admin/settings"]
  Sleep   1

  ##### AC2. A Claimer should see limited info about an order. ZZ is to specify what info is to be displayed"

Check that is displayed limited info about a policy
  Go To     ${SiteUrl}/claimhandler/policies/
  Sleep   1
  Input Text    //input[@st-search="user_name"]     alexsimple
  Sleep   1
  Click Element     xpath=(//*[text()[contains(.,'View')]])[3]
  Sleep   1
  Element Should Be Visible     xpath=(//*[text()[contains(.,'Policy ID:')]])
  Sleep   1
  Element Should Be Visible     xpath=(//*[text()[contains(.,'Email:')]])[1]
  Sleep   1
  Element Should Be Visible     xpath=(//*[text()[contains(.,'Address:')]])
  Sleep   1
  Element Should Be Visible     xpath=(//*[text()[contains(.,'Name:')]])
  Sleep   1
  Element Should Be Visible     xpath=(//*[text()[contains(.,'Email:')]])[2]
  Sleep   1
  Element Should Be Visible     xpath=(//*[text()[contains(.,'Registered at:')]])
  Sleep   1
  Element Should Not Be Visible     xpath=(//*[text()[contains(.,'Order id:')]])
  Sleep   1
  Element Should Not Be Visible     xpath=(//*[text()[contains(.,'Ref. Number:')]])
  Sleep   1

# ZZ-936 -> AC1. Claim Hanlder needs to be able to access their account settings, reset their password etc
CH - check and change profile settings
  # Change settings
  Click Element     //a[@class="dropdown-toggle"]
  Sleep   1
  Click Element     xpath=(//*[text()[contains(.,'Profile')]])[1]
  Sleep   1
  Click Element     //select[@id="usertitle_id"]
  Sleep   1
  Click Element     //option[@value="3"]
  Sleep   1
  Input Text      //input[@id="password"]     2w2w2w2w
  Sleep   1
  Input Text      //input[@id="password_confirmation"]      2w2w2w2w
  Sleep   1
  Clear Element Text      //input[@id="first_name"]
  Sleep   1
  Input Text      //input[@id="first_name"]     Test111
  Sleep   1
  Clear Element Text      //input[@id="last_name"]
  Sleep   1
  Input Text      //input[@id="last_name"]    Alex222
  Sleep   1
  Click Button      //button[@type="submit"]
  Sleep   1
  # Restore changed settings
  Click Element     xpath=(//*[text()[contains(.,'Profile')]])[2]
  Sleep   1
  Click Element     //select[@id="usertitle_id"]
  Sleep   1
  Click Element     //option[@value="3"]
  Sleep   1
  Input Text      //input[@id="password"]     1q1q1q1q
  Sleep   1
  Input Text      //input[@id="password_confirmation"]      1q1q1q1q
  Sleep   1
  Clear Element Text      //input[@id="first_name"]
  Sleep   1
  Input Text      //input[@id="first_name"]     Alex
  Sleep   1
  Clear Element Text      //input[@id="last_name"]
  Sleep   1
  Input Text      //input[@id="last_name"]    Testing1
  Sleep   1
  Click Button      //button[@type="submit"]
  Sleep   1
  Element Should Not Be Visible       //input[@name="activated"]
  Sleep   1
  Element Should Not Be Visible       //input[@data-group-id="1"]
  Sleep   1
  Element Should Not Be Visible       //input[@data-group-id="2"]
  Sleep   1
  Element Should Not Be Visible       //input[@data-group-id="3"]
  Sleep   1
  Element Should Not Be Visible       //input[@name="superuser"]
  Sleep   1
  Element Should Not Be Visible       //input[@name="permissions[dashboard]"]
  Sleep   1
  Element Should Not Be Visible       //input[@name="permissions[settings.index]"]
  Sleep   1
  Element Should Not Be Visible       //input[@name="permissions[blocks.index]"]
  Sleep   1
  Element Should Not Be Visible       //input[@name="permissions[blocks.show]"]
  Sleep   1

# ZZ-937 -> AC2. I want to able to find an policy by Policy ID
Find a policy by Policy ID
  [Arguments]   ${PolicyIDVal}
  Click Element     //input[@st-search="policy_id"]
  Sleep   1
  Input Text      //input[@st-search="policy_id"]    ${PolicyIDVal}

# ZZ-937 -> AC1. I want to able to find an policy by Customer Name
Find a policy by Customer Name
  Click Element     //input[@st-search="user_name"]
  Sleep   1
  Input Text      //input[@st-search="user_name"]     alexsimple
  Sleep   1

# ZZ-937 -> AC3. I want to able to find an policy by Customer Address
Find a policy by Customer Address
  Click Element     //input[@st-search="address"]
  Sleep   1
  Input Text      //input[@st-search="address"]     w1j
  Sleep   1

# ZZ-937 -> AC4. I want to able to find an policy by Customer's Phone"
Find a policy by Phone
  Click Element     //input[@st-search="phone"]
  Sleep   1
  Input Text      //input[@st-search="phone"]     09
  Sleep   1

# ZZ-938 -> AC1. I want to see all the payments' details. Initial payment, installments and how many done/left
Check payments instalments
  Go To   ${SiteUrl}/claimhandler/policies
  Sleep   1
  Input Text    //input[@st-search="user_name"]       AlexSimple UserTest
  Sleep   1
  Click Element       xpath=(//*[text()[contains(.,'View')]])[3]
  Sleep   1
  # Initial payment
  Element Should Be Visible     xpath=(//*[text()[contains(.,'Initial payment')]])[1]
  Sleep   1
  Element Should Be Visible     //tbody/tr/td[contains(.,"Initial payment")]/../td[2]
  Sleep   1
  Element Should Be Visible     //tbody/tr/td[contains(.,"Initial payment")]/../td[2]
  # Instalmments payments
  Sleep   1
  Element Should Be Visible     //tbody/tr/td[contains(.,"Instalment")]
  Sleep   1
  Element Should Be Visible     //tbody/tr/td[contains(.,"Instalment")]/../td[2]
  Sleep   1
  Element Should Be Visible     //tbody/tr/td[contains(.,"Instalment")]/../td[3]
  Sleep   1
  Element Should Be Visible     //tbody/tr/td[contains(.,"Instalment")]/../td[4]
  Sleep   1
  # to return and create script for "installments and how many done/left"

#ZZ-940 -> "AC1. I want to be able to update claim's description
Check claims options from CH dashboard
  Go To   ${SiteUrl}/claimhandler/policies
  Sleep   1
  Input Text    //input[@st-search="user_name"]       AlexSimple UserTest
  Sleep   1
  Click Element       xpath=(//*[text()[contains(.,'View')]])[3]
  Sleep   1
  ### Update description and file from a claim
  Go To   ${SiteUrl}/claimhandler/claims
  Sleep   1
  Input Text    //input[@st-search="name"]       test_claim
  Sleep   1
  Click Element       xpath=(//*[text()[contains(.,'Edit')]])
  Sleep   1
  Clear Element Text    //textarea[@id="description"]
  Sleep   1
  Click Element     //textarea[@id="description"]
  Sleep   1
  Input Text      //textarea[@id="description"]   updated_description
  Sleep   1
  Choose File	xpath=//input[@type="file"]	${CURDIR}/replacement.jpg
  Sleep   1
  Click Element     //button[@type="submit"]

#ZZ-941 -> AC1. The list of all claims for a policy, if any, should be displayed when I see the details of a Product order
Check Claims section from a policy
  Go To   ${SiteUrl}/claimhandler/policies
  Sleep   1
  Input Text    //input[@st-search="user_name"]       AlexSimple UserTest
  Sleep   1
  Click Element       xpath=(//*[text()[contains(.,'View')]])[3]
  Sleep   1
  Element Should Be Visible     //table[@class="details-table claims-table"]

# ZZ-942 -> AC1. The list of all claims done by a user, if any, should be displayed in a separate page
Check All claims of a user
  Go To       ${SiteUrl}/claimhandler/users-with-claims
  Sleep   1
  Input Text      //input[@st-search="first_name"]      AlexSimple
  Sleep   1
  Click Element       xpath=(//*[text()[contains(.,'View')]])[2]
  Sleep   1
  Element Should Be Visible       //table[@st-persist="modelsTable"]

# ZZ-943 -> I want to see all the claims, and filter them by various parameters
Check All claims and search by claim title
  Go To       ${SiteUrl}/claimhandler/claims
  Sleep   1
  Input Text    //input[@st-search="name"]    test_claim
  Sleep   4

# ZZ-943 -> Check All claims and search by claim id
Get claim id from CH dashboard
  Go To       ${SiteUrl}/claimhandler/policies
  Sleep   1
  Input Text          //input[@st-search="user_name"]     alexsimple
  Sleep   1
  Click Element       xpath=(//*[text()[contains(.,'View')]])[3]
  Sleep   3
  Click Element       //tbody/tr/td[contains(.,"test_claim")]/a
  Sleep   3
  ${GetUrlSource} =     Get Location
  Sleep   1
  ${ClaimID} =    claimid  ${GetUrlSource}
  Sleep   1
  [return]    ${ClaimID}
Fill claim id
  [Arguments]     ${Value}
  Go To   ${SiteUrl}/claimhandler/claims
  Sleep   2
  Input Text    //input[@st-search="id"]    ${Value}

# ZZ-943 -> Check All claims - search by claim code
Check All claims - search by claim code
  Go To       ${SiteUrl}/claimhandler/claims
  Sleep   1
  Input Text    //input[@st-search="reference_number"]      111222333
  Sleep   1

# ZZ-943 -> Check All claims - search by policy id
Get Policy ID from Policies page
  Go To       ${SiteUrl}/claimhandler/policies
  Sleep   1
  Input Text    //input[@st-search="user_name"]      alexsimple
  Sleep   1
  ${PolicyID} =     Get Text      //tbody/tr/td[2]
  ${IDvalue} =    policyidvalue   ${PolicyID}
  [return]      ${IDvalue}
Fill policy id
  [Arguments]   ${PolicyIDValue}
  Go To      ${SiteUrl}/claimhandler/claims
  Input Text    //input[@st-search="policy_id"]     ${PolicyIDValue}

# ZZ-943 -> Check All claims - search by "User"
Claims - search by User
  Go To     ${SiteUrl}/claimhandler/claims
  Sleep   1
  Input Text    //input[@st-search="user_name"]    alexsimple

# ZZ-943 -> Check All claims and search by Phone number
Claims - search by PhoneNumber
  Go To     ${SiteUrl}/claimhandler/policies
  Sleep   1
  Input Text    //input[@st-search="user_name"]     alexsimple
  Sleep   1
  ${GetPhone} =     Get Text      //tbody/tr/td[5]
  [return]      ${GetPhone}
Fill Phone Number
    [Arguments]   ${PhoneNumberValue}
    Go To     ${SiteUrl}/claimhandler/claims
    Sleep   1
    Input Text    //input[@st-search="user_phone"]    ${PhoneNumberValue}

# ZZ-943 -> Check All claims and search by address
Get address from created Policy
  Go To     ${SiteUrl}/claimhandler/policies
  Sleep   1
  Input Text    //input[@st-search="user_name"]     alexsimple
  Sleep   1
  ${GetAddress} =     Get Text      //tbody/tr/td[4]
  [return]      ${GetAddress}
Fill address value
  [Arguments]     ${Address}
  Go To     ${SiteUrl}/claimhandler/claims
  Sleep   1
  Input Text    //input[@st-search="user_address"]    ${Address}

# ZZ-943 -> AC5. I want to have a direct link to a claim"
Press Edit and View buttons of a selected claim
  Go To   ${SiteUrl}/claimhandler/claims
  Sleep   1
  Input Text    //input[@st-search="user_name"]     alexsimple
  Sleep   1
  Click Element     xpath=(//*[text()[contains(.,'Edit')]])[1]
  Sleep   1
  Go Back
  Sleep   1
  Click Element     xpath=(//*[text()[contains(.,'View')]])[3]

# ZZ-945 -> Chech XS reasons for a claim
Check XS reasons for a Claim
  ##### Login as a Super Admin
  Sleep   1
  Input Text    //input[@id="login-input-email"]      ${UsernameAdmin}
  Sleep   1
  Input Text    //input[@id="login-input-password"]     ${Password}
  Sleep   1
  Click Button    //button[@id="login-input-submit"]
  Sleep   1
  #### Change CH role to XS
  Go To   ${SiteUrl}/admin/users
  Sleep   1
  Input Text    //input[@class="form-control input-sm"]     ${UsernameUser}
  Sleep   1
  Click Element       xpath=(//*[text()[contains(.,'Edit')]])[1]
  Sleep   1
  Click Element       //div[@class="selectize-input items full has-options has-items"]
  Sleep    1
  Click Element       //div[@data-value="13"]
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 0)
  Sleep   1
  Click Element     //button[@type="submit"]
  Sleep   1
  Click Element     //li[@class="dropdown"]
  Sleep   1
  Click Element     //a[@href="http://zz-stag.atomateapps.com/auth/logout"]
  #### Login as simple user
  Go To     ${SiteUrl}/auth/login
  Sleep   1
  Input Text    //input[@id="login-input-email"]      ${SimpleUserName}
  Sleep   1
  Input Text    //input[@id="login-input-password"]     ${SimpleUserPassword}
  Sleep   1
  Click Button    //button[@id="login-input-submit"]
  Sleep   2
  #### Buy XS insurance
  Go To     ${SiteUrl}/insurance/xs-cover/get-cover
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 0)
  Sleep   1
  Input Text    //input[@id="carNumber"]      ${XSvalue}
  Sleep   1
  Input Text    //input[@id="deliveryPostcode"]     w22nl
  Sleep   1
  Sleep   1
  Click Element     //span[@id="deliveryLookForAddress"]
  Sleep   1
  Click Element     //button[@id="btn-dd-postCodeDropDown"]
  Sleep   1
  Click Element     //a[@data-value="11"]
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 2000)
  Sleep   1
  Input Text      //input[@id="deliveryPhone"]    ${PhoneNumber}
  Sleep   1
  ### new part
  Input Text    //input[@id="cardNumber"]     ${CardNumber}
  Sleep   1
  Input Text    //input[@id="cardUserName"]      ${HolderName}
  Sleep   1
  Input Text      //input[@id="cardCVV"]      ${CardCVV}
  Sleep   1
  Click Element     xpath=(//div[@class="checkbox"])[2]
  Sleep   1
  Click Button    //button[@id="insuranceFormSubmit"]
  Sleep   2
  Click Button      //button[@id="orderSummaryFormSubmit"]
  Sleep   5
  Input Text      //input[@name="st_username"]    sty
  Sleep   2
  Click Element     //input[@type="submit"]
  Sleep   10
  Confirm Action
  Sleep   5
  Wait Until Element Is Visible      xpath=(//div[@class="payment-info"]/h5)[1]
  Sleep   2
  ${secondValue}      Get Text      xpath=(//div[@class="payment-info"]/h5)[1]
  Sleep   1
  Should Be Equal As Strings   ${firstValue}      ${secondValue}
  Sleep   2
  Click Element     //a[@data-toggle="dropdown"]
  Sleep   1
  Click Element     xpath=//*[text()[contains(.,'Sign out')]]
  Sleep   1
  ##### Login as a Claim Handler
  Go To       ${SiteUrl}/auth/login
  Sleep   1
  Input Text    //input[@id="login-input-email"]      ${UsernameUser}
  Sleep   1
  Input Text    //input[@id="login-input-password"]     ${PasswordUser}
  Sleep   1
  Click Button    //button[@id="login-input-submit"]
  Sleep   1
  ##############
  Input Text    //input[@st-search="user_name"]     alexsimple
  Sleep   1
  Click Element     xpath=(//*[text()[contains(.,'View')]])[3]
  Sleep   1
  Click Element     //*[text()[contains(.,'Make a claim')]]
  Sleep   1
  Element Should Be Visible     //option[@value="Accidental Damage"]
  Sleep   1
  Element Should Be Visible     //option[@value="Malicious Damage"]
  Sleep   1
  Element Should Be Visible     //option[@value="Theft"]
  Sleep   1
  Element Should Be Visible     //option[@value="Third Party Damage"]
  Sleep   1

Deactivate Simple Account details
  Sleep   1
  Go To   ${SiteUrl}/admin/users
  Sleep   1
  Click Element     //input[@class="form-control input-sm"]
  Sleep   1
  Input Text      //input[@class="form-control input-sm"]     ${SimpleUserName}
  Sleep   1
  Click Element    xpath=//*[text()[contains(.,'Edit')]]
  Sleep   1
  Click Element     //input[@id="first_name"]
  Sleep   1
  Clear Element Text      //input[@id="first_name"]
  Sleep   1
  ${GeneratorValue} =   generate_random_letters.main
  Sleep   1
  Input Text      //input[@id="first_name"]     ${GeneratorValue}
  Sleep   1
  Click Element     //input[@id="last_name"]
  Sleep   1
  Clear Element Text      //input[@id="last_name"]
  Sleep   1
  Input Text      //input[@id="last_name"]      ${GeneratorValue}
  Sleep   1
  Click Element     //input[@id="email"]
  Sleep   1
  ${EmailGenerator} =   GenerateRandomEmails.main
  Sleep   1
  Clear Element Text    //input[@id="email"]
  Sleep   1
  Input Text      //input[@id="email"]    ${EmailGenerator}
  Sleep   1
  Click Element   xpath=(//input[@name="activated"])[2]
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 0)
  Sleep   1
  Click Button      //button[@type="submit"]
  Sleep   5
  Click Element     //li[@class="dropdown"]
  Sleep   1
  Click Element     //a[@href="http://zz-stag.atomateapps.com/auth/logout"]

Deactivate Claim Holder Account details
  Sleep   1
  Go To   ${SiteUrl}/admin/users
  Sleep   1
  Click Element     //input[@class="form-control input-sm"]
  Sleep   1
  Input Text      //input[@class="form-control input-sm"]     ${UsernameUser}
  Sleep   1
  Click Element    xpath=//*[text()[contains(.,'Edit')]]
  Sleep   1
  Click Element     //input[@id="first_name"]
  Sleep   1
  Clear Element Text      //input[@id="first_name"]
  Sleep   1
  ${GeneratorValue} =   generate_random_letters.main
  Sleep   1
  Input Text      //input[@id="first_name"]     ${GeneratorValue}
  Sleep   1
  Click Element     //input[@id="last_name"]
  Sleep   1
  Clear Element Text      //input[@id="last_name"]
  Sleep   1
  Input Text      //input[@id="last_name"]      ${GeneratorValue}
  Sleep   1
  Click Element     //input[@id="email"]
  Sleep   1
  ${EmailGenerator} =   GenerateRandomEmails.main
  Sleep   1
  Clear Element Text    //input[@id="email"]
  Sleep   1
  Input Text      //input[@id="email"]    ${EmailGenerator}
  Sleep   1
  Click Element   xpath=(//input[@name="activated"])[2]
  Sleep   1
  Execute JavaScript    window.scrollTo(0, 0)
  Sleep   1
  Click Button      //button[@type="submit"]
  Sleep   5
  Click Element     //li[@class="dropdown"]
  Sleep   1
  Click Element     //a[@href="http://zz-stag.atomateapps.com/auth/logout"]

Deactivate last created claim
  Go To       ${SiteUrl}/claimhandler/claims
  Sleep   1
  Input Text    //input[@st-search="reference_number"]      111222333
  Sleep   1
  Click Element    xpath=//*[text()[contains(.,'Edit')]]
  Sleep   1
  Click Element     //input[@name="reference_number"]
  Sleep   1
  Clear Element Text      //input[@name="reference_number"]
  Sleep   1
  ${GenRandDigits} =    generate_random_digits.main
  Sleep   1
  Input Text      //input[@name="reference_number"]     ${GenRandDigits}
  Sleep   1
  Click Button      //button[@id="exit"]
  Sleep   1
