const API_URL = "/api/root.php";

$(document).ready(
  () => {
    // Load domain list from BE
    $.post(API_URL, {
      api: "GET_DOMAIN_LIST"
    },
      (response) => {
        response = JSON.parse(response);
        if (response.status === 0) {
          $('#domain').empty();
          for (v of response.data) {
            $('#domain').append(
              `<option value=${v.id}> ${v.name} </option>`
            );
          }
          $('#domain').val('');
        }
        // Load element list from BE
        $.post(API_URL, {
          api: "GET_ELEMENT_LIST"
        }, (response) => {
          response = JSON.parse(response);
          $('#element').empty();
          for (v of response.data) {
            $('#element').append(
              `<option value=${v.id}> ${v.name} </option>`
            );
          }
          $('#element').val('');
        })
      });

    // handle select change for domain and element
    $('#domain').on('change', () => {
      updateInfo("domain");
    })
    $('#element').on('change', () => {
      updateInfo("element");
    })

    // update information
    // type: what is changed? domain or element?
    function updateInfo(type) {
      const domainId = $('#domain').val();
      const elementId = $('#element').val();
      // average fetch time from domain
      // urls fetched from domain
      if (type === "domain") {
        // urls from domain
        $.post(API_URL, {
          api: "GET_URL_COUNT_FROM_DOMAIN",
          domainId: domainId
        },
          (response) => {
            response = JSON.parse(response);
            if (response.status === 0)
            {
              console.log("url count from domain", response.data);
              $('#urls_from_domain').text(response.data);
            }
          });
      }
      // elements count from domain
      if (domainId && elementId)
      {
        $.post(API_URL, {
          api: "GET_ELEMENT_COUNT_FROM_DOMAIN",
          elementId: elementId,
          domainId: domainId
        }, 
        (response) => {
          response = JSON.parse(response);
          if(response.status === 0)
          {
            console.log("element from domain", response.data);
            $("#elements_from_domain").text(response.data);
          }
        });
      }
      // element count so far
      if (type === "element")
      {
        $.post(API_URL, {
          api: "GET_ELEMENT_COUNT",
          elementId: elementId
        }, 
        (response) => {
          response = JSON.parse(response);
          if(response.status === 0)
          {
            console.log("element count so far", response.data);
            $("#elements_so_far").text(response.data);
          }
        });
      }
    }
  }
)