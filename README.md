# php-mattermost-driver (v4)

[![Latest Stable Version][7]][8] [![Scrutinizer Code Quality][5]][6]

Completed Php Driver to interact with the [Mattermost Web Service API][4].  

Please read [the api documentation][1] for further information on using this application.

## Installation
### Composer
The best way to install php-mattermost-driver is to use Composer:

```
composer require gnello/php-mattermost-driver
```

Read more about how to install and use Composer on your local machine [here][3].

#### V3
If you want to install the [V3 Driver][9] instead of the V4 one you should do:

```
composer require gnello/php-mattermost-driver:1.*
```

## Usage
### Authentication

```php
 use \Gnello\Mattermost\Driver;

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
 $result = $driver->authenticate();
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
    'email'    => 'test@test.com', 
    'username' => 'test', 
    'password' => 'testpsw'
];
$result = $driver->getUserModel()->createUser($requestOptions);

//Get a user
$result = $driver->getUserModel()->getUserByUsername('username');
```

### Channel data model
```php
//Create a channel
$requestOptions = [
    'name'         => 'new_channel',
    'display_name' => 'New Channel',
    'type'         => 'O',
];
$result = $driver->getChannelModel()->createChannel($requestOptions);


//Get a channel
$result = $driver->getChannelModel()->getChannelByName('team_id_of_the_channels_to_return', 'new_channel');
```

### Post data model
```php
//Create a post
$requestOptions = [
    'channel_id'    => 'channel_id'
    'message'       => 'hello world!'
];
$result = $driver->getPostModel()->createPost($requestOptions);


//Get a post
$postId = 'post_id_of_the_post_to_return';
$result = $driver->getPostModel()->getPost($postId);
```

### Preference data model
```php
//Get a list of the user's preferences
$userId = 'user_id';
$result = $driver->getPreferenceModel($userId)->getUserPreference();
```

## Contact
- luca@gnello.com

[1]: https://api.mattermost.com/
[2]: http://www.php-fig.org/psr/psr-7/
[3]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx
[4]: https://about.mattermost.com/
[5]: https://scrutinizer-ci.com/g/gnello/php-mattermost-driver/badges/quality-score.png?b=master
[6]: https://scrutinizer-ci.com/g/gnello/php-mattermost-driver/?branch=master
[7]: https://poser.pugx.org/gnello/php-mattermost-driver/v/stable
[8]: https://packagist.org/packages/gnello/php-mattermost-driver
[9]: https://github.com/gnello/php-mattermost-driver/tree/v1.3.0