# [Connect2Field](connect2field.com/api/) PHP SDK

Connect2Field is a SaaS platform for service-oriented business such as pest control and landscaping companies to manage their business. I needed to do some custom integration with their API and wanted a better way to interact with their .NET web service than making raw curl calls to their system. This library aims to make building PHP-based integrations with the Connect2Field platform more pleasant.

## Basic usage
```php
<?php
include('php-connect2field.php');

$c2f = new Connect2Field('your-email', 'your-password');

print_r($c2f->all_clients());
?>
```