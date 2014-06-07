Feature: Download API endpoint
  In order to download torrents
  A REST endpoint endpoint will need to exist to fetch files

  Scenario: Download a torrent
    When I set header "Content-Type" with value "application/json"
    And I send a PUT request to "/api/download/" with body:
    """
    {
      "url": "http://torcache.net/torrent/6ED1D014AC6CD8685A2EA6302EA7B3D0C6B1301D.torrent?title=[kickass.to]12.angry.men.1957.1080p.bluray.x264.cinefile"
    }
    """
    Then the response code should be 201
