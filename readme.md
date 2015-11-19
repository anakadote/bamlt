# BAM Lead Tracker Service Class

Send a lead to the default BAM Lead Tracker web service.

## Usage

     with(new BAMLT)->send(env('BAMLT_URI'), $request->all());

This package is also accessible via a Laravel Facade so to use simply call its methods on the Facade "BAMLT".
