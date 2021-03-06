MultiValue Textformatter for ProcessWire
================

Set flexible data structures in "key = value1, value2, ..." format to use as variable groups in templates.

Great for general site settings, social links, menus, or just grouping items together without creating separate fields.

Features
---------------------------------------

- create groups of variables using only a single textarea/text field
- easy value retrieval
- (optional) row headers
- scalability: add as many rows and items as you need, or change their order
- fallback to original field value
- multilanguage ready through FieldtypeTextLanguage and FieldtypeTextareaLanguage field types

Usage
---------------------------------------

1. Copy module files to "/site/modules/TextformatterMultiValue/" directory
2. Go to Modules in the admin, Refresh and Install the module "MultiValue Textformatter"
3. Create a field of type FieldtypeTextarea or FieldtypeText
4. Apply "MultiValue Textformatter" textformatter on the field's "Details" tab
5. Enter rows with keys and items (see syntax below)

Syntax
---------------------------------------

**Rows**

Rows consists of a "row key" (optional) and item(s).
The key separator is the " = " and the items separator is ":::".
**Note**: from version 1.3.1 the spaces in the key separator are mandatory.

```txt
Row key = Some value ::: Another value ::: Yet another value
```

Row key can be any string, it will be converted to lowercase and sanitized.
For example the key "Row key" will be converted to "row_key".
This key will be used for retrieval in template files.

***No keys mode***

Keys can be optionally left out which allows setting items simply by listing them:

```txt
https://player.vimeo.com/video/123456
https://player.vimeo.com/video/654321
https://player.vimeo.com/video/321645
```

Retrieval for the above:

```php
foreach($page->video_links as $video_link) {
    echo '<iframe src="' . $video_link . '"></iframe>';
}
```

**Row header**

If the first line begins with the "@" character it indicates it contains row headers.

```txt
@ url ::: title ::: target
Facebook = https://facebook.com/mycompany ::: Follow us on Facebook ::: _blank
Linkedin = https://www.linkedin.com/mycompany ::: NULL ::: _blank
Email = #contact ::: Contact
```
Row headers are optional but thely will help you retrieving items. 
For example, to get the "title" item, use this:

```php
echo $page->my_field->facebook->title
// result: "Follow us on Facebook"

echo $page->my_field->email->title
// result: "Contact"
```

If row headers are missing you can get the items using "valueX", where "X" is the index of the item (zero-based!):
```php
echo $page->my_field->facebook->value1
// result: "Follow us on Facebook"
```

**Number and order of items**

You can use any number of items in a row, and rows doesn't need to contain the same number of items.
However, the order of the item is important, so if an item is not needed, substitute it with the "NULL" placeholder value:

```txt
@ url ::: title ::: target
Linkedin = https://www.linkedin.com/mycompany ::: NULL ::: _blank
```

In the example above "$page->my_field->linkedin->title" will be an empty string.

**Misc**

- when no key is set the unmodified field value is returned ($page->field)
- get the number of rows using "$page->field->count"
- get the number of items using "$page->field->key->count"
- check if a key name is available using "$page->field->hasName"

**Comments**

Use "//" to comment out items.

```txt
// Info = this row will be skipped.
```

Cheat sheet
---------------------------------------

```php
$page->field->key            // item value
$page->field->key->value     // item value
$page->field->key->value2    // third item value (if no headers set, value0, value1, ...)
$page->field->key->name      // human readable key name
$page->field->key->count     // number of row items
$page->field                 // original field value (no modification)
$page->field->count          // number of field rows
$page->field->hasName        // true if key name is set, false if not
$page->field->original       // original field value (no modification)
```

License
---------------------------------------

Licensed under the MIT license.

MultiValue textformatter is provided "as-is" without warranty of any kind, express, implied or otherwise, including without limitation, any warranty of merchantability or fitness for a particular purpose. In no event shall the author of this software be held liable for data loss, damages, loss of profits or any other kind of loss while using or misusing this software.
