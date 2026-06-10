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
</head>
<body>
<?
// === 1. ОБРАБОТКА ВХОДНЫХ ДАННЫХ (ФИЛЬТРЫ) ===
$filter = $_GET["filter"]; // Режим фильтрации (0 - сброс, 1 - активен)
$sort   = $_GET["sort"];   // Режим сортировки

// Получение значений из формы
$value1 = $_POST['FilterValue1']; // Студент
$value2 = $_POST['FilterValue2']; // Преподаватель
$value3 = $_POST['FilterValue3']; // Предмет
$value4 = $_POST['FilterValue4']; // Статус посещаемости

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

if (($value3 != "Все") and ($filter == 1)) 
    $s .= " and study.idsubject = $value3 ";

if (($value4 != "Все") and ($filter == 1)) 
    $s .= " and attendance like '$value4' ";

// Обязательный фильтр по периоду дат
$s .= " and datestudy>='$date1' and datestudy<='$date2' ";

// === 4. ЛОГИКА СОРТИРОВКИ ===
if ($sort == 1) {
    // Сортировка по выбранному полю
    $fieldsort = $_POST['sortname'];
    $s .= " order by $fieldsort";
} else {
    // Сортировка по умолчанию
    $s .= " order by student";
}

// Выполнение запроса
$r = mysqli_query($dbcnx, $s);
?>
    <div class="wrapper">
        <!-- Шапка сайта и меню -->
        <div class="main-header">
            <div class="logo-header">
                <a href="#" class="logo"><? echo $permission;?></a>
                <!-- Кнопки навигации -->
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            
        </div>

        <? require "menu.php"; // Подключение бокового меню ?>

        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <form name="form2" method="post">
                            <div class="card-header">
                                <div class="card-title">Посещаемость</div>
                                <div align="right">	
                                    <!-- Выбор поля для сортировки -->
                                    Сортировка:
                                    <select name="sortname" style="height:22; width:auto" onChange="this.form.action='attendancedean.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();">
                                        <option value="student" <? if ($fieldsort=="student") {?> selected="selected" <? }?>>Студент </option>
                                        <option value="attendance" <? if ($fieldsort=="attendance") {?> selected="selected" <? }?>>Посещаемость </option>
                                    </select>   

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
                                    <select name="FilterValue3">	
                                        <option value="Все" selected=selected> Все</option>			
                                        <?
                                        $d = mysqli_query($dbcnx,"select * from subject");
                                        while ($m = mysqli_fetch_array($d)) {
                                            echo "<option value=".$m['idsubject'];
                                            if ($m['idsubject'] == $value3) echo " selected=selected";
                                            echo ">".$m["subject"]."</option>";	 		
                                        }
                                        ?>				
                                    </select>

                                    <!-- Фильтр: Статус присутствия -->
                                    &nbsp;&nbsp;Присутствие: 
                                    <select name="FilterValue4">	
                                        <option value="Все" selected=selected> Все</option>			
                                        <option value="Присутствовал" <? if ($value4=='Присутствовал') {echo "selected=selected";}?>> Присутствовал</option>	
                                        <option value="Отсутствовал" <? if ($value4=='Отсутствовал') {echo "selected=selected";}?>> Отсутствовал</option>					
                                    </select>

                                    <!-- Выбор периода дат -->
                                    с:<input name="date1" value="<? echo "$date1";?>" type="date">
                                    по:<input name="date2" type="date" value="<? echo "$date2";?>" >

                                    <br>
                                    <!-- Кнопки управления формой -->
                                    <input type="button" name="button1" onclick="this.form.action='attendancedean.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();" value="Фильтр">
                                    <input type="button" name="button2" onclick="this.form.action='attendancedean.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();" value="Очистить">
                                    <br>
                                    
                                    <!-- Кнопка экспорта/печати -->
                                    <div align="left">
                                        <input type="button" class="btn btn-success" name="button" onclick="this.form.action='expattendancedean.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости"> 
                                    </div>            
                                </div>  
                                
                                <div class="card-body">
                                    <table class="table table-head-bg-success">
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
                                                <label class="form-radio-input">
                                                    <!-- Радио-кнопка для выбора записи (например, для редактирования) -->
                                                    <input class="form-radio-input" type="radio" name="arrattendance[]" value=<? echo $f["idattendance"];?> <? if (!isset($checked)) { echo "checked=checked"; $checked=true; } ?>>
                                                    <span class="form-radio-sign"></span>
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
                    </div>
                </div>
            </div>     
            
        </div>
    </div>
</div>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
</body>
<!-- Подключение JavaScript библиотек -->



</html>