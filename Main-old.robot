#2nd TS - Login to ZZ
*** Settings ***
Resource          Settings.robot

*** Variables ***


*** Test Cases ***
#001 - Open First Time
First Open
    Open Browser to the Start Page
    [Teardown]    Close Browser

#002 - Register new user to ZZ
Register new User
    Open Browser to the Register Page
    Enter First Name
    Enter Last Name
    Enter Email
    Enter Register Password
    Enter Confirm Password
    Click Create Account
    Sleep and Close browser

#003 - Login to ZZ as Admin
Login as Admin
    Open Browser To The Login Page
    Enter User Name
    Enter Admin Password
    Click Login Button
    Sleep and Close browser

#004 - Admin - Activate User Account
Activate User Account
    Open Browser Login Page
    Enter Admin UserName
    Enter The Password
    Tap On Login
    Open Admin Dashboard
    Search by Email2
    Click Edit
    Click Activate checkbox
    Click Save and Exit
    Do Sleep
    Make Close browser

#005 - Login with registered User
Login and Logout as User
    Open Browser on Login Page
    Enter User Name
    Enter User Password
    Press Login
    Freeze
    Logout
    Freeze
    Exit from site
    Freeze
    Freeze
    Close the browser

#006 - Delete registered user
Delete registered user
    Open Browser With Login Page
    Enter User Admin Name
    Fill Password
    Click The Login
    Make Sleep
    Open Admin Dashboard Page
    Search by Email
    Make Sleep
    Click Remove
    Close popup
    Make Sleep
    Do Close browser
