# php-mattermost-driver (v3)

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

### Team data model
```php
//Add a new team
$requestOptions = [
    'name'         => 'new_team',
    'display_name' => 'New Team',
    'type'         => 'O',
];
$result = $driver->getTeamModel()->createTeam($requestOptions);


//Get a team
$result = $driver->getTeamModel()->getTeamByName('new_team');
```

### Channel data model
```php
//Create a channel
$teamId = 'team_id_to_add_the_channel_to';
$requestOptions = [
    'name'         => 'new_channel',
    'display_name' => 'New Channel',
    'type'         => 'O',
];
$result = $driver->getChannelModel($teamId)->createChannel($requestOptions);


//Get a channel
$teamId = 'team_id_of_the_channels_to_return';
$result = $driver->getChannelModel($teamId)->getChannelByName('new_channel');
```

### Post data model
```php
//Create a post
$teamId = 'team_id_to_create_the_post_to';
$channelId = 'channel_id_to_create_the_post_to';
$requestOptions = [
    'message'   => 'hello world!'
];
$result = $driver->getPostModel($teamId)->createPost($channelId, $requestOptions);


//Get a post
$teamId = 'team_id_of_the_post_to_return';
$channelId = 'channel_id_of_the_post_to_return';
$postId = 'post_id_of_the_post_to_return';
$result = $driver->getPostModel($teamId)->getPost($channelId, $postId);
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
