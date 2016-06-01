@homepage
Feature: Homepage default behavior
  
  Scenario: The title display
    When I am on the homepage
    Then I should see "Welcome"
    
  Scenario: The title display
    When I am on the homepage
	And I am logged as "XLE"
    Then I should see "Welcome XLE"