Test Project
Coding Style(Nameing)
-DB
    table, field name: snake_case

-Frontend
    function, variable name: camelCase

-Backend
    function, variable name: camelCase
    query: reserved words UPPER CASE

-Ajax Communication
    parameter name: camelCase
    data format: x-www-form-urlencoded
    method: POST

Project structure & Development principle
- Backend: 
    api root: api/root.php
    routing information: index.php
    constants and settings information: config/*.php
    api request data format: 
        .api -> api name to call (defined in constants.php)
        .relevant input params
    api response data format:
        .data -> output data for response(status == 0) or error(status == 1)
        .status -> 0(success) 1(fail)  Like unix system call response
    api names: config/constants.php

- Frontend
    page structure: header.php + {custom_body} + footer.php
    main layout: flex-grid system

!Do not use mixture of php and html for data sharing, all data should be  fetched using ajax call

For deployment
- db settings: config/constant.php
- .htaccess ettings
    all GET requests are redirected to index.php
    rewrite engine ON
    allow all overrides ON