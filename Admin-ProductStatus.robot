http://zz-dev.atomateapps.com/admin/products/8/edit

# 2.2.1.3
*** Settings ***
Resource            Authorization.robot
Resource            Variables.robot
Resource            UserActivity.robot

*** Variables ***

*** Test Cases ***
#Login to ZZ as Admin
Login to ZZ as Admin
    Open SiteUrl    ${SiteUrl}auth/login
    Login AS Admin
    Go To           ${SiteUrl}admin/products/8/edit
    Maximize Browser Window
    # Freeze a bit
    Uncheck Status
    Freeze a bit
    Go To           ${SiteUrl}admin/products/8/edit
    Checkback Status
    # Attach Main Image
    # Freeze a bit
    # Attach Other Photo
    # Freeze a bit
    # Fill SKU
    # Freeze a bit
    # Fill Price
    # Freeze a bit
    # Select Color
    # Freeze a bit
    # [Teardown]    Close Browser

*** Keywords ***
Uncheck Status
  Execute Javascript  window.jQuery("div.checkbox").find('input[name="en[status]"]').click()
  Click Button  //button[@id="exit"]

Checkback Status
  Execute Javascript  window.jQuery("div.checkbox").find('input[name="en[status]"]').click()
  Click Button  //button[@id="exit"]

# Attach Main Image
#   Execute Javascript   window.jQuery('input[type="file"][name="image"]').click();
#
# Attach Main Image
#   Choose File	xpath=//input[@id="image"]	${CURDIR}/contacts.png
#
# Attach Other Photo
#   Choose File	xpath=//input[@id="product_photo"]	${CURDIR}/contacts.png
#
# Fill SKU
#   Input Text  //input[@name="sku"]  ${SKU}
#
# Fill Price
#   Input Text  //input[@name="price"]  ${Price}
#
# Select Color
#   Execute Javascript  window.jQuery('a[href="/insurance/gadget-insurance"]').parent().click();
#   # Click Element
#   # //label[@for="colors[] "]

Freeze a bit
  Sleep   ${Delay}
