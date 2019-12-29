# Font Awesome SVG - PHP

A PHP class that can be used to add [Font Awesome 5+](https://fontawesome.com/)'s SVG icons inline without Javascript.

## Installation

You can install it using Composer:

```
composer require husseinalhammad/fontawesome-svg
```

Or you can download the `FontAwesomeSVG.php` file and include it manually.


## Usage

### Files

* Download Font Awesome (Free or Pro)
* Get the folder `advanced-options/raw-svg` and place it in your project
* Add `svg-with-js/css/fa-svg-with-js` to your document (or write your own CSS)

### Examples

```php
// $dir = directory where SVG files are
$FA = new FontAwesomeSVG($dir);

echo $FA->get_svg('fas fa-file');
```

Add custom classes:

```php
echo $FA->get_svg('fas fa-file', ['class' => 'my-custom-class another-class']);
```

Remove default class `.svg-inline--fa`:

```php
echo $FA->get_svg('fas fa-file', ['default_class' => false]);
```

Change `<path>` fill (default is `currentColor`):

```php
echo $FA->get_svg('fas fa-file', ['fill' => '#f44336']);
```

Add `<title></title>`:

```php
echo $FA->get_svg('fas fa-file', ['title' => 'My accessible icon']);
```

Multiple options at once:

```php
echo $FA->get_svg('fas fa-file', [
    'class' => 'my-custom-class another-class',
    'default_class' => false,
    'title' => 'My title',
    'role' => 'img',
    'fill' => '#ffffff',
]);
```

| Option                | What it means   |
|-----------------------|--------------------------------------------------------------------------|
| class                 | Adds classes to the SVG tag |
| default_class         | If set to `false`, the default CSS class won't be added to the SVG tag. Deafult: `true`.  |
| title                 | Adds a `<title>` inside the SVG tag for semantic icons |
| title_id              | Adds an `id` attribute to `<title>` and adds `aria-labelledby` on the SVG tag with the same value |
| role                  | The value of the `role` attribute in the SVG tag. Default: `img` |
| fill                  | The value of the `fill` attribute in the `<path>` inside the SVG. Default: `currentColor` |


## Accessibility

* `role="img"` is added to the SVG tag by default
* `aria-hidden="true"` is added to the SVG tag by default unless a `<title>` is set
* You can add `aria-labelledby` to the SVG tag and `id` to `<title>`