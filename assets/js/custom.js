// Toggle action for nav bar on mobile mode
$("#toggler").on("click", (e) => {
  $(e.currentTarget).toggleClass("change");
  $("#topnav").toggleClass("responsive")
});

// Close button for alert notification
$("#closeAlert").on("click", (e) => {
  $(e.currentTarget).parent().css({"opacity": 0});
});

// Submit action on submit form
$("#scrapeForm").on("submit", (e) => {
  e.preventDefault();

  const data = {
    "url": url.value,
    "element": element.value
  }

  $.post("/api/getdata", data, function(data, status) {
    if (status === "success") {
      console.log(data);
    }
  })
})

// Set active Menu