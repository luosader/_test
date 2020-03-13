
this.addEventListener('install', function(e) {
  console.log('Service Worker install');
});

this.addEventListener('activate', function(e) {
  console.log('Service Worker activate');
});

// Message: 页面 => SW 
this.addEventListener('message', function(e) {
    console.log(e.data); // this message is from page
});

// Message: SW => 页面
// 最简单的方法就是从页面发送过来的消息中获取 WindowClient 实例，使用的是 event.source ，不过这种方法只能向消息的来源页面发送信息。 
this.addEventListener('message', function(e) {
    e.source.postMessage('this message is from sw.js, to page');
});

// // 如果不想受到这个限制，则可以在 serivce worker 文件中使用 this.clients 来获取其他的页面，并发送消息。
// this.clients.matchAll().then(client => {
//     console.log(client); // []
//     // client[0].postMessage('this message is from sw.js, to page');
// });

// // 使用 Message Channel 来通信
// this.addEventListener('message', function (e) {
//     console.log(e.data); // Channel is from page, to sw
//     e.ports[0].postMessage('Channel is from sw.js, to page');
// });

// self.addEventListener('fetch', function(e) {
//     // console.log('SW fetching...');
// });