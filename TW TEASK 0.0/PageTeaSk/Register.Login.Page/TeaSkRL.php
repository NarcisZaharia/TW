<?php

session_start();

?>

<!DOCTYPE html>
<html lang = "ro">
<head>
<title>Proiect TW - TeaSk</title>
<link rel="stylesheet" href="TeaSkRL.css">
<meta charset="UTF-8">
</head>
<body>

	<div>
	 <h1 class="centeralign"><b>TeaSk (Technical Skill Enhancer)</b></h1>
	</div>			
	 <br>     
			<main>
	<div class="left styleleft scrollbar" id ="contentleft">								
			<br>		
			<p>Bun venit pe TeaSk!<p>
			<p>TeaSk (Technical Skill Enhancer) Clasa de dificultate: M</p>
<p class = "margin20px">Se doreste o aplicatie Web capabila sa ofere intr-o forma atractiva 
o lista a celor mai reprezentative evenimente (conferinte, ateliere de lucru, concursuri, stagii de practica) 
si proiecte software la care un utilizator ar putea participa pentru a-si imbunatati aptitudinile tehnice 
dintr-un domeniu de interes. Sugestiile expuse se vor baza pe un profil tehnic al persoanei, construit utilizand 
informatii de interes colectate din situri specializate - e.g., retele sociale profesionale (de exemplu, LinkedIn), 
sisteme de stocare si gestiune a codului sursa (minimal, GitHub), situri ce propun rezolvarea unor probleme de 
algoritmica sau concursuri tematice, situri propunand stagii de pregatire (e.g., Stagii pe bune, Junio, Intern Suply), 
sisteme de tip intrebare-raspuns (de pilda, StackExchange, Reddit ori Quora), blog-uri axate pe aspecte tehnologice 
gazduite pe platforme ca Medium sau WordPress etc. Aceste surse vor putea fi ajustate de utilizator. De asemenea, 
sistemul trebuie sa urmareasca evolutia utilizatorilor (de exemplu, actualizarea profilului in functie de sugestiile oferite), 
eventual oferind suport pentru 'gamification'. Diversele statistici vor fi disponibile in formatele HTML, JSON si XML. Resurse suplimentare:</p>
<p><a href = "https://www.programmableweb.com/category/social/api">Programmable web - social</a><p>
<p><a href = "https://developer.github.com/v3/">developer.github.com/v3/</a></p>
<p><a href = "https://api.stackexchange.com/"> api.stackexchange.com</a></p>
	</div>		  
	<div class="right styleright scrollbar" id = "contentright">								
			<p><b>LOGIN</b></p>	
				<form action="processlogin.php" method = "POST">
				<div class = "styleregister">
					<p><label>Type email: </label><input type="email" id="email" name="email" required></p>
					<p><label>Type password: </label><input type="password" id="password" name="password" required></p>
				</div>
					<input type="submit" value="Login" class="button">
				</form>
				 
				 <p>If you don't have an account please:</p>
				 <p><b>REGISTER</b></p>
				 <form action="processregister.php" method = "POST">
				 <div class = "styleregister">
					 <p><label>Type first name: </label><input type="name" name="firstname" required></p>
					 <p><label>Type last name: </label><input type="name" name="lastname" required></p>
					 <p><label>Type email: </label><input type="email" name="email" required></p>
					 <p><label>Type password: </label><input type="password" name="password" required></p>
				</div>
					<input type="submit" value="Register" class="button">
				</form>
	</div>	
            </main>
</body>
</html>