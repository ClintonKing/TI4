<head>
    <title>APIs Page</title>
</head>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="instagram.js" type="text/javascript"></script>
<script src="jquery.tweet-linkify.js"></script>
<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiiGTqv4hRQyG23vNY4EKDs2y84--YxeA&sensor=false">
    </script>
<link href="styles.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

<script>
    function pageReady(){
        console.log("pageReady()");
        $('p.tweet').tweetLinkify();
        $('p.user_name').tweetLinkify();
    };
</script>

<script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(47.622138,-122.354102),
          zoom: 17
        };
        
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
        
        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(47.622138,-122.354102),
          map: map,
          title: 'Seattle Key Arena'
        });
        
        var marker2 = new google.maps.Marker({
          position: new google.maps.LatLng(47.620467,-122.349116),
          map: map,
          title: 'Space Needle'
        });
        
        var infowindow = new google.maps.InfoWindow({
          content: "Seattle's Key Arena will be the home of this year's Dota 2 International. Located downtown, only a few blocks from the Space Needle, the Key Arena can seat up to 17,000 attendees."
        });
        
        var infowindow2 = new google.maps.InfoWindow({
          content: "The Seattle Space Needle."
        });
        
        google.maps.event.addListener(marker, 'click', function(){
          infowindow.open(map,marker);  
        });
        
         google.maps.event.addListener(marker2, 'click', function(){
          infowindow2.open(map,marker2);  
        });
        
        
        var mapOptions2 = {
          center: new google.maps.LatLng(50,89),
          zoom: 2
        };
        var map2 = new google.maps.Map(document.getElementById("map-canvas2"),
            mapOptions2);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

<body>
    <img id="banner" src="images/ti4Banner.png">
<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12">
            <div class="infoBlock">
                <h2>About The International 2014</h2>
                <h4>What is it?</h4>
                <p>The International 2014 (TI4) is the fourth annual occurance of the largest Dota 2 tournament in the world. Hosted by Valve, the games creator, this competition brings the biggest teams from around the world together to compete for what will be a prize pool of over one million dollars. Fifteen diverse teams will display their superiority in skill and strategy before an audience of more than 15,000 fans.</p>
                <h4>Who is competing?</h4>
                <p>While <a href="http://www.dota2.com/international/announcement/">eleven of the world's top teams</a> are being invited directly, four teams will have to earn their way to the stage through regional qualifiers in the Americas, Southeast Asia, China, and Euroupe. The qualifiers start May 12th and will feature a mixture of fan-favorites and talented newcomers.</p>
                <h4>How Can I Watch?</h4>
                <p>Tickets to the International sold out in less than an hour after going on sale. However, anyone can watch any of the qualifier or main event matches through the Dota 2 client (available free on Valve's Steam service), or a variety of live-streeming websites like twitch.tv and joindota.com</p>
            </div>
            <div class="infoBlock">
                <h2>When and Where</h2>
                <p>Online regional qualifiers for The International will begin May 12th and carry through to May 25th. The International 2014 itself starts Friday July 18th and finishes on July 21st. The event will be held in the Key Arena located in downtown Seattle Washington, a popular sports and concert venue capable of seeting up to 17,00 people.</p>
                <div id="map-canvas"></div>
            </div>
        </div>
        <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 infoBlock" id="twittbar">
            <h3 id="twittTitle">#TI4 Tweets</h3>
            <?php
            ini_set('display_errors', 1);
            require_once('TwitterAPIExchange.php');
            
            /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
            $settings = array(
                'oauth_access_token' => "2429123821-0Us2OdkLKTnUF4IIHFOUU4AFRVIZqun8bup0PfC",
                'oauth_access_token_secret' => "4mXKbCqOrhrGCKVPUvmSJc3BeqYEqmrOgwVmDhWzUTIyt",
                'consumer_key' => "svJCRAVYD6qozV73Ha3YQ11BJ",
                'consumer_secret' => "xKzvuYUTU8UXGf3Wj8jzzNufKcsmOuTgNrLbseXgc3FA9lN0hy"
            );
            
            
            /** Perform a GET request and echo the response **/
            /** Note: Set the GET field BEFORE calling buildOauth(); **/
            $url = 'https://api.twitter.com/1.1/search/tweets.json';
            
            $requestMethod = 'GET';
            
            $getfield = '?q=%23roadtoTI4&count=4&lang=en';
            
            
            
            $twitter = new TwitterAPIExchange($settings);
            /*echo $twitter->setGetfield($getfield)
                         ->buildOauth($url, $requestMethod)
                         ->performRequest();
            */
            /**This is to view as a JSON object **/
            $string = json_decode($twitter->setGetfield($getfield)
                                  ->buildOauth($url, $requestMethod)
                                  ->performRequest(), $assoc = TRUE);
            
            foreach($string['statuses'] as $items)
                {
                    $userArray = $items['user'];
                    
                    echo "<hr id='hr'>";
                    echo "<img id='avatar' src='" .$userArray['profile_image_url']."' height='45' width='45'>    <p class='user_name'>@" . $userArray['screen_name']."</p>";
                    echo "<p class='tweet'>" . $items['text']."</p>";
                    /**echo "<p id='when'> Tweeted " .date( 'M y, h:i a', strtotime($items ["created_at"]) ). "</p>"; **/
                    
                }
                
                echo '<script>pageReady();</script>';
                
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div id="bottomOut">
                <h2>TI4 On Instagram</h2>
                <hr id="hr">
                <div id="instagram"></div>
            </div> 
        </div>
    </div>
    <div class="footer">
        <p id="theFoot" align="center">Created by <a href="http://clintonjking.com/portfolio">Clinton King</a></p>
    </div>



</div>
</body>