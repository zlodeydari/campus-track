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
$filter = $_GET["filter"]; // Режим фильтрации (0 - сброс, 1 - активен)
$sort   = $_GET["sort"];   // Режим сортировки

// Получение значений из формы
$value1 = $_POST['FilterValue1']; // Студент
$value2 = $_POST['FilterValue2']; // Преподаватель
$value3 = "Все"; // Предмет
$value4 = "Все"; // Статус посещаемости

// === 2. ЛОГИКА СБРОСА ИЛИ ПРИМЕНЕНИЯ ФИЛЬТРОВ ===
if ($filter == 0) {
    // Если фильтр сброшен — ставим значения "Все" и широкий диапазон дат
    $value1 = $value2 = $value3 = $value4 = "Все"; 
    $date1 = (date("Y")-1)."-".date("m")."-".date("d");    
    $date2 = (date("Y")+1)."-".date("m")."-".date("d");    
} else {
    // Если фильтр активен — берем даты, выбранные пользователем
    $date1 = $_POST['date1'];    
    $date2 = $_POST['date2'];   
}

// === 3. ФОРМИРОВАНИЕ SQL-ЗАПРОСА ===
// Объединение таблиц (JOIN) для получения полной информации о занятии
$s = "SELECT * from study, attendance, student, teacher, subject 
      where study.idstudy=attendance.idstudy 
      and attendance.idstudent=student.idstudent  
      and study.idsubject=subject.idsubject 
      and study.idteacher=teacher.idteacher";

// Динамическое добавление условий фильтрации (только если выбрано не "Все")
if (($value1 != "Все") and ($filter == 1)) 
    $s .= " and attendance.idstudent = $value1 ";

if (($value2 != "Все") and ($filter == 1)) 
    $s .= " and study.idteacher = $value2 ";

// Обязательный фильтр по периоду дат

// === 4. ЛОГИКА СОРТИРОВКИ ===


// Выполнение запроса
$r = mysqli_query($dbcnx, $s);
?>
    <? require "menu.php"; ?>
<main>
<form name="form2" method="post">
                            <div>
                                <div>Посещаемость</div>
                                <div align="right">	
                                    <!-- Выбор поля для сортировки -->
                                    
                                       

                                    <!-- Фильтр: Студент (заполняется из БД) -->
                                    &nbsp;&nbsp;Студент: 
                                    <select name="FilterValue1">	
                                        <option value="Все" selected=selected> Все</option>			
                                        <?
                                        $d = mysqli_query($dbcnx,"select * from student");
                                        while ($m = mysqli_fetch_array($d)) {
                                            echo "<option value=".$m['idstudent'];
                                            if ($m['idstudent'] == $value1) echo " selected=selected";
                                            echo ">".$m["student"]."</option>";	 		
                                        }
                                        ?>				
                                    </select>

                                    <!-- Фильтр: Преподаватель (заполняется из БД) -->
                                    &nbsp;&nbsp;Преподаватель: 
                                    <select name="FilterValue2">	
                                        <option value="Все" selected=selected> Все</option>			
                                        <?
                                        $d = mysqli_query($dbcnx,"select * from teacher");
                                        while ($m = mysqli_fetch_array($d)) {
                                            echo "<option value=".$m['idteacher'];
                                            if ($m['idteacher'] == $value2) echo " selected=selected";
                                            echo ">".$m["teacher"]."</option>";	 		
                                        }
                                        ?>				
                                    </select>

                                    <!-- Фильтр: Предмет (заполняется из БД) -->
                                    &nbsp;&nbsp;Предмет: 
                                    

                                    <!-- Фильтр: Статус присутствия -->
                                    &nbsp;&nbsp;Присутствие: 
                                    

                                    <!-- Выбор периода дат -->

                                    <br>
                                    <!-- Кнопки управления формой -->
                                    <input type="button" name="button1" onclick="this.form.action='attendancedean.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();" value="Фильтр">
                                    <input type="button" name="button2" onclick="this.form.action='attendancedean.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();" value="Очистить">
                                    <br>
                                    
                                    <!-- Кнопка экспорта/печати -->
                                    <div align="left">
                                        <input type="button" name="button" onclick="this.form.action='expattendancedean.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
                                    </div>            
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
