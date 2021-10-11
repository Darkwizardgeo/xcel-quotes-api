# Xcelirate Jorge Sanchez Test

This is a Symfony 5 base skeleton with some changes to respond to an API call like `/api/quote/{famous-person}?limit={number}` as asked on [Test Sent](https://github.com/Xcelirate/backend_test). To run the application we have to ways the Symfony Http Dev server and a small `docker-compose.yml` that will allow us to run it as a container.

## Symfony way

To run the symfony with the dev serve we should first:

1. Install [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) if do not have it already.

2. Create `.env` and `.env-test` files from example (not available if downloaded from Github).

3. Run `composer install` from project root.

4. Run `bin/console symfony start` and access application from `http://localhost:8000`.

## Docker Way

To run the app with `docker-composer.yml` file.

1. Install [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) if do not have it already.

2. Install docker and docker-composer if not already. Follow the official page guide instruction.

3. Create `.env` and `.env-test` files from example (not available if downloaded from Github).

4. Run `composer install` from project root.

5. On Folder root run command `docker-compose up` to build and run aplication from the file instruction.

6. If everything is up and no error on build you can access application from `http://localhost:8000`.

To run this as a Command Line application we can also use Symfony Console Commands Feature to create one that accepts arguments and uses the same Service as the Api Controller and it should work.
