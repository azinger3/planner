// Define the routes
crossroads.addRoute('/', function() {
    $('#routeContent').load('react.html');
});

crossroads.addRoute('/user/{userId}', function(userId) {
    $('#routeContent').load('user/details.html');
});

crossroads.addRoute('/trans/{?query}', function (query) {
    // query strings are decoded into objects
    //console.log('param1 ' + query.lorem + ' param2 ' + query.dolor);
    $('#routeContent').load('trans.html?param1=' + query.param1 + '&param2=' + query.param2);
});

crossroads.bypassed.add(function(request) {
    console.error(request + ' seems to be a dead end...');
});
 
//Listen to hash changes
window.addEventListener("hashchange", function() {
    var route = '/';
    var hash = window.location.hash;
    if (hash.length > 0) {
        route = hash.split('#').pop();
    }
    crossroads.parse(route);
});
 
// trigger hashchange on first page load
window.dispatchEvent(new CustomEvent("hashchange"));