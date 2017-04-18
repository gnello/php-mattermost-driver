# php-mattermost-driver

Complete Php Driver to interact with the Mattermost Web Service API.

Please read [the api documentation][1] for further information on using this application.

## Installation
### Composer
The best way to install php-mattermost-driver is to use Composer:

```
composer require gnello/php-mattermost-driver
```

Read more about how to install and use Composer on your local machine [here][9].

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
         'verify' => false
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

### Check result
This Driver follow the [PSR-7][2] document

```php
if($result['response']) {
    echo $result['output'];
} else {
    echo 'Error!';
}
```
### Users
```php
//Add a new user
$properties = array('key1' => 'value1', 'key2' => 'value2');
$result = $driver->getUserModel()->createUser($properties);
```

## Contact
- gnello luca@gnello.com

[1]: https://api.mattermost.com/
[2]: http://www.php-fig.org/psr/psr-7/