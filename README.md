# Arillo\Elements\Menu

[![Latest Stable Version](https://poser.pugx.org/arillo/silverstripe-elements-menu/v/stable?format=flat)](https://packagist.org/packages/arillo/silverstripe-elements-menu)
&nbsp;
[![Total Downloads](https://poser.pugx.org/arillo/silverstripe-elements-menu/downloads?format=flat)](https://packagist.org/packages/arillo/silverstripe-elements-menu)

Adds inpage menus for Arillo\Elements.

### Requirements

SilverStripe CMS ^4.0
arillo/silverstripe-elements >=2.0.5

## Installation

Install with composer:

```bash
composer require arillo/silverstripe-elements-menu
```

## Usage

### PHP

`Arillo\Elements\Menu\ElementBaseExtension` is already added to `Arillo\Elements\ElementBase` when this package is installed. You need to use `Arillo\Elements\Menu\ElementsMenu` in your `Page.php` e.g.:

```php
<?php

use SilverStripe\CMS\Model\SiteTree;
use Arillo\Elements\Menu\ElementsMenu;

class Page extends SiteTree
{
    // optional configure element relation name you want to use as menu.
    // Default: Elements
    private static $elements_menu_relationname = '<YOUR_RELATION_NAME>';

    // can be used to deactivate inpage-menus for certain SiteTree subclasses.
    private static $disable_elements_menu = true;

    // add this
    use ElementsMenu;
}
```

### Templates

You can use `ElementsMenu.ss` provided by this module:

```
<% include ElementsMenu %>
```

or you might to provide your own markup e.g.:

```
<% if $ElementsMenuItems.Exists %>
  <ul>
    <% loop $ElementsMenuItems %>
      <li>
        <a href="#$URLSegment">
          <% if $MenuTitle %>$MenuTitle<% else %>$Title<% end_if %>
        </a>
      </li>
    <% end_loop %>
  </ul>
<% end_if %>
```

