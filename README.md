SmoyaOmniataBundle
==================
[![Build Status](https://travis-ci.org/smoya/SmoyaOmniataBundle.svg?branch=master)](https://travis-ci.org/smoya/SmoyaOmniataBundle)
[![Latest stable](http://img.shields.io/packagist/v/smoya/SmoyaOmniataBundle.svg)](https://packagist.org/packages/smoya/omniata-bundle)

Integration of Omniata Component [smoya/omniata-component](https://github.com/smoya/omniata-component) into Symfony2.

## Installation

The best way to install is using [Composer](http://getcomposer.org/).

Add to your `composer.json`:

```yaml
"require": {
	"smoya/omniata-bundle": "*"
}
```

and run:

```sh
$ composer update
```

## Configuration

```yaml
smoya_omniata:
	api_key: kaei330 # required
	tracker: 
	    url: https://api.omniata.com/event # Optional
	    timeout: 1000 # Optional. Time in ms. Timeout for the Omniata server response on event sending.
	deliverer:
	    url: https://api.omniata.com/channel # Optional
	    timeout: 1000 # Optional. Time  in ms. Timeout for the Omniata server response on delivering content.
```

## Services

### Events Tracker

`smoya_omniata.tracker` sends events to Omniata using the [Event API](https://omniata.atlassian.net/wiki/display/DOC/Event+API). 

See [Tracker](https://github.com/smoya/omniata-component/blob/master/Tracker.php) class.

### Channel Deliverer

`smoya_omniata.deliverer` retrieves channel content using the [Channel API](https://omniata.atlassian.net/wiki/display/DOC/Channel+API).

See [Deliverer](https://github.com/smoya/omniata-component/blob/master/Deliverer.php) class.
