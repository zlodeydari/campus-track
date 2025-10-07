 <?
// Подключение конфигурации БД и проверка сессии
require "option.php";
$menugroup = 7; // ID пункта меню для подсветки

// Получение данных о учебном курсе (если передан ID)
if (isset($idstudy)) {
    $r = mysqli_query($dbcnx, "select * from study where idstudy=$idstudy");
    $f = mysqli_fetch_array($r);
    $status = $f['status'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><? echo $permission;?></title>
    <!-- Подключение стилей Bootstrap и темы -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/ready.css">
<style>@media(max-width:991px){.sidebar{transform:none!important;position:static!important;width:100%}.sidebar .sidebar-wrapper{width:100%;padding-top:0;max-height:none}.main-panel{width:100%;margin-left:0}}</style>
</head>
<body>
<?
// === 1. ОБРАБОТКА ВХОДНЫХ ДАННЫХ (ФИЛЬТРЫ) ===
$s = "SELECT * from study, attendance, student, teacher, subject 
      where study.idstudy=attendance.idstudy 
      and attendance.idstudent=student.idstudent  
      and study.idsubject=subject.idsubject 
      and study.idteacher=teacher.idteacher";
$r = mysqli_query($dbcnx, $s);
?>
    <? require "menu.php"; ?>
<main>
<form name="form2" method="post">
                            <div>
                                <div>Посещаемость</div>
                                            
                                </div>  
                                
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Дата занятия</th> 
                                                <th scope="col">Студент</th> 
                                                <th scope="col">Предмет</th> 
                                                <th scope="col">Посещаемость</th>
                                                <th scope="col">Причина</th>       
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?
                                        // Цикл вывода результатов запроса
                                        while ($f = mysqli_fetch_array($r)) {
                                            echo "<tr>";
                                            ?>
                                            <td>
                                                <label>
                                                    <!-- Радио-кнопка для выбора записи (например, для редактирования) -->
                                                    <input type="radio" name="arrattendance[]" value=<? echo $f["idattendance"];?> <? if (!isset($checked)) { echo "checked=checked"; $checked=true; } ?>>
                                                    <span></span>
                                                </label>
                                            </td>
                                            <?
                                            // Вывод данных строки в ячейки таблицы
                                            echo "
                                            <td> $f[datestudy]</td>				
                                            <td> $f[student]</td>		
                                            <td> $f[subject]</td>	
                                            <td> $f[attendance]</td>
                                            <td> $f[cause]</td>	
                                            ";							
                                            echo "</tr>";
                                        }		 
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
</main>
</body>
</html>
