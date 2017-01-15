<!DOCTYPE html>
<html>
<head>

	<?php

		ob_start();

		include("/xamp/htdocs/DocX/include/DBConnect.php");

		$conn = new DB_Connect();
		$db = $conn->connect();

		$query = "SELECT * FROM `patient` ORDER BY `f_name` ASC";
		$result = mysqli_query($db, $query);

		ob_clean();

	?>

	<title>DocX</title>

	<link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,400,500" rel="stylesheet">
	<link rel="icon" href="fav_icon.png">

	<script type="text/javascript">
		var l_tab = 1;
		var max;

		function tabsOnClick(id){
			var li = document.getElementById(id);
			var div = document.getElementById('tab_'+id);
			var tab_strip = document.getElementById('tab_strip');


			for(var i=1; i<=3; i++){
				document.getElementById(i).className = '';
				document.getElementById("tab_"+i).style.display = "none";
			}
			if(l_tab>id){
				max = l_tab;				
				var displacement = (max - id) * 100;
			}
			else{
				max = id;				
				var displacement = (max - l_tab) * 100;
			}

			tab_strip.style.transform = "translateX("+displacement+"px)";

			li.className += 'current';			
			li.style.className += "ripple";
			div.style.display = "block";			
			c_tab = id;
		}

		function patient_delete(p_id){
			var ajax = new XMLHttpRequest();

			ajax.onreadystatechanged = function(){
				if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText)
					document.getElementById("toast_txt").innerHTML = this.responseText;
					document.getElementById("toast").style.display = "flex";
				}
			}

			ajax.open("GET", "http://localhost/DocX/include/delete.php?id="+p_id, true);
			ajax.send();

			location.reload();
		}

		function edit(p_id){
			location.href = "http://localhost/DocX/edit.php?p_id="+p_id;
		}

		function filter(){
			var ajax = new XMLHttpRequest();
			var input = document.getElementById("search");

			ajax.onreadystatechanged = function(){
				if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText)					
				}
			}

			ajax.open("GET", "http://localhost/DocX/include/search.php?search_txt="+input.value, true);
			ajax.send();
		}
	</script>

	<style type="text/css">	
		body{			
			margin: 0;
			padding: 0;	
			background-color: #fafafa;
		}

		nav{
			background-color: #FFC107;			
			box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2);
			position: fixed;
			width: 100%;
		}

		.nav{
			height: auto;			
			padding: 20px 10px 0px 10px;
			width: 100%;
			max-width: 800px;
			margin: auto;
		}

		p, h1{
			font-family: 'Roboto', sans-serif;
			font-weight: 300;
		}
		
		h2{
			display: inline-block;
			font-family: 'Roboto', sans-serif;
			font-weight: 300;
			color: #fff;
			margin: 0;
			margin-bottom: 20px;
		}

		ul{
			width: 300px;
		    display: flex;	
		    margin: 0;
		    padding: 0;
		    z-index: -1;
		    margin-bottom: -3px;
		}

		li{
			cursor: pointer;
			width: 50px;
			font-family: 'Roboto', sans-serif;			
			font-size: 14px;
			color: rgba(255,255,255,0.7);
			float: left;
			list-style-type: none;
			padding: 15px 25px 15px 25px;
			text-align: center;
		}

		/*li:hover{
			background-color: #FFD740;
		}*/		

		.current{
			color: #fff;
			padding-bottom: 5px;
			/*border-bottom: 3px solid #fff;*/
		}

		#tab_strip{
			background-color: #fff;
			width: 100px;
			height: 3px;
			transition-duration: 0.3s;
		}

		.container{
			width: 100%;
			max-width: 800px;
			height: auto;
			margin: auto;
			padding-top: 116px; 
		}

		#tab_1{
			display: block;
			padding: 8px;
		}

		#tab_2{
			display: none;
			padding: 8px;
		}

		#tab_3{
			display: none;
			padding: 8px;
		}

		input{
			border: 0;
			border-bottom: 1px solid #121212;
			font-size: 16px;
			outline: 0;
			padding: 3px;
			margin-left: 5px;
		}

		.submit{
			padding: 10px;
			font-family: 'Roboto', sans-serif;
			background-color: #FFA000;
			color: #fff;
			border-radius: 2px;
		    border: none;
		    width: 100px;
		    height: 40px;
		    font-size: 15px;
		    transition-duration: 0.4s;
		    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2);
		}

		.create_form{
			background-color: #fafafa;
			padding: 16px;
			box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2);
		}

		.patient_card{			
			width: auto;			
			height: auto;
			background-color: #fafafa;
			padding: 16px;
			box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2);
			display: flex;
			justify-content: space-around;
			align-items: center;
			margin-bottom: 16px;
		}

		.pic{
			float: left;
		}

		.fab_edit{
			width: 56px;
			height: 56px;
			background-color: #2196F3;
			border-radius: 50%;
			box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.2);
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 16px;
		}

		.fab_delete{
			width: 56px;
			height: 56px;
			background-color: #f44336;
			border-radius: 50%;
			box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.2);
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 16px;
		}

		.search_icon{
			vertical-align: middle;
			margin-right: 5px;
		}

		.search_txt{
			background-color: transparent;
			border-bottom: 1px solid #FFA000;
			margin-right: 50px; 
			margin-top: 0;		
			color: #fafafa;
		}

		.search_txt[type="search"]{
			color: #fafafa;
		}

		#toast{
			display: none;
			background-color: #121212;
			opacity: 0.5;
			width: auto;			
			height: 30px;
			border-radius: 30px;
			color: #fff;
			justify-content: center;
			align-items: center;
		}


	</style>
</head>
<body>

	<nav>
		<div class="nav">
			<h2>DocX</h2>
			<div style="float: right;">
			<img class="search_icon" src="magnify.png">
			<input onkeyup="filter()" id="search" type="search" name="search" placeholder="Search" class="search_txt">
			</div>
			<ul>
				<li id="1" class="current" onclick="tabsOnClick('1')">VIEW</li>
				<li id="2" onclick="tabsOnClick('2')">CREATE</li>
				<li id="3" onclick="tabsOnClick('3')">HISTORY</li>
			</ul>
			<div id="tab_strip"></div>
		</div>
	</nav>

	<section class="container">
		<div id="tab_1">

		<?php

			while($data = mysqli_fetch_assoc($result)){

				if($data['gender']=="Male"){
					$gender = "male.png";
				}else{
					$gender = "female.png";
				}				

				echo "<div class=\"patient_card\">
					<img class=\"pic\" src=\"".$gender."\">				
					<div>
						<p style=\"font-size: 25px; margin-bottom: 0;\"><strong>Name:</strong> ".$data['f_name']." ".$data['l_name']."</p>
						<p><strong>Age:</strong> ".$data['age']."</p>
						<p><strong>Weight:</strong> ".$data['weight']."kgs <strong>		Height:</strong> ".$data['height']."cm</p>
						<p><strong>Last Diagnosis:</strong> ".$data['diagnosis']."</p>
						<p><strong>Last Prescription:</strong> ".$data['prescription']."</p>
						<p><strong>Last Treated On:</strong> ".$data['last_visited']."</p>
					</div>
					<div>
						<div class=\"fab_edit\" onclick=\"edit('".$data['_id']."')\"><img src=\"border-color.png\"></div>
						<div class=\"fab_delete\" onclick=\"patient_delete('".$data['_id']."')\"><img src=\"delete.png\"></div>
					</div>
				</div>\n";
			}

		?>

		</div>

		<div id="tab_2">

			<div class="create_form">
				<center>
				<h1>Create New Patient Record</h1>

				<form id="patient_record_new" method="POST" action="http://localhost/DocX/include/insert_patient.php">

				<p>First Name: <input type="text" name="f_name" placeholder="First Name"></p>
				<p>Last Name: <input type="text" name="l_name" placeholder="Last Name"></p>
				<p>Age: <input type="number" name="age" placeholder="Age"></p>
				<p>Gender: <input type="radio" name="gender" value="Male">Male
				<input type="radio" name="gender" value="Female">Female</p>
				<p>Weight: <input type="number" step="any" name="weight" placeholder="Weight">kgs</p>
				<p>Height: <input type="number" step="any" name="height" placeholder="Height">cm</p>
				<p>Daignosis: <textarea name="diagnosis" placeholder="Daignosis"></textarea></p>
				<p>Prescription: <textarea name="prescription" placeholder="Prescription"></textarea></p>
				<input class="submit" type="submit" name="Submit" value="CREATE">

				</form>
				</center>
			</div>

		</div>

		<div id="tab_3">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>

		<div id="toast">
			<p id="toast_txt"></p>
		</div>
	</section>

</body>
</html>