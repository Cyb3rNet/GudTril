<?php


require_once("github.connect.inc.php");

require_once("github.api.services.inc.php");


////
//// CLASS - GITHUB REPOSITORIE VISIBILITY
////
//
class CGithubRepositoryVisibility
{
	const iPrivate = 0;
	const iPublic = 1;
}


////
//// CLASS - GITHUB REPOSITORY API SERVICES
////
//   Class implementing the GitHUb Repositories API Services
//
class CGithubRepository extends CGithubAPIRequestServices
{
	public function __constructor($sResponseType, $bAuthenticate = false)
	{
		parent::__construct($sResponseType, $bAuthenticate);
	}

////
//// METHOD - GITHUB REPOSITORY - SEARCH REPOSITORIES
////
//   Searching Repositories
//   GET
//   repos/search/:q
//
//   Returns:
/*

$ curl http://github.com/api/v2/yaml/repos/search/ruby+testing
--- 
repositories: 
- score: 0.32255203
  name: synthesis
  actions: 4653
  size: 2048
  language: Ruby
  followers: 27
  username: gmalamid
  type: repo
  id: repo-3555
  forks: 1
  fork: false
  description: Ruby test code analysis tool employing a "Synthesized Testing" strategy, aimed to reduce the volume of slower, coupled, complex wired tests.
  pushed: "2009-01-08T13:45:06Z"
  created: "2008-03-11T23:38:04Z"
- score: 0.56515217
  name: flexmock
  actions: 210
  size: 928
  language: Ruby
  followers: 7
  username: jimweirich
  type: repo
  id: repo-41100
  forks: 0
  fork: false
  description: Flexible mocking for Ruby testing
  pushed: "2009-04-01T16:23:58Z"
  created: "2008-08-08T18:52:54Z"

*/
	public function SearchRepos($sSearchTerm)
	{
		$sAPIPathURL = "/repos/search/".urlencode($sSearchTerm);
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - GITHUB REPOSITORY - SHOW REPOSITORY INFO
////
//   Show Repo Info
//   repos/show/:user/:repo
//   GET
//
//   Returns:
/*

$ curl http://github.com/api/v2/yaml/repos/show/schacon/grit
--- 
repository: 
  :description: Grit is a Ruby library for extracting information from a
 git repository in an object oriented manner - this fork tries to
 intergrate as much pure-ruby functionality as possible
  :forks: 4
  :name: grit
  :watchers: 67
  :private: false
  :url: http://github.com/schacon/grit
  :fork: true
  :owner: schacon
  :homepage: http://grit.rubyforge.org/

*/
	public function ShowRepoInfo($sUser, $sRepo)
	{
		$sAPIPathURL = "/repos/show/".urlencode($sUser)."/".urlencode($sRepo);
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - GITHUB REPOSITORY - LIST ALL USER REPOSITORIES
////
//   List All Repositories
//   repos/show/:user
//   GET
//
//   Returns:
/*

$ curl http://github.com/api/v2/yaml/repos/show/schacon
--- 
repositories: 
- :description: Ruby/Git is a Ruby library that can be used to 
create, read and manipulate Git repositories by wrapping system 
calls to the git binary.
  :forks: 30
  :name: ruby-git
  :watchers: 132
  :private: false
  :url: http://github.com/schacon/ruby-git
  :fork: false
  :owner: schacon
  :homepage: http://jointheconversation.org/rubygit/
- :description: A quick & dirty git-powered Sinatra wiki
  :forks: 1
  :name: git-wiki
  :watchers: 15
  :private: false
  :url: http://github.com/schacon/git-wiki
  :fork: true
  :owner: schacon
  :homepage: http://atonie.org/2008/02/git-wiki

*/
	public function ShowUserRepos($sUser)
	{
		$sAPIPathURL = "/repos/show/".urlencode($sUser);
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - GITHUB REPOSITORY - WATCH REPOSITORY
////
//   Watch Repository
//   repos/watch/:user/:repo
//   POST
//   Authenticated
	public function WatchRepo($sUser, $sRepo)
	{
		$sAPIPathURL = "/repos/watch/".urlencode($sUser)."/".urlencode($sRepo);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}


////
//// METHOD - GITHUB REPOSITORY - UNWATCH REPOSITORY
////
//   UnWatch Repository
//   repos/unwatch/:user/:repo
//   POST
//   Authenticated
	
	public function UnWatchRepo($sUser, $sRepo)
	{
		$sAPIPathURL = "/repos/unwatch/".urlencode($sUser)."/".urlencode($sRepo);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}
	

////
//// METHOD - GITHUB REPOSITORY - FORK A REPOSITORY
////
//   Forking Repositories
//   repos/fork/:user/:repo
//   POST
//   Authenticated
//
//   Returns:
/*

curl -F 'login=schacon' -F 'token=XXX' http://github.com/api/v2/yaml/repos/fork/dim/retrospectiva
--- 
repository: 
  :description: Retrospectiva is an open source, web-based, project management and bug-tracking tool. It is intended to assist the collaborative aspect of work carried out by software development teams.
  :forks: 0
  :name: retrospectiva
  :watchers: 1
  :private: false
  :url: http://github.com/schacon/retrospectiva
  :fork: true
  :owner: schacon
  :homepage: http://www.retrospectiva.org

*/
	public function ForkRepo($sUser, $sRepo)
	{
		$sAPIPathURL = "/repos/fork/".urlencode($sUser)."/".urlencode($sRepo);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}


////
//// METHOD - GITHUB REPOSITORY - CREATE REPOSITORY
////
//   Creating a Repository
//   repos/create
//   POST
//   Authenticated
//
//   Send:
/*

name 			=> name of the repository
description 	=> repo description
homepage		=> homepage url
public			=> 1 for public, 0 for private

*/
	public function CreateRepo($sRepoName, $sDescription, $sHomepage, $iVisibility)
	{
		$sPost = "name=".urlencode($sRepoName)."&description=".urlencode($sDescription)."&homepage=".urlencode($sHomepage)."&public=".urlencode($cVisibility);
	
		$sAPIPathURL = "/repos/create";
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate, $sPost);
	}


////
//// METHOD - GITHUB REPOSITORY - DELETE REPOSITORY
////
//   Deleting a Repository
//   repos/delete/:repo
//   POST
//   Authenticated
//
//   Returns:
/*

delete_token

*/
//   POST a second time with previous received token
//
	public function DeleteRepo($sRepo)
	{
		$sAPIPathURL = "/repos/delete/".urlencode($sRepo);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);		
	}

	
	public function ConfirmDeleteRepo($sRepo, $sDeleteToken)
	{
		$sPost = "delete_token=".urlencode($sDeleteToken);
	
		$sAPIPathURL = "/repos/delete/".urlencode($sRepo);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate, $sPost);
	}


////
//// METHOD - GITHUB REPOSITORY - SET REPOSITORY PRIVATE
////
//   Repository Visibility - Set Private
//   repos/set/private/:repo
//   POST
//   Authenticated
	public function SetRepoPrivate($sRepo)
	{
		$sAPIPathURL = "/repos/set/private/".urlencode($sRepo);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}


////
//// METHOD - GITHUB REPOSITORY - SET REPOSITORY PUBLIC
////
//   Repository Visibility - Set Public
//   repos/set/public/:repo
//   POST
//   Authenticated
	public function SetRepoPublic($sRepo)
	{
		$sAPIPathURL = "/repos/set/public/".urlencode($sRepo);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}


////
//// METHOD - GITHUB REPOSITORY - GET REPOSITORY DEPLOY KEYS
////
//   Get Deploy Keys
//   repos/keys/:repo
//   POST
//   Authenticated
//
//   Returns:
/*

$ curl -F 'login=schacon' -F 'token=XXX' http://github.com/api/v2/yaml/repos/keys/retrospectiva
--- 
public_keys: 
- title: my deploy key
  id: 98748
  key: ssh-rsa AAAAB3NzaC1cy3EAAAABIwAAAQEAqxtaIQhX9ICzxJw2ct+MuEEo8T6w
6woAwOHGuz9tZVZ1ncIa641O+z9hHJ68g61OK508M4Z6mkVNL68bW7TCPcTEXcCmkGTbB9F
5wCWD5uYExRgDaywamaREkEzaP0wl3CFvGADfrxUUvEzp4eKsAneCHD07FQiBXDFApqfJEm
IcsXPaJKfl8NpyIAMLr9ge2ToKH7hDOQG5Q6UcYIfYZH0kIZFfhnf8tBp+6oIHNFkXriTRB
OxFKoCuyauVCnX12N7GUR29L//MWmbL+bDdEg/HHnmZWkwpaZhC/rsqqylZobpZsUcAKZ7f
0Daq6H8C1CHf1RB6JriP7CCja8pl+w==

*/
	public function GetRepoDeployKeys($sRepo)
	{
		$sAPIPathURL = "/repos/keys/".urlencode($sRepo);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}


////
//// METHOD - GITHUB REPOSITORY - ADD REPOSITORY DEPLOY KEY
////
//   Add Deploy Key
//   repos/key/:repo/add
//   POST
//   Authenticated
//
//   Send:
/*

title 	=> title of the key
key		=> public key data

*/
	public function AddRepoDeployKey($sRepo, $sTitle, $sKey)
	{
		$sPost = "title=".urlencode($sTitle)."&key=".urlencode($sKey);
	
		$sAPIPathURL = "/repos/key/".urlencode($sRepo)."/add";
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate, $sPost);
	}


////
//// METHOD - GITHUB REPOSITORY - REMOVE REPOSITORY DEPLOY KEY
////
//   Remove Deploy Key
//   repos/key/:repo/remove
//   POST
//   Authenticated
//
//   Send:
/*

id 	=> id of the key

*/
	public function RemoveRepoDeployKey($sRepo, $sKeyId)
	{
		$sPost = "id=".urlencode($sKeyId);
	
		$sAPIPathURL = "/repos/key/".urlencode($sRepo)."/remove";
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate, $sPost);
	}


////
//// METHOD - GITHUB REPOSITORY - LIST COLLABORATORS
////
//   List Collaborators
//   repos/show/:user/:repo/collaborators
//   POST
//   Authenticated
//
//   Returns:
/*

????

*/
	public function ListRepoCollaborators($sUser, $sRepo)
	{
		$sAPIPathURL = "/repos/show/".urlencode($sUser)."/".urlencode($sRepo)."/collaborators";
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}


////
//// METHOD - GITHUB REPOSITORY - ADD COLLABORATOR
////
//   Add Collaborator
//   repos/collaborators/:repo/add/:user
//   POST
//   Authenticated
//
	public function AddRepoCollaborator($sRepo, $sCollaborator)
	{
		$sAPIPathURL = "/repos/collaborators/".urlencode($sRepo)."/add/".urlencode($sCollaborator);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}


////
//// METHOD - GITHUB REPOSITORY - REMOVE COLLABORATOR
////
//   Remove Collaborator
//   repos/collaborators/:repo/remove/:user
//   POST
//   Authenticated
//
	public function RemoveRepoCollaborator($sRepo, $sCollaborator)
	{
		$sAPIPathURL = "/repos/collaborators/".urlencode($sRepo)."/remove/".urlencode($sCollaborator);
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}


////
//// METHOD - GITHUB REPOSITORY - LIST NETWORK
////
//   Network
//   repos/show/:user/:repo/network
//   GET
//
//   Returns:
/*

$ curl http://github.com/api/v2/yaml/repos/show/schacon/ruby-git/network
--- 
network: 
- :description: Ruby/Git is a Ruby library that can be used to create,
 read and manipulate Git repositories by wrapping system calls to the 
 git binary.
  :forks: 30
  :name: ruby-git
  :watchers: 132
  :private: false
  :url: http://github.com/schacon/ruby-git
  :fork: false
  :owner: schacon
  :homepage: http://jointheconversation.org/rubygit/
- :description: Ruby/Git is a Ruby library that can be used to create,
 read and manipulate Git repositories.
  :forks: 0
  :name: ruby-git
  :watchers: 2
  :private: false
  :url: http://github.com/ericgoodwin/ruby-git
  :fork: true
  :owner: ericgoodwin
  :homepage: http://jointheconversation.org/rubygit/

*/
	public function ListRepoNetwork($sUser, $sRepo)
	{
		$sAPIPathURL = "/repos/show/".urlencode($sUser)."/".urlencode($sRepo)."/network";
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - GITHUB REPOSITORY - LANGUAGE BREAKDOWN
////
//   Language Breakdown
//   /repos/show/:user/:repo/languages
//   GET
//
//   Returns:
/*

$ curl http://github.com/api/v2/yaml/repos/show/mojombo/grit/languages
--- 
languages: 
  Ruby: 35097
  
*/
	public function ShowRepoLanguages($sUser, $sRepo)
	{
		$sAPIPathURL = "/repos/show/".urlencode($sUser)."/".urlencode($sRepo)."/languages/";
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - GITHUB REPOSITORY - SHOW TAGS
////
//   Repository Refs
//   repos/show/:user/:repo/tags
//   GET
//
//   Returns:
/*

$ curl http://github.com/api/v2/yaml/repos/show/schacon/ruby-git/tags
--- 
tags: 
  1.0.3: be47ad8aea4f854fc2d6773456fb28f3e9f519e7
  1.0.5: 6c4af60f5fc5193b956a4698b604ad96ef3c51c6
  1.0.5.1: ae106e2a3569e5ea874852c613ed060d8e232109
  v1.0.7: 1adc5b8136c2cd6c694629947e1dbc49c8bffe6a
  
*/
	public function ShowRepoTags($sUser, $sRepo)
	{
		$sAPIPathURL = "/repos/show/".urlencode($sUser)."/".urlencode($sRepo)."/tags";
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - GITHUB REPOSITORY - SHOW BRANCHES
////
//   Repository Refs - Branches
//   repos/show/:user/:repo/branches
//   GET
//
//   Returns:
/*

$ curl http://github.com/api/v2/yaml/repos/show/schacon/ruby-git/branches
--- 
branches: 
  master: ee90922f3da3f67ef19853a0759c1d09860fe3b3
  internals: 6a9db968e8563bc27b8f56f9d413159a2e14cf67
  test: 2d749e3aa69d7bfedf814f59618f964fdbc300d5
  integrate: 10b880b418879e662feb91ce7af98560adeaa8bb
  
*/
	public function ShowRepoBranches($sUser, $sRepo)
	{
		$sAPIPathURL = "/repos/show/".urlencode($sUser)."/".urlencode($sRepo)."/branches";
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}
}


?>