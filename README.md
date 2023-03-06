# php-mattermost-driver

[![Latest Stable Version][7]][8] [![Scrutinizer Code Quality][5]][6] [![Total Downloads][11]][12]

The PHP Driver to interact with the [Mattermost Web Service API][4].

Please read [the api documentation][1] for further information on using this application.

## Installation
### Composer
The best way to install php-mattermost-driver is to use Composer:

```
composer require gnello/php-mattermost-driver
```

Read more about how to install and use Composer on your local machine [here][3].

### Laravel
If you are going to install this library on laravel maybe you prefer to install the [laravel-mattermost-driver][10].

#### V3
If you want to install the [V3 Driver][9] instead of the V4 one you should do:

```
composer require gnello/php-mattermost-driver:1.*
```

## Usage
### Authentication

#### Login id and password
```php
use \Gnello\Mattermost\Driver;

// construct your own GuzzleHttp client instance
$guzzle = new GuzzleHttp/Client(...);

$driver = new Driver($guzzle, [
    'url' => 'your_chat_url',
    'login_id' => 'your_login_id',
    'password' => 'your_password',
]);
$result = $driver->authenticate();
```

#### Token
```php
 use \Gnello\Mattermost\Driver;

 // construct your own GuzzleHttp client instance
$guzzle = new GuzzleHttp/Client(...);

$driver = new Driver($guzzle, [
    'url' => 'your_chat_url',
    'token' => 'your_token',
]);

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
### Users endpoint
```php
//Add a new user
$result = $driver->getUserModel()->createUser([
    'email'    => 'test@test.com',
    'username' => 'test',
    'password' => 'testpsw'
]);

//Get a user
$result = $driver->getUserModel()->getUserByUsername('username');

//Please read the UserModel class or refer to the api documentation for a complete list of available methods.
```

### Channels endpoint
```php
//Create a channel
$result = $driver->getChannelModel()->createChannel([
    'name'         => 'new_channel',
    'display_name' => 'New Channel',
    'type'         => 'O',
]);


//Get a channel
$result = $driver->getChannelModel()->getChannelByName('team_id_of_the_channel_to_return', 'new_channel');

//Search a channel
$result = $driver->getChannelModel()->searchChannels($teamId, [
    'term' => "full or partial name or display name of channels"
]);

//Please read the ChannelModel class or refer to the api documentation for a complete list of available methods.
```

### Posts endpoint
```php
//Create a post
$result = $driver->getPostModel()->createPost([
    'channel_id' => 'The channel ID to post in',
    'message' => 'The message contents, can be formatted with Markdown',
]);


//Get a post
$result = $driver->getPostModel()->getPost('post_id_of_the_post_to_return');

//Please read the PostModel class or refer to the api documentation for a complete list of available methods.
```

### Files endpoint
```php
//Upload a file
$result = $driver->getFileModel()->uploadFile([
    'channel_id' => 'The ID of the channel that this file will be uploaded to',
    'filename' => 'The name of the file to be uploaded',
    'files' => fopen('Path of the file to be uploaded', 'rb'),
]);

//Send a post with the file just uploaded
$result = $driver->getPostModel()->createPost([
    'channel_id' => 'The channel ID to post in',
    'message' => 'The message contents, can be formatted with Markdown',
    'file_ids' => 'A list of file IDs to associate with the post',
]);

//Please read the FileModel class or refer to the api documentation for a complete list of available methods.
```

### Preferences endpoint
```php
//Get a list of the user's preferences
$result = $driver->getPreferenceModel('user_id')->getUserPreference();

//Please read the PreferenceModel class or refer to the api documentation for a complete list of available methods.
```

## Endpoints supported

- [Bleve](https://api.mattermost.com/#tag/bleve)
- [Bots](https://api.mattermost.com/#tag/bots)
- [Brand](https://api.mattermost.com/#tag/brand)
- [Channels](https://api.mattermost.com/#tag/channels)
- [Cluster](https://api.mattermost.com/#tag/cluster)
- [Commands](https://api.mattermost.com/#tag/commands)
- [Compliance](https://api.mattermost.com/#tag/compliance)
- [DataRetention](https://api.mattermost.com/#tag/dataretention)
- [Elasticsearch](https://api.mattermost.com/#tag/elasticsearch)
- [Emoji](https://api.mattermost.com/#tag/emoji)
- [Files](https://api.mattermost.com/#tag/files)
- [Groups](https://api.mattermost.com/#tag/groups)
- [Integration Actions](https://api.mattermost.com/#tag/integration_actions)
- [Jobs](https://api.mattermost.com/#tag/jobs)
- [LDAP](https://api.mattermost.com/#tag/LDAP)
- [OAuth](https://api.mattermost.com/#tag/OAuth)
- [Plugins](https://api.mattermost.com/#tag/plugins)
- [Posts](https://api.mattermost.com/#tag/posts)
- [Preferences](https://api.mattermost.com/#tag/preferences)
- [Reactions](https://api.mattermost.com/#tag/reactions)
- [Roles](https://api.mattermost.com/#tag/roles)
- [SAML](https://api.mattermost.com/#tag/SAML)
- [Schemes](https://api.mattermost.com/#tag/schemes)
- [Status](https://api.mattermost.com/#tag/status)
- [System](https://api.mattermost.com/#tag/system)
- [Teams](https://api.mattermost.com/#tag/teams)
- [Threads](https://api.mattermost.com/#tag/threads)
- [Users](https://api.mattermost.com/#tag/users)
- [Webhooks](https://api.mattermost.com/#tag/webhooks)

Don't you see the endpoint you need? Feel free to open an issue or a PR!

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
[10]: https://github.com/gnello/laravel-mattermost-driver
[11]: https://poser.pugx.org/gnello/php-mattermost-driver/downloads
[12]: https://packagist.org/packages/gnello/php-mattermost-driver
[13]: https://docs.guzzlephp.org/en/stable/request-options.html
