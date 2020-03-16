$(document).ready(function() {

    let deferPrompt;
    let isPwa = (navigator.standalone || window.matchMedia('(display-mode: standalone)').matches);//判断PWA是否安装

    // serviceWorker 功能
    // 注意这里的sw作用域！！！
    if ('serviceWorker' in window.navigator) {
        navigator.serviceWorker.register('sw.js');
    }

    // console.log(!isPwa)
    // console.log(!$.cookie('Delayed'))
    // 未安装过和没有点击隐藏按钮
    if (!isPwa && !$.cookie('Delayed')) {
        // 应用安装横幅事件
        window.addEventListener('beforeinstallprompt', function(event) {
            $('.jq-slide').slideDown(500);//滑动显示
            event.preventDefault();//取消默认事件
            deferPrompt = event;//为了实现延迟操作，存储事件的返回值，后续将异步地调用 prompt()。
            // if (!deferPrompt || typeof(deferPrompt.prompt)!="function") {
            //     $('.jq-slide').hide();
            // }
        });

        // 点击触发安装弹窗
        $('.jq-prompt').click(function() {
            // if (deferPrompt!==null) {
            if (deferPrompt && typeof(deferPrompt.prompt)=="function") {
                deferPrompt.prompt();//异步触发横幅显示
                deferPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'dismissed') {
                        console.log('用户取消安装应用');
                    } else {
                        console.log('用户安装了应用');
                        $('.jq-slide').slideUp(500);//滑动隐藏
                        $('.jq-popup').fadeIn(500);//淡出显示
                    }
                    deferPrompt = null;
                })
                .catch((error) => {
                    console.log('install sw failed: ', error.toString());
                });
            }
        });

        // 隐藏触发框
        $('.jq-hide').click(function() {
            $.cookie('Delayed', true);//不再触发安装弹窗
            $('.jq-slide').slideUp(500);//滑动隐藏
        });
    } else {
        $('.jq-slide').hide();
    }

    // // 安装统计
    // function install_stat() {
    // }

    // 检查到是否安装某个应用
    // window.addEventListener('appinstalled', (evt) => {
    //     console.log('a2hs installed');
    //     install_stat('install', window.location.href);
    // });

    // 已安装
    if (isPwa) {
        // let domain = new RegExp('^http[s]?:\/\/[^.]+\.([^/]+)', 'i');
        // let main = window.location.href.match(domain)[1].toLowerCase();
        // $(document).on('click', 'a', function(event) {
        //     if (this.href && main === this.href.match(domain)[1].toLowerCase()) {
        //         if (event.preventDefault) {
        //             event.preventDefault();
        //         } else {
        //             window.event.returnValue = false;
        //         }
        //         window.location = this.href;
        //         return false;
        //     } else {
        //         return true;
        //     }
        // });

        // console.log($.cookie('Hidden'))
        // install_stat('open', window.location.href);
        if (!$.cookie('Hidden')) $('.jq-popup').fadeIn(500);//淡出显示
    }


});
