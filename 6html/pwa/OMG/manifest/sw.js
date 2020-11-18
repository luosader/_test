/*sw即Service Worker*/

// // sw首次被注册时候触发
// self.addEventListener('install', function(e) {
//     console.log('SW installing...');
//     console.log('only install,no cache');
// });

self.addEventListener('fetch', function(e) {
    // console.log('SW fetching...');
});