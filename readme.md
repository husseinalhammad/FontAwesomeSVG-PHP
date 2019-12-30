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

The below is implemented based on:

- Font Awesome's [Accessibility docs](https://fontawesome.com/how-to-use/on-the-web/other-topics/accessibility)
- Heather Migliorisi's article on CSS-Tricks [Accessible SVGs](https://css-tricks.com/accessible-svgs/)


### `role` attribute

`role="img"` is added to the SVG tag by default:

```html
<svg role="img"></svg>
```


### `<title>`, `aria-labelledby`

You can set a `<title>`, an `id` for the `<title>` and the `aria-labelledby` attribute will be added automatically:

```php
echo $FA->get_svg('fas fa-file', [
    'title' => 'File',
    'title_id' => 'file-id',
]);
```

```html
<svg aria-labelledby="file-id">
    <title id="file-id">File</title>
</svg>
```


### `aria-*` attributes

You can add any aria-* attribute to the SVG tag:

```php
echo $FA->get_svg('fas fa-file', [
    'aria-label' => 'File',
]);
```

```html
<svg aria-label="File"></svg>
```


### `aria-hidden` attribute

`aria-hidden="true"` is added to the SVG tag by default unless `<title id="">` or `aria-label` is set.

```php
echo $FA->get_svg('fas fa-file');
```

```html
<svg aria-hidden="true"></svg>
```