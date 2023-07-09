# Font Awesome SVG - PHP

A PHP class that can be used to add [Font Awesome 6+](https://fontawesome.com/)'s SVG icons inline without Javascript.

## Installation

You can install it using Composer:

```
composer require husseinalhammad/fontawesome-svg
```

Or you can download the `FontAwesomeSVG.php` file and include it manually.

## Usage

### Files

- Download Font Awesome (Free or Pro)
- Get the folder `advanced-options/raw-svg` and place it in your project
- Add `svg-with-js/css/fa-svg-with-js` to your document (or write your own CSS)

### Examples

```php
// $dir = directory where SVG files are
$FA = new FontAwesomeSVG($dir);

echo $FA->get_svg('fa-solid fa-file');
```

Add custom classes:

```php
echo $FA->get_svg('fa-solid fa-file', ['class' => 'my-custom-class another-class']);
```

Remove default class `.svg-inline--fa`:

```php
echo $FA->get_svg('fa-solid fa-file', ['default_class' => false]);
```

Change `<path>` fill (default is `currentColor`):

```php
echo $FA->get_svg('fa-solid fa-file', ['fill' => '#f44336']);
```

Add `<title></title>`:

```php
echo $FA->get_svg('fa-solid fa-file', ['title' => 'My accessible icon']);
```

Multiple options at once:

```php
echo $FA->get_svg('fa-solid fa-file', [
    'class' => 'my-custom-class another-class',
    'default_class' => false,
    'title' => 'My title',
    'role' => 'img',
    'fill' => '#ffffff',
]);
```

Customise duotone icons:

```php
echo $FA->get_svg('fa-duotone fa-laugh-wink', [
    'primary' => [
        'fill'    => '#e64980',
    ],
    'secondary' => [
        'fill'    => '#fcc417',
        'opacity' => '1',
    ],
]);
```

| Option        | What it means                                                                                     |
| ------------- | ------------------------------------------------------------------------------------------------- |
| class         | Adds classes to the SVG tag                                                                       |
| default_class | If set to `false`, the default CSS class won't be added to the SVG tag. Deafult: `true`.          |
| inline_style  | Whether to add duotone styles as inline style to the `<svg>` tag. Deafult: `true`.                |
| title         | Adds a `<title>` inside the SVG tag for semantic icons                                            |
| title_id      | Adds an `id` attribute to `<title>` and adds `aria-labelledby` on the SVG tag with the same value |
| role          | The value of the `role` attribute in the SVG tag. Default: `img`                                  |
| fill          | The value of the `fill` attribute in the `<path>` inside the SVG. Default: `currentColor`         |
| primary       | Duotone primary options (see table below)                                                         |
| secondary     | Duotone secondary options (see table below)                                                       |

## Duotone

> Requires **v5.10.0** or greater, and a FontAwesome Pro license

## Sharp

> Requires **v6.4.0** or greater, and a FontAwesome Pro license

```php
echo $FA->get_svg('fa-sharp fa-light fa-file');
echo $FA->get_svg('fa-sharp fa-regular fa-file');
echo $FA->get_svg('fa-sharp fa-solid fa-file');
```

### options

If `inline_style` is enabled, the value of `fill` and `opacity` are also used in the inline style on `<svg>` tag.

| Option  | What it means                                                                             |
| ------- | ----------------------------------------------------------------------------------------- |
| fill    | The value of the `fill` attribute in the `<path>` inside the SVG. Default: `currentColor` |
| opacity | The value of the `opacity` attribute in the `<path>` inside the SVG.                      |

### Examples:

Single colour:

```php
echo $FA->get_svg('fad fa-laugh-wink', [
    'fill' => '#e64980',
]);
```

Swapping Layer Opacity:

```php
echo $FA->get_svg('fad fa-laugh-wink', [
    'fill'  => '#e64980',
    'class' => 'fa-swap-opacity',
]);
```

Single colour with custom opacity:

```php
echo $FA->get_svg('fad fa-laugh-wink', [
    'fill' => '#e64980',
    'secondary' => [
        'opacity' => '0.2',
    ],
]);
```

Custom colours and opacity:

```php
echo $FA->get_svg('fad fa-laugh-wink', [
    'primary' => [
        'fill'    => '#e64980',
        'opacity' => '0.5',
    ],
    'secondary' => [
        'fill'    => '#fcc417',
        'opacity' => '1',
    ],
]);
```

## Aliases

The short aliases from version 5 are still supported

```php
echo $FA->get_svg('fab fa-twitter');
echo $FA->get_svg('fad fa-file');
echo $FA->get_svg('fal fa-file');
echo $FA->get_svg('far fa-file');
echo $FA->get_svg('fas fa-file');

// And the new shorthands for thin and sharp
echo $FA->get_svg('fat fa-file'); // thin
echo $FA->get_svg('fasl fa-file'); // sharp-light
echo $FA->get_svg('fasr fa-file'); // sharp-regular
echo $FA->get_svg('fass fa-file'); // sharp-solid
```

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
echo $FA->get_svg('fa-solid fa-file', [
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

You can add any aria-\* attribute to the SVG tag:

```php
echo $FA->get_svg('fa-solid fa-file', [
    'aria-label' => 'File',
]);
```

```html
<svg aria-label="File"></svg>
```

### `aria-hidden` attribute

`aria-hidden="true"` is added to the SVG tag by default unless `<title id="">` (and `aria-labelledby`) or `aria-label` is set.

```php
echo $FA->get_svg('fa-solid fa-file');
```

```html
<svg aria-hidden="true"></svg>
```
