<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />

  <title>Exercise 1: Batman Trivia</title>

  <link rel="stylesheet" type="text/css" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet">
</head>

<body>
  <div id="container">

    <h1>Batman Trivia: Results</h1>

    <?php

    static $answer_keys = ['D', 'B', 'B', 'C', 'B']; //the correct answer keys
    static $answer_values = [ /*correct answers to show user on results page*/
      'Q1: Correct Answer was D - Batman overpowers Bane in his normal form, but when Bane unleashed his more bestial side, he severely injures Batman and breaks his back off-screen.',
      'Q2: Correct Answer was B - Catwoman made her first appearance in Batman #1 (Spring, 1940).',
      'Q3: Correct Answer was B - Harvey Dent was driven insane after a mob boss threw acidic chemicals at him during a trial, hideously scarring the left side of his face. He subsequently adopted the "Two-Face" persona, becoming a criminal obsessed with duality.',
      'Q4: Correct Answer was C - After Jason is killed by the Joker and resurrected in the Lazarus Pit, he goes on to become the Red Hood.',
      'Q5: Correct Answer was B - Located on the outskirts of Gotham, Arkham Asylum is a psychiatric hospital where many of Batman\'s foes are sent for rehabilitation.'
    ];
    static $answers = []; //user answers
    static $incorrect_answers = []; //incorrect answers
    $username = $_POST['name']; // username
    $count = 1; //increment global variable POST
    $possibleCorrect = 5; //total questions
    $totalCorrect = 0; //total of correct answers

    //add users answer to array
    for ($i = 0; $i < 5; $i++) {
      $answers[$i] = $_POST["question-" . $count . "-answers"];
      $count++;
    }

    //compare user answer to key, set index null if correct, add answer value to array if incorrect
    for ($i = 0; $i < 5; $i++) {
      if ($answers[$i] == $answer_keys[$i]) {
        $totalCorrect++;
        $incorrect_answers[$i] = null;
      } else {
        $incorrect_answers[$i] = $answer_values[$i];
      }
    }

    //display username and number of correct answers
    echo "<div id='results'>" . ucfirst($username) . ", you scored $totalCorrect / $possibleCorrect correct</div>";

    //header before displaying correct answers
    if ($totalCorrect > 0) echo "<div id='info'>Here is what you missed ...</div>";

    //display the correct answer(s) if user incorrectly answered
    for ($i = 0; $i < count($incorrect_answers); $i++) echo "<div id='correct-answers'>$incorrect_answers[$i]</div>";

    ?>

    <!-- button to retake the quiz -->
    <p style='margin-top: 50px'>
      <input type=button onClick="parent.location='index.html'" value='Retake Quiz'>
    </p>

  </div>

</body>

</html>