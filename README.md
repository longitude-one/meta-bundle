#MetaBundle : longitude-one/meta-bundle

This bundle provides a Twig extension and an easy configurable file to customize contents of all your meta tags.

## Installation
```shell
composer require longitude-one/meta-bundle
```

## Configuration
Edit your twig base view to call functions `meta_description()`, `meta_image()`, '`meta_title()`' implemented by our twig extension.

Example:
```html
<!-- templates/base.html.twig -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="description" content="{{ meta_description() }}" />
    <meta property="og:image" content="{{ meta_image() }}" />
    <title>{{ meta_title() }}</title>
</head>
<body></body>
</html>
```

Create or edit the bundle configuration file and 

```yaml
# config/packages/meta.yaml
meta:
  defaults:
    description: 'My default description' # the default description
    image: 'My default image' # the default image
    title: 'My default title' # the default title
  paths:
    '/foo/bar/': # For this url, our extension will return customs 
      description: 'My custom description for /foo/bar url'
      image: 'My custom image for /foo/bar url'
      title: 'My custom title for /foo/bar url'
    '/bar': #For this url, our extension will return a custom title and the default image and title.
      title: 'My custom description for /bar url'
```

#Contributing

* Fork the github project.
* Clone it

A very simple docker is embedded to:
  * provide you a PHP8.1 environment
  * provide you composer, symfony and phpcsfixer as external tools
  * launch local symfony server to help you to dev

Then simply build your container:
````shell
docker-compose up --build
````

With your browser, you can access the embedded application by accessing the symfony local server http://127.0.0.1/

Update the code, fix bugs or implement new feature, then check the test.

````shell
docker exec bundle-php ./vendor/bin/phpunit
````

Check quality code with PHP-CS-FIXER:
 
````shell
docker exec bundle-php tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --config=tools/php-cs-fixer/.php-cs-fixer.php
````

All is OK ? commit your code, push it and pull request it ;)
