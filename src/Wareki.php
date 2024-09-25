<?php

namespace yamaaaaaa\Wareki;

use _PHPStan_cb8f9103f\Nette\Neon\Exception;
use Carbon\Carbon;
use Carbon\Month;
use Carbon\WeekDay;
use DateTimeInterface;
use DateTimeZone;

class Wareki extends Carbon
{
	
	const ERA = 'ERA';
	const ERA_NAME = 'ERA_NAME';
	const ERA_SHORT = 'ERA_SHORT';
	const ERA_YEAR = 'ERA_YEAR';
	private EraYear|null $eraYear = null;
	
	public function __construct(float|DateTimeInterface|int|string|WeekDay|Month|null $time = null, int|DateTimeZone|string|null $timezone = null)
	{
		parent::__construct($time, $timezone);
		$this->eraYear = new EraYear($this->year);
	}
	
	
	public function format(string $format): string
	{
		$this->eraYear->setYear($this->year);
		$format = preg_replace(
				[
						'/' . self::ERA_NAME . '/',
						'/' . self::ERA_SHORT . '/',
						'/' . self::ERA_YEAR . '/',
						'/' . self::ERA . '/',
				],
				[
						$this->eraYear->name, 
						$this->eraYear->name_short,
						$this->eraYear->year_wareki,
						$this->eraYear->era,
				],
				$format
		);
		$format = parent::format($format);
		return $format;
	}
	
	
	
	
}