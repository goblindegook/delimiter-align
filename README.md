# goblindegook/delimiter-align

Aligns and rebalances plain text multiline strings around a delimiter.

In short, it turns this:

```
one: 1
two: 2
three: 3
```

into this:

```
one:   1
two:   2
three: 3
```

## Installation

Install using Composer by running the following in your project directory:

```
$ composer require goblindegook/delimiter-align
```

## Description

```php
string delimiter_align ( string $string [, string $delimiter ] [, array $options ] );
```

Aligns and rebalances plain text multiline strings around a delimiter.

### Parameters

#### `string`
Multiline string to align.

#### `delimiter`
Boundary string to align around. (Optional, defaults to `:`.)

#### `options`
Alignment options:

| Option   | Description                                         | Default |
| :------- | :-------------------------------------------------- | :------ |
| `before` | String prepended to the padded delimiter.           | (empty) |
| `after`  | String appended to the padded delimiter.            | `' '`   |
| `pad`    | Padding character.                                  | `' '`   |
| `right`  | Align the delimiter by placing padding on the left. | `false` |

### Return Value

Returns the `string` aligned around the provided `delimiter`.
