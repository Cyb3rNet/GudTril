<?php

require_once("github.connect.inc.php");

////
//// CLASS - GITHUB REPOSITORIES - SEARCH REPOSITORIES
////
//   Searching Repositories
//   repos/search/:q
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
class CGithubRepositoriesSearch
{

}


////
//// CLASS - GITHUB REPOSITORIES - SHOW REPOSITORY INFO
////
//   Show Repo Info
//   GET
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
class CGithubRepositoriesSingleInfo
{

}


////
//// CLASS - GITHUB REPOSITORIES - LIST ALL USER REPOSITORIES
////
//   List All Repositories
//   GET
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


?>