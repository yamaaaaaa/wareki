<?php

namespace yamaaaaaa\Wareki;

class EraYear
{
	
	const ERA_YEARS = [
			['min' => 1, 'max' => 1868],
			['min' => 1868, 'max' => 1912],
			['min' => 1912, 'max' => 1926],
			['min' => 1926, 'max' => 1989],
			['min' => 1989, 'max' => 2019],
			['min' => 2019, 'max' => 9999],
	];
	
	const ERA_NAMES = [
			'西暦',
			'明治',
			'大正',
			'昭和',
			'平成',
			'令和',
	];
	
	const ERA_KEYS = [
			'AD',
			'M',
			'T',
			'S',
			'H',
			'R',
	];
	
	const ERA_NAMES_SHORT = [
			'\Y',
			'\M',
			'\T',
			'\S',
			'\H',
			'\R',
	];
	
	private int $eraIndex = 0;
	public int $year = 0;
	public string $year_wareki = '';
	public string $name = '';
	public string $name_short = '';
	public string $era = '';
	
	public function __construct(int $year)
	{
		$this->setYear($year);
	}
	
	public function setYear(int $year)
	{
		//現在の元号を検索
		foreach (self::ERA_YEARS as $k => $eraYear) {
			$min = $eraYear['min'];
			if ($year < $min) {
				break;
			}
			$this->eraIndex = $k;
		}
		$this->year = $year;
		$this->year_wareki = ($year - self::ERA_YEARS[$this->eraIndex]['min'] + 1);
		$this->name = self::ERA_NAMES[$this->eraIndex];
		$this->name_short = self::ERA_NAMES_SHORT[$this->eraIndex];
		$this->era = $this->name . $this->year_wareki . '年';
		//1年の場合に表記を元年に変更
		if ($this->year_wareki == 1) {
			$this->era = $this->name . '元年';
			//旧元号の最後と同じ年の場合併記する
			$oldIndex = $this->eraIndex - 1;
			$oldEra = self::ERA_YEARS[$oldIndex] ?? null;
			if (isset($oldEra['max'])) {
				if ($this->year == $oldEra['max']) {
					$oldName = self::ERA_NAMES[$oldIndex];
					$oldWareki = $oldEra['max'] - $oldEra['min'] + 1;
					$this->era = sprintf('%s元年(%s年)', $this->name, $oldName . $oldWareki);
				}
			}
		}
	}
	
	public static function options()
	{
		$names = array_reverse(self::ERA_NAMES);
		$keys = array_reverse(self::ERA_KEYS);
		$options = [];
		foreach ($names as $i => $val) {
			$options[$keys[$i]] = $val;
		}
		return $options;
		
	}
	
	
}