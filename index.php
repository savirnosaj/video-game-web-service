<html>
	<head>
		<title>Harry Potter Web Service Demo</title>
		<style>
			body {font-family:georgia;}
			.film {
				border:1px solid #E77DC2;
				border-radius: 5px;
				padding: 5px;
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
					success: potterJSON
				});
			}

			function toConsole(data)
			{//return data to console for JSON examination
				console.log(data); //to view,use Chrome console, ctrl + shift + j
			}

			function potterJSON(data){
				console.log(data);
				//indentifies the type of data returned
				$('#filmtitle').html(data.title);

				//clears other clicked films
				$('#films').html("");
				
				//loop through films and add template
				$.each(data.games,function(i,item){
					let myFilm = gameTemplate(item);
					$('<div></div>').html(myFilm).appendTo('#films');
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
			function gameTemplate(film){
				return `
					<div class="film">
					<b>Film:</b>${film.Film}<br />
					<b>Title:</b>${film.Title}<br />
					<b>Year:</b>${film.Year}<br />
					<b>Director:</b>${film.Director}<br />
					<b>Producers:</b>${film.Producers}<br />
					<b>Writers:</b>${film.Writers}<br />
					<b>Composer:</b>${film.Composer}<br />
					<b>Budget:</b>${film.Budget}<br />
					<b>Box Office:</b>${film.BoxOffice}<br />
					<div class="pic">
					<img width="100px" height="auto" src="thumbnails/${film.Image}" />
					</div>
				`;
			}
		</script>
	</head>
	<body>
		<h1>Harry Potter Web Service</h1>
		<a href="year" class="category">Harry Potter Films By Year</a><br />
		<a href="box" class="category">Harry Potter Films By International Box Office Totals</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films"></div>
		<div id="output">Results go here</div>
	</body>
</html>