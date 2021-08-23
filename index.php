<html>
	<head>
		<title>Video Game Web Service</title>
		<style>
			body {font-family:georgia;}
			.film{
				border:1px solid #E77DC2;
				border-radius: 5px;
				padding: 5px;
				margin-bottom:5px;
				position:relative;	
			}

			.pic{
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
					success: bondJSON,
					error: function(xhr, status, error){
						let errorMessage = xhr.status + ': ' + xhr.statusText
						alert('Error - ' + errorMessage);
					}
				});
			}
				
			function toConsole(data)
			{//return data to console for JSON examination
				console.log(data); //to view,use Chrome console, ctrl + shift + j
			}

			function bondJSON(data){
			//JSON processing data goes here
				console.log(data)

				$('#filmTitle').html(data.title);

				$('#films').html('');
				// $.each(data.films, function(i, item){
				// 	let myFilm = bondTemplate(item);

				// 	$('<div></div>').html(myFilm).appendTo('#films');
				// });

				//this loads the data on the page, but it's all bunched up
				// $('#output').text(JSON.stringify(data));

				// this creates a map of the JSON on our page
				let myData = JSON.stringify(data, null, 4);
				myData = '<pre>' + myData + '</pre>';
				$("#output").html(myData);

			}

			function bondTemplate(film){
				return `
					<div class="film">
						<b>Title: </b> ${film.Title} <br>
						<b>Genre: </b> ${film.Genre} <br>
						<b>Company: </b> ${film.Company} <br>
						<b>Year: </b> ${film.Year} <br>
						<b>Rating: </b> ${film.Rating} <br>
						<div class="pic"> <img src="thumbnails/${film.Image}" alt=""></div>
					</div>
				`;
			}

		</script>
	</head>

	<body>
		<h1>Video Game Web Service</h1>
		<a href="year" class="category">Video Games By Year</a><br />
		<a href="title" class="category">Video Games by Title</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films"></div>
		<div id="output">Results go here</div>
	</body>

</html>
