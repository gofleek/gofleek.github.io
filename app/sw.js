self.addEventListener('install', (e) => {
  e.waitUntil(
    caches.open('fox-store').then((cache) => cache.addAll([
      '/app/',
      '/app/index.html',
      '/app/index.js',
      '/app/style.css',
      '/app/images/fox1.jpg',
      '/app/images/fox2.jpg',
      '/app/images/fox3.jpg',
      '/app/images/fox4.jpg',
    ])),
  );
});

self.addEventListener('fetch', (e) => {
  console.log(e.request.url);
  e.respondWith(
    caches.match(e.request).then((response) => response || fetch(e.request)),
  );
});
