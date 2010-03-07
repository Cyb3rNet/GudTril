>> GudTril by Serafim Junior Dos Santos Cyb3r Net
>>
>> PHP 5 Github API Library
>>
>> Version 0.9
>>
>> MIT Licence
>>
>> Uses github.com API
>> Uses CURL library

# Another PHP Github API Wrapper library

I needed to implement for a client some fonctionalities with the Github API. The PHP GitHub API libraries available not offering me the desired services, I decided to build my own.

# Usage

Include the file "github.api.inc.php".

    include("github.api.inc.php");

Set the configs in the "github.confs.inc.php" file.

    Set the GITHUB_LOGIN and GITHUB_TOKEN constants.

Instantiate an object of a class contained in the files mentioned in the next section.

## API Classes

API classes follow the documentation at **develop.github.com** and are in the following files:

* github.api.user.inc.php - currently developed - tested
* github.api.issues.inc.php - currently developed - tested
* github.api.repository.inc.php - currently developed - tested
* github.api.commit.inc.php - currently developed - tested
* github.api.object.inc.php - currently developed - not tested

## API Classes Usage

Most of the classes have the same usage. Data is posted or getted after one instance creation and a method call. A method requesting the service is called and the response returned. That's it.

Two values are passed to the constructor: First parameter passed to the constructor is a constant of the **CGithubResponseTypes** class to indicate the type of response desired; literally a string **'json'**, **'yaml'** or **'xml'** passed later internaly to the URL.

The other parameter is a boolean value asking for a forced authentication, although it can be non mandatory letting the internal logic decide if authentication is required with a POST HTTPS connection.

## Usage Example

    // Commenting an issue

    // /issues/comment/:user/:repo/:id
    // + comment
    
	$bAuthenticate = true;
	
    $oGHIssues = new CGithubIssues(CGithubResponseTypes::sXML, $bAuthenticate);
	
	$sResponse = $oGHIssues->CommentOnIssue("Cyb3rWeb", "GudTril", 1, "This is a comment");

## Authentication

Authentification is done by passing a boolean value at the constructor of the APi modules or automatically set by default on some methods. When Authetification is valued the connexion goes on HTTPS mode and its a POST request. HTTPS can be forced on the configuration file: `github.confs.inc.php`.

## API Service Call Limitation

I've even implemented a counter as the base curl class for limiting the the number of requests to less than 60 per minute as mentioned in the documentation. The script throws a **GitHubLimitException** if 60 or more requests within a minute have been made.

## Tests

I've implemented a test case for the files and classes of the library. To run the tests, load in a browser the file **test.github.api.php**.

## More Information

Check the wiki of the GudTril repository on github.com.