# php-mattermost-driver (v3.7.0)

Completed Php Driver to interact with the Mattermost Web Service API.

Version of the Mattermost server required: 3.7.0

Please read [the api documentation][1] for further information on using this application.

## Installation
### Composer
The best way to install php-mattermost-driver is to use Composer:

```
composer require gnello/php-mattermost-driver
```

Read more about how to install and use Composer on your local machine [here][3].

## Usage
### Authentication

```php
 $container = new \Pimple\Container([
     'driver'    => [
         'url'       => 'your_chat_url',
         'login_id'  => 'your_login_id',
         'password'  => 'your_password',
     ],
     'guzzle'    => [
         //put here any options for Guzzle
     ]
 ]);
 
 $driver = new Driver($container);
 $login = $driver->authenticate();
 
 if ($login) {
    echo "SUCCESS!";
 } else {
    echo "SOMETHING WENT WRONG.";
 }
 ```

### Check results
This Driver follows the [PSR-7][2] document therefore any response is a ResponseInterface type:

```php
if ($result->getStatusCode() == 200) {
    echo "Everything is ok.";
    var_dump(json_decode($result->getBody()));
} else {
    echo "HTTP ERROR " . $result->getStatusCode();
}

```
### User data model
```php
//Add a new user
$requestOptions = [
    'email' => 'test@test.com', 
    'username' => 'test', 
    'password' => 'testpsw'
];
$result = $driver->getUserModel()->createUser($requestOptions);

//Get a user
$res = $driver->getUserModel()->getUserByUsername('username');
```

### Team data model
In Development, coming soon!

## ToDo
*[ ] Add Team data model (in development)
*[ ] Add Channel data model
*[ ] Add Post data model
*[ ] Add File data model
*[ ] Add Admin data model
*[ ] Add Preference data model

## Contact
- luca@gnello.com

[1]: https://api.mattermost.com/
[2]: http://www.php-fig.org/psr/psr-7/
[3]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx