const apiKey = 'fa35a325ddfa4c4798102ebb76809bbb';
const main = document.querySelector('main');
const sourceSelector = document.querySelector('#sourceSelector');
const defaultSource = 'techcrunch';

// 异步执行 页面加载后执行逻辑
window.addEventListener('load', async e => {
    updateNews();
    await updateSources();
    sourceSelector.value = defaultSource;
    sourceSelector.addEventListener('change', e => {
        updateNews(e.target.value);
    });
    
    // 判断浏览器是否支持serviceWorker
    if ('serviceWorker' in navigator) {
        try {
            // 尝试注册serviceWorker到sw.js文件中
            navigator.serviceWorker.register('sw.js');
            console.log('SW registered');
        } catch (error) {
            console.log('SW reg failed');
        }
    }
});



/**
 * 加载数据 以下是数据源处理
 * https://www.jianshu.com/p/dfd7cf757850
 * await可以认为是 async wait 的简写
 */

// 获取来源
async function updateSources() {
    // const res = await fetch(`https://newsapi.org/v2/sources?apiKey=${apiKey}`);
    const res = await fetch(`http://localhost/_test/html/pwa/push.php?act=index&apiKey=${apiKey}`);
    // console.log(res)
    // return
    const json = await res.json();//变成json数据
    console.log(json)
    // return

    // sourceSelector.innerHTML = json.sources.map(src => `<option value="${src.id}">${src.name}</option>`).join('\n');
    sourceSelector.innerHTML = json.map(src => `<option value="${src.id}">${src.name}</option>`).join('\n');
}

// 根据来源获取文章内容
async function updateNews(source = defaultSource) {
    // const res = await fetch(`https://newsapi.org/v2/top-headlines?sources=${source}&apiKey=${apiKey}`);
    const res = await fetch(`http://localhost/_test/html/pwa/push.php?id=${source}&act=detail&apiKey=${apiKey}`);
    // console.log(res)
    // return
    const json = await res.json();//转化成json的格式
    console.log(json)
    // return

    // main.innerHTML = json.articles.map(createArticle).join('\n');
    // main.innerHTML = json.map(createArticle).join('\n');
    main.innerHTML = createArticle(json);
}

// 创建文章内容
function createArticle(article) {
    return `
        <div class="article">
            <a target="_blank" href="${article.url}">
                <h2>${article.title}</h2>
            </a>
            <img src="${article.img}" />
            <p>${article.desc}</p>
        </div>
    `;
}
