<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />

  <title>Exercise 1 : Batman Trivia</title>

  <link rel="stylesheet" type="text/css" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet">
</head>

<body>

  <div id="container">

    <h1>Batman Trivia - Quiz</h1>


    <?php
    // define variables and set to empty values
    $nameErr = "";
    $username = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["name"])) {
        $nameErr = "Name is required";
      } else {
        session_start();
        $_SESSION['POST'] = $_POST;
        header("Location: results.php");
      }
    }
    ?>

    <p><span class="error">* required field.</span></p>

    <!-- </form> -->
    <form method="post" action="<?php
                                echo $_SERVER["PHP_SELF"]; ?>">
      <table>
        <tr>
          <td>Name:</td>
          <td><input type="text" name="name">
            <span class="error">* <?php echo $nameErr; ?></span>
          </td>
        </tr>
      </table>

      <ol>
        <!-- Question 1 -->
        <li>

          <h3>What super villain once broke Batman's back, leaving him crippled and wheelchair-bound?</h3>

          <div>
            <input type="radio" name="question-1-answers" id="question-1-answers-A" value="A" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-1-answers-A">A. Ra's al Ghul </label>
          </div>

          <div>
            <input type="radio" name="question-1-answers" id="question-1-answers-B" value="B" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-1-answers-B">B. Joker</label>
          </div>

          <div>
            <input type="radio" name="question-1-answers" id="question-1-answers-C" value="C" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-1-answers-C">C. Killer Croc</label>
          </div>

          <div>
            <input type="radio" name="question-1-answers" id="question-1-answers-D" value="D" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-1-answers-D">D. Bane</label>
          </div>

        </li>

        <!-- Question 2 -->
        <li>

          <h3>Which of these Bat-villains was introduced first?</h3>

          <div>
            <input type="radio" name="question-2-answers" id="question-2-answers-A" value="A" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-2-answers-A">A. The Penguin</label>
          </div>

          <div>
            <input type="radio" name="question-2-answers" id="question-2-answers-B" value="B" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-2-answers-B">B. Catwoman</label>
          </div>

          <div>
            <input type="radio" name="question-2-answers" id="question-2-answers-C" value="C" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-2-answers-C">C. The Riddler</label>
          </div>

          <div>
            <input type="radio" name="question-2-answers" id="question-2-answers-D" value="D" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-2-answers-D">D. Mr. Freeze</label>
          </div>

        </li>

        <!-- Question 3 -->
        <li>

          <h3>What former District Attorney became the villain known as Two-Face?</h3>

          <div>
            <input type="radio" name="question-3-answers" id="question-3-answers-A" value="A" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-3-answers-A">A. Edward Nygma</label>
          </div>

          <div>
            <input type="radio" name="question-3-answers" id="question-3-answers-B" value="B" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-3-answers-B">B. Harvey Dent</label>
          </div>

          <div>
            <input type="radio" name="question-3-answers" id="question-3-answers-C" value="C" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-3-answers-C">C. Floyd Lawton</label>
          </div>

          <div>
            <input type="radio" name="question-3-answers" id="question-3-answers-D" value="D" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-3-answers-D">D. Jason Blood</label>
          </div>

        </li>

        <!-- Question 4 -->
        <li>

          <h3>Who killed Jason Todd?</h3>

          <div>
            <input type="radio" name="question-4-answers" id="question-4-answers-A" value="A" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-4-answers-A">A. Two-Face</label>
          </div>

          <div>
            <input type="radio" name="question-4-answers" id="question-4-answers-B" value="B" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-4-answers-B">B. Bane</label>
          </div>

          <div>
            <input type="radio" name="question-4-answers" id="question-4-answers-C" value="C" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-4-answers-C">C. Joker</label>
          </div>

          <div>
            <input type="radio" name="question-4-answers" id="question-4-answers-D" value="D" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-4-answers-D">D. Colton Grundy</label>
          </div>

        </li>

        <!-- Question 5 -->
        <li>

          <h3>Where does Batman send his most twisted foes for rehabilitation?</h3>

          <div>
            <input type="radio" name="question-5-answers" id="question-5-answers-A" value="A" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-5-answers-A">A. Gotham Prison</label>
          </div>

          <div>
            <input type="radio" name="question-5-answers" id="question-5-answers-B" value="B" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-5-answers-B">B. Arkham Asylum</label>
          </div>

          <div>
            <input type="radio" name="question-5-answers" id="question-5-answers-C" value="C" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-5-answers-C">C. Penhurst Asylum</label>
          </div>

          <div>
            <input type="radio" name="question-5-answers" id="question-5-answers-D" value="D" onClick="checkIfSubmitButtonShouldBeEnabled(this)" />
            <label for="question-5-answers-D">D. Greystone Psychiatric Hospital</label>
          </div>

        </li>

      </ol>


      <!-- Submit Button -->
      <p style='margin: 40px 0 0 50px'>
        <input type="submit" value="Submit" class="btn-submit" disabled="true" />
      </p>
    </form>

    <!-- Enable button if all questions have answer-->
    <script>
      const q = [],
        QUESTIONS = 5,
        btn_submit = document.querySelector('input[type="submit"]');

      let questionsAnswered = [false, false, false, false, false],
        username = document.querySelector('input[type="text"]');

      function checkIfSubmitButtonShouldBeEnabled(radio) {
        //check radio change in each question group
        if (radio.name === 'question-1-answers') questionsAnswered[0] = true;
        if (radio.name === 'question-2-answers') questionsAnswered[1] = true;
        if (radio.name === 'question-3-answers') questionsAnswered[2] = true;
        if (radio.name === 'question-4-answers') questionsAnswered[3] = true;
        if (radio.name === 'question-5-answers') questionsAnswered[4] = true;

        //check if all questions have answer
        if (questionsAnswered[0] &&
          questionsAnswered[1] &&
          questionsAnswered[2] &&
          questionsAnswered[3] &&
          questionsAnswered[4]
        ) {
          btn_submit.disabled = false;
          // console.log('btn enabled');
        }
      }
    </script>

    </form>

  </div>
</body>

</html>