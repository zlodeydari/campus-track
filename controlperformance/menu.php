
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
				

			


			


			

			


<?
}


if ($permission=="Преподаватель")
{
?>				 						     						
			

			


<?
}

if ($permission=="Студент")
{
?>				 						     						
			

			


<?
}
?>


			</ul>
				</div>
			</div>

