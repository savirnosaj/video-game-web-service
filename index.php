<html>
	<head>
		<title>Video Game Web Service</title>
		<style>
			body {font-family:georgia;}
			.game {
				border:1px solid #E77DC2;
				border-radius: 5px;
				padding: 8px;
				margin-bottom:5px;
				position:relative;
			}
			.pic {
				position:absolute;
				right:10px;
				top:10px;
			}
		</style>

		<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('.category').click(function(e){
					e.preventDefault(); //stop default action of the link
					cat = $(this).attr("href");  //get category from URL
					loadAJAX(cat);  //load AJAX and parse JSON file
				});
			});

			function loadAJAX(cat)
			{
				$.ajax({
					type: "GET",
					dataType: "json",
					url: "api.php?cat=" + cat,
					success: gameJSON
				});
			}

			function toConsole(data)
			{//return data to console for JSON examination
				console.log(data); //to view,use Chrome console, ctrl + shift + j
			}

			function gameJSON(data){
				console.log(data);

				//indentifies the type of data returned
				$('#gametitle').html(data.title);

				//clears other clicked films
				$('#games').html("");
				
				//loop through films and add template
				$.each(data.games,function(i,item){
					let myFilm = gameTemplate(item);
					$('<div></div>').html(myFilm).appendTo('#games');
				});

				//This loads the data on the page, but it is all bunched
				//$("#output").text(JSON.stringify(data));
				//this creates a map of JSON on our page

				/*
				let myData = JSON.stringify(data,null,4);
				myData = "<pre>" + myData + "</pre>";
				$("#output").html(myData);
				*/
			}
			function gameTemplate(game){
				return `
					<div class="game">
						<b>Film:</b>${game.Game}<br />
						<b>Title:</b>${game.Title}<br />
						<b>Genre:</b>${game.Genre}<br />
						<b>Company:</b>${game.Company}<br />
						<b>Year:</b>${game.Year}<br />
						<b>Rating:</b>${game.Rating}<br />
						<div class="pic">
							<img width="100px" height="auto" src="thumbnails/${game.Image}" />
						</div>
					</div>
				`;
			}
		</script>
	</head>

	<body>

		<h1>Video Game Web Service</h1>
		
		<a href="year" class="category">Video Games By Year</a><br />
		<a href="title" class="category">Video Games by Title</a>

		<h3 id="gametitle">Title Will Go Here</h3>
		<div id="games"></div>
		<div id="output">Results go here</div>

	</body>
</html>