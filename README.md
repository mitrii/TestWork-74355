
## Installation

1. `cp .env.example .env`

2. `composer install`

3. `vendor/bin/sail artisan key:generate`

4. `vendor/bin/sail artisan migrate`

5. `npm install`

## Run

### Seed test data
`vendor/bin/sail artisan db:seed`

### Run backend
`vendor/bin/sail up`

### Run frontend
`npm run watch`

## Run tests

`vendor/bin/sail artisan test`
