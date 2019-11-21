🍎 Compotes 🍏
=============

A <abbr title="Work in progress">WIP</abbr> application to view bank operations.

This is meant to be used locally, for **your local machine**, not online. That would be quite unfortunate to view all your bank operations in a row.

# Install

This is a PHP/Symfony project, so:

* Run `composer install` to install the dependencies.
* You need a running SQL database of whatever kind you want, then you need to set the `DATABASE_URL` environment var in `.env.local` if the defaults do not suit you.
* To run the server in dev, you can [download the Symfony CLI on `symfony.com/download`](https://symfony.com/download) and run the `symfony serve --daemon` to run it in the background. Note that during the development process (cache clear, etc.) you might have to restart it 

# Operations

Bank operations can be imported from files via this command:

```
$ php bin/console operations:import
```

Here are the requirements:

* File format must be CSV.
* File name must be `year-month.csv`.
* First line of the file must be headers (no specific syntax, could be empty headers, we don't use them anyway).
* Each line column must be the following:
  1. Date in `d/m/Y` format (nothing else supported for now).
  2. Operation type (given by bank provider).
  3. Display type (not mandatory, can be an empty string).
  4. Operation details (can be a longer string).
  5. Amount in cents. Note that this can be a string like `1 234,55` or `1,234.55`. Every non-digit character (except `+` and `-`) will be removed and all remaining numbers will make the amount in cents. We don't store as floats to avoid [floating point issues](https://0.30000000000000004.com/).

# Roadmap/TODO list

* Make many analytics dashboards.
* Operation tags (insurance, internet provider, car loan, etc.). Multiple tags per operation.
* Implement more source file types like xls, ods, etc., that could be transformed to CSV before importing them. [PHPSpreadsheet](https://phpspreadsheet.readthedocs.io/) is already installed, though not used yet.
* Custom source file format.
* Change CSV headers at runtime (could be done with a command-line `InputOption::VALUE_IS_ARRAY` option).
* Change CSV delimiter/enclosure at runtime.
* Change input operation date format.
* Multiple bank accounts
* Operation currency
* Docker setup, maybe?