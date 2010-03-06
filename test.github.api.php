<html>

<head>

<title>Github API Tests</title>

<style type="text/css">

body
{
	font-family:Georgia, serif;
	font-weight:bold;
}

h1.test-helper
{
	border:0px solid #666;
	border-top-width:3px;
}

h2.test-helper
{
	border:0px solid #999;
	border-top-width:3px;
	padding:10px
	margin:10px;
}

h3.test-helper
{
	border:0px solid #CCC;
	border-top-width:3px;
}

p.test-helper, code.test-helper, pre.test-helper
{
	border:2px dashed #666;
	background-color:#EEE;
	color:#000;
	font-size:;
	padding:10px;
	margin:5px;
	display:block;
}

p.test-helper-param
{
	border:2px solid #666;
	background-color:beige;
	color:#000;
	padding:10px;
	margin:5px;
}

</style>

</head>

<body>

<?php

// GITHUB API
//
include("github.api.inc.php");

// TEST UTILITARIES
//
include("test/utils.inc.php");

// INDIVIDUAL IMPLEMENTATION FILE TESTS
//
//include("test/test.http.base.inc.php");
//include("test/test.http.requester.inc.php");
//include("test/test.github.connect.inc.php");
//include("test/test.github.api.services.inc.php");

// TEST THE FOLOWING FILE SEPARATELY
//include("test/test.github.api.call.limitator.inc.php");

// GITHUB API FILE TESTS
//
//include("test/test.github.api.user.inc.php");
//include("test/test.github.api.issues.inc.php");
#include("test/test.github.api.network.inc.php");
include("test/test.github.api.repository.inc.php");
//include("test/test.github.api.commit.inc.php");
//include("test/test.github.api.object.inc.php");

?>

</body>

</html>