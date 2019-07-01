<?php
include_once    '/../config.php';
include_once  '/Sessions.php';
include_once   '/Database.php';
//use PDO;
class InviteForm
{
	public $table='authorizations';
	public $table2='subjects';
	public $table3='payments';
	
	private $name;
	private $lastname;
	private $age;
	private $city=
	[
		"irk" => "Иркутск",
		"ang" => "Ангарск",
		"she" => "Шелехов",
		"bra" => "Шелехов",
		"msk" => "Шелехов",
		"eka" => "Екатиринбург"
	];
	private $phone;
	private $email;
	private $tema = 
	[
		"Bus" => "Бизнес",
		"Tex" => "Технологии",
		"RM" => "Реклама и маркетинг"
	];
	private $pay = 
	[
		"WM" => "Web-Money",
		"YA" => "Yandex.money",
		"PP" => "PayPal",
		"CC" => "Credit Card"
	];
	private $agree;
	
	private $dateCreate;
	private $dateUpdate;
	private $dateDelete;
	private $ipaddr;

	
	private $error = [];
	
	
	
	
	/*public function save()
	{
		$this->ipaddr = $_SERVER['REMOTE_ADDR']; 
		if (empty($this->status))
			$this->status = "n";
		$contents = $this->name."|".$this->lastname ."|".$this->age."|".$this->phone."|".$this->city."|".
		$this->email."|".$this->tema."|".$this->pay ."|".$this->agree."|".$this->dateCreate."|".$this->ipaddr."|"."\n";
		
		file_put_contents("data/allform.txt", $contents, FILE_APPEND);
	}*/
	
	
	public function save_bd()
	{
		switch ($this->city) 
		{
			case 'irk':
				$c = 1;
				break;
			
			case 'ang':
				$c = 2;
				break;
			case 'she':
				$c = 3;
				break;
			case 'bra':
				$c = 4;
				break;
			case 'msk':
				$c = 5;
				break;
			case 'eka':
				$c = 6;
				break;
	
				
		}
		
		switch ($this->tema) 
		{
			case 'Bus':
				$t = 1;
				break;
			case 'Tex':
				$t = 2;
				break;
			
			case 'RM':
				$t = 3;
				break;
		}
		switch ($this->pay) 
		{
			case 'WM':
				$p = 1;
				break;
			
			case 'YA':
				$p = 2;
				break;
			case 'PP':
				$p = 3;
				break;
			case 'CC':
				$p = 4;
				break;
		}
		
		
		
		//$sql = static::get_pdo()->prepare('INSERT INTO `'.$this->table.'` (`name`,`lastname`,`email`,`phone`,`subject_id`,`payment_id`,`deleted_at`, `created_at`, `update_at`) VALUES (?,?,?,?,?,?,?,?,?);');
        //$sql->execute(array($this->name,$this->lastname,$this->email,$this->phone,$t,$p,$this->dateDelete, $this->dateCreate, $this->dateUpdate));
		//$pdo=new PDO('mysql:');
		
		$db = new Database();
		
		//$this->dateUpdate=$this->dateCreate;
		
		if ($db->insertRow('INSERT INTO `'.$this->table.'` (`name`,`lastname`,`age`,`city_id`,`phone`,`email`,`subject_id`,`payment_id`,`agree`,`deleted_at`, `created_at`, `updated_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)',
		[$this->name,$this->lastname, $this->age, $c, $this->phone, $this->email, $t, $p, $this->agree, $this->dateDelete, $this->dateCreate, $this->dateUpdate]) == TRUE)
		{
			include "/../templates/answer.php";	//форма отправлена
        } 
		else 
		{
            echo 'Error!';
        }
		//return $db->rowCount() === 1;

	}
	
	public function getRows_from_bd()
	{
		
		$db = new Database();	
		$result = [];
		
		 //$count= $db->countRow(' SELECT COUNT(`id`) FROM `authorizations`');
		//while ($row =$count)	???
        //{   
			//;
				//echo '<pre>';
					//print_r($result);
				//echo '</pre>';
			while ($result=$db->getRows("SELECT * FROM `authorizations`"))
			{
				$str=$result->id."|".$result->name."|".$result->lastname."|".$result->age."|".$result->city_id."|".$result->phone."|".$result->email."|". $result->subject_id."|".
					$result->payment_id ."|". $result->agree."|". $result->created_at."|"."|".$result->updated_at;
				$res = preg_replace("/ /","", $str);
				echo "<input type='checkbox' name='f[]' value=".$res.">".$str."<br>";
				//$result[] = $result;
			}
			return $result;
			
		//}
		
	}
	
	
	/*
	public function read_in_db()
	{
		//$sql = static::get_pdo()->prepare('SELECT t1.id, t1.name, lastname, email, phone, t2.sub_name, t3.pay_name, created_at, update_at, deleted_at FROM `' . $this->table . '` t1,`' . $this->table2 . '` t2,`' . $this->table3 . '` t3 WHERE t1.subject_id = t2.id AND t1.payment_id = t3.id AND `deleted_at` is NULL;');
        //$sql->execute();
        $objects = [];
        while ($object = $db->fetchObject(static::class))
        {
            $str=$object->id."|".$object->name."|".$object->lastname."|".$object->email."|".$object->phone."|".$object->sub_name."|".$object->pay_name."|".$object->created_at."|".$object->updated_at;
            $res = preg_replace("/ /","", $str);
            echo "<input type='checkbox' name='f[]' value=".$res.">".$str."<br>";
            $objects[] = $object;
        }
        return $objects;
	}
	
	*/
	
	
	
	public function del_in_bd()
	{
		$db = new Database();	
        if(empty($_POST['f']))
		{ 
                echo "<h2>Вы ничего не выбрали!</h2>";
        } 
        else
		{
            $del=$_POST['f'];
            $arr=array();
            foreach ($del as $key) 
			{
                $res=explode('|', $key);
                array_push($arr, $res[0]);
			}
        }
        echo "Удаление файлов:\n";
        $j=count($del);
        for($i=0;$i<$j;$i++)
		{
			echo $del[$i]."<br>"; 
        }
        foreach ($arr as $k)
		{ 
           // $sql = $this->get_pdo()->prepare('UPDATE `'.$this->table.'` SET `deleted_at` = ? WHERE `id` = ?;');
            //$sql->execute(array(date('Y-m-d-H-i-s'),$k)); 
			
			$bd->deliteRow("DELETE FROM `.$this->table.` SET `deleted_at` = ?",[date('Y-m-d-H-i-s'),$k]);
            $j--;
        }
        if ($j === 0)
		{
            echo "<h2>Файлы удалены</h2>";
		}
        else
		{
            echo "<h2>Неудалось удалить</h2>";
        }
		
	}
	
	public  function validate()
	{
		
		foreach (['name', 'lastname',  'age', 'city', 'phone', 'email', 'tema','pay','agree'] as $key) 
		{
			
			if(empty($this->$key))	//проверка всех полей на пустоту
			{
				$this->error[$key] = 'Ошибка.Заполните поле';
			}
		}
		if (!empty($this->error))	//не допуск к сохранению данных
		{
			return false;
		}
		
		//если поля не пустые ,проверяем содержимое
		/*if(preg_match_all('/^[А-Я]{1}[а-я]+$/',$this->name)== null)	//проверка имени
		{
			$this->error['name'] = 'Неверно введено имя';
			return false;
		}
		if(preg_match_all('/^[А-Я]{1}[а-я]+$/',$this->lastname) == null)	//проверка фамилии
		{
			$this->error['lastname'] = 'Неверно введена фамилия';
			return false;
		}
		if (preg_match('/^[a-z0-9]+@[a-z]+\.[a-z]+$/', $this->email) ==null)	//проверка почты
		{
			$this->error['email'] = 'Неверно введен e-mail';
			return false;
		}
		
		if (preg_match('/^(\+7|8)\d{10}$/', $this->phone) == null)	//проверка номера телефона
		{
			$this->error['phone'] = 'Неверно введен номер телефона';
			return false;
		}
		else
		{
			$this->phone=format_phone($this->phone);
		}*/
		return true;
	}
	
	public function format_phone($phone)
	{	
			$patterns= ['/^(\+7|8)((\d){3})((\d){3})((\d){2})(\d{2})$/'];	//+79991234566
			$replacements = ['${1} ${2} ${4}-${6}-${8}'];	////+7 999 123-45-66
			$phone= preg_replace($patterns, $replacements, $phone);
			return $phone;
	}
	public function errors_print($key)
	{
		return $this->error[$key];
	}
	
	public function get_date()
	{
		return $this->dateCreate;
	}
	
	public function get_date_upd()
	{
		return $this->dateCreate;
	}
	
	public function request()
	{
		$this->name = isset($_POST['name']) ? trim($_POST['name']) : null;
		$this->lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : null;
		$this->age = isset($_POST['age']) ? trim($_POST['age']) : null;
		$this->city = isset($_POST['city']) ? trim($_POST['city']) : null;
		$this->phone = isset($_POST['phone']) ? trim($_POST['phone']) : null;
		$this->email = isset($_POST['email']) ? trim($_POST['email']) : null;
		$this->tema = isset($_POST['tema']) ? trim($_POST['tema']) : null;
		$this->pay = isset($_POST['pay']) ? trim($_POST['pay']) : null;
		$this->agree = isset($_POST['agree']) ? 'yes' : 'no';
		$this->dateCreate = date('Y-m-d-H-i-s');
		
		$mes = new Sessions ;
		
		$mes->set('<h2>Ваша заявка отправлена успешно!</h2>');
		
		if ($this->validate())	//если нет ошибок
		{
			
			//$this->save();	//сохранение в файл
			$this->save_bd();	//сохранение в БД
			exit;
		}
				
	}
	public function read_to_file($i)
	{
		$filelist = file_get_contents("data/allform.txt");
		$filelist = explode("\n", trim($filelist));
		if (!isset($filelist[$i]))
			return false;
		$str = explode("|", trim($filelist[$i]));
		$j = 0;
		foreach (['name', 'lastname',  'age', 'city', 'phone', 'email', 'tema', 'pay','agree', 'dateCreate', 'ipaddr'] as $key) 
		{
			$this->$key = $str[$j];
			$j++;
		}
		return true;
	}
	
	/*
	public static function get_pdo()
	{
		$_pdo;
        if (empty($_pdo))
        {
            $_pdo = new PDO('mysql:host=localhost;dbname=formareg','root','');
        }
	}
	*/
	
}