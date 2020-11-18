/*sw即Service Worker*/


//////////
//离线与缓存 //
//////////

/**
 * 缓存我们的静态资源文件
 * 什么？没有缓存起来？那你肯定是没有告诉浏览器刷新时候要更新你的sw.js文件。可以勾选这里(Application/update on reload)，然后再次刷新。
 */
const staticAssets = [
    './',
    './style.css',
    // './app.js'
];

// sw.js首次被注册时候触发
self.addEventListener('install', async event => {
    const cache = await caches.open('news-static');
    cache.addAll(staticAssets);
});

/**
 * 我们要拦截请求并告诉浏览器我们要使用这些缓存
 * 编写完这些之后我们可以先勾选offline按钮，之后刷新页面，发现我们的站点依然有数据。
 */
// // sw监听到fetch事件时候触发
// self.addEventListener('fetch', event => {
//     const req = event.request;
//     event.respondWith(cacheFirst(req));
// });

// // 使用浏览器缓存
// async function cacheFirst(req) {
//     const cachedResponse = await caches.match(req);
//     return cachedResponse || fetch(req);
// }

/**
 * 根据网络优先的原则修改下sw逻辑
 * 处于联网状态下，用服务器的最新数据更新我们的缓存。
 * 至此我们的案例基本上完成了，但是还是可以再次优化一下。
 * 假设用户还没有查看过我们的站点页面其他内容，也就是说我们的缓存不完整，这个时候可以提供一个mock数据提示用户等待可以联网的时候再来查看当前页面。
 *     具体文件： https://github.com/HQ-Lin/simple-pwa-project
 */
self.addEventListener('fetch', event => {
    const req = event.request;
    const url = new URL(req.url);
    
    // 当本地开发时候可以这么配置
    if (url.origin === location.origin) {
        event.respondWith(cacheFirst(req));
    } else if ((req.url.indexOf('http') !== -1)) {
        // chrome的https协议限制，接口必须满足https
        event.respondWith(networkFirst(req));
    }
});

// 缓存优先
async function cacheFirst(req) {
    const cachedResponse = await caches.match(req);
    return cachedResponse || fetch(req);
}

// 网络优先
async function networkFirst(req) {
    // 将请求到的数据缓存在id为news-dynamic中
    const cache = await caches.open('news-dynamic');
    try {
        const res = await fetch(req); // 获取数据
        cache.put(req, res.clone()); // 更新缓存
        return res;
    } catch (error) {
        return await cache.match(req); // 报错则使用缓存
    }
}

