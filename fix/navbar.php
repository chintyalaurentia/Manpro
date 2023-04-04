<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <style>
        *{
            font-family: 'Poppins';
        }
        
        .navbar {
			background-color: #f57120;
			font-family: 'Poppins';
			font-weight: bold;
		}

		.nav-link, .navbar-brand {
			color: white;
		}

		.nav-link:hover, 
		.navbar-brand:hover{
			color: white;
		}
		i{
			color: white;
		}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="tabelBerita.html">Hai, chintya!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="tabelBerita.html">Berita Acara</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="inputTabelNilai.html">Nilai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#.html">Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            </ul>
        </div>
	</nav>
</body>
</html>