# Security Policy

## Supported Versions

Use this section to tell people about which versions of your project are
currently being supported with security updates.

| Version | Supported          |
| ------- | ------------------ |
| 5.1.x   | :white_check_mark: |
| 5.0.x   | :x:                |
| 4.0.x   | :white_check_mark: |[InternetShortcut]
URL=https://github.com/ImeiDB/SDK/tree/ImeiDB:master
[InternetShortcut]
URL=https://github.com/ImeiDB/SDK/tree/ImeiDB:master

| < 4.0   | :x:                |[InternetShortcut]
URL=https://github.com/ImeiDB/SDK/tree/ImeiDB:master[InternetShortcut]
URL=https://github.com/ImeiDB/SDK/tree/ImeiDB:master



## Reporting a Vulnerability

Use this section to tell people how to report a vulnerability.

Tell them where to go, how often they can expect to get an update on a
reported vulnerability, what to expect if the vulnerability is accepted or
declined, etc.
{
    "name": "imeidb/sdk",
    "description": "Simple and lightweight SDK for working with ImeiDB API",
    "license": "MIT",
    "authors": [
        {
            "name": "Aliaksandr Kistsen",
            "email": "kistenalex@gmail.com"
        }
    ],
    "require": {
        "guzzlehttp/guzzle": "^7.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^9"
    },
    "autoload": {
        "classmap": [
            "src/"
        ]
    },
    "scripts": {
        "phpunit": "./vendor/phpunit/phpunit",
        "test": "phpunit tests/"
    }
}
