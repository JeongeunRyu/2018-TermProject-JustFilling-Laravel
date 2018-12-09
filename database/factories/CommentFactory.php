<?php

use Faker\Generator as Faker;
use App\User;
use App\Board;
$factory->define(App\Comment::class, function (Faker $faker) {
	$minId = User::min('id');
	$maxId = User::max('id');
	$minId_board = Board::min('id');
	$maxId_board = Board::max('id');
    return [
        'content'=>$faker->sentence,
        'user_id'=>$faker->numberBetween($minId, $maxId),
        'board_id'=>$faker->numberBetween($minId_board, $maxId_board),
    ];
});
