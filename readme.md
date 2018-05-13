# Font Awesome SVG - PHP

A PHP class that can be used to add [Font Awesome 5+](https://fontawesome.com/)'s SVG icons inline without Javascript.


## Usage

### Files

* Download Font Awesome (Free or Pro)
* Get the folder `advanced-options/raw-svg` and place it in your project
* Add `svg-with-js/css/fa-svg-with-js` to your document (or write your own CSS)

### Basic examples

```
// $dir = directory where SVG files are
$FA = new FontAwesomeSVG($dir);

echo $FA->get_svg('fas fa-file');
```

Add custom classes:

```
echo $FA->get_svg('fas fa-file', ['class' => 'my-custom-class another-class']);
```

Remove default class `.svg-inline--fa`:

```
echo $FA->get_svg('fas fa-file', ['default_class' => false]);
```

Add `<title></title>`:

```
echo $FA->get_svg('fas fa-file', ['title' => 'My accessible icon']);
```



## Accessibility

* `role="img"` is added to the SVG tag by default
* `aria-hidden="true"` is added to the SVG tag by default unless a `<title>` is set
