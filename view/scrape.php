<?php require "layout/header.php" ?>
  <div class="container">
    <div class="d-flex-centered">
      <div class="alert">
        <span class="closebtn" onclick="closeAlert(this)">&times;</span>
      </div>
      <form action="/action_page.php">
        <label for="url">URL:</label>
        <input type="text" id="url" name="url" placeholder="Please input URL">

        <label for="element">Element:</label>
        <input type="text" id="element" name="lastname" placeholder="Please input element">

        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
<?php require "layout/footer.php" ?>