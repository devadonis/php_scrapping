<?php require "layout/header.php" ?>
  <div class="container">
    <div class="d-flex-centered">
      <div class="alert">
        <span class="closebtn" id="closeAlert">&times;</span>
      </div>
      <form id="scrapeForm">
        <label for="url">URL:</label>
        <input type="url" id="url" name="url" placeholder="Please input URL" required>

        <label for="element">Element:</label>
        <input type="text" id="element" name="element" placeholder="Please input element" required>

        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
<?php require "layout/footer.php" ?>