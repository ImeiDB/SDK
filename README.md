# ImeiDB SDK
IMEIDB - big database that allows you to decrypt IMEI mobile devices and receive information about them.

Website: https://imeidb.xyz

## Capability

* Retrieve information about current state of balance
* Decode IMEI and retrieve information about it

## Installation
Install basic component using composer
```bash
composer require imeidb/sdk
```

## Examples
**{YOUR_SECRET_TOKEN}** - Your personal code for accessing the API, which can be found in your personal account. (Here: https://imeidb.xyz/user)

```php
use imeidb\sdk\ImeiDBClient;

# Init 
$client = new ImeiDBClient('{YOUR_SECRET_TOKEN}');

# Get information about the current state of the account
$response = $client->getBalance();

# Decode the imei number
$response = $client->getDecode('352877111096108');

# Process results
if ($response->getStatusCode() === 200) {
    $data = json_decode($response->getBody()->getContents());
}
```

Basically information will be returned in **JSON** format. We support both JSON and XML:

```php
use imeidb\sdk\ImeiDBClient;

# Using initialize method
$client = new ImeiDBClient('{YOUR_SECRET_TOKEN}', ImeiDBClient::FORMAT_XML);
# or using dynamically change format
$client->setFormat(ImeiDBClient::FORMAT_XML);
```
