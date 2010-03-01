<?php
 
 
require_once("github.connect.inc.php");
 
require_once("github.api.services.inc.php");


////
//// CLASS - GITHUB OBJECT API SERVICES
////
//   Class implementing the GitHUb Object API Services
//
class CGithubObject extends CGithubAPIRequestServices
{
	public function __constructor($sResponseType, $bAuthenticate = false)
	{
		parent::__construct($sResponseType, $bAuthenticate);
	}
	
	
////
//// METHOD - GITHUB OBJECT - TREE CONTENT
////
//   Trees
//   tree/show/:user/:repo/:tree_sha
//   GET
/*

$ curl http://github.com/api/v2/yaml/tree/show/defunkt/facebox/a47803c9ba26213ff194f042ab686a7749b17476
---
tree:
- name: .gitignore
  sha: e43b0f988953ae3a84b00331d0ccf5f7d51cb3cf
  mode: "100644"
  type: blob
- name: README.txt
  sha: d4fc2d5e810d9b4bc1ce67702603080e3086a4ed
  mode: "100644"
  type: blob
- name: b.png
  sha: f184e6269b343014f58694093b55558dd5dde193
  mode: "100644"
  type: blob
- name: bl.png
  sha: f6271859d51654b6fb2719df5fe192c8398ecefc
  mode: "100644"
  type: blob
- name: br.png
  sha: 31f204fc451cd9dd5cfdadfad2d86ed0e1104882
  mode: "100644"
  type: blob
- name: build_tar.sh
  sha: 08f6f1fce2f6a02dcb15b6c66244470794587bb0
  mode: "100755"
  type: blob
- name: closelabel.gif
  sha: 87b4f8bd699386e3a6fcc2e50d7c61bfc4aabb8d
  mode: "100755"
  type: blob
- name: facebox.css
  sha: 08e190d5f81959d73d2bdd3e4f752271800886bf
  mode: "100644"
  type: blob
- name: facebox.js
  sha: 43245f3b1b50a0568ece00b44d2dc67be413f2a4
  mode: "100644"
  type: blob
- name: faceplant.css
  sha: dc61a86c3f342b930f0a0447cae33fee812e27d3
  mode: "100644"
  type: blob

*/
	public function ShowTree($sUser, $sRepoName, $sTreeSHA)
	{
		$sAPIPathURL = "/tree/show/".urlencode($sUser)."/".urlencode($sRepoName)."/".urlencode($sTreeSHA);
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}

	
////
//// METHOD - GITHUB OBJECT - BLOB CONTENT BY TREE SHA
////
//   Blobs - Blob Content By Tree SHA
//   blob/show/:user/:repo/:tree_sha/:path
//   GET
//
//   Returns:
/*

$ curl http://github.com/api/v2/yaml/blob/show/defunkt/facebox/365b84e0fd92c47ecdada91da47f2d67500b8e31/README.txt
---
blob:
  name: README.txt
  size: 178
  sha: d4fc2d5e810d9b4bc1ce67702603080e3086a4ed
  mode: "100644"
  mime_type: text/plain
  data: |
    Please visit http://famspam.com/facebox/ or open index.html in your favorite browser.

    Need help?  Join our Google Groups mailing list:
      http://groups.google.com/group/facebox/

*/
	public function BlobByTreeSHA($sUser, $sRepoName, $sTreeSHA, $sPath)
	{
		$sAPIPathURL = "/blob/show/".urlencode($sUser)."/".urlencode($sRepoName)."/".urlencode($sTreeSHA)."/".urlencode($sPath);
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - GITHUB OBJECT - LIST ALL BLOBS
////
//   Blobs - List Blobs
//   blob/all/:user/:repo/:tree_sha
//   GET
//
//   Return:
/*

$ curl http://github.com/api/v2/yaml/blob/all/defunkt/facebox/master
---
blobs:
  test_programmatic.html: 0249382efbdc741
  stairs.jpg: 63459bb418f5f6d
  shadow.gif: e58b35b362ce534
  screenshots/photo.png: 837cfbd897b1e06
  .gitignore: e43b0f988953ae3
  screenshots/preview.png: e04c5f64000c9cf
  screenshots/error.png: c2165a01e6d1be1
  releases/.gitignore: e69de29bb2d1d64
  facebox.css: 76e0a30a0e4ed4b
  jquery.js: ebe02bdd357c337
  faceplant.css: dc61a86c3f342b9
  build_tar.sh: 08f6f1fce2f6a02
  screenshots/preview_small.png: 4deb6d708a105a3
  screenshots/.DS_Store: 7d8a1d70403b670
  loading.gif: f864d5fd38b7466
  fbx-border-sprite.png: dc7a99978d2d50a
  closelabel.gif: 87b4f8bd699386e
  README.txt: d4fc2d5e810d9b4
  screenshots/success_small.png: dfff54f6443f01a
  logo.png: e41cfe5c654e8e0
  test.html: 0a279c66167d358
  screenshots/error_small.png: ce96ac453c19c66
  index.html: a9d1c235d08ae38
  facebox.js: 7695b90efc38931
  b.png: f184e6269b34301
  screenshots/success.png: b547e7ad945666d
  screenshots/photo_small.png: 933df8b638d4ada
  remote.html: 98d3e92373d1bc5

*/
	public function ListBlobs($sUser, $sRepoName, $sTreeSHA)
	{
		$sAPIPathURL = "/blob/all/".urlencode($sUser)."/".urlencode($sRepoName)."/".urlencode($sTreeSHA);
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - GITHUB OBJECT - SHOW BLOB
////
//   Raw Git Data
//   blob/show/:user/:repo/:sha
//   GET
//
//   Returns:
/*

A Blob

*/
	public function ShowBlob($sUser, $sRepoName, $sSHA)
	{
		$sAPIPathURL = "/blob/show/".urlencode($sUser)."/".urlencode($sRepoName)."/".urlencode($sSHA);
		
		$sDefaultMethod = CHTTPRequestMethods::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}
}


 
?>