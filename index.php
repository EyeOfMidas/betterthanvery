<html>
    <head>
	<title>Better Than Very</title>
	<link rel="icon" type="image/png" href="betterthanvery_icon.png" />
        <link rel="stylesheet" media="all" type="text/css" href="style.css" />
	<meta property="og:title" content="Better Than Very" />
	<meta property="og:description" content="Ever find yourself stuck trying to describe something and 'very' isn't cutting it? This site can suggest better words to use!" />
	<meta name="description" content="Ever find yourself stuck trying to describe something and 'very' isn't cutting it? This site can suggest better words to use!" />
	<meta property="og:image" content="betterthanvery_logo.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    <body><?php include_once('analyticstracking.php'); ?>
<div id="wrap">
        <div id="main">
            <div id="header">
		<img src="betterthanvery_logo.png" />
        <h2>Using <em>very</em> as an adjective is the mark of a limited vocabulary. Instead, search the word you're looking for to get a replacement.</h2>
                </div>
        <form id="verysuggest" method="post" action="suggest.php">
            Very <input type="text" id="word" placeholder="happy"/>
            <input id="getvocab" type="submit" value="Suggest"/>
        </form>
            <div id="suggestion"></div>
        </div>
        </div>
        <div id="footer">Is your word missing? <a href="https://github.com/EyeOfMidas/betterthanvery/pulls">Make a request</a> or <a href="mailto:eyeofmidas+betterthanvery@gmail.com">send an email</a></div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type="text/javascript">        
            $("#getvocab").click(function() {
                $.post("suggest.php", {word: $("#word").val()}, function(data) {
                    var message = "";
                    if(data.error) {
                        message = "The word <em>" + data.word + "</em> " + data.error;
                    } else {
                        message = "Instead of <em>very " + data.word + "</em>, try <strong>"+ data.suggestion + "</strong>. ";
                        message += '<a href="javascript:;" id="togglesuggest">Some other options?</a><div id="alts"><ul>';
                        for(var i = 0; i < data.alternates.length; i++) {
                            message += "<li>" + data.alternates[i] + "</li>";
                        }
                        message += '</ul></div>';
                    }
                    $("#suggestion").html(message);
                    $("#togglesuggest").click(function() {
                       $("#alts").toggle();
                        return false;
                    });
                    
                }, 'json');
                return false;
            });
        </script>
    </body>
</html>
