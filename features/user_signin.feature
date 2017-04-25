Feature: user signin

@mink:selenium2
    Scenario: testing user signin
        Given I some data
            | username | password  |
            | ilham    | ilham123  |
        And I post request url "/public/api/auth/signin"
        Then I get response code 200