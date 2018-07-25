# FutureActivities API

This is a Magento 2 extension that provides additional API endpoints and customisations 
that you may find useful.

## Endpoints

### Information about a URL key

    GET /rest/V1/pageKey/:param

Retrieves details about the URL, such as the type of page and any corresponding IDs.

Example:

    /rest/V1/pageKey/home
    
might return:

    <response>
        <type>cms-page</type>
        <id>2</id>
    </response>

### Get Product by SKU

    GET /rest/V1/productBySku/:sku
    
Retrieves a product by the product SKU.

### Get Product by ID

    GET /rest/V1/productById/:productId
    
Retrieves a product by the product ID.
    
### Get all products with basic info

Returns a list of all products with name and url - only includes products enabled and visible.

    GET /rest/V1/fa/productNames
    
### Get categories by specific field

Returns a list of categories and all their children

    GET /rest/V1/fa/categories
    
With the following params

    values - an array of top level category values to load, e.g. IDs
    field - the field to search the categories by, defaults to `entity_id` if empty
    
### Get all products, categories & CMS pages with very minimal data

Returns a list of all products, categories & CMS pages, typically with only their
name and URL. This is intended to be used for quick searching.

    GET /rest/V1/fa/searchData

### Reset a customers password

    POST /rest/V1/customers/resetPassword
    
Opens this endpoint up to be run anonymously.

### Set a billing & shipping address without required a shipping method

    POST /rest/V1/carts/mine/addresses
    POST /rest/V1/guest-carts/:cartId/addresses
    
This will allow you to set a shipping or billing address to customers cart.
Consider why you are using this endpoint as you should probably be using 
`carts/mine/shipping-information` instead passing in the customer addresses and 
selected shipping method.

### Store View Currency

The store views currency is being added to the following endpoint:

    GET /rest/V1/store/storeViews
    
### Merge guest cart with a customers cart

This will merge the selected guest cart with the customers cart

    GET /rest/V1/carts/mine/transfer/:guestCartId
    
Where `cartId` is the guest cart masked ID.

### Tax Rates

Adds the following REST API endpoints:

    GET /V1/taxRates
    GET /V1/customer/taxRates
    
This will return a list of all tax class IDs and their corresponding tax rate.

### Customer Downloads

To return a list of available downloadable products purchased by the customer:

    GET /rest/V1/customers/me/downloads
    
## PLUGINS

### Configurable Products Link Management

Override the `getChildren` function to ensure response contains the extension
attributes and media gallery. Due to a bug in Magento this is missing by default.
See: https://github.com/magento/magento2/issues/8700

### Product Repository

Add `configurable_product_options_labels` to extension attributes.
This will work the same way as `configurable_product_options` but also includes the label
instead of just an ID.

### Store Repository

Adds `display_currency` to extension attributes

## CHANGELOG

### v1.6
- Tidied up and split filters into a new extension

### v1.5
- Added additional plugins to fix Magento bug #8700

### v1.4
- Added a new customer downloads feed