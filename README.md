# Laravel 4 Asset Pipeline Package For Handlebars.js and Ember.js

Compile your `.handlebars` templates and also deliver Handlebars into your Laravel 4 application.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `estshy/l4-asset-handlebars`.

It might look something like:

```php
  "require": {
    "laravel/framework": "4.0.*",
    "estshy/l4-asset-handlebars": "dev-master"
  }
```

Next, update Composer from the Terminal:

```php
    composer update
```

Once this operation completes, add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

```php
    'estshy\L4AssetHandlebars\L4AssetHandlebarsServiceProvider'
```


## Usage

Once installed you can add this your Asset pipeline manifest file `[laravel_root]/app/assets/javascripts/application.js`

```
	//= require handlebars
  //= require_tree .
```

Now create a file `app/assets/javascripts/application.handlebars`

```html
	<!doctype html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>My Ember Application</title>
  </head>
  <body>
    {{outlet}}
  </body>
  </html>
```

You can either put your templates in `templates` subdirectory, so your path will you look like this `app/assets/javascripts/templates/index.handlebars`