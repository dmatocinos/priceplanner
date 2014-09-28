<?php

class RecordQuality extends \Eloquent {

	protected $fillable = [
		'name',
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public static function getRecordQualities()
	{
		$record_qualities = DB::table('record_qualities')->get();	

		$data = [];
		foreach ($record_qualities as $rq) {
			$data[$rq->id] = $rq->name;
		}

		return $data;
	}

	public static function getId($name)
	{
		return DB::table('record_qualities')->where('name', $name)->pluck('id');
	}

}
