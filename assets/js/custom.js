$("#toggler").on("click", (e) => {
  $(e.currentTarget).toggleClass("change");
  $("#topnav").toggleClass("responsive")
});

$("#closeAlert").on("click", (e) => {
  $(e.currentTarget).parent().css({"opacity": 0});
});

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