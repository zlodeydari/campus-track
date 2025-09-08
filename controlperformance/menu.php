
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
                        		

<?
}

	
if ($permission=="Декан")
{
?>				 						     						
					
					
				

			


			


			

			


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

