<?php
// Think about how you would set up the different elements within the game… 
// What should be a class?
// players
// gameBoard
// // Instance variable?
// players
// =======
// name
// piece

// game
// ----------
// board
// playerTurn
// gamerunning

// Method?
//  A few minutes of thought can save you from wasting an hour of coding.
// Build your game, taking care to not share information between classes any more than you have to.
// Post your solution below, then check out the example solution provided.



include 'lib/classes.php';
// create instance of game
$game = new Game();
// run game
$game->start_game();
// echo board
$game->print_board();

