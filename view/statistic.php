<?php require "layout/header.php" ?>
<div class="container">
  <div class="d-flex-centered">
    <div class="alert">
      <span class="closebtn" id="closeAlert">&times;</span>
    </div>
    <form class="big-form">
      <label for="domain"> Select Domain(120) </label>
      <select id="domain" name="domain">
        <option>Google.com</option>
      </select>
      <p>Average fetch time from domain</p>
      <p class="result" id="average_fetch_time">___</p>
      <p>Urls fetched from domain</p>
      <p class="result" id="urls_from_domain">___</p>
      <hr class="separator" />
      <label for="domain"> Select Element(30) </label>
      <select name="element" id="element">
        <option>div</option>
        <option>label</option>
      </select>
      <p>Total &lt;img&gt; elements fetched from google.com</p>
      <p class="result" id="elements_from_domain">___</p>
      <p>Total &lt;img&gt; elements fetched so far</p>
      <p class="result" id="elements_so_far">___</p>
      <input type="submit" value="Submit">
    </form>
  </div>
</div>
</main>
<!-- script goes here -->
<script src="<?php echo ASSETS; ?>/js/statistic.js"></script>
<?php require "layout/footer.php" ?>