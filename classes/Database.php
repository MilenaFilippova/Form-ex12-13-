<?php

class Database
{
	public $isConn;
	protected $datab;
	//указываем личные данные
	public function __construct($username = "root", $password = "", $host="localhost", $dbname="formareg",$options=[])
	{
		$this->isConn=TRUE;
		try
		{
			$this->datab=new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username,$password,$options);
			$this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//обработка ошибок с пдо
			$this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			throw new  Exсeption($e->getMessage());
		}
	}
	
	public function Disconnect()
	{
		$this->datab=NULL;
		$this->isConn=FALSE;
	}
	
	public function getRow($query,$params=[])
	{
		try
		{
			$stmt=$this->datab->prepare($query);
			$stmt->execute($params);
			
			return $stmt->fetch();
		}
		catch(PDOException $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	public function getRows($query,$params=[])
	{
		try
		{
			$stmt=$this->datab->prepare($query);
			$stmt->execute($params);
			return $stmt->fetchObject(static::class);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			throw new Exception($e->getMessage());
		}
	}
	/*
	public function countRow($query,$params=[])
	{
		try
		{
			$stmt=$this->datab->prepare($query);
			$stmt->execute($params);
			
			return $stmt->fetch_row(static::class);
		}
		catch(PDOException $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	*/
	public function insertRow($query,$params=[])
	{
		
		try
		{
			$stmt=$this->datab->prepare($query);
			$stmt->execute($params);
			return TRUE;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			throw new Exception($e->getMessage());
		}
	}
	
	public function updateRow($query,$params=[])
	{
		$this->insertRow($query,$params);
	}
	
	public function deliteRow($query,$params=[])
	{
		$this->insertRow($query,$params);
	}
}


