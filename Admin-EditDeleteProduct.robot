# 2.2.1.2
*** Settings ***
Resource            Authorization.robot
Resource            Variables.robot
Resource            UserActivity.robot

*** Variables ***
${SKU}    0011
${Price}    20.55
${VAL}   1100
${PRI}   55.20
*** Test Cases ***

Login to ZZ as Admin

  # CREATE A PRODUCT

    Open SiteUrl    ${SiteUrl}auth/login
    # Maximize Browser Window
    Login AS Admin
    Go To           ${SiteUrl}admin/products
# Press Create button
    Click Element   //a[@class='btn-add']
# Attach Main Image
    Choose File	xpath=//input[@id="image"]	${CURDIR}/contacts.png
# Attach Other Photo
    Choose File	xpath=//input[@id="product_photo"]	${CURDIR}/contacts.png
    Sleep   ${Delay}
# Scroll the page to bottom
    Execute JavaScript    window.scrollTo(0, document.body.scrollHeight)
    Sleep   ${Delay}
# Click on color field
    Click Element   xpath=(//div[@class='selectize-control form-control multi'])[1]
# Select Color
    Execute Javascript    window.jQuery ("div:contains('Red')").click();
    Sleep   ${Delay}
# Activate product checkbox
    Execute Javascript   window.jQuery('input[type="checkbox"][name="en[status]"]').parent().click();
# Enter Summary text
    Input Text  //textarea[@id="en[summary]"]   Test111
    Sleep   ${Delay}
# Click on size field
    Click Element   xpath=(//div[@class='selectize-control form-control multi'])[2]
# Select Size
    Execute Javascript  window.jQuery ("div:contains('XL')").click();
    Sleep   ${Delay}
# Input Title
    Input Text 	//input[@id="en[title]"]    TestOneTwoThree
    Sleep   ${Delay}
# Click on category field
    Execute Javascript  window.jQuery("div.selectize-control.form-control.single > div.selectize-input.items.full").click();
# Select Category
    Execute Javascript  window.jQuery ("div:contains('Special')").click();
    Sleep   ${Delay}
# Scroll the page to top
    Execute JavaScript    window.scrollTo(0, 0)
# Fill Price
    Input Text  //input[@name="price"]  ${Price}
    Sleep   ${Delay}
# Fill SKU
    Input Text  //input[@name="sku"]  ${SKU}
# Save and Close
    Click Button  exit

#EDIT PRODUCT
  # Click on Edit button
    Click Element   xpath=(//a[@class='btn btn-default btn-xs'])[1]
  # Clear price and sku value
    Clear Element Text  //input[@name="sku"]
    Clear Element Text  //input[@name="price"]
  # Fill new price and sku values
    Input Text  //input[@name="sku"]  ${VAL}
    Input Text  //input[@name="price"]  ${PRI}
    Sleep   ${Delay}
  # Scroll up page
    Execute JavaScript    window.scrollTo(0, 0)
    Sleep   ${Delay}
  # Save changes
    Click Button  exit

#DELETE PRODUCT
  # Click on Delete button
    Click Element   xpath=(//span[@class='fa fa-remove'])[1]
    Sleep   ${Delay}
  # Confirm to delete product
    Confirm Action

#END OF THE TEST
    [Teardown]    Close Browser

# *** Keywords ***
# CREATE A PRODUCT
# Attach Main Image
#   Choose File	xpath=//input[@id="image"]	${CURDIR}/contacts.png
# Attach Other Photo
#   Choose File	xpath=//input[@id="product_photo"]	${CURDIR}/contacts.png
# Fill SKU
#   Input Text  //input[@name="sku"]  ${SKU}
# Fill Price
#   Input Text  //input[@name="price"]  ${Price}
# Click on color field
#   Click Element   xpath=(//div[@class='selectize-control form-control multi'])[1]
# Select Color
#   Execute Javascript    window.jQuery ("div:contains('Red')").click();
# Click on size field
#   Click Element   xpath=(//div[@class='selectize-control form-control multi'])[2]
# Select Size
#   Execute Javascript  window.jQuery ("div:contains('XL')").click();
# Input Title
#   Input Text 	//input[@id="en[title]"]    TestOneTwoThree
# Activate product checkbox
#   Execute Javascript   window.jQuery('input[type="checkbox"][name="en[status]"]').parent().click();
# Enter Summary text
#   Input Text  //textarea[@id="en[summary]"]   Test111
# Click on category field
#   Execute Javascript  window.jQuery("div.selectize-control.form-control.single > div.selectize-input.items.full").click();
# Select Category
#   Execute Javascript  window.jQuery ("div:contains('Special')").click();
# Save and Close
#   Click Button  exit
# Freeze a bit
#   Sleep   ${Delay}
# Scroll the page to bottom
#   Execute JavaScript    window.scrollTo(0, document.body.scrollHeight)
# Scroll the page to top
#   Execute JavaScript    window.scrollTo(0, 0)
# Click on Edit button
#   Click Element   xpath=(//a[@class='btn btn-default btn-xs'])[1]
# Click on Delete button
#   Click Element   xpath=(//span[@class='fa fa-remove'])[1]
# Confirm to delete product
#   Confirm Action
# Press Create button
#   Click Element   //a[@class='btn-add']
