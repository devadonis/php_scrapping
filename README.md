This project will enable us to see how you combine your skills developing using PHP/MySQL/JavaScript/CSS. Please read carefully and feel free to ask anything.

Create a single web page that will be hosted on a PHP server with MySQL. The page will have a title "HTML Element Counter" and will receive a URL of another web page and name of HTML element to check. For example:
URL http://colnect.com/en
Element: img
If you visit that page and run jQuery $('img').length in the console you'll see that the page has 3 <img> elements. As one is only loaded with JS, counting it <img> tags in HTML would result in 2.

When the form is submitted (AJAX), a response area on the page will be updated with the following information:

A. Request results: URL fetched / Date & time of response / Response time in msec / Count of elements 
So for our example it could be:
    URL http://colnect.com/en Fetched on 29/11/2016 1:11, took 532msec.
    Element <img> appeared 2 times in page.

B. Statistics for all requests (that's where MySQL comes in):
    i. How many URLs of that domain have been checked till now?
    ii. Average page fetch time from that domain during the last 24 hours.
    iii. Total count of this element from this domain.
    iv. Total count of this element from ALL requests ever made.
    
For our example this could be:
    General Statistics
    28 different URLs from colnect.com have been fetched
    Average fetch time from colnect.com during the last 24 hours hours is 472ms
    There was a total of 91 <img> elements from colnect.com
    Total of 1720 <img> elements counted in all requests ever made.
    

Guidelines:
1/ This may be accessed by different users on different computers with different browsers. Make us feel this is a service that could have been public. Depending on your knowledge and experience, this task may take anywhere between a couple of hours and months. So feel free to make assumptions to shorten development time BUT write them clearly.
2/ Check user input on both client AND on server.
3/ On server side, if the same request was made less than 5 minutes ago, send the previous response (don't re-fetch the page).
4/ Handle errors gracefully. Invalid URL / Inaccessible URL / Invalid HTML content / ... Some servers (such as Colnect) may block you if the request made by your server looks odd (proper user-agent?) or is too frequent. Take it into account.
5/ Have an optimal database that doesn't have needless repetition of information in it, not even for optimizing queries. Having a single table with repeating VARCHAR values isn't optimal. Have more than one table and use JOIN when needed. We suggest these tables: request(id, domain_id, url_id, element_id, time, duration) domain(id, name) url(id, name) element(id, name) but feel free to create a schema which you'll find better.
6/ No framework should be used. jQuery and some library for DB operations are allowed, although not required. It's going to be you writing raw code so please mind to have it well formed and coherent. Code should be easily readable with sufficient comments to understand it well. You may use existing code you've created previously and whichever resources you want.
7/ Ensure your HTML validates, and that your PHP/JavaScript code passed a linter and produces no notices/deprecation messages.
8/ Use CSS to format your form WITHOUT using the style attribute on specific elements.
9/ Optimize your code as not to have obvious inefficiencies such as redundant calculations in a loop or fetching unused data from the DBMS.
10/ You may assume that once you have <html> in the loaded page content, the HTML is valid.

What we expect to receive:
1/ The URL where we can see this project. You may host your code on some free hosting such as hostinger.com or on your own server and provide an IP.
2/ Archive with all files needed for deployment with a short explanation on how to do it. Include the details of software used where it's deployed and browsers on which it was tested.
3/ Track the time it took you to complete this project. Write how much time went into planning, development of each part, testing, deployment.

Good luck :)