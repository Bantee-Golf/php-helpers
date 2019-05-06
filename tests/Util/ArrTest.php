<?php


class ArrTest extends \PHPUnit\Framework\TestCase
{

	public function test_Arr_intersectRecursive_simple_subset_match_1()
	{
		$input = [
			'payload' => [
				[
					'item' => 'item 1',
					'desc' => 'desc',
				]
			]
		];

		$subset = [
			'payload' => [
				[
					'item' => 'item 1',
					'desc' => 'desc',
				]
			]
		];

		$response = \EMedia\PHPHelpers\Util\Arr::intersectRecursive($input, $subset);

		self::assertTrue($response == $subset);
	}

	public function test_Arr_intersectRecursive_simple_subset_match_2()
	{
		$input = [
			'payload' => [
				[
					'item' => 'item 1',
					'desc' => 'desc',
				],
				[
					'item' => 'item 2',
					'desc' => 'desc',
				],
				[
					'item' => 'item 3',
					'desc' => 'desc',
				]
			]
		];

		$subset = [
			'payload' => [
				[
					'item' => 'item 2',
					'desc' => 'desc',
				],
			]
		];

		$response = \EMedia\PHPHelpers\Util\Arr::intersectRecursive($input, $subset);

		self::assertTrue($response == $subset);
	}

	public function test_Arr_intersectRecursive_simple_subset_match_3()
	{
		$input = [
			'payload' => [
				[
					'item' => 'item 1',
					'desc' => 'desc',
				],
				[
					'item' => 'item 2',
					'desc' => 'desc',
				],
				[
					'item' => 'item 3',
					'desc' => 'desc',
				]
			]
		];

		$subset = [
			'payload' => [
				[
					'item' => 'item 2',
				],
			]
		];

		$response = \EMedia\PHPHelpers\Util\Arr::intersectRecursive($input, $subset);
		self::assertTrue($response == $subset);
	}

	public function test_Arr_intersectRecursive_simple_subset_match_4()
	{
		$input = [
			'payload' => [
				[
					'item' => 'item 1',
					'desc' => 'desc',
					'is_read' => true,
				],
				[
					'item' => 'SENT_SINGLE_DEVICE_SEED_NOTIFICATION_2',
					'is_read' => false,
					'badge_count' => '',
				],
				[
					'item' => 'item 3',
					'desc' => 'desc',
				]
			]
		];

		$subset = [
			'payload' => [
				[
					'item' => 'SENT_SINGLE_DEVICE_SEED_NOTIFICATION_2',
					'is_read' => true,
				],
			]
		];

		$response = \EMedia\PHPHelpers\Util\Arr::intersectRecursive($input, $subset);

		self::assertFalse($response == $subset);
	}

	public function test_isAssocArray_detects_assoc_array()
	{
		$array = [
			'one' => 1,
			'two' => 2,
		];
		$result = \EMedia\PHPHelpers\Util\Arr::isAssocArray($array);

		self::assertTrue($result);

		$array = [
			1, 2, 4
		];
		$result = \EMedia\PHPHelpers\Util\Arr::isAssocArray($array);

		self::assertFalse($result);
	}



}
