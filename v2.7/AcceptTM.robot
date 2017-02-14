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
  # Create Simple User
  Buy gadget insurance with a simple user
  # [Teardown]    Close Browser

*** Keywords ***
Buy gadget insurance with a simple user

  Go To         ${SiteUrl}/insurance/gadget-cover/get-cover
  Sleep   5
  Execute JavaScript      window.scrollTo(0, 3000)
  Sleep   6
  Click Element     xpath=(//div[@class="checkbox"])[2]
  # xpath=(//div/div/div/label[@for="accept_terms"])[1]
  Sleep   3
