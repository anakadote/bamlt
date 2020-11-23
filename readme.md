# BAM Lead Tracker Service Class

Send a lead to the default BAM Lead Tracker web service.

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `anakadote/bamlt`.

	"require": {
		"anakadote/bamlt": "dev-master"
	}

Next, update Composer from the Terminal:

    composer update


## Usage

There is one public method available, **send(string $uri, array $input, $is_client_uri = false)**, which takes three parameters:

1. **$uri**  - (required) BAM Lead Tracker URI
2. **$input** - (required)
3. **$is_client_uri** - true for a Client URI, false for a Store URI


    with(new BAMLT)->send(BAMLT_URI, $input);


### Laravel

To use with Laravel, add the service provider. Open `config/app.php` and add a new item to the providers array.

    Anakadote\BAMLT\BAMLTServiceProvider::class

This package is also accessible via a Laravel Facade so to use simply call its methods on the Facade "BAMLT":  

    BAMLT::send(env('BAMLT_URI'), $request->all())
