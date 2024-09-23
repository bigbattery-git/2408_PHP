<?php

  $rsp = [
    "scissors",
    "rock",
    "paper"
  ];
  
  while(true){
    echo "계속하시려면 scissors, rock, paper 셋 중 하나를 입력하세요.\n그만하시려면 0을 입력하세요.";

    $input = "";
    fscanf(STDIN, "%s\n", $input);
  
    if($input === "0"){
      echo "\n가위바위보를 종료합니다.";
      break;
    }
    echo "\n".get_rsp_result((string)$input)."\n\n";
  }

  function get_computer_result(int $result, string $scissors, string $rock, string $paper){
    if($result === 0){
      return "\n".$scissors;
    }
    else if($result === 1){
      return "\n".$rock;
    }
    else{
      return "\n".$paper;
    }
  }

  function get_rsp_result(string $my_answer){

    global $rsp;
    $isWorng = true;

    foreach($rsp as $value){
      if($my_answer === $value){
        $isWorng = false;
        break;
      }
    }

    if($isWorng === true)
      return "옳은 행위가 아닙니다. 휴먼";

    $computer_answer = rand(0, 2);

    $result = "유저의 선택은 : ".$my_answer."\n컴퓨터의 선택은 : ".$rsp[$computer_answer];
    // 유저가 가위를 냈을 때
    if ($my_answer === $rsp[0]){
      $result .= get_computer_result($computer_answer, "당신은 비겼습니다.", "당신은 졌습니다.", "당신은 이겼습니다.");
    }

    // 유저가 바위를 냈을 때 
    else if($my_answer === $rsp[1]){
      $result .= get_computer_result($computer_answer, "당신은 이겼습니다.", "당신은 비겼습니다.", "당신은 졌습니다.");
    }

    // 유저가 보를 냈을 때
    else if($my_answer === $rsp[2]){
      $result .= get_computer_result($computer_answer, "당신은 졌습니다.", "당신은 이겼습니다.", "당신은 비겼습니다.");
    }

    return $result;
  }