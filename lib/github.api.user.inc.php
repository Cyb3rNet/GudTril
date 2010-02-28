<?php
 
 
require_once("github.connect.inc.php");
 
require_once("github.api.services.inc.php");


////
//// CLASS - GITHUB USER API SERVICES
////
//   Class implementing the GitHUb Users API Services
//
class CGithubUser extends CGithubAPIRequestServices
{
	public function __construct($sResponseType, $bAuthenticate = false)
	{
		parent::__construct($sResponseType, $bAuthenticate);
	}
	
	
////
//// METHOD - GITHUB USER - SEARCH USERS
////
//   Searching for Users
//   /user/search/:search
//   GET
//
	public function SearchUsers($sSearch)
	{
		$sAPIPathURL = "/user/search/".$sSearch;
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}
	

////
//// METHOD - GITHUB USER - GET USER INFORMATION
////
//   Getting User Information
//   /user/show/:username
//   GET
//
//   Returns:
/*

$ curl -i http://github.com/api/v2/yaml/user/show/defunkt

user: 
  id: 23
  login: defunkt
  name: Kristopher Walken Wanstrath
  company: LA
  location: SF
  email: me@email.com
  blog: http://myblog.com
  following_count: 13
  followers_count: 63
  public_gist_count: 0
  public_repo_count: 2

// If authenticated

total_private_repo_count: 1
  collaborators: 3
  disk_usage: 50384
  owned_private_repo_count: 1
  private_gist_count: 0
  plan: 
    name: mega
    collaborators: 60
    space: 20971520
    private_repos: 125
	
*/
	public function GetUserInfo($sUser)
	{
		$sAPIPathURL = "/user/show/".$sUser;
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - GITHUB USER - SET USER INFORMATION
////
//   Authenticated User Management
//   /user/show/:username
//   POST
//   Authenticated
/*

name
email
blog
company
location

*/
//   Returns:
/*

$ curl -F 'login=schacon' -F 'token=XXX' https://github.com/api/v2/json/user/show/schacon -F 'values[email]=scott@geemail.com'
{
  "user": {
    "company": "Logical Awesome",
    "name": "Scott Chacon",
    "blog": "http:\/\/jointheconversation.org",
    "disk_usage": 89352,
    "collaborators": 3,
    ...
    "email": "scott@geemail.com",
    "location": "Redwood City, CA"
    "created_at": "2008\/01\/27 09:19:28 -0800",
  }
}

*/
	public function SetUserInfo($sUser, $sName, $sEmail, $sBlog, $sCompany, $sLocation)
	{
		$sPost = "";
		
		if (strlen($sName))
			$sPost .= "values[name]=".urlencode($sName);
		if (strlen($sEmail))
			$sPost .= "&values[email]=".urlencode($sEmail);
		if (strlen($sBlog))
			$sPost .= "&values[blog]=".urlencode($sBlog);
		if (strlen($sCompany))
			$sPost .= "&values[company]=".urlencode($sCompany);
		if (strlen($sLocation))
			$sPost .= "&values[location]=".urlencode($sLocation);
		
		$sAPIPathURL = "/user/show/".$sUser;
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate, $sPost);
	}
	
	
////
//// METHOD - GITHUB USER - SHOW WHO USER FOLLOWS
////
//   Following Network - Whos user following
//   /user/show/:user/followers
//   GET
//
	public function ShowWhoUserFollowing($sUser)
	{
		$sAPIPathURL = "/user/show/".$sUser."/followers";
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}

	
////
//// METHOD - GITHUB USER - SHOW WHO'S FOLLOWING USER
////
//   Following Network - Whos following user
//   /user/show/:user/followers
//   GET
//
	public function ShowWhoUserFollowers($sUser)
	{
		$sAPIPathURL = "/user/show/".$sUser."/followers";
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}

	
////
//// METHOD - GITHUB USER - FOLLOW USER
////
//   Following Network - Follow user
//   /user/follow/:user
//   POST
//   Authenticted
//
	public function FollowUser($sUser)
	{
		$sAPIPathURL = "/user/follow/".$sUser;
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}
	
	
////
//// METHOD - GITHUB USER - UNFOLLOW USER
////
//   Follow Network = Unfollow user
//   /user/unfollow/:user
//   POST
//   Authenticated
//
	public function UnFollowUser($sUser)
	{
		$sAPIPathURL = "/user/unfollow/".$sUser;
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}
	
	
////
//// METHOD - GITHUB USER - SHOW WATCHED REPOSITORIES
////
//   Watched Repos
//   /repos/watched/:user
//   GET
//
/*

$ curl http://github.com/api/v2/yaml/repos/watched/schacon 
repositories: 
- :watchers: 42
  :owner: ddollar
  :name: git-db
  :description: CouchDB-based git server
  :private: false
  :url: http://github.com/ddollar/git-db
  :open_issues: 0
  :fork: false
  :homepage: http://github.com/ddollar/git-db
  :forks: 2
- :watchers: 2
  :owner: schacon
  :name: git-db
  :description: CouchDB-based git server
  :private: false
  :url: http://github.com/schacon/git-db
  :open_issues: 0
  :fork: true
  :homepage: http://github.com/ddollar/git-db
  :forks: 0

*/
	public function ShowWatchedRepos($sUser)
	{
		$sAPIPathURL = "/repos/watched/".$sUser;
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}
	
	
////
//// METHOD - GITHUB USER - GET PUBLIC KEYS
////
//   Public Key Management - Get public keys
//   /user/keys
//   GET
//   Authenticated
	public function GetPublicKeys()
	{
		$sAPIPathURL = "/user/keys";
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}
	

////
//// METHOD - GITHUB USER - ADD PUBLIC KEY
////
//   Public Key Management - Add public key
//   /user/key/add
//   POST
//
/*

:name
:key

*/
	public function AddPublicKey($sKeyName, $sKey)
	{
		$sPost = "name=".urlencode($sKeyName)."&key=".urlencode($sKey);
	
		$sAPIPathURL = "/user/key/add";
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate, $sPost);
	}


////
//// METHOD - GITHUB USER - REMOVE PUBLIC KEY
////
//   Public Key Management - Remove public key
//   /user/key/remove
//   POST
//   Authenticated
/*

:id

*/
	public function RemovePublicKey($sKeyId)
	{
		$sPost = "id=".$sKeyId;
	
		$sAPIPathURL = "/user/key/remove";
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate, $sPost);
	}

	
////
//// METHOD - GITHUB USER - GET EMAILS
////
//   Email Address Management - Get emails
//   /user/emails
//   GET
//   Authenticated
	public function GetEmails()
	{
		$sAPIPathURL = "/user/emails";
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate);
	}

	
////
//// METHOD - GITHUB USER - ADD EMAIL
////
//   Email Address Management - Add email
//   /user/email/add
//   POST
//
	public function AddEmail($sEmail)
	{
		$sPost = "email=".$sEmail;
	
		$sAPIPathURL = "/user/email/add";
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate, $sPost);

	}

	
////
//// METHOD - GITHUB USER - REMOVE EMAIL
////
//   Email Address Management - Remove email
//   /user/email/remove
//   POST
//
	public function RemoveEmail($sEmail)
	{
		$sPost = "email=".$sEmail;
	
		$sAPIPathURL = "/user/email/remove";
		
		$sDefaultMethod = CHTTPRequestMethods::iPost;
		
		$bAuthenticate = true;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $bAuthenticate, $sPost);
	}
}


?>