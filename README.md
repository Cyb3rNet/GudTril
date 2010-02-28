>> GudTril by Serafim Junior Dos Santos Cyb3r Web
>>
>> PHP 5 Github API Library
>>
>> Version 0.7
>>
>> MIT Licence
>>
>> Uses github.com API
>> Uses CURL library

# Another PHP Github API Wrapper library

I needed to implement for a client some fonctionalities with the Github API but didn't like the suggested PHP library, so I decided to build another one on my time and to share it with the world. I'm not too happy with most of the implementation and there's still alot to do, but it paves the way to offer a full PHP 5 Github API Wrapper library for the masses.

Fork it and play with it!

# Usage

Include the file "github.api.inc.php".

    include("github.api.inc.php");

Set the configs in the "github.confs.inc.php" file.

    Set the GITHUB_LOGIN and GITHUB_TOKEN constants.

Instantiate an object of a class contained in the files mentioned in the next section.

## API Classes

API classes follow the documentation at **develop.github.com** and are/will be in the following files:

* github.api.user.inc.php
* github.api.issues.inc.php - currently developed - tested
* github.api.repository.inc.php - currently developed - tested
* github.api.commit.inc.php - currently developed - tested
* github.api.object.inc.php - currently developed - not tested

## API Classes Usage

Most of the classes have the same usage. Data is posted or getted after one instance creation and two method calls. Values are passed on the constructor, request is assembled and returned with two methods. That's it.

First parameter passed to the constructor is a constant of the **CGithubResponseTypes** class to indicate the type of response desired; literally a string **'json'**, **'yaml'** or **'xml'** passed later internaly to the URL.

The other parameters are usually values needed to fill the URL for the request or the post values.

The request is assembled with **AssembleRequest()** method an data is returned with **RequestService()** method.

## Usage Example

    // Commenting an issue

    // /issues/comment/:user/:repo/:id
    // + comment
    
	$bAuthenticate = true;
	
    $oGHIssues = new CGithubIssues(CGithubResponseTypes::sXML, $bAuthenticate);
	
	$sResponse = $oGHIssues->CommentOnIssue("Cyb3rWeb", "GudTril", 1, "This is a comment");

## Authentication

Authentification is done by passing a boolean value at the constructor of the APi modules or automatically set by default on some methods. When Authetification is valued the connexion goes on HTTPS mode. HTTPS can be forced on the configuration file: `github.confs.inc.php`.

## API Limitation

I've even implemented a counter as the base curl class for limiting the the number of requests to less than 60 per minute as mentioned in the documentation. The script throws an **Exception** if 60 or more requests within a minute have been made.

## Tests

I've implemented a test case for the files and classes of the library. To run the tests, load in a browser the file **test.github.api.php**.

## More Information

Check the wiki of the GudTril repository on github.com.