Feature: User edition

  @cleanup
  Scenario: Display an existing user
    Given I have a stored user with:
    | Firstname | Fred |
    | Lastname | Dewinne |
    When I go to:
    | /user/ | %temporaryUser% |
    Then the "Firstname" field should contain "Fred"
    And the "Lastname" field should contain "Dewinne"

  Scenario Outline: Display an error message on non exist users
    Given I am on "<url>"
    Then the response status code should be 404
    
    Examples: 
    | url          |
    | /user/0      |
    | /user/987654 |