const CACHE = 'igvault-mobile-page';
const CASH_LIST = ['css', 'jpg', 'png', 'jpeg', 'gif', 'svg', 'ttf', 'woff', 'eot', 'ico', 'webmanifest'];//js
let reg = new RegExp('(?:.*\\/[^\\/]+\\.(?:' + CASH_LIST.join('|') + '))', 'i');
const IGNORE = ['cloudfront', 'google'];
let ignoreReg = new RegExp('[^./]*(?:' + IGNORE.join('|') + ')[^.]*\\.', 'i');
let logDebug = false;

// console.log 封装，方便后期上线的时候统一去掉
// console.log = (function(oriLogFunc) {
//     return function() {
//         if (logDebug) {
//             oriLogFunc.apply(this, arguments);
//         }
//     };
// })(console.log);

// Service Worker 首次被注册时候触发
// 如果想要立即更新需要在新的代码中做一些处理，首先在install事件中调用self.skipWaiting()方法，然后在active事件中调用self.clients.claim()方法通知各个客户端。
self.addEventListener('install', function(e) {
    console.log('SW installing...');
    console.log('only install,no cache');
    return self.skipWaiting();
});
 
// 请求命中缓存时直接返回缓存结果，否则发起请求
// sw处于activated状态时，可以在sw.js监听fetch事件并拦截和处理任何请求
self.addEventListener('fetch', function(e) {
    console.log('SW fetching...');
    if (ignoreReg.test(e.request.url) || /sw\.js/.test(e.request.url) || (!/[/ - ] js / .test(e.request.url) && !reg.test(e.request.url))) {
        return;
    }
    console.log('cache ' + e.request.url); 
    e.respondWith(caches.match(e.request).then(function(response) {
        e.request.mode = 'no-cors';
        return response || fetch(e.request).then(function(response) {
            if (ignoreReg.test(e.request.url) || /sw\.js/.test(e.request.url) || (!/[/ - ] js / .test(e.request.url) && !reg.test(e.request.url))) {
                return;
            }
            console.log('save file:' + location.href);
            if (!response) {return; }
            return caches.open(CACHE).then(function(cache) {
                cache.delete(e.request, {
                    ignoreSearch: true
                });
                cache.put(e.request, response.clone());
                return response;
            });
        });
    }));
});

// 如果当前浏览器没有激活的service worker或者已经激活的worker被解雇，
// 新的service worker进入active事件
self.addEventListener('activate', function(e) {
    console.log('SW activating...');
    e.waitUntil(caches.keys().then(cacheNames => {
        return Promise.all(cacheNames.filter(cacheNames => {
            return cacheNames !== CACHE;
        }).map(cacheNames => {
            return caches.delete(cacheNames);
        }));
    }).then(() => {
        return self.clients.claim();
    }));
});

// 服务器推送事件
self.addEventListener('push', function(e) {
    let data = e.data;
    if (e.data) {
        data = data.json();
        if (navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) {
            new Notification(data.title, data.options);
        } else {
            // 弹出推送的通知给客户看
            self.registration.showNotification(data.title, data.options);
        }
        console.log('push success');
    } else {
        console.log('push null');
    }
});

// 推送消息对话框点击事件
self.addEventListener('notificationclick', function(e) {
    let data = e.notification.data;
    let url = data.default;
    let action = e.action || 'default';
    action = action.toLowerCase();
    if (data.hasOwnProperty(action)) {
        url = data[action];
    }
    data.action = action;
    e.notification.close();

    // 执行某些异步操作，等待它完成
    // clients.matchAll 方法来遍历打开的（属于自己域的）窗口。
    e.waitUntil(self.clients.matchAll().then(function(clients) {
        // 打开某个URL clients.openWindow()
        if (!clients || clients.length === 0) {
            self.clients.openWindow && self.clients.openWindow(url);
            return;
        }
        clients[0].focus && clients[0].focus();
        clients.forEach(function(client) {
            client.postMessage(url);//向页面发送数据
        });
    }));
});

// 推送消息对话框关闭事件
self.addEventListener('notificationclose', function(e) {
    console.log('Hi there! notification close!');
});