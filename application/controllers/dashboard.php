<?php

class Dashboard_Controller extends Base_Controller {

	private $counts = array();
	private $raw = array();

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	public function action_index()
	{
		// TODO: cache everything for 1 minute
		$logitems = Logitem::all();

		foreach ($logitems as $i)
		{
			$this->increment_error($i->site_id, $i->code);
			$this->append_error_msg($i->site_id, "{$i->message} on line {$i->line} in {$i->file}");
		}

		$data = array(
			'raw' => $this->raw,
			'counts' => $this->counts
		);
                	
		return View::make('dashboard', $data);
	}

	private function init()
	{
		foreach (array_keys(Config::get('loggy.sites')) as $id)
		{
			$this->counts[$id] = array(
				'fatals' => 0,
				'warnings' => 0,
				'notices' => 0,
				'other' => 0
			);

			$this->raw[$id] = '';
		}

	}

	private function increment_error($site_id, $errno)
	{
		if ($errno == E_ERROR)
			$this->counts[$site_id]['fatals']++;
		else if ($errno == E_WARNING)
			$this->counts[$site_id]['warnings']++;
		else if ($errno == E_NOTICE)
			$this->counts[$site_id]['notices']++;
		else
			$this->counts[$site_id]['other']++;
	}

	private function append_error_msg($site_id, $msg)
	{
		$this->raw[$site_id] .= "<pre>{$msg}</pre>";
	}

}