<?php
// class for player objects
// $player = new Player($name, $piece);
class Player{
  public $name, $piece;

  function __construct($name, $piece){
    $this->name = $name;
    $this->piece = $piece;
  }

}

// class for game objects
// $game = new Game();
class Game{
  public $board, $player1, $player2, $current_player_turn, $running;
  private $win_conditions;

  function __construct(){
    $this->player1 = null;
    $this->player2 = null;
    $this->win_conditions = [
        [ 0, 1, 2],
        [ 3, 4, 5],
        [ 6, 7, 8],
        [ 0, 3, 6],
        [ 1, 4, 7],
        [ 2, 5, 8],
        [ 0, 4, 8],
        [ 2, 4, 6]
      ];
      $this->current_player_turn = 1;
  }

  //output empty board array
  function create_board(){
    return [
        [ [], [], [] ] ,
        [ [], [], [] ] ,
        [ [], [], [] ]
      ];
  }
  // output : rules string
  function print_rules(){
    return  "\nFirst player to mark 3 squares in a row horizontal, diagonal or vertical wins! If all squares a full and there is no winner then it is a draw\n";
  }
  // start game off
  function start_game(){
    echo "Welcome to Tic Tac Toe!\n";
    echo "Player 1 is X and Player 2 is O \n";
    echo "Rules are:  ";
    echo $this->print_rules();
    $player1Name = readline('Player 1 enter your name:');
    $player2Name = readline('Player 2 enter your name:');
    $this->player1 = new Player($player1Name, 'X');
    $this->player2 = new Player($player2Name, 'O');
    $this->board = $this->create_board();
    $this->running = true;
    $this->run_game();
  }
  // runs game round
  function run_game(){
    while($this->running){
      $this->print_board();
      $player_move = (int) readline('Player '. $this->current_player_turn.  ' which square would you like to place your piece?');
      if($this->make_move($player_move)){
        if($this->check_win()){
          echo "\nGame Over\n";
          echo $this->current_player_turn == 1 ? "Player 1 wins!\n" : "\nPlayer 2 wins!\n";
          $this->running = false;
        }else if($this->check_draw()){
          echo "\nThis was a draw\n";
          $this->running = false;
        }
       $this->current_player_turn = $this->current_player_turn == 1 ? 2 : 1;
      }else{
        echo "\nPlayer enter a valid move \n";
      }      
    }
  }
  // input sqr number ; output : true if empty ; false if not
  function make_move($n){
    $token = $this->current_player_turn == 1 ? "X" : "O" ;
    $x = 1;
    foreach($this->board as $idxRow=>$row){
      foreach($row as $idxCol=>$col){
        if($x == $n){
          echo "\n " . print_r($this->board[$idxRow][$idxCol]) . "\n";
          if(empty($this->board[$idxRow][$idxCol])){
            echo "\n Empty \n";
            $this->board[$idxRow][$idxCol] = $token;
            return true;
          }     
        }

        echo "Col is" . $idxCol;
        $x ++;
      }
    }
    echo "\n Not Empty \n";
    return false;
  }
    //input: board array ; output : true if win ; false if not
    function check_win(){
      $winConditions = $this->win_conditions;
      $board = $this->board;
      $token = $this->current_player_turn == 1 ? "X" : "O" ;
      foreach($winConditions as $winCondRow){
        $count = 0;
        foreach($winCondRow as $winCondIdx){
          for($i = 0 ; $i < count($board); $i++){
            for($j = 0; $j < count($board[$i]); $j++){
              $idx = ($i * 3) + $j;
              if(($idx == $winCondIdx) && ($board[$i][$j] == $token)){
                $count ++ ;
              }
              if($count == 3){
                return true;
              }
            }
          }
        }
      }
      return false;
    }
    // Input : board array  output : true if draw ; false if not
    function check_draw(){
      $board = $this->board;
      $count = 0;
      foreach($board as $row){
        foreach($row as $col){
          if(!empty($col)){
            $count ++;
          }
        }
      }
      return $count == 9;
    }
    
  //pretty print board output visual of board for cli
  function print_board(){
    $i = 1;
    foreach($this->board as $row){
      foreach($row as $cell){
        echo empty($cell) ? ' '.$i.' |' : ' '.$cell[0].' |';
        $i++;
      }      
      echo "\n------------\n";
    }
  }
}



