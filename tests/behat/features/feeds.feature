Feature: Feeds API endpoint
  In order to customize my searches
  I need to be able to manipulate the feed configuration

  Scenario: Listing all feeds
    When I send a GET request to "/api/feeds"
    Then the response code should be 200
    And the response should contain json:
    """
    [
      {
        "label": "KickAss",
        "enabled": true
      },
      {
        "label": "Mininova",
        "enabled": true
      }
    ]
    """

    Scenario: Disabling a feed
      When I send a PUT request to "/api/feeds/KickAss" with body:
      """
      {
        "feed": "KickAss",
        "enabled": false
      }
      """
      Then the response code should be 204
