$(document).ready(function() {
    const publicKey = 'BPaFjgpGwBvYm0gHfwW9y49PQyG4TT8mAkq9DGIBCoP33CBHcul59wbf0DQcuitkNsuZV4ytv41rrvwvA5-iCU0';

    // matchMedia() 一个MediaQueryList对象在一个document上维持着一系列的媒体查询，并负责处理当媒体查询在其document上发生变化时向监听器进行通知的发送。
    let deferredPrompt,
        isPwa = (navigator.standalone || window.matchMedia('(display-mode: standalone)').matches),
        isPermission = ('Notification' in window && Notification.permission === 'granted'),//window.webkitNotifications
        logDebug = (new RegExp('debug', 'i')).test(window.location.search);

    // console.log 封装，方便后期上线的时候统一去掉
    // console.log = (function(oriLogFunc) {
    //     return function() {
    //         if (logDebug) {
    //             oriLogFunc.apply(this, arguments);
    //         }
    //     };
    // })(console.log);

    // serviceWorker 功能
    // 代码执行完成之后，我们这就注册了一个 Service Worker，它工作在 worker context，所以没有访问 DOM 的权限。在正常的页面之外运行 Service Worker 的代码来控制它们的加载。
    // 注意这里的sw作用域！！！
    if (navigator.serviceWorker != null) {
        navigator.serviceWorker.register('./sw.js', {scope: './'})//注册Service Worker
        .then(function(swReg) {
            //then() 函数链式调用我们的 promise，当 promise resolve 的时候，里面的代码就会执行。
            console.log('register sw success :', swReg.scope);
            pushSubscription(swReg);
        })
        .catch(function(err) {
            //catch() 函数，当 promise rejected 才会执行
            console.log(err.toString());
        });
    }

    // 页面的应用安装相关触发事件：未安装过和没有点击隐藏按钮
    if (!isPwa && !$.cookie('Delayed')) {
        // 应用安装横幅事件
        window.addEventListener('beforeinstallprompt', function(e) {
            $('.bot-tipsbar').slideDown(500);//滑动显示
            deferredPrompt = e;//为了实现延迟操作，存储事件的返回值，后续将异步地调用 prompt()。
            e.preventDefault();//取消默认事件
            // return false;

            // 判断用户是否安装此应用 beforeinstallprompt event fired
            // e.userChoice.then(function(choiceResult) {
            //     if (choiceResult.outcome === 'dismissed') {
            //         console.log('用户取消安装应用');
            //     } else {
            //         console.log('用户安装了应用');
            //     }
            // });
        });

        // 点击触发安装弹窗
        // app.js:168 Uncaught TypeError: Cannot read property 'prompt' of undefined  
        // 原因：1、deferredPrompt有值但不含prompt()属性； 2、程序有概率触发beforeinstallprompt事件； 3、由于程序开启了缓存，Ctrl+F5生效，F5永不生效；
        // 解决：1、清除浏览器缓存； 2、关闭sw缓存功能； 3、多刷新几次？
        $('.bot-tipsbar .bar-right a:first').click(function() {
            if (deferredPrompt != null) {
                // 异步触发横幅显示
                deferredPrompt.prompt();
                // 检测用户的安装行为
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'dismissed') {
                        console.log('用户取消安装应用');
                    } else {
                        console.log('用户安装了应用');
                        $('.bot-tipsbar').slideUp(500);//滑动隐藏
                        $('.coupon-popup').fadeIn(500);//淡出显示
                    }
                    deferredPrompt = null;
                })
                .catch((err) => {
                    console.log('install sw failed: ', err.toString());
                });
            }
        });

        // 隐藏触发框
        $('.bot-tipsbar .bar-right a:last').click(function() {
            $.cookie('Delayed', true);//使不再触发安装弹窗
            $('.bot-tipsbar').slideUp(500);//滑动隐藏
        });
    }

    // 安装统计
    function install_stat(act, act_url) {
        var cur_url = act_url;
        console.log('install stat start');
        $.ajax({
            url: '/_test/html/pwa/stat.php',//服务器地址
            type: 'GET',
            dataType: 'json',
            data: {
                'a': navigator.standalone,
                'b': window.matchMedia('(display-mode: standalone)').matches,
                'act': act,
                req_url: cur_url
            },
            async: true,
            success: function(data) {
                console.log('stat success');
            },
            error: function() {
                console.log('stat error');
            }
        });
        console.log('install stat end');
    }

    // 检查到手机是否安装某个应用
    window.addEventListener('appinstalled', (evt) => {
        console.log('a2hs installed');
        install_stat('install', window.location.href);
    });

    // 已添加到主屏快捷键
    if (isPwa) {
        // 热链接统计
        let domain = new RegExp('^http[s]?:\/\/[^.]+\.([^/]+)', 'i');
        let main = window.location.href.match(domain)[1].toLowerCase();
        $(document).on('click', 'a', function(event) {
            if (this.href && main === this.href.match(domain)[1].toLowerCase()) {
                if (event.preventDefault) {
                    event.preventDefault();
                } else {
                    window.event.returnValue = false;
                }
                window.location = this.href;
                return false;
            } else {
                return true;
            }
        });
        install_stat('open', window.location.href);

        if (!$.cookie('Hidden')) $('.coupon-popup').fadeIn(500);//淡出显示
    }

    // 将base64的applicationServerKey转换成UInt8Array，才能作为订阅方法接受的参数。
    window.urlBase64ToUint8Array = function(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);
        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    };

    // 订阅推送服务
    // https://lavas.baidu.com/pwa/engage-retain-users/how-push-works
    // applicationServerKey:应用的唯一标识，别名VAPID
    //    生成applicationServerKey的方法有两种：
    //      1.在服务端使用 web-push 生成； 
    //      2.访问https://web-push-codelab.appspot.com/快速生成
    //    此时得到的applicationServerKey是base64编码后的字符串，需要转换成UInt8Array格式，才能作为订阅方法接受的参数。
    //    另外要注意，生成applicationServerKey的同时，会同时生成与之配对的私钥，用于后续服务端请求推送服务的安全验证
    // 
    // PushManager:从第三方服务器接收消息通知的能力。
    function pushSubscription(swReg) {
        if ('PushManager' in window) {
            // subscribe(): 添加订阅
            swReg.pushManager.subscribe({
                'userVisibleOnly': true,//不允许静默的推送，所有推送都对用户可见
                'applicationServerKey': window.urlBase64ToUint8Array(publicKey)//服务器生成的公钥
            })
            .then(function(pst) {
                console.log('subscribe start');
                $.ajax({
                    url: '/_test/html/pwa/subscribe.php',//服务器地址
                    type: 'POST',
                    dataType: 'json',
                    data: JSON.stringify(pst),
                    async: true,
                    success: function(data) {
                        console.log('subscribe success');
                    },
                    error: function() {
                        console.log('subscribe error');
                    }
                });
                console.log('subscribe end');
            })
            .catch(function(err) {
                // if (Notification.permission === 'denied') {
                //     // 用户拒绝了订阅请求
                // }
                console.log('subscribe failed:', err.toString());
            });

            // // 取消订阅
            // swReg.pushManager.getSubscription().then(function (unpst) {
            //     unpst.unsubscribe().then(function(successful) {
            //         // code
            //     }).catch(function(e) {
            //         // code
            //     });
            // });
        }

        // swReg.pushManager.getSubscription().then(function(subscription) {
        //     subscription.unsubscribe().then(function(successful) {
        //         console.log('取消订阅')
        //     }).catch(function(e) {
        //     });
        // });
    }

    // Notification 授权
    // 在订阅消息之前，浏览器需要得到用户授权，同意后才能使用消息推送服务。
    window.authorize = function() {
        if ('Notification' in window && !isPermission && !$.cookie('Permission')) {
            Notification.requestPermission(function(back) {
                if (back !== 'granted') {
                    $.cookie('Permission', back);
                } else {
                    $.cookie('Permission', null);
                }
            });
        }

        // 兼容新旧版本的返回值
        // 当用户允许或者拒绝授权后，后续都不会重复询问。
        // return new Promise(function(resolve, reject) {
        //     var permissionResult = Notification.requestPermission(function(result) {
        //         resolve(result);// 旧版本
        //     });
        //     if (permissionResult) {
        //         permissionResult.then(resolve, reject);// 新版本
        //     }
        // }).then(function(permissionResult) {
        //     if (permissionResult !== 'granted') {
        //         $.cookie('Permission', permissionResult);// 用户未授权
        //     } else {
        //         $.cookie('Permission', null);
        //     }
        // });
    };

    // 订阅推送服务
    window.subscribe = function() {
        try {
            navigator.serviceWorker.ready.then(function(swReg) {
                pushSubscription(swReg);
            })
            .catch(function(err) {
                console.log(err.toString());
            });
        } catch(e) {}
    };

    (function() {
        isPermission || authorize();//授权
        if ($.cookie('Expired')) {
            subscribe(); //过期重新订阅
        }
    })();

    // 通过监听 message 事件来获取数据
    navigator.serviceWorker.addEventListener('message', function(e) {
        console.log('receive post-message from sw, action is ', e.data);
        if (e.data) {
            location.href = e.data;
        }
    });
});