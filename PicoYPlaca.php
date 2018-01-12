<?php

/**
 * Class PicoYPlaca
 * @since   2018-01-11
 * @author  Erick Vaca <erkow@hotmail.com>
  */
class PicoYPlaca {
	
	private $plate;
	private $date;
	private $time;


	//Timeslot of restriction
	public $timeslot = [
		['start'=>'07:00','end'=>'09:30'],
		['start'=>'16:00','end'=>'19:30']
	];

	//Days of restriction with plate numbers
	public $days = ['Monday'=>[1,2],
					'Tuesday'=>[3,4],
					'Wednesday'=>[5,6],
					'Thursday'=>[7,8],
					'Friday'=>[9,0]
				];


	public function __construct($plate=null, $date=null, $time=null){
		$this->plate=$plate;
		$this->date = $date; 
		$this->time = $time; 
	}

	//Set plate number
	public function setPlate($plate){
		$this->plate = $plate; 
	}

	//Get plate number
	public function getPlate(){
		return $this->plate;
	}

	//Set date
	public function setDate($date){
		$this->date = $date; 
	}

	//Get date
	public function getDate(){
		return $this->date;
	}

	//Set time
	public function setTime($time){
		$this->time = $time; 
	}

	//Get time
	public function getTime(){
		return $this->time;
	}

	/*
	* Get last digit in plate
	* @author  Erick Vaca <erkow@hotmail.com>
	* @since   2018-01-11
	*/
	private function getLastDigitPlate(){
		return substr($this->plate, -1);
	}

	/*
	* Get the day of the date
	* @author  Erick Vaca <erkow@hotmail.com>
	* @since   2018-01-11
	*/
	private function getDayOfDate(){
		$date = DateTime::createFromFormat("d/m/Y", $this->date);
 		return $date->format("l");		 
	}


	/*
	* Function to check if car can be on road on a day/time
	* @author  Erick Vaca <erkow@hotmail.com>
	* @since   2018-01-11
	*/
	public function checkPicoYPlaca()
	{

		$canBeOnRoad = true;

		//Validate inputs
		$this->validateRequired();

		$lastDigitPlate = $this->getLastDigitPlate();
		$dayOfDate = $this->getDayOfDate();

		//Check if plate is in the day of restriction first
		$restrictedNumbers = $this->days[$dayOfDate];
		if(in_array($lastDigitPlate, $restrictedNumbers)){
			//Check time slot
			foreach ($this->timeslot as $val) {
				if(strtotime($val['start']) <= strtotime($this->time) && strtotime($val['end'])>=strtotime($this->time) ){
					$canBeOnRoad = false;
					break;
				}				
			}			
		}
		return $canBeOnRoad;
	}

	/*
	* Function to validate required fields
	* @author  Erick Vaca <erkow@hotmail.com>
	* @since   2018-01-11
	*/
	private function validateRequired(){
		if(!$this->plate){
			throw new Exception("Plate number is required.");			
		}
		if(!$this->date){
			throw new Exception("Date is required.");			
		}
		if(!$this->time){
			throw new Exception("Time is required.");			
		}
	}

}