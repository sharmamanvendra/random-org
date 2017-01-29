random-org-php
==============

Random.org JSON-RPC Client implementation for PHP


## Technical details:  
https://api.random.org/json-rpc/1/<br>

## Example:
```php
$random = new \Odan\Random\RandomOrgClient();

// Get a API key: https://api.random.org/api-keys
$random->setApiKey('');

// Generate 5 true random integers between 1-100
$integers = $random->generateIntegers(5, 1, 100);
var_dump($integers);

```
