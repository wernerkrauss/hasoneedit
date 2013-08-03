# Has One Edit

This module allows you to directly edit the fields of a related has_one object directly, without having to mess around with GridField or links to ModelAdmin. If the related has_one doesn't exist yet, then this module also creates the object and sets up the relation for you on first write.

This module has been tested editing a has_one in both a GridFieldDetailForm and on a generic Page in CMSMain.

## Requirements

SilverStripe 3.x.

This module has been tested on both 3.0.x-dev and 3.1.x-dev. There is no separate version for the two different Framework branches.

## Usage

To use this module, simply add a field to the CMS fields for your object in your `getCMSFields()` method. The name of the field should be `HasOneName:FieldName`.

For example, say you have a has_one called `Show` and that has_one has a field called `Title` you want to edit. You'd add the field `TextField::create('Show:Title', 'Show Title')`.

### Using with your own form

To add support to your own forms, you need to add the `sgn_hasoneedit_UpdateFormExtension` extension to your controller and call `$this->extend('updateEditForm', $form)` before returning the form to the template. Without this, the fields will not get populated with the values from the has_one though saving will work.
