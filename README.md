# IonCube checker for Shopware

[![Join the chat at https://gitter.im/FriendsOfShopware/Lobby](https://badges.gitter.im/FriendsOfShopware/Lobby.svg)](https://gitter.im/FriendsOfShopware/Lobby)

Simple plugin to list all [ionCube](http://www.ioncube.com/) encrypted plugins inside the Shopware installation.

## Requirements

* Shopware 5.2.x or higher
* PHP 7.0 (newer PHP versions will not work )

## Installation

### Zip Installation package for the Shopware Plugin Manager

* Download the [latest plugin version](https://github.com/FriendsOfShopware/FroshIonCubeChecker/releases/latest/).
* Upload and install plugin using Plugin Manager.

### Git Version
* Checkout Plugin in `/custom/plugins/FroshIonCubeChecker`.
* Install the Plugin with the Plugin Manager.

## Features
* A new backend module lists all ionCube encrypted plugins with detailed information such as name, author, install status and path to the plugin.
* The same list can be displayed inside the console with the new command `sw:plugin:ioncube`.

## Images

![Backend module](https://i.imgur.com/xAv8V6L.png)

![CLI command](https://i.imgur.com/S2WRssq.png)

## Contributing

Feel free to fork and send pull requests!

## Licence

This project uses the [MIT License](LICENCE.md).
