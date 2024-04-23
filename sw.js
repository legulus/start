var CACHE_NAME = 'task-management';

var urlsToCache = [
  './home.php',
  './assets/css',
  './assets/img',
  './assets/js',
];
self.addEventListener('install', function (event) {
  event.waitUntil(
    caches
    .open(CACHE_NAME)
    .then(function (cache) {
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener('fetch', function (event) {
  event.respondWith(
    caches
    .match(event.request)
    .then(function (response) {
      return response || fetch(event.request);
    })
  );
});