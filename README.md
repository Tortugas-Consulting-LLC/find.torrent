# find.torrent Silex Edition

find.torrent is a service to facilitate the discovery and downloading of
torrent files to a home server or leachbox. The service provides a REST API for
searching configured torrent RSS feeds and triggering a file download at the
server. Neither the torrent file nor its indicated content is returned to the
client; the .torrent file is simply downloaded to a configured location at the
server. Another service such as [Transmission](http://www.transmissionbt.com/)
needs to be running on the server to process the downloaded .torrents for any
additional action to be taken.

# Requirements
* PHP 5.5+
* Composer for dependency management
  * Install with `curl -s http://getcomposer.org/installer | php`

# Installation
* Clone this repository
* Install dependencies
  * Run `composer.phar install`
* Set your PATH variable
  * `export PATH="app/bin/:$PATH"`
* Run `phing prepare`
* Modify app/config/config.php as necessary

# Development
This repository comes with a helpful phing configuration to allow you to run
common commands.  Each of these are outlined below.  You can also view the list
by running phing -list

* `phing clean` Remove all file and directories that can be regenerated
* `phing prepare` This will prepare the entire system for deployment
* `phing build` This will prepare the entire system for development, including
  running migrations, generating docs and coverage reports, etc.
* `phing migrate` This will ensure the database is up-to-date
* `phing coverage` Generate a PHPUnit HTML coverage report, accessible at public/coverage/
* `phing doc` Generate source code documentation, accessible at public/docs
  (e.g. public/coverage and public/doc)
* `phing test` Run all tests (unit and integration)
* `phing unit` Run all unit tests with PHPUnit
* `phing behat` Run behat integration tests
