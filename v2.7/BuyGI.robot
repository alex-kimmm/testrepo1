*** Settings ***
Resource			  Settings.robot
Resource        Variables.robot

*** Test Cases ***
# ***********************
# ZugarZnap Sprint v.2.7
#************************

Update created claim
# Is needed to avoid the crash of test for next running time
  Open Browser    ${SiteUrl}/auth/login     Firefox
  Maximize browser window
  Login with Admin account
  Deactivate last created claim
  Sleep   5
  [Teardown]    Close Browser

# Create simpleuser and buy a gadget insurance
#   Open Browser    ${SiteUrl}/auth/login     Firefox
#   Maximize browser window
#   Login with Admin account
#   Deactivate Simple Account details
#   # Create Simple User
#   # Buy gadget insurance with a simple user
#   # Buy XS insurance
#   # [Teardown]    Close Browser

*** Keywords ***
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

Login with Admin account
  Input Text      login-input-email    ${UsernameAdmin}
  Sleep   1
  Input Text      login-input-password    ${Password}
  Sleep   1
  Click Button    login-input-submit
  Sleep           5
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
  ${GeneratorValue} =   generator.main
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
Buy XS insurance
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

  # Click Button    xpath = (//button[@class="btn btn-default"])[1]
  # Sleep   1
  # Click Button
  # Sleep   1
  # Click Element     //a[@data-value="11"]
  # Sleep   1
  # Input Text      //input[@id="phone-number"]     11112222333
  # Sleep   1
  # Execute JavaScript    window.scrollTo(0, 2945)
  # Sleep   2
  # Click Element     //div[@class="yellow-checkbox getcover-checkbox tc-span"]
  # Sleep   1
  # Click Button      //button[@id="insuranceFormSubmit"]
  # Sleep   1
  # Click Element     //div[@class="close"]
  # Sleep   1
  # Click Button     //button[@type="submit"]
  # Sleep   1
  # Input Text      //input[@id="card-number"]      4111110000000211
  # Sleep   1
  # Click Element   //select[@id="cardExpireYear"]
  # Sleep   1
  # Click Element     //option[@value="2021"]
  # Sleep   1
  # Input Text    //input[@name="cardUserName"]     ${CardName}
  # Sleep   1
  # Click Element     //input[@name="cardCVV"]
  # Sleep   1
  # Input Text    //input[@name="cardCVV"]    123
  # Sleep   1
  # Click Element     //option[@value="2019"]
  # Sleep   5
  # Click Button     //button[@type="submit"]
  # Sleep   5
  # Input Text    //input[@name="st_username"]  sty
  # Sleep   3
  # Click Element   //input[@type="submit"]
  # Sleep   4
  # Confirm Action
  # Sleep   15
  # Click Element     //li[@class="account li-menu-right-section nav-fill"]
  # Sleep   1
  # Click Element     //*[text()[contains(.,'Sign out')]]
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
