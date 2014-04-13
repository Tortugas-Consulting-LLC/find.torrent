Feature: Search API endpoint
  In order to search for torrents
  A REST endpoint will need to exist to crawl various torrent sites

  Scenario: Searching for a torrent
    When I send a GET request to "/api/search/12+angry+men"
    Then the response code should be 200
    And the response should contain "KickAss"
    And the response should contain "Mininova"

  Scenario: Search for a torrent in a particular feed
    When I send a GET request to "/api/search/KickAss/12+angry+men"
    Then the response code should be 200
    And the response should contain "KickAss"
    And the response should not contain "Mininova"
