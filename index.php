<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>title>The Giphy App</title>
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" class="navbar-brand">The Giphy App</a>
        </div>
    </div>
    </nav>
    <br>
<div class="container">


    <form method="get" action="<?= $_SERVER['PHP_SELF']; ?>">
        <div class="row">
            <div class="col-lg-1 col-sm-1"></div>
            <div class="text-center col-lg-10 col-sm-10"><input type="text" name="query-text" value="<?= (isset($_GET['query-text'])) ? ($_GET['query-text']) : ''; ?>" class="input-lg" placeholder="Search for a GIF" required></div>
            <div class="col-lg-1 col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-sm-1"></div>
            <div class="text-center col-lg-10 col-sm-10"><input type="submit" value="Search" class="btn btn-lg btn-primary"></div>
            <div class="col-lg-1 col-sm-1"></div>
        </div>
    </form>
<br>

<?php

const KEY='dc6zaTOxFJmzC';
const BASE_URL='http://api.giphy.com/v1/gifs/search';

error_reporting(~E_ALL);
if(isset($_GET['query-text'])):
    //extract first word from search term
    $query=strtok($_GET['query-text'], " \n\t");

    //make api query
    $url=BASE_URL.'?q='.$query.'&api_key='.KEY.'&limit=10';
    $results=json_decode(file_get_contents($url),true);

    //if something happened eg.. network failure,inform the user
    if(!$results || $results===null):
        ?><div class="alert alert-danger text-center">An error occurred. Please check your network connection and try again</div>
        <?php
    else:
        //if we have results, display them
        if(count($results['data'])!=0):
        echo "<h3>GIFs matching \"$query\"</h3>";
            echo "<div class=\"row\">";
foreach($results['data'] as $result):
?>
        <div class="col-sm-4" style="height: 250px"><img  class="img-responsive" src="<?= $result['images']['fixed_height_downsampled']['url']; ?>" style="float: right;padding: 15%"></div>
        <?php
    endforeach;
            echo "</div>";
        else:
            //no results found; tell the user
        ?><div class="alert alert-info text-center">No results found. Try a different keyword</div>
    <?php
    endif;
        endif;
endif;
?>

</div>
<div class="panel-footer text-center">The Giphy App, by Shalvah</div>
</body>
</html>