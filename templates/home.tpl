{#INCLUDE:header.tpl}
<body>
	<div class="main">
		<div class="top">
			<div id="base">
				<div id="right">
					<ul>
					  <li>
						{#playersOnline}  players online
					  </li>
					  <li>
						<span style="color:#D78600;">Server Time:</span> {#serverTime}
					  </li>
					</ul>
				</div>
			</div>
			<div id="basebottom"></div>
			<div class="intro-header">
				<div class="logo">
					<div class="img"></div>
				</div>
				<div id="image-menutop">
				    <div class="align">
						<a href="{#base}game/register"><div class="create"></div></a>
						<a href="{#base}game"><div class="play"></div></a>
						<a href="{#base}game/upgrade"><div class="upgrade"></div></a>
					</div>
				</div>
				<div class="menu">
					<div id="base">
						<ul id="left">
						  <a href="{#base}"><li>Home</li></a>
						  <a href="{#base}ranking"><li>Ranking</li></a>
						  <a href="{#base}maps"><li>Maps</li></a>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="main-content">
			<div class="container">
				<div class="row margintop-20">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dns">
						    <div class='well well-sm description'>
							    Desc here
							</div>
							<?php foreach ($this->getPlugins()->get("news")->getNews(10) as $key => $arr) {  ?>
							<div class="row">
								<div class="pull-left">
									<div class="dnAvatar">
										<img src="images/avatar/<?php print $arr["Author"]; ?>.png">
									</div>
									<p class="text-center nomargin-top"><?php print $arr["Author"]; ?></p>
								</div>
								<div class="post pull-right">
									<p class="date"><?php print $arr["Date"]; ?></p>
									<h2><?php print $arr["Title"]; ?></h2>
									<h3><?php print $arr["SubTitle"]; ?></h3>
									<p><?php print $arr["Text"]; ?></p>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 right-side">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding-sides"> 
						  <div class="well well-sm clearfix">
							<form action="/" method="GET">
							  <div class="title">Character Lookup</div>
							  <div class="form-group margintop-20">
								<input class="form-control" style="text-align:center;" type="text" name="char" aria-label="Character Name" placeholder="Type some username to search a hero...">
								<div class="text-center margintop-10"><button type='submit' class='btn btn-danger'>View Character</button></div>
							  </div>
							</form>
						  </div>
						</div> 					  
					</div> 	
				</div>
		   </div>
		</div>
	</div>
	<div class="footer">
		<div class="footerBG">
			<div id="base">
				<div id="left">Copyright © {#name}</div>
				<div id="right">FateCMS by Thalys M.</div>
			</div>
		</div>
	</div>
</body>
</html>