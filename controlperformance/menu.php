
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">


					</div>					
                   	<ul class="nav">

			<li class="nav-item">
							<a href="index.php">
								<i class="la la-home"></i>
								<p>Главная</p>
						
							</a>
			</li>	
<?
if ($permission=="Администратор")
{
?>						
                        <li class="nav-item">
							<a href="usersystem.php">
								<i class="la la-user""></i>
								<? if ($menugroup==1) echo "<b>";?>
								<p>Пользователи</p>
								<? if ($menugroup==1) echo "</b>";?>   

							</a>
						</li>		

<?
}

	
if ($permission=="Декан")
{
?>				 						     						
			<li class="nav-item">
							<a href="spec.php">
								<i class="la la-folder"></i>
								<? if ($menugroup==2) echo "<b>";?>
								<p>Специальности</p>
								<? if ($menugroup==2) echo "</b>";?>        

							</a>
						</li>		
			<li class="nav-item">
							<a href="squad.php">
								<i class="la la-weixin"></i>
								<? if ($menugroup==3) echo "<b>";?>
								<p>Группы</p>
								<? if ($menugroup==3) echo "</b>";?>        

							</a>
						</li>		
			<li class="nav-item">
							<a href="student.php">
								<i class="la la-tasks"></i>
								<? if ($menugroup==4) echo "<b>";?>
								<p>Студенты</p>
								<? if ($menugroup==4) echo "</b>";?>        

							</a>
						</li>	

			<li class="nav-item">
							<a href="subject.php">
								<i class="la la-star-o"></i>
								<? if ($menugroup==5) echo "<b>";?>
								<p>Предметы</p>
								<? if ($menugroup==5) echo "</b>";?>        

							</a>
						</li>


			<li class="nav-item">
							<a href="performancedean.php">
								<i class="la la-history"></i>
								<? if ($menugroup==6) echo "<b>";?>
								<p>Успеваемость</p>
								<? if ($menugroup==6) echo "</b>";?>        

							</a>
						</li>


			<li class="nav-item">
							<a href="attendancedean.php">
								<i class="la la-paper-plane"></i>
								<? if ($menugroup==7) echo "<b>";?>
								<p>Посещаемость</p>
								<? if ($menugroup==7) echo "</b>";?>        

							</a>
						</li>

			<li class="nav-item">
							<a href="controldean.php">
								<i class="la la-hourglass"></i>
								<? if ($menugroup==8) echo "<b>";?>
								<p>Контроль</p>
								<? if ($menugroup==8) echo "</b>";?>        

							</a>
						</li>


<?
}


if ($permission=="Преподаватель")
{
?>				 						     						
			<li class="nav-item">
							<a href="performanceteacher.php">
								<i class="la la-history"></i>
								<? if ($menugroup==2) echo "<b>";?>
								<p>Успеваемость</p>
								<? if ($menugroup==2) echo "</b>";?>        

							</a>
						</li>

			<li class="nav-item">
							<a href="studyteacher.php">
								<i class="la la-yelp"></i>
								<? if ($menugroup==3) echo "<b>";?>
								<p>Занятия</p>
								<? if ($menugroup==3) echo "</b>";?>        

							</a>
						</li>


<?
}

if ($permission=="Студент")
{
?>				 						     						
			<li class="nav-item">
							<a href="performancestudent.php">
								<i class="la la-history"></i>
								<? if ($menugroup==2) echo "<b>";?>
								<p>Успеваемость</p>
								<? if ($menugroup==2) echo "</b>";?>        

							</a>
						</li>

			<li class="nav-item">
							<a href="attendancestudent.php">
								<i class="la la-yelp"></i>
								<? if ($menugroup==3) echo "<b>";?>
								<p>Посещаемость</p>
								<? if ($menugroup==3) echo "</b>";?>        

							</a>
						</li>


<?
}
?>


			</ul>
				</div>
			</div>

