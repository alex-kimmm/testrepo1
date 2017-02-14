*** Settings ***
Library         Selenium2Library
Library					String
Library					Collections
Library					SSHLibrary
Library					OperatingSystem
Library					HttpLibrary.HTTP
Library					RequestsLibrary
Library         BuiltIn
Resource			  Variables.robot
Library         claimid.py
Library         policyid.py
Library         generate_random_letters.py
Library         GenerateRandomEmails.py
Library         generate_random_digits.py
