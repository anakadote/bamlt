# BAM Lead Tracker Service Class

Send a lead to the default BAM Lead Tracker web service.

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `anakadote/bamlt`.

	"require": {
		"anakadote/bamlt": "dev-master"
	}

Next, update Composer from the Terminal:

    composer update

Next, add the service provider. Open `config/app.php` and add a new item to the providers array.

    Anakadote\BAMLT\BAMLTProvider::class


## Usage

     with(new BAMLT)->send(env('BAMLT_URI'), $request->all());

This package is also accessible via a Laravel Facade so to use simply call its methods on the Facade "BAMLT".
