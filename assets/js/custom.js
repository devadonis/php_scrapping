$(document).ready(
  () => {

    // SET ACTIVE MENU
    const pathname = location.pathname;
    // Calculate last path 
    if (pathname === "/") {
      $("#home").addClass("active");
      $("#statistic").removeClass("active");
    }
    else if (pathname === "/statistic/") {
      $("#statistic").addClass("active");
      $("#home").removeClass("active");
    }
    // Toggle action for nav bar on mobile mode
    $("#toggler").on("click", (e) => {
      $(e.currentTarget).toggleClass("change");
      $("#topnav").toggleClass("responsive")
    });

    // Close button for alert notification
    $("#closeAlert").on("click", (e) => {
      $(e.currentTarget).parent().css({ "opacity": 0 });
    });

    // Submit action on submit form
    $("#scrapeForm").on("submit", (e) => {
      e.preventDefault();

      $.post(API_URL, {
        api: "SCRAPE_URL",
        url: url.value,
        element: element.value
      }, (response) => {
        response = JSON.parse(response);

        if (response.status === 0) {
          if (response.data.msg === "success") { // Show response data
            $("#alert").addClass("success").css({"opacity": 1});
            $("#alertMessage").text(response.data.data);
          } else { // Show error message
            $("#alert").removeClass("success").css({"opacity": 1});
            $("#alertMessage").text(response.data.msg);
          }
        }
      })
    })

  }
)