<html lang="en">
	<head>
		<title>RPIDAY</title>
		<meta charset="utf-8"/>
		<link href='http://fonts.googleapis.com/css?family=Kurale' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="style.css" type="text/css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>

		<header class="mainheader">
			<nav><ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="projects.html">Projects</a></li>
				<li class="active"><a href="yourRPIDAY.php">Your RPIDAY</a></li>
				<li><a href="help.html">Help</a></li>
				<div class="log_sign" id="login">
					<li class="signup"><a href="signup.html">Sign Up</a></li>
					<li class="login"><a href="login.html">Log In</a></li>
				</div>
				<div class="loggedin" id="loggedin">
					<h5 id="user_name"  onclick="toggleMenuOn();" class="loggedInH5"></h5>
					<ul class="dropDownUser" id="dropDownUser">
						<li><a href="#" id="profile">Profile</a></li>
						<li><a href="messages.php" id="messages">Messages (3)</a></li>
						<li><a href="log_out.php">Log Out</a></li>
					</ul>
				</div>
			</ul></nav>
		</header>
			
		<script>
			//Script For The Calender
			
			var dateChose = [];
			
			var monthOrder = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "Spetember", "October", "November", "December"];
			
			var currentYear = new Date().getFullYear();
			var currentYearChoice = currentYear;
			
			var currentMonth = new Date().getMonth();
			var currentMonthChoice = currentMonth;
			
			function changeYear(way){
				if(way == "-"){
					currentYearChoice = currentYearChoice - 1;
				}else{
					if((currentYearChoice+1) > currentYear){
						console.log("Error Year In Future");
					}else{
						currentYearChoice = currentYearChoice + 1;
					}
				}
				
				document.getElementById("year").innerHTML = currentYearChoice;
				updateMonth("n");
			}
			
			function choseDate(date, side){
				dateChose[date, currentMonthChoice + side, currentYearChoice];
				if(document.getElementsByClassName("activeDay")[0] != null){
					document.getElementsByClassName("activeDay")[0].className = "altenativeToNone";
				}
				document.getElementById(date+"-"+side).className = "activeDay";
			}
			
			function initilizeCalender(){
				console.log("Initalizing Calender");
			}
			
			function updateMonth(way){
				if(currentMonthChoice == 0 && way == "-"){
					console.log("Error Month Is January Cannot Go To December")
				}else{
					if(currentMonthChoice == 10 && way == "+"){
						console.log("Error Month Is December Cannot Go To January")
					}else{
						if(currentMonthChoice+3 > currentMonth && way == "+" && currentYearChoice == currentYear){
							console.log("Error Month Going To Be Greater That Current Time")
						}else{
							if(way == "-"){
								currentMonthChoice = currentMonthChoice - 1;
							}else if(way == "n"){
								currentMonthChoice = currentMonthChoice;
							}else{
								currentMonthChoice = currentMonthChoice + 1;
							}
						}
					}
				}
				
				document.getElementById("rightMonthName").innerHTML = monthOrder[currentMonthChoice + 1];
				document.getElementById("leftMonthName").innerHTML = monthOrder[currentMonthChoice];
				
				leftStringForDate = "";
				rightStringForDate = "";
				
				weekNumberDay = 0;
				
				for(day = 1; day <= new Date(currentYearChoice, currentMonthChoice+1, 0).getDate(); day ++){
					weekNumberDay += 1;
					//if(){
						
					//}
					if(weekNumberDay == 1){
						leftStringForDate += "<div class='week'><a id='" + day +  "-0" + "' href='javascript:choseDate(" + day + ", 0);'>" + day + "</a>";
					}else if(weekNumberDay == 7){
						weekNumberDay = 0;
						leftStringForDate += "<a id='" + day +  "-0" + "' href='javascript:choseDate(" + day + ", 0);'>" + day + "</a></div>";
					}else{
						leftStringForDate += "<a id='" + day +  "-0" + "' href='javascript:choseDate(" + day + ", 0);'>" + day + "</a>";
					}
				}
				
				weekNumberDay = 0;
				
				for(day = 1; day <= new Date(currentYearChoice, currentMonthChoice+2, 0).getDate(); day ++){
					weekNumberDay += 1;
					if(weekNumberDay == 1){
						rightStringForDate += "<div class='week'><a id='" + day +  "-1" + "' href='javascript:choseDate(" + day + ",1);'>" + day + "</a>";
					}else if(weekNumberDay == 7){
						weekNumberDay = 0;
						rightStringForDate += "<a id='" + day +  "-1" + "' href='javascript:choseDate(" + day + ",1);'>" + day + "</a></div>";
					}else{
						rightStringForDate += "<a id='" + day +  "-1" + "' href='javascript:choseDate(" + day + ", 1);'>" + day + "</a>";
					}
				}
				
				document.getElementById("leftMonthDays").innerHTML = leftStringForDate;
				document.getElementById("rightMonthDays").innerHTML = rightStringForDate;
				
				console.log(currentMonthChoice);
				
			}
		
		</script>
		
		<div class="mainContent">
			<div class="news">
				<article class="topContent">
					<header>
						<h2><a href="#" title="Update Settings">Update Settings</a></h2>
					</header>
					
					<footer>
						<p class="post-info">Last Updated At 11:52:30</p>
					</footer>
					
					<content>
						<form>
							<div class="colourPicker">Main Colour : <input type="color" id="mainColour" onchange="clickColor(0, -1, -1, 5)" value="#c61931"></div>
							<div class="colourPicker">Secondary Colour : <input type="color" id="secondaryColour" onchange="clickColor(0, -1, -1, 5)" value="#FFFFFF"></div>
							<div class="colourPicker">Tertiary Colour : <input type="color" id="tertiaryColour" onchange="clickColor(0, -1, -1, 5)" value="#111111" ></div>
							
							<div class="namePicker">Forename : <input type="input" id="forename" value="Joseph"></div>
							<div class="namePicker">Surname : <input type="input" id="surname" value="Saunders"></div>
							
							<div class="dobPicker">
								<div class="yearPicker">
								<div class="yearTitle"><a href="javascript:changeYear('-');">&#171;</a><span id="year">2016</span><a href="javascript:changeYear('+');">&#187;</a></div>
									<div class="monthPicker">
										<div class="monthTitle" id="leftMonth"><a href="javascript:updateMonth('-');">&#171;</a><span id="leftMonthName">June</span></div>
										<div id="leftMonthDays">
											<div class="week">
												<a>1</a>
												<a>2</a>
												<a>3</a>
												<a>4</a>
												<a>5</a>
												<a>6</a>
												<a>7</a>
											</div>
											
											<div class="week">
												<a>8</a>
												<a>9</a>
												<a>10</a>
												<a>11</a>
												<a>12</a>
												<a>13</a>
												<a>14</a>
											</div>
											
											<div class="week">
												<a>15</a>
												<a>16</a>
												<a>17</a>
												<a>18</a>
												<a>19</a>
												<a>20</a>
												<a>21</a>
											</div>
											
											<div class="week">
												<a>22</a>
												<a>23</a>
												<a>24</a>
												<a>25</a>
												<a>26</a>
												<a>28</a>
												<a>29</a>
											</div>
											
											<div class="week">
												<a>30</a>
												<a>31</a>
											</div>
										</div>
									</div>
									
									
									<div class="monthPicker">
										<div class="monthTitle"  id="rightMonth"><span id="rightMonthName">June</span><a href="javascript:updateMonth('+');">&#187;</a></div>
										<div id="rightMonthDays">
											<div class="week">
												<a>1</a>
												<a>2</a>
												<a>3</a>
												<a>4</a>
												<a>5</a>
												<a>6</a>
												<a>7</a>
											</div>
											
											<div class="week">
												<a>8</a>
												<a>9</a>
												<a>10</a>
												<a>11</a>
												<a>12</a>
												<a>13</a>
												<a>14</a>
											</div>
											
											<div class="week">
												<a>15</a>
												<a>16</a>
												<a>17</a>
												<a>18</a>
												<a>19</a>
												<a>20</a>
												<a>21</a>
											</div>
											
											<div class="week">
												<a>22</a>
												<a>23</a>
												<a>24</a>
												<a>25</a>
												<a>26</a>
												<a>28</a>
												<a>29</a>
											</div>
											
											<div class="week">
												<a>30</a>
												<a>31</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<input type="submit" text="Update" class="updateButton">
						</form>
					</content>
				</article>
				
				<!--<article class="middleContent">
					<header>
						<h2><a href="#" title="The Software">The Software</a></h2>
					</header>
					
					<content>
						<p>All the application software is wrote in Python and is fully open source and modable. Plugin pages can be found over the internet, so every week we chose our favourite one and will
						post a link to it on the home page.</p>
					</content>
				</article>
				
				<article class="bottomContent">
					<header>
						<h2><a href="#" title="Other">Other</a></h2>
					</header>
					
					<content>
						<p>Will Be Filled In At A Later Date.</p>
					</content>
				</article>-->
			</div>
		</div>

		
		<footer class="mainFooter">
			<p>Copyright &copy; 2015 <a href="#" title="Joseph-Saunders">Joseph Saunders</a>
				<ul class="HeadList">
					<li class="HeadElement"><h4>Pages</h4>
						<ul class="subList">
							<li class="active"><a href="index.html">Home</a></li>
							<li><a href="projects.html">Projects</a></li>
							<li><a href="yourRPIDAY.php">Your RPIDAY</a></li>
							<li><a href="help.html">Help</a></li>
							<li><a href="login.html">Log In</a></li>
							<li><a href="signup.html">Sign Up</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</li>
					
					<li class="HeadElement"><h4>Info and T&C's</h4>
						<ul class="subList">
							<li><a href="#">EULA</a></li>
							<li><a href="#">T&C's</a></li>
							<li><a href="#">Info On Unknown&trade;</a></li>
							<li><a href="#">Copyright</a></li>
							<li><a href="#">Freedom Of Information</a></li>
						</ul>
					</li>
					
					<li class="HeadElement"><h4>Contact</h4>
						<ul class="subList">
							<li><a href="#">Website: www.rpiday.com</a></li>
							<li><a href="#">Email: contact@rpiday.com</a></li>
							<li><a href="#">Reddit: r/RPIDAY</a></li>
							<li><a href="#">Phone: No Phone</a></li>
						</ul>
					</li>
				</ul>
			</p>
		</footer>
		
	</body>
</html>