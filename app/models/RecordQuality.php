<?php

class RecordQuality extends \Eloquent {

	protected $fillable = [
		'name',
		'accounting_type_id'
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public static function getRecordQualities()
	{
		$record_qualities = DB::table('record_qualities')->get();	
		$data = [];
		foreach ($record_qualities as $record_quality)
		{
			$data[$record_quality->id] = $record_quality->name; 
		}

		return $data;
	}

}
