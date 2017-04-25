Feature: user signup

@mink:selenium2
    Scenario: testing user signup
        Given I some data
            | name         | username | email                | password |
            | luki sanjaya | lukisan  | lukisanjaya@gmail.com| luki123  |
        And I post request url "/public/api/auth/signup"
        Then I get response code 201