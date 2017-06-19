Find.Torrent Issue Tracker Of Awesome
=====================================

- [ ] Create \FindDotTorrent\Config and pass that in to the constructor of \FindDotTorrent\App
    - [ ] Use this to get config values like $app->getConfig()->getWelcomeMessage()
- [ ] Create feeds for different RSS services and have them return an array of SearchResult objects
- [ ] Authentication (Update README)
- [ ] Define an installation procedure (console?)
    - [ ] Detect an unconfigured or misconfigured install
- [x] Determine the response format based on HTTP headers instead of a configuration value
- [ ] Handle 404 with a template
- [ ] Need to frisby test the database?
- [ ] We still need to try to support file listings, and seeders and leechers.
    - [ ] The format isn't the same for each, so pay attention to how we'll have to parse some of the things.
