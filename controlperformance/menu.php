
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
								
								<p>Пользователи</p>
								   

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
								
								<p>Специальности</p>
								        

							</a>
						</li>		
			<li class="nav-item">
							<a href="squad.php">
								<i class="la la-weixin"></i>
								
								<p>Группы</p>
								        

							</a>
						</li>		
			<li class="nav-item">
							<a href="student.php">
								<i class="la la-tasks"></i>
								
								<p>Студенты</p>
								        

							</a>
						</li>	

			<li class="nav-item">
							<a href="subject.php">
								<i class="la la-star-o"></i>
								
								<p>Предметы</p>
								        

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
								
								<p>Успеваемость</p>
								        

							</a>
						</li>

			<li class="nav-item">
							<a href="studyteacher.php">
								<i class="la la-yelp"></i>
								
								<p>Занятия</p>
								        

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
								
								<p>Успеваемость</p>
								        

							</a>
						</li>

			<li class="nav-item">
							<a href="attendancestudent.php">
								<i class="la la-yelp"></i>
								
								<p>Посещаемость</p>
								        

							</a>
						</li>


<?
}
?>


			</ul>
				</div>
			</div>

