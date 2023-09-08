<?php require "layout/header.php" ?>
<div class="container">
  <div class="d-flex-centered">
    <div class="alert">
      <span class="closebtn" id="closeAlert">&times;</span>
    </div>
    <form class="big-form">
      <label for="domain"> Select Domain(120) </label>
      <select name="domain">
        <option>Google.com</option>
      </select>
      <p>Average fetch time from domain</p>
      <p class="result">24s</p>
      <p>Urls fetched from domain</p>
      <p class="result">2500</p>
      <hr class="separator" />
      <label for="domain"> Select Element(30) </label>
      <select name="element">
        <option>div</option>
        <option>label</option>
      </select>
      <p>Total &lt;img&gt; elements fetched from google.com</p>
      <p class="result">245</p>
      <p>Total &lt;img&gt; elements fetched so far</p>
      <p class="result">2435</p>
      <input type="submit" value="Submit">
    </form>
  </div>
</div>
</main>
<!-- script goes here -->
<?php require "layout/footer.php" ?>