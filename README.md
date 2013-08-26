# Laravel 4 Asset Pipeline Package For Handlebars.js

Bring in your `.jst.hbs` JST templates and also Handlebars into your Laravel 4 application.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `codesleeve/l4-asset-handlebars`.

It might look something like:

```php
  "require": {
    "laravel/framework": "4.0.*",
    "codesleeve/l4-asset-handlebars": "dev-master"
  }
```

Next, update Composer from the Terminal:

```php
    composer update
```

Once this operation completes, add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

```php
    'Codesleeve\L4AssetHandlebars\L4AssetHandlebarsServiceProvider'
```


## Usage

Once installed you can add this your Asset pipeline manifest file `[laravel_root]/app/assets/javascripts/application.js`

```
	//= require handlebars
```

Now create a file `app/assets/javascripts/myfirst.jst.hbs`

```html
	<div> Put some html here, {{smeagol}} </div>
```

After refreshing the page inspect JST object in the javascript console and the function

```
	JST['myfirst']({smeagol: 'precious!!!'})
```

which should give you 

```html
	<div> Put some html here, previous </div>
```
