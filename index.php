<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="js/main.js"></script> 
<form method="post" >
            <select name="result">
              <option value="normal">normal</option>
              <option value="success">success</option>
            </select> 
            <button>Show success or normal</button>
            </form> 
<?php
// phpinfo();
 class Init{
    private $conn;
    private $name;
    private $password;
    private $dbname;
    public $host;
    public function __construct($host,
                                $name,
                                $password,
                                $dbname) {
      $this->host = $host;
      $this->name=$name;
      $this->password = $password;
      $this->dbname = $dbname;
      $this -> create();
      $this->fill();
      $this->fill();
      $this->fill();
      $conn = new mysqli($this->host,$this->name,$this->password, $this->dbname);       
      }
    private function create()   { 
      //   конструктор для подключения к mysql серверу
      $conn = new mysqli($this->host,$this->name,$this->password, $this->dbname );         
        // sql создания таблицы
        $sql = "CREATE TABLE test(
            id   INT AUTO_INCREMENT NOT NULL,
            script_name VARCHAR (25) NOT NULL,
            start_time  INT NOT NULL,
            end_time    INT NOT NULL,
            result set('normal','illegal','success','failed'),       
            PRIMARY KEY (id)
          );";
        // ПРОВЕРКА ФАКТА ОТСУТСТВИЯ ТАБЛИЦЫ В БАЗЕ ДАННЫХ
        $sqlTest = "SHOW TABLES LIKE 'test';";
        // 
        $result = mysqli_fetch_array($conn->query($sqlTest));
        // var_dump(isset($result));

        $result??$conn->query($sql);
        //   проверка на нличие ошибок в подключении к базе данных
        if($conn->connect_error)  {
            // выдача ошибки и остановка скрипта
             die("Connection failed: " . $conn->connect_error);
        }  
        
        // закрытие подключения
        $conn->close();
     }
    

    private function fill() {
      $conn = new mysqli($this->host,$this->name,$this->password, $this->dbname);       
      // поядковый номер
      $i = rand(0,10000);
      // случайное строка
      
      $script_name = "script_name_$i"; 
      // случайное число для end_time и start_time?
      $start_time = rand();
      $end_time = rand();
      // случайные числа для set переменной
      $rand_set = rand(1,4);
    //  sql запрос заполнения таблицы
      $sql = "INSERT INTO test(id,script_name,start_time,end_time,result) values($i, '{$script_name}',$start_time,$end_time,$rand_set);";
      // вцполнение этого запоса
      $res = $conn->query($sql);
    }
    
    public function get(){
      // подключение в этой функции
      $conn = new mysqli($this->host,$this->name,$this->password, $this->dbname);       
      // строка получения запроса от пользователя
      $result = array_key_exists('result',$_POST)?$result = $_POST["result"]:"";
      
      // sql запрос получения данных по выбранному типу
      $sql = "SELECT * FROM test WHERE FIND_IN_SET(result,'{$result}');";
      // выполнение запроса описанного выше
     $result = $conn ->query($sql);

     while($rows = $result->fetch_array(MYSQLI_ASSOC)) {
      // отображение результата запроса      
      echo "<table>";
        echo "<tr>";
        echo "<td>". $rows['id']."</td>";
        echo "<td>". $rows['script_name']."</td>";
        echo "<td>". $rows['start_time']."</td>";
        echo "<td>". $rows['end_time']."</td>";
        echo "<td>". $rows['result']."</td>";
        echo "</tr>";
      echo "</table>";
      
     }
    }
}
$inits = new Init('', 'root','root','test');
$inits ->get();

?>
<p>https://handyhost.ru/help/poleznyie-stati/optimizacziya-mysql-zaprosov.html</p>  
<p>https://habr.com/ru/articles/154167/</p>
<p>2.1 Все запросы рекомендуется кэшировать< для повторного обращения и использования 
</p>
<p>2.2 В запросе указывать * не рекомендуется,
  так как это приводит к выборке огромного количества не нужных столбцов из
  таблиц которые объединябтся.
</p>
3 <p>Создать скрипт, который в папке /datafiles найдет все файлы</p>   
<?php
function sort_file_name() {
// адрес сераера
$url = 'localhost';
// путь до папки с фалами
$dir = __DIR__ . '\datafiles'; 
// считать всё что усть в папке
   $files = scandir($dir);
  //  шаблон для поиска по назва
  $patern= "(\w{3,25}.txt)";
  // массив для результатов
  $arr = [];
  foreach($files as $file) {
    // поиск по егулярному выражению
    preg_match($patern, $file, $res);
    // убираю в массив полученное значение
    array_push($arr, $res );
      }
  //  сортировка полученного массива   
  sort($arr);
  // отображение полученного результата
  return ($arr);
    }
    // проверка работы функции
    var_dump(sort_file_name());

?>
<p>4. Написать скрипт закачивания страницы www.bills.ru</p>
 <?php

$lines = file('https://www.bills.ru/');
   var_dump($lines);
?>
<div class="first-div">
  <ul style="LIST-STYLE-TYPE:NONE">
    <li><button>1</button></li>
    <li><button>2</button></li>
    <li><button>3</button></li>
  </ul>
</div>

</body>
</html>
<?php

?>