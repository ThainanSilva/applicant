<!DOCTYPE html>
<!-- saved from url=(0056)http://www.lostdecadegames.com/demos/simple_canvas_game/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<title>Simple Canvas Game</title>
	</head>
	<body>
        
        <input type="hidden" id="usrName" value="<?php echo $_GET['usrName']; ?>"name="usrName">
           <script src="../js/jquery-3.1.0.min.js"></script>
		<script>
            
            window.usrdbdata =" ";
            
            
            $(document).ready(function(){
                // send  json  here
                $.post( "update.php", { name: $("#usrName").val(), newUsr:"1"})
                .done(function( data ) {
                    
                  });
                var i = 0
            window.usrdbdata =" ";
var canvas = document.createElement("canvas");
var ctx = canvas.getContext("2d");
;canvas.width = 512;
canvas.height = 480;
document.body.appendChild(canvas);

// Background image
var bgReady = false;
var bgImage = new Image();
bgImage.onload = function () {
	bgReady = true;
};
bgImage.src = "images/background.png";
//***************************************************************************
// Hero image
var heroReady = false;
var heroImage = new Image();
heroImage.onload = function () {
	heroReady = true;
};
heroImage.src = "images/hero.png";
//***************************************************************************
// Monster image
var monsterReady = false;
var monsterImage = new Image();
monsterImage.onload = function () {
	monsterReady = true;
};
monsterImage.src = "images/monster.png";
//***************************************************************************

// Game objects
var hero = {
	speed: 256 // movement in pixels per second
};
var monster = {};
var monstersCaught = 0;
//***************************************************************************q

// Handle keyboard controls
var keysDown = {};

addEventListener("keydown", function (e) {
	keysDown[e.keyCode] = true;
}, false);

addEventListener("keyup", function (e) {
	delete keysDown[e.keyCode];
}, false);

// Reset the game when the player catches a monster
var reset = function () {
	hero.x = canvas.width / 2;
	hero.y = canvas.height / 2;

	// Throw the monster somewhere on the screen randomly
	monster.x = 32 + (Math.random() * (canvas.width - 64));
	monster.y = 32 + (Math.random() * (canvas.height - 64));
};

// Update game objects
var update = function (modifier) {
	if (38 in keysDown) { // Player holding up
        borderTop = canvas.height-canvas.height ;
        if (hero.y <= borderTop){
         
        }else{
		hero.y -= hero.speed * modifier;
        }
	}
	if (40 in keysDown) { // Player holding down
        borderBottom = canvas.height-32 ;
        if (hero.y >= borderBottom){
         
        }else{
		hero.y += hero.speed * modifier;
        }
	}
	if (37 in keysDown) { // Player holding left
        borderLeft = canvas.width-canvas.width ;
        if (hero.x <= borderLeft){
         
        }else{
		  hero.x -= hero.speed * modifier;
        }
	}
	if (39 in keysDown) { // Player holding right
        
        
        
        
        
        borderRight = canvas.width-32;
        if (hero.x >= borderRight){
         
        }else{
            toutch = 0
            if(window.usrdbdata != " "){
    
             jsonResponse = jQuery.parseJSON(window.usrdbdata);
                
         for (var k in jsonResponse) {
             	
             if (hero.x <= (jsonResponse[k].width + 32)
		&& jsonResponse[k].width <= (hero.x + 32)
		|| hero.y <= (jsonResponse[k].height + 32)
		&& jsonResponse[k].height <= (hero.y + 32) ){
                 toutch = toutch + 1;
             }             
      }
                
    }
            if(toutch != 0 ){
                 
                }else{
                    hero.x += hero.speed * modifier; 
                }
            
            
        }
        
        
    }


	// Are they touching?
	if (
		hero.x <= (monster.x + 32)
		&& monster.x <= (hero.x + 32)
		&& hero.y <= (monster.y + 32)
		&& monster.y <= (hero.y + 32)
	) {
		++monstersCaught;
		reset();
	}
};

// Draw everything
var render = function () {
	if (bgReady) {
		ctx.drawImage(bgImage, 0, 0);
	}

	if (heroReady) {
		ctx.drawImage(heroImage, hero.x, hero.y);
	}

	if (monsterReady) {
		ctx.drawImage(monsterImage, monster.x, monster.y);
	}

	// Score
	ctx.fillStyle = "rgb(250, 250, 250)";
	ctx.font = "24px Helvetica";
	ctx.textAlign = "left";
	ctx.textBaseline = "top";
	ctx.fillText("Goblins caught: " + monstersCaught, 32, 32);
    
	ctx.fillText($("#usrName").val()+" : "+hero.x, hero.x, (hero.y-40));
    
    if(window.usrdbdata != " "){
    
             jsonResponse = jQuery.parseJSON(window.usrdbdata);
         for (var k in jsonResponse) {
             	if (heroReady) {
	
             ctx.drawImage(heroImage, jsonResponse[k].width, jsonResponse[k].height);
             ctx.fillText(jsonResponse[k].name+' '+jsonResponse[k].width, jsonResponse[k].width, (jsonResponse[k].height-40));
             }
      }
    }
    if(i >=11  ){
     $.post( "update.php", { name: $("#usrName").val(), newUsr:"0", width:hero.x, height:hero.y, gbc:monstersCaught })
                .done(function( data ) {
         
         window.usrdbdata = data
         
                    
     });
        i = 0
}
    i = i+1
    
};

// The main game loop
var main = function () {
	var now = Date.now();
	var delta = now - then;

	update(delta / 1000);
	render();

	then = now;

	// Request to do this again ASAP
	requestAnimationFrame(main);
};

// Cross-browser support for requestAnimationFrame
var w = window;
requestAnimationFrame = w.requestAnimationFrame || w.webkitRequestAnimationFrame || w.msRequestAnimationFrame || w.mozRequestAnimationFrame;

// Let's play this game!
var then = Date.now();
reset();
main();
            });
            // Create the canvas
            
        </script>
	

</body></html>