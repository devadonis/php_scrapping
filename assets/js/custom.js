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
  }
)