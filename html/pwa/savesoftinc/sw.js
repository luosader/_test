/**
 * Welcome to your Workbox-powered service worker!
 *
 * You'll need to register this file in your web app and you should
 * disable HTTP caching for this file too.
 * See https://goo.gl/nhQhGp
 *
 * The rest of the code is auto-generated. Please don't update this file
 * directly; instead, make changes to your Workbox build configuration
 * and re-run your build process.
 * See https://goo.gl/2aRDsh
 */

importScripts("https://storage.googleapis.com/workbox-cdn/releases/3.2.0/workbox-sw.js");

workbox.skipWaiting();
workbox.clientsClaim();

/**
 * The workboxSW.precacheAndRoute() method efficiently caches and responds to
 * requests for URLs in the manifest.
 * See https://goo.gl/S9QRab
 */
self.__precacheManifest = [
  {
    "url": "404.html",
    "revision": "f47fd3625c62e632a89ef575d3eeed23"
  },
  {
    "url": "aboutus.html",
    "revision": "3635e77adcd54c1c122cb7fc77cbc3e7"
  },
  {
    "url": "android-icon-144x144.png",
    "revision": "13f0303b01469b080de03e692635738b"
  },
  {
    "url": "android-icon-192x192.png",
    "revision": "da2591ce4e806ef2e5b3b2dfa5069957"
  },
  {
    "url": "android-icon-36x36.png",
    "revision": "8b29ac14208f4647f897d3ec93ac0169"
  },
  {
    "url": "android-icon-48x48.png",
    "revision": "918629b3d28ec9be9e472dd8681c6dbe"
  },
  {
    "url": "android-icon-72x72.png",
    "revision": "ec614a62527b86d4105823c50a5f4c20"
  },
  {
    "url": "android-icon-96x96.png",
    "revision": "bf5df684f70eb96119e82de674541a58"
  },
  {
    "url": "apple-icon-114x114.png",
    "revision": "37765ae750d3153d159f7ae268326f6b"
  },
  {
    "url": "apple-icon-120x120.png",
    "revision": "1b848f6bc6304cab21068f1f32fc2921"
  },
  {
    "url": "apple-icon-144x144.png",
    "revision": "13f0303b01469b080de03e692635738b"
  },
  {
    "url": "apple-icon-152x152.png",
    "revision": "c3687dc328ecb484b611f584c0c6695c"
  },
  {
    "url": "apple-icon-180x180.png",
    "revision": "a0d3dcb93962439a9eb257955b0b4f24"
  },
  {
    "url": "apple-icon-57x57.png",
    "revision": "d222c6d1d9ea23865c171236a4ac8e57"
  },
  {
    "url": "apple-icon-60x60.png",
    "revision": "a645b0c44e0afdc2696b37266855df6e"
  },
  {
    "url": "apple-icon-72x72.png",
    "revision": "ec614a62527b86d4105823c50a5f4c20"
  },
  {
    "url": "apple-icon-76x76.png",
    "revision": "a61aa1a53eadb0bf4e150c301976b665"
  },
  {
    "url": "apple-icon-precomposed.png",
    "revision": "9a3e48dcfc20c873667673dfda0dab37"
  },
  {
    "url": "apple-icon.png",
    "revision": "9a3e48dcfc20c873667673dfda0dab37"
  },
  {
    "url": "careers-blue.html",
    "revision": "1e420e6e81a930268ea863e6b27bdd53"
  },
  {
    "url": "careers.html",
    "revision": "22bc8fae83d6f05055de00e439f91c2d"
  },
  {
    "url": "contact.html",
    "revision": "eb58c1541bfb027e4be35af3c7f92841"
  },
  {
    "url": "css/~main.css",
    "revision": "88823c86669cfaf2fa4383485b43026a"
  },
  {
    "url": "css/~style.css",
    "revision": "7150bb51f28b1548d1fa487c5c9a2ed5"
  },
  {
    "url": "css/animate.css",
    "revision": "aa232bb8d1ade654deec66f3ec2a2069"
  },
  {
    "url": "css/blue.css",
    "revision": "ce9da914d3c7556a450ea78f2052a1bb"
  },
  {
    "url": "css/bootstrap-responsive.css",
    "revision": "6810293e9551fecf7b531e05112e6f00"
  },
  {
    "url": "css/bootstrap.css",
    "revision": "559eb91d8f9a4103f9a00175850b80c4"
  },
  {
    "url": "css/boxed.css",
    "revision": "f15774be8cc7dcb40e398c546663a323"
  },
  {
    "url": "css/colors/aqua.css",
    "revision": "a4e57f4d06a68c06479bbbfdf639965b"
  },
  {
    "url": "css/colors/blue.css",
    "revision": "ce9da914d3c7556a450ea78f2052a1bb"
  },
  {
    "url": "css/colors/green-b.css",
    "revision": "ef7e73beb9f6e23bb9a7afed5a835b43"
  },
  {
    "url": "css/colors/green.css",
    "revision": "12803d94a1a4c55a3c195837e480792a"
  },
  {
    "url": "css/colors/grey.css",
    "revision": "faa1121580ebea18a3763124e912b7b4"
  },
  {
    "url": "css/colors/lime.css",
    "revision": "28b6a4f83d9a9d4cc5f3d06b45caae03"
  },
  {
    "url": "css/colors/orange.css",
    "revision": "7e26b72a937cade4f8c34638028bcb32"
  },
  {
    "url": "css/colors/pink.css",
    "revision": "c9fc325c4897bcd33b36a7543a3b6890"
  },
  {
    "url": "css/colors/purple.css",
    "revision": "243f7ecc0b0a6faff491947e053fe83e"
  },
  {
    "url": "css/colors/red.css",
    "revision": "393f7926ad3368365231984fcbccf459"
  },
  {
    "url": "css/colors/savesoft.css",
    "revision": "cc47a3b454ab41bf1ab87da516c330d0"
  },
  {
    "url": "css/colors/yellow.css",
    "revision": "af1e6a2761fcf5ff5941cf82c5f5af4a"
  },
  {
    "url": "css/flexslider.css",
    "revision": "e5352c5d5e5a8890bbc5d8798421f933"
  },
  {
    "url": "css/ie.css",
    "revision": "a3f4ba5d024034bd42d075a20b81a23f"
  },
  {
    "url": "css/main.css",
    "revision": "5dfa1c696a34599a4c1ba825acd649d5"
  },
  {
    "url": "css/one-page.css",
    "revision": "41dec33e8d21318a042508778431ae38"
  },
  {
    "url": "css/prettyPhoto.css",
    "revision": "a1bce4f44ca22f4db69c014e886de890"
  },
  {
    "url": "css/responsiveslides.css",
    "revision": "e573a2d86ed2f07696c25132c2771496"
  },
  {
    "url": "css/rev-settings.css",
    "revision": "54100d4b5cfab1e65a2bed8acd23c312"
  },
  {
    "url": "css/style.css",
    "revision": "c1e598dc0fdd1969997c3c6931d9ec38"
  },
  {
    "url": "css/switcher.css",
    "revision": "e41d71ea447c3d029e2001bd7a855a8c"
  },
  {
    "url": "css/wide-screen.css",
    "revision": "16e475932ee0ab80e18d2dfed1dbf1e8"
  },
  {
    "url": "css/wide.css",
    "revision": "ce37fb8702d5d5ba84d5e8bc2fc78c13"
  },
  {
    "url": "favicon-16x16.png",
    "revision": "801dec85e681287569e6dbbb272c15ff"
  },
  {
    "url": "favicon-32x32.png",
    "revision": "2922efe46fcd213cd5fe56f464072a3c"
  },
  {
    "url": "favicon-96x96.png",
    "revision": "bf5df684f70eb96119e82de674541a58"
  },
  {
    "url": "font-awesome/css/font-awesome-ie7.css",
    "revision": "2984ce7c2ee292a2a6ef882ca55c4264"
  },
  {
    "url": "font-awesome/css/font-awesome-ie7.min.css",
    "revision": "4efc20143a3957f447ceeaa53695ceb6"
  },
  {
    "url": "font-awesome/css/font-awesome.css",
    "revision": "192636ca135bd99a933dfe3ab57cc854"
  },
  {
    "url": "font-awesome/css/font-awesome.min.css",
    "revision": "7fbe76cdac6093784895bb4989203e5a"
  },
  {
    "url": "font-awesome/font/fontawesome-webfont.svg",
    "revision": "f99a231ed57ee113b50b1c3e9f9fcdc3"
  },
  {
    "url": "google94d3ce6f62ae6860.html",
    "revision": "94de3f68f47595e802fe1c27a9df1c72"
  },
  {
    "url": "googlee023d17b91012c5a.html",
    "revision": "b61a5c07af1f4d2fcfcd305f0c4d797c"
  },
  {
    "url": "images-slider/bootstrap.png",
    "revision": "c479393c0e6468bf350aecd0b8726cd8"
  },
  {
    "url": "images-slider/careers.png",
    "revision": "6cdb7c4a113b8b056264e41ec64c9c50"
  },
  {
    "url": "images-slider/clean.png",
    "revision": "9a6df1acac88a0d4c2f5a805829313dc"
  },
  {
    "url": "images-slider/commitment.png",
    "revision": "4c6cca8125eefcc32162fe284dccfee1"
  },
  {
    "url": "images-slider/dedication.png",
    "revision": "d8761ddecf1e9a1511501267bcaa0f72"
  },
  {
    "url": "images-slider/fresh.png",
    "revision": "b8314f5dcf6af6fc6e663633b7dd187a"
  },
  {
    "url": "images-slider/guy-shadow.png",
    "revision": "33e5ddcd0f60566fb3960092b0698055"
  },
  {
    "url": "images-slider/guy.png",
    "revision": "bc8b4b0d68a7585bcc9e2c10c29ff9b3"
  },
  {
    "url": "images-slider/imac.png",
    "revision": "55dc6b26951fd4902cadf9535a55fa7e"
  },
  {
    "url": "images-slider/inspira.png",
    "revision": "66aecde59ae3eb5a15426a83c5b0a342"
  },
  {
    "url": "images-slider/it-solutions.png",
    "revision": "40f4ee8c1081eca56079f9c0fbd13e84"
  },
  {
    "url": "images-slider/lb.png",
    "revision": "54bbab2f6359779dfac09d922b423d18"
  },
  {
    "url": "images-slider/lightweight.png",
    "revision": "598edb14eabc63c299f7a71402cb1877"
  },
  {
    "url": "images-slider/lm.png",
    "revision": "97d912d3f0300a24bc6f2b497378e99d"
  },
  {
    "url": "images-slider/lu.png",
    "revision": "63bbfa6b3a8f6676be7f546513057322"
  },
  {
    "url": "images-slider/macbook.png",
    "revision": "d7e4ffff745e91b35f3a0eda54c546f3"
  },
  {
    "url": "images-slider/online-training.png",
    "revision": "621de4b3638f10f3f62b611a3d3fe147"
  },
  {
    "url": "images-slider/our-features.png",
    "revision": "aa66e5c5584bce32f4da34cf3b51b646"
  },
  {
    "url": "images-slider/quality.png",
    "revision": "e81c3b92d069b824dcb20f7201e8923f"
  },
  {
    "url": "images-slider/rb.png",
    "revision": "c54a25c900c2c72a69a1a8bdd8170781"
  },
  {
    "url": "images-slider/responsive.png",
    "revision": "781dd1daa8579b4cc6644cadd64645ce"
  },
  {
    "url": "images-slider/rm.png",
    "revision": "8832aaab27fbf6626be4e913a925c244"
  },
  {
    "url": "images-slider/ru.png",
    "revision": "4e301e862eaeb1b9d5958c1d247dd7ee"
  },
  {
    "url": "images-slider/savesoft.png",
    "revision": "f0c1e26b89e42cb59396defa47a8dbf0"
  },
  {
    "url": "images-slider/slider-10.png",
    "revision": "96d6434acf108255f2b12ff63c3b9cdb"
  },
  {
    "url": "images-slider/solid.png",
    "revision": "747806bc99df75fc1b1ef832c93e5b43"
  },
  {
    "url": "images-slider/spotlight.png",
    "revision": "daf4ace39a38e352062f0db07537778c"
  },
  {
    "url": "images-slider/spotlight2.png",
    "revision": "8b42f95a5d7cd24e661359da87af4e6e"
  },
  {
    "url": "images-slider/testimonial-bg.jpg",
    "revision": "dfd855d1b5ed9ced51219e91040d8c7f"
  },
  {
    "url": "images-slider/wide1-grey.jpg",
    "revision": "9a9c308851493db117f5be30e32bac4f"
  },
  {
    "url": "images-slider/wide1.jpg",
    "revision": "30dc3fb588513428f71a72e4999bb0ba"
  },
  {
    "url": "images-slider/wide2.jpg",
    "revision": "987648b0312c0bd0366925a00978e012"
  },
  {
    "url": "images-slider/wide3.jpg",
    "revision": "8ec89d9fd36aa4309e6482b0b9c9d387"
  },
  {
    "url": "images-slider/wide4.jpg",
    "revision": "e991b7432b99014b56f1296ef50d5d13"
  },
  {
    "url": "images-slider/wide5.jpg",
    "revision": "8338b281579d8d50a17452a70df9d084"
  },
  {
    "url": "images/arrow-4.png",
    "revision": "ae727f3405fe80251e4bf7ad7aad5c47"
  },
  {
    "url": "images/arrow-nav.png",
    "revision": "1d9ffc682ae3d375d00a2b5f055d6f3f"
  },
  {
    "url": "images/arrows-1.png",
    "revision": "59f4a6b6029add4d2887c91eb452597e"
  },
  {
    "url": "images/avatar.jpg",
    "revision": "c4496ae3790bfb2f4aecd94b88ef5d9e"
  },
  {
    "url": "images/banner-aboutus.jpg",
    "revision": "26fff12748e78cb25fd712a5440feddb"
  },
  {
    "url": "images/banner-career.jpg",
    "revision": "4a5dc01267b448c9d77647bdc6196a0d"
  },
  {
    "url": "images/banner-services.jpg",
    "revision": "d9bd8a56a509d2b5464ca334023fc20c"
  },
  {
    "url": "images/blank.png",
    "revision": "8ab38083c10ef0c17df0bb4cbfa570b7"
  },
  {
    "url": "images/dot-black.png",
    "revision": "1bbaa8507700e158311e6d08b4eee926"
  },
  {
    "url": "images/dot.png",
    "revision": "f88a91f2575e7b5afd76bf951f8a3fac"
  },
  {
    "url": "images/icon-plus.png",
    "revision": "08ab0fdd2e952bebfe19c1892ee682d8"
  },
  {
    "url": "images/icon-url.png",
    "revision": "fc7d8d2f463d9cec3ab1bcc15eb80344"
  },
  {
    "url": "images/icon-zoom.png",
    "revision": "34c1fe4b9320b9dc96fdb84a106a02e0"
  },
  {
    "url": "images/logo-bk.png",
    "revision": "503d42d3472b15c4fae0ba24838251b9"
  },
  {
    "url": "images/logo-e.png",
    "revision": "e8d63a42b21b33fb65dbf31857368e4e"
  },
  {
    "url": "images/logo-small.png",
    "revision": "936ff98efe2dbca3bd3f5b3c7fa0e87a"
  },
  {
    "url": "images/logo.png",
    "revision": "9974b65ceaccda664252dd35d994510c"
  },
  {
    "url": "images/news-small-1.jpg",
    "revision": "43b884e67335017ed81c870b8e9a3122"
  },
  {
    "url": "images/news-small-2.jpg",
    "revision": "28188447d298a2e107ccf6868e93669e"
  },
  {
    "url": "images/news-small-3.jpg",
    "revision": "e4597e6e38b6c5f4419ae9ffcf8582de"
  },
  {
    "url": "images/prettyPhoto/default/default_thumb.png",
    "revision": "8a3e7c798030574d519d3d167a5e6d5d"
  },
  {
    "url": "images/prettyPhoto/default/sprite_next.png",
    "revision": "b903c8c15dff677b7b3dfd042fe8d860"
  },
  {
    "url": "images/prettyPhoto/default/sprite_prev.png",
    "revision": "bf55ea7dede2004166dc4024c5b5528c"
  },
  {
    "url": "images/prettyPhoto/default/sprite_x.png",
    "revision": "26b97559a5225bf3cc3e1634950bcb84"
  },
  {
    "url": "images/prettyPhoto/default/sprite_y.png",
    "revision": "096e04fbfb474c46cf17a9a878b3d221"
  },
  {
    "url": "images/prettyPhoto/default/sprite.png",
    "revision": "f814686dca4830164d3f8d2c949b42cf"
  },
  {
    "url": "images/slider-pic-1.png",
    "revision": "f7153f71afcddeedac664bf16b48c577"
  },
  {
    "url": "images/social-icons/24x24/facebook.png",
    "revision": "80998ecee4a427eaffbf23908dac49ba"
  },
  {
    "url": "images/social-icons/24x24/linkedin.png",
    "revision": "b5f824ad0e97def124d02656e70475c0"
  },
  {
    "url": "images/social-icons/24x24/twitter.png",
    "revision": "9eb57e877b503401bdd43b4585db376a"
  },
  {
    "url": "images/social-icons/facebook.png",
    "revision": "0605d27acc2e7f1d2365a71e8634f235"
  },
  {
    "url": "images/social-icons/linkedin.png",
    "revision": "6de60c796c9183dcc649be59971dd05a"
  },
  {
    "url": "images/social-icons/twitter.png",
    "revision": "b058a01a295eb853aaae10da7a9f5aa7"
  },
  {
    "url": "images/testi-default.jpg",
    "revision": "c9f333f50e7dff53a46895bb3d4b8bfd"
  },
  {
    "url": "images/text-pic-1.png",
    "revision": "2f97bf7194649d613ff7206b908bd65b"
  },
  {
    "url": "images/text-pic-2.png",
    "revision": "92d488dad1a9fb0de65452965a6b2b9c"
  },
  {
    "url": "images/text-pic-3.png",
    "revision": "24f95e378e09c80af6b65f8169b88a74"
  },
  {
    "url": "images/text-pic-4.png",
    "revision": "463d6b8b5ed64dcfd7193238f4bd67cf"
  },
  {
    "url": "images/training.jpg",
    "revision": "437ca597841a3709764268959bfaf9e3"
  },
  {
    "url": "images/ui.totop.png",
    "revision": "b49a69215294243d43bbc7fb5876ed9d"
  },
  {
    "url": "index.html",
    "revision": "28c2d8ccc99fea696b7fad1904db7021"
  },
  {
    "url": "ms-icon-144x144.png",
    "revision": "13f0303b01469b080de03e692635738b"
  },
  {
    "url": "ms-icon-150x150.png",
    "revision": "db0c630c166b859f0bf502156fd7b80b"
  },
  {
    "url": "ms-icon-310x310.png",
    "revision": "eae9f3d399e73923ce792e03687baae1"
  },
  {
    "url": "ms-icon-70x70.png",
    "revision": "d972f521c83faefba58000e7820df816"
  },
  {
    "url": "rs-plugin/assets/arrow_large_left.png",
    "revision": "6645e864642da518fb40d275437aa31a"
  },
  {
    "url": "rs-plugin/assets/arrow_large_right.png",
    "revision": "421c7c6749ea6894aa308405fe38f329"
  },
  {
    "url": "rs-plugin/assets/arrow_left.png",
    "revision": "56458574dfbdc004d385499c968c516b"
  },
  {
    "url": "rs-plugin/assets/arrow_left2.png",
    "revision": "904f4a773b15b429b665a6c6e79ff104"
  },
  {
    "url": "rs-plugin/assets/arrow_right.png",
    "revision": "528f50a273ef6fa047f7376ca321d6d7"
  },
  {
    "url": "rs-plugin/assets/arrow_right2.png",
    "revision": "81d17d06ca481b690b3a116ba7a7f25b"
  },
  {
    "url": "rs-plugin/assets/arrowleft.png",
    "revision": "1601a090cc9c29f61903040cbff16f9b"
  },
  {
    "url": "rs-plugin/assets/arrowright.png",
    "revision": "3036bdfc70e00499e5da821030e61b14"
  },
  {
    "url": "rs-plugin/assets/black50.png",
    "revision": "0a014a0a50f77c151de01a99b0c8d398"
  },
  {
    "url": "rs-plugin/assets/boxed_bgtile.png",
    "revision": "9ee6f56fe8ba89e63b6dc4a4d3245473"
  },
  {
    "url": "rs-plugin/assets/bullet_boxed.png",
    "revision": "aba529a3d7abb00e184b48d68edc02e4"
  },
  {
    "url": "rs-plugin/assets/bullet.png",
    "revision": "1d9b619191601f6dee14cf5d6e302c49"
  },
  {
    "url": "rs-plugin/assets/bullets.png",
    "revision": "a5045ded13f7bdafb40f39718882fe92"
  },
  {
    "url": "rs-plugin/assets/bullets2.png",
    "revision": "6087c55f214de2265a108c0178c74525"
  },
  {
    "url": "rs-plugin/assets/coloredbg.png",
    "revision": "397e5bd80bc0fe4e18c1837deead5e72"
  },
  {
    "url": "rs-plugin/assets/grain.png",
    "revision": "1df4c242d561c670bcc716870f9ab87b"
  },
  {
    "url": "rs-plugin/assets/large_left.png",
    "revision": "c7d7eee3ae27c6eea078e5b6c30c8763"
  },
  {
    "url": "rs-plugin/assets/large_right.png",
    "revision": "21c9f3380e28a14fe7461d3c6ef29f64"
  },
  {
    "url": "rs-plugin/assets/navigdots_bgtile.png",
    "revision": "d1c9f9a753be6aa09135d6b077b6bed4"
  },
  {
    "url": "rs-plugin/assets/navigdots.png",
    "revision": "5abba4696745986d3c69eff14fe5332d"
  },
  {
    "url": "rs-plugin/assets/shadow1.png",
    "revision": "e32b622cc793ecd8ae2df266efd7835a"
  },
  {
    "url": "rs-plugin/assets/shadow2.png",
    "revision": "4b3c40d070971a9b27d933e26b56f422"
  },
  {
    "url": "rs-plugin/assets/shadow3.png",
    "revision": "2132557fd6d693dc0f0277841fc1bad8"
  },
  {
    "url": "rs-plugin/assets/small_left_boxed.png",
    "revision": "f750ed4e89c4391ba1fb5d532a441467"
  },
  {
    "url": "rs-plugin/assets/small_left.png",
    "revision": "c58c78835c983ece519fa2354419cdc7"
  },
  {
    "url": "rs-plugin/assets/small_right_boxed.png",
    "revision": "1609b70a465389bfe1944d108d55354c"
  },
  {
    "url": "rs-plugin/assets/small_right.png",
    "revision": "234c53e8bfca8b621dc83c0323dc38f5"
  },
  {
    "url": "rs-plugin/assets/timer.png",
    "revision": "ba593bd9fc9e07110f3dc74f728b3768"
  },
  {
    "url": "rs-plugin/assets/timerdot.png",
    "revision": "390a994e9945f467a33ed9c2ab02126b"
  },
  {
    "url": "rs-plugin/assets/transparent.jpg",
    "revision": "391ded01873db90453e899775f910f8c"
  },
  {
    "url": "rs-plugin/assets/white50.png",
    "revision": "294e11af4ace946721a5057b1de4200e"
  },
  {
    "url": "rs-plugin/css/settings-ie8.css",
    "revision": "46f6d9725322bb9974b38aca818689d2"
  },
  {
    "url": "rs-plugin/css/settings.css",
    "revision": "c23fc442aa3e1e35cfe71f51f0a1b070"
  },
  {
    "url": "rs-plugin/images/decor_inside_white.png",
    "revision": "f42a88c868fc5027480586b1bb642bb4"
  },
  {
    "url": "rs-plugin/images/decor_inside.png",
    "revision": "74608639d92a506a161319a39aad610a"
  },
  {
    "url": "rs-plugin/images/decor_testimonial.png",
    "revision": "b6b065305de3fe07df422843bca5381d"
  },
  {
    "url": "rs-plugin/images/gradient/g30.png",
    "revision": "4912786eaa91c5f7b19d591426bb2ddd"
  },
  {
    "url": "rs-plugin/images/gradient/g40.png",
    "revision": "ba8a54d683f09cb9f43c3c35294fd602"
  },
  {
    "url": "rs-plugin/videojs/font/vjs.svg",
    "revision": "585ded817aa9d33d11ce7455f762902e"
  },
  {
    "url": "rs-plugin/videojs/video-js.min.css",
    "revision": "9940af761e99f0e87f2a909542fc085b"
  },
  {
    "url": "rs-plugin/videojs/video-js.png",
    "revision": "cdd687b3953d710c4b00ac12a7d788c4"
  },
  {
    "url": "savesoft_pwa/404.html",
    "revision": "c7b99211e16af3149f05bb9f24a37acc"
  },
  {
    "url": "savesoft_pwa/aboutus.html",
    "revision": "1e3ab29944c94ced5be120e4d0270bbe"
  },
  {
    "url": "savesoft_pwa/android-icon-144x144.png",
    "revision": "13f0303b01469b080de03e692635738b"
  },
  {
    "url": "savesoft_pwa/android-icon-192x192.png",
    "revision": "da2591ce4e806ef2e5b3b2dfa5069957"
  },
  {
    "url": "savesoft_pwa/android-icon-36x36.png",
    "revision": "8b29ac14208f4647f897d3ec93ac0169"
  },
  {
    "url": "savesoft_pwa/android-icon-48x48.png",
    "revision": "918629b3d28ec9be9e472dd8681c6dbe"
  },
  {
    "url": "savesoft_pwa/android-icon-72x72.png",
    "revision": "ec614a62527b86d4105823c50a5f4c20"
  },
  {
    "url": "savesoft_pwa/android-icon-96x96.png",
    "revision": "bf5df684f70eb96119e82de674541a58"
  },
  {
    "url": "savesoft_pwa/apple-icon-114x114.png",
    "revision": "37765ae750d3153d159f7ae268326f6b"
  },
  {
    "url": "savesoft_pwa/apple-icon-120x120.png",
    "revision": "1b848f6bc6304cab21068f1f32fc2921"
  },
  {
    "url": "savesoft_pwa/apple-icon-144x144.png",
    "revision": "13f0303b01469b080de03e692635738b"
  },
  {
    "url": "savesoft_pwa/apple-icon-152x152.png",
    "revision": "c3687dc328ecb484b611f584c0c6695c"
  },
  {
    "url": "savesoft_pwa/apple-icon-180x180.png",
    "revision": "a0d3dcb93962439a9eb257955b0b4f24"
  },
  {
    "url": "savesoft_pwa/apple-icon-57x57.png",
    "revision": "d222c6d1d9ea23865c171236a4ac8e57"
  },
  {
    "url": "savesoft_pwa/apple-icon-60x60.png",
    "revision": "a645b0c44e0afdc2696b37266855df6e"
  },
  {
    "url": "savesoft_pwa/apple-icon-72x72.png",
    "revision": "ec614a62527b86d4105823c50a5f4c20"
  },
  {
    "url": "savesoft_pwa/apple-icon-76x76.png",
    "revision": "a61aa1a53eadb0bf4e150c301976b665"
  },
  {
    "url": "savesoft_pwa/apple-icon-precomposed.png",
    "revision": "9a3e48dcfc20c873667673dfda0dab37"
  },
  {
    "url": "savesoft_pwa/apple-icon.png",
    "revision": "9a3e48dcfc20c873667673dfda0dab37"
  },
  {
    "url": "savesoft_pwa/careers-blue.html",
    "revision": "ac664908d687ba634dd8fca4b939455e"
  },
  {
    "url": "savesoft_pwa/careers.html",
    "revision": "fced479942d13bb998d933486e6a9080"
  },
  {
    "url": "savesoft_pwa/contact.html",
    "revision": "3675f27fb03c21aaf57f0cf819ecad74"
  },
  {
    "url": "savesoft_pwa/css/animate.css",
    "revision": "aa232bb8d1ade654deec66f3ec2a2069"
  },
  {
    "url": "savesoft_pwa/css/bootstrap-responsive.css",
    "revision": "6810293e9551fecf7b531e05112e6f00"
  },
  {
    "url": "savesoft_pwa/css/bootstrap.css",
    "revision": "559eb91d8f9a4103f9a00175850b80c4"
  },
  {
    "url": "savesoft_pwa/css/boxed.css",
    "revision": "f15774be8cc7dcb40e398c546663a323"
  },
  {
    "url": "savesoft_pwa/css/colors/blue.css",
    "revision": "ce9da914d3c7556a450ea78f2052a1bb"
  },
  {
    "url": "savesoft_pwa/css/flexslider.css",
    "revision": "e5352c5d5e5a8890bbc5d8798421f933"
  },
  {
    "url": "savesoft_pwa/css/ie.css",
    "revision": "a3f4ba5d024034bd42d075a20b81a23f"
  },
  {
    "url": "savesoft_pwa/css/main.css",
    "revision": "5dfa1c696a34599a4c1ba825acd649d5"
  },
  {
    "url": "savesoft_pwa/css/one-page.css",
    "revision": "41dec33e8d21318a042508778431ae38"
  },
  {
    "url": "savesoft_pwa/css/prettyPhoto.css",
    "revision": "a1bce4f44ca22f4db69c014e886de890"
  },
  {
    "url": "savesoft_pwa/css/responsiveslides.css",
    "revision": "e573a2d86ed2f07696c25132c2771496"
  },
  {
    "url": "savesoft_pwa/css/rev-settings.css",
    "revision": "54100d4b5cfab1e65a2bed8acd23c312"
  },
  {
    "url": "savesoft_pwa/css/style.css",
    "revision": "12d497d72bfd87bf6cd3b421017c8e52"
  },
  {
    "url": "savesoft_pwa/css/switcher.css",
    "revision": "e41d71ea447c3d029e2001bd7a855a8c"
  },
  {
    "url": "savesoft_pwa/css/wide-screen.css",
    "revision": "16e475932ee0ab80e18d2dfed1dbf1e8"
  },
  {
    "url": "savesoft_pwa/css/wide.css",
    "revision": "ce37fb8702d5d5ba84d5e8bc2fc78c13"
  },
  {
    "url": "savesoft_pwa/favicon-16x16.png",
    "revision": "801dec85e681287569e6dbbb272c15ff"
  },
  {
    "url": "savesoft_pwa/favicon-32x32.png",
    "revision": "2922efe46fcd213cd5fe56f464072a3c"
  },
  {
    "url": "savesoft_pwa/favicon-96x96.png",
    "revision": "bf5df684f70eb96119e82de674541a58"
  },
  {
    "url": "savesoft_pwa/filenotfound.html",
    "revision": "1e074af84956f42d4cce309dae89e210"
  },
  {
    "url": "savesoft_pwa/images-slider/bootstrap.png",
    "revision": "c479393c0e6468bf350aecd0b8726cd8"
  },
  {
    "url": "savesoft_pwa/images-slider/careers.png",
    "revision": "6cdb7c4a113b8b056264e41ec64c9c50"
  },
  {
    "url": "savesoft_pwa/images-slider/clean.png",
    "revision": "9a6df1acac88a0d4c2f5a805829313dc"
  },
  {
    "url": "savesoft_pwa/images-slider/commitment.png",
    "revision": "4c6cca8125eefcc32162fe284dccfee1"
  },
  {
    "url": "savesoft_pwa/images-slider/dedication.png",
    "revision": "d8761ddecf1e9a1511501267bcaa0f72"
  },
  {
    "url": "savesoft_pwa/images-slider/fresh.png",
    "revision": "b8314f5dcf6af6fc6e663633b7dd187a"
  },
  {
    "url": "savesoft_pwa/images-slider/guy-shadow.png",
    "revision": "33e5ddcd0f60566fb3960092b0698055"
  },
  {
    "url": "savesoft_pwa/images-slider/guy.png",
    "revision": "bc8b4b0d68a7585bcc9e2c10c29ff9b3"
  },
  {
    "url": "savesoft_pwa/images-slider/imac.png",
    "revision": "55dc6b26951fd4902cadf9535a55fa7e"
  },
  {
    "url": "savesoft_pwa/images-slider/inspira.png",
    "revision": "66aecde59ae3eb5a15426a83c5b0a342"
  },
  {
    "url": "savesoft_pwa/images-slider/it-solutions.png",
    "revision": "40f4ee8c1081eca56079f9c0fbd13e84"
  },
  {
    "url": "savesoft_pwa/images-slider/lb.png",
    "revision": "54bbab2f6359779dfac09d922b423d18"
  },
  {
    "url": "savesoft_pwa/images-slider/lightweight.png",
    "revision": "598edb14eabc63c299f7a71402cb1877"
  },
  {
    "url": "savesoft_pwa/images-slider/lm.png",
    "revision": "97d912d3f0300a24bc6f2b497378e99d"
  },
  {
    "url": "savesoft_pwa/images-slider/lu.png",
    "revision": "63bbfa6b3a8f6676be7f546513057322"
  },
  {
    "url": "savesoft_pwa/images-slider/macbook.png",
    "revision": "d7e4ffff745e91b35f3a0eda54c546f3"
  },
  {
    "url": "savesoft_pwa/images-slider/online-training.png",
    "revision": "621de4b3638f10f3f62b611a3d3fe147"
  },
  {
    "url": "savesoft_pwa/images-slider/our-features.png",
    "revision": "aa66e5c5584bce32f4da34cf3b51b646"
  },
  {
    "url": "savesoft_pwa/images-slider/quality.png",
    "revision": "e81c3b92d069b824dcb20f7201e8923f"
  },
  {
    "url": "savesoft_pwa/images-slider/rb.png",
    "revision": "c54a25c900c2c72a69a1a8bdd8170781"
  },
  {
    "url": "savesoft_pwa/images-slider/responsive.png",
    "revision": "781dd1daa8579b4cc6644cadd64645ce"
  },
  {
    "url": "savesoft_pwa/images-slider/rm.png",
    "revision": "8832aaab27fbf6626be4e913a925c244"
  },
  {
    "url": "savesoft_pwa/images-slider/ru.png",
    "revision": "4e301e862eaeb1b9d5958c1d247dd7ee"
  },
  {
    "url": "savesoft_pwa/images-slider/savesoft.png",
    "revision": "f0c1e26b89e42cb59396defa47a8dbf0"
  },
  {
    "url": "savesoft_pwa/images-slider/slider-10.png",
    "revision": "96d6434acf108255f2b12ff63c3b9cdb"
  },
  {
    "url": "savesoft_pwa/images-slider/solid.png",
    "revision": "747806bc99df75fc1b1ef832c93e5b43"
  },
  {
    "url": "savesoft_pwa/images-slider/spotlight.png",
    "revision": "daf4ace39a38e352062f0db07537778c"
  },
  {
    "url": "savesoft_pwa/images-slider/spotlight2.png",
    "revision": "8b42f95a5d7cd24e661359da87af4e6e"
  },
  {
    "url": "savesoft_pwa/images-slider/testimonial-bg.jpg",
    "revision": "dfd855d1b5ed9ced51219e91040d8c7f"
  },
  {
    "url": "savesoft_pwa/images-slider/wide1-grey.jpg",
    "revision": "9a9c308851493db117f5be30e32bac4f"
  },
  {
    "url": "savesoft_pwa/images-slider/wide1.jpg",
    "revision": "30dc3fb588513428f71a72e4999bb0ba"
  },
  {
    "url": "savesoft_pwa/images-slider/wide2.jpg",
    "revision": "987648b0312c0bd0366925a00978e012"
  },
  {
    "url": "savesoft_pwa/images-slider/wide3.jpg",
    "revision": "8ec89d9fd36aa4309e6482b0b9c9d387"
  },
  {
    "url": "savesoft_pwa/images-slider/wide4.jpg",
    "revision": "e991b7432b99014b56f1296ef50d5d13"
  },
  {
    "url": "savesoft_pwa/images-slider/wide5.jpg",
    "revision": "8338b281579d8d50a17452a70df9d084"
  },
  {
    "url": "savesoft_pwa/images/arrow-4.png",
    "revision": "ae727f3405fe80251e4bf7ad7aad5c47"
  },
  {
    "url": "savesoft_pwa/images/arrow-nav.png",
    "revision": "1d9ffc682ae3d375d00a2b5f055d6f3f"
  },
  {
    "url": "savesoft_pwa/images/arrows-1.png",
    "revision": "59f4a6b6029add4d2887c91eb452597e"
  },
  {
    "url": "savesoft_pwa/images/avatar.jpg",
    "revision": "c4496ae3790bfb2f4aecd94b88ef5d9e"
  },
  {
    "url": "savesoft_pwa/images/banner-aboutus.jpg",
    "revision": "26fff12748e78cb25fd712a5440feddb"
  },
  {
    "url": "savesoft_pwa/images/banner-career.jpg",
    "revision": "4a5dc01267b448c9d77647bdc6196a0d"
  },
  {
    "url": "savesoft_pwa/images/banner-services.jpg",
    "revision": "d9bd8a56a509d2b5464ca334023fc20c"
  },
  {
    "url": "savesoft_pwa/images/blank.png",
    "revision": "8ab38083c10ef0c17df0bb4cbfa570b7"
  },
  {
    "url": "savesoft_pwa/images/dot-black.png",
    "revision": "1bbaa8507700e158311e6d08b4eee926"
  },
  {
    "url": "savesoft_pwa/images/dot.png",
    "revision": "f88a91f2575e7b5afd76bf951f8a3fac"
  },
  {
    "url": "savesoft_pwa/images/icon-plus.png",
    "revision": "08ab0fdd2e952bebfe19c1892ee682d8"
  },
  {
    "url": "savesoft_pwa/images/icon-url.png",
    "revision": "fc7d8d2f463d9cec3ab1bcc15eb80344"
  },
  {
    "url": "savesoft_pwa/images/icon-zoom.png",
    "revision": "34c1fe4b9320b9dc96fdb84a106a02e0"
  },
  {
    "url": "savesoft_pwa/images/logo-bk.png",
    "revision": "503d42d3472b15c4fae0ba24838251b9"
  },
  {
    "url": "savesoft_pwa/images/logo-e.png",
    "revision": "e8d63a42b21b33fb65dbf31857368e4e"
  },
  {
    "url": "savesoft_pwa/images/logo-small.png",
    "revision": "936ff98efe2dbca3bd3f5b3c7fa0e87a"
  },
  {
    "url": "savesoft_pwa/images/logo.png",
    "revision": "9974b65ceaccda664252dd35d994510c"
  },
  {
    "url": "savesoft_pwa/images/news-small-1.jpg",
    "revision": "43b884e67335017ed81c870b8e9a3122"
  },
  {
    "url": "savesoft_pwa/images/news-small-2.jpg",
    "revision": "28188447d298a2e107ccf6868e93669e"
  },
  {
    "url": "savesoft_pwa/images/news-small-3.jpg",
    "revision": "e4597e6e38b6c5f4419ae9ffcf8582de"
  },
  {
    "url": "savesoft_pwa/images/slider-pic-1.png",
    "revision": "f7153f71afcddeedac664bf16b48c577"
  },
  {
    "url": "savesoft_pwa/images/testi-default.jpg",
    "revision": "c9f333f50e7dff53a46895bb3d4b8bfd"
  },
  {
    "url": "savesoft_pwa/images/text-pic-1.png",
    "revision": "2f97bf7194649d613ff7206b908bd65b"
  },
  {
    "url": "savesoft_pwa/images/text-pic-2.png",
    "revision": "92d488dad1a9fb0de65452965a6b2b9c"
  },
  {
    "url": "savesoft_pwa/images/text-pic-3.png",
    "revision": "24f95e378e09c80af6b65f8169b88a74"
  },
  {
    "url": "savesoft_pwa/images/text-pic-4.png",
    "revision": "463d6b8b5ed64dcfd7193238f4bd67cf"
  },
  {
    "url": "savesoft_pwa/images/training.jpg",
    "revision": "437ca597841a3709764268959bfaf9e3"
  },
  {
    "url": "savesoft_pwa/images/ui.totop.png",
    "revision": "b49a69215294243d43bbc7fb5876ed9d"
  },
  {
    "url": "savesoft_pwa/index-alt.html",
    "revision": "b55a397966b7eedcba583022f5cb7411"
  },
  {
    "url": "savesoft_pwa/index.html",
    "revision": "ce22f92f221024fee3b29b1c0e251741"
  },
  {
    "url": "savesoft_pwa/ms-icon-144x144.png",
    "revision": "13f0303b01469b080de03e692635738b"
  },
  {
    "url": "savesoft_pwa/ms-icon-150x150.png",
    "revision": "db0c630c166b859f0bf502156fd7b80b"
  },
  {
    "url": "savesoft_pwa/ms-icon-310x310.png",
    "revision": "eae9f3d399e73923ce792e03687baae1"
  },
  {
    "url": "savesoft_pwa/ms-icon-70x70.png",
    "revision": "d972f521c83faefba58000e7820df816"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/arrow_large_left.png",
    "revision": "6645e864642da518fb40d275437aa31a"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/arrow_large_right.png",
    "revision": "421c7c6749ea6894aa308405fe38f329"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/arrow_left.png",
    "revision": "56458574dfbdc004d385499c968c516b"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/arrow_left2.png",
    "revision": "904f4a773b15b429b665a6c6e79ff104"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/arrow_right.png",
    "revision": "528f50a273ef6fa047f7376ca321d6d7"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/arrow_right2.png",
    "revision": "81d17d06ca481b690b3a116ba7a7f25b"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/arrowleft.png",
    "revision": "1601a090cc9c29f61903040cbff16f9b"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/arrowright.png",
    "revision": "3036bdfc70e00499e5da821030e61b14"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/black50.png",
    "revision": "0a014a0a50f77c151de01a99b0c8d398"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/boxed_bgtile.png",
    "revision": "9ee6f56fe8ba89e63b6dc4a4d3245473"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/bullet_boxed.png",
    "revision": "aba529a3d7abb00e184b48d68edc02e4"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/bullet.png",
    "revision": "1d9b619191601f6dee14cf5d6e302c49"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/bullets.png",
    "revision": "a5045ded13f7bdafb40f39718882fe92"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/bullets2.png",
    "revision": "6087c55f214de2265a108c0178c74525"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/coloredbg.png",
    "revision": "397e5bd80bc0fe4e18c1837deead5e72"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/grain.png",
    "revision": "1df4c242d561c670bcc716870f9ab87b"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/large_left.png",
    "revision": "c7d7eee3ae27c6eea078e5b6c30c8763"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/large_right.png",
    "revision": "21c9f3380e28a14fe7461d3c6ef29f64"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/navigdots_bgtile.png",
    "revision": "d1c9f9a753be6aa09135d6b077b6bed4"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/navigdots.png",
    "revision": "5abba4696745986d3c69eff14fe5332d"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/shadow1.png",
    "revision": "e32b622cc793ecd8ae2df266efd7835a"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/shadow2.png",
    "revision": "4b3c40d070971a9b27d933e26b56f422"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/shadow3.png",
    "revision": "2132557fd6d693dc0f0277841fc1bad8"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/small_left_boxed.png",
    "revision": "f750ed4e89c4391ba1fb5d532a441467"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/small_left.png",
    "revision": "c58c78835c983ece519fa2354419cdc7"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/small_right_boxed.png",
    "revision": "1609b70a465389bfe1944d108d55354c"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/small_right.png",
    "revision": "234c53e8bfca8b621dc83c0323dc38f5"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/timer.png",
    "revision": "ba593bd9fc9e07110f3dc74f728b3768"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/timerdot.png",
    "revision": "390a994e9945f467a33ed9c2ab02126b"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/transparent.jpg",
    "revision": "391ded01873db90453e899775f910f8c"
  },
  {
    "url": "savesoft_pwa/rs-plugin/assets/white50.png",
    "revision": "294e11af4ace946721a5057b1de4200e"
  },
  {
    "url": "savesoft_pwa/rs-plugin/css/settings-ie8.css",
    "revision": "46f6d9725322bb9974b38aca818689d2"
  },
  {
    "url": "savesoft_pwa/rs-plugin/css/settings.css",
    "revision": "c23fc442aa3e1e35cfe71f51f0a1b070"
  },
  {
    "url": "savesoft_pwa/rs-plugin/images/decor_inside_white.png",
    "revision": "f42a88c868fc5027480586b1bb642bb4"
  },
  {
    "url": "savesoft_pwa/rs-plugin/images/decor_inside.png",
    "revision": "74608639d92a506a161319a39aad610a"
  },
  {
    "url": "savesoft_pwa/rs-plugin/images/decor_testimonial.png",
    "revision": "b6b065305de3fe07df422843bca5381d"
  },
  {
    "url": "savesoft_pwa/rs-plugin/videojs/video-js.min.css",
    "revision": "9940af761e99f0e87f2a909542fc085b"
  },
  {
    "url": "savesoft_pwa/rs-plugin/videojs/video-js.png",
    "revision": "cdd687b3953d710c4b00ac12a7d788c4"
  },
  {
    "url": "savesoft_pwa/services.html",
    "revision": "715ba627736c7a23b993d4c1ad330967"
  },
  {
    "url": "savesoft_pwa/training.html",
    "revision": "5c96730c39bc81bb10ec4d7d85cbe94f"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201606.png",
    "revision": "3e2b8f59f6f30739fc0d812bcced22c4"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201607.png",
    "revision": "f9c45883844682856084ae1789014259"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201608.png",
    "revision": "4fea92c412519885b1b89c45921fc53d"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201609.png",
    "revision": "a8f87b73198aff34f4444937f10eddec"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201610.png",
    "revision": "84d2c84b177453788cb17533e43d0c07"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201611.png",
    "revision": "aebcab9be3369b2a5c0336a23594416d"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201612.png",
    "revision": "c1c360f1fed7ea8b2f1d6eb1bbaeecfd"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201701.png",
    "revision": "1a351011aa1c6ea44a84b2bed1ed398a"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201702.png",
    "revision": "8df041f44249f0c97cf4f3a8ace5f999"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201703.png",
    "revision": "826cba06183b1cbc9127783705d00909"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201704.png",
    "revision": "ce7225470ca47478843ad4e1756616a5"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201705.png",
    "revision": "a4ecca27beb3b6f6e77f708a73a5bc0b"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201706.png",
    "revision": "0536d11b13395691c3d726a41c87ae8c"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201707.png",
    "revision": "d2724abf729e6bc1adfc68ebf38b8124"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201708.png",
    "revision": "2e7656c8a23e225cfa2083ea2110f028"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201709.png",
    "revision": "b3384974e56af216b12862742ba06228"
  },
  {
    "url": "savesoft_pwa/webalizer/ctry_usage_201710.png",
    "revision": "92272b123773f9b45ae4bfff708bc492"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201606.png",
    "revision": "1a2ba345b84e070755cbdfcb2da36ec9"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201607.png",
    "revision": "40f94f8128c433dd9243e7023859900c"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201608.png",
    "revision": "23d7dcbf595e7c4221f28616ccb95ec7"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201609.png",
    "revision": "6910041cf7d162dfa2f095dfd84afa3e"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201610.png",
    "revision": "69236d3259b92b7cc2ecb21c28acfe38"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201611.png",
    "revision": "5d9a972d89980f896c0891a0ab5783d5"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201612.png",
    "revision": "f7d7119813b2ef409af15549b1febef0"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201701.png",
    "revision": "6d2485fd5c159357bb17c62e765360b7"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201702.png",
    "revision": "9408f1ccf3163f293cb40ac665b48253"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201703.png",
    "revision": "282ca4bd8bb89a6c3ad5a4a3b6152b2d"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201704.png",
    "revision": "fe33ac44c1b08892de0d512e4e7b8da3"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201705.png",
    "revision": "6c523781ff348fff0468d5d2b3847bef"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201706.png",
    "revision": "71dc342c830b100eddfa03cfe16194ff"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201707.png",
    "revision": "346f2dea2707663fa59f167e9fdbb42b"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201708.png",
    "revision": "aa3189f2153a7585b2412d0c3fa2efb8"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201709.png",
    "revision": "946a236207da6f46a67680bdde2c2e0f"
  },
  {
    "url": "savesoft_pwa/webalizer/daily_usage_201710.png",
    "revision": "8fe8d14a33dcfec0ab34773cb10f8b87"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201606.png",
    "revision": "f56b104b3537ac3358b89c99e608d931"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201607.png",
    "revision": "d464dd33f66bfea43f2b46a1cb208c6d"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201608.png",
    "revision": "35df4071e39ac3061d956ce1599d4047"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201609.png",
    "revision": "e830547d021b765ae226900262fb4356"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201610.png",
    "revision": "2d6ad379e49a95e7b4bbb57359f837a0"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201611.png",
    "revision": "849ca3917e9161ef9b0adaf6e439a502"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201612.png",
    "revision": "fae024f5b63b65fd0e7ac887e203983b"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201701.png",
    "revision": "21cfcbc1d642316b86b469e3b4ae5074"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201702.png",
    "revision": "59f0cc385439e3b596c2728d19975e61"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201703.png",
    "revision": "731b0678515110d91ce973af677b85f9"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201704.png",
    "revision": "d3c060f260841a2e7ffdd608d6c33db7"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201705.png",
    "revision": "b5e06dfb4a325c18aeff67e61f998837"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201706.png",
    "revision": "53645866e1e6c8a4a24d046fa86f6cfd"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201707.png",
    "revision": "2def77ebb13dceba21b0ee184e2271a3"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201708.png",
    "revision": "e931bc00a1cb4e2ff69ef6a532801098"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201709.png",
    "revision": "84423ff6d0370ff9e1ef21f69c265cb3"
  },
  {
    "url": "savesoft_pwa/webalizer/hourly_usage_201710.png",
    "revision": "ff4b1c5551253cd5242c6b5f9eaf0108"
  },
  {
    "url": "savesoft_pwa/webalizer/images/box.jpg",
    "revision": "ae76224a8c2b750da49ea2ff9d7f9f1d"
  },
  {
    "url": "savesoft_pwa/webalizer/images/head_tile.jpg",
    "revision": "98b62187d11e7dff47ac7545fc3bba71"
  },
  {
    "url": "savesoft_pwa/webalizer/index.html",
    "revision": "dbecbde98933d2d8af23f533c7f1d54d"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201606.html",
    "revision": "759535e00e3b3ef604cee8e77165035c"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201607.html",
    "revision": "4529565af6c4156be1a975e1965ac8ef"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201608.html",
    "revision": "e4b86167f1ba7bde33398b66c20385a1"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201609.html",
    "revision": "64ecfedb50891e9711578ad9b6dce9c0"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201610.html",
    "revision": "0385e3954f8173badda32fd846075659"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201611.html",
    "revision": "1e26737a3f6155997e3983acfd31b30b"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201612.html",
    "revision": "5dfafc5cb0b75be6e1491b06fd479eb7"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201701.html",
    "revision": "65b032dcdfcd2adac72b4ac8a6d25c23"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201702.html",
    "revision": "b73892cda14d214e378236dc9946173e"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201703.html",
    "revision": "72b0f0c7188ad40c507170ce368484cd"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201704.html",
    "revision": "f810bc749d02ad1e36d7e5a08fa14826"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201705.html",
    "revision": "4c1b2c0e7d2b60fa08a9fb2d92c67bb1"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201706.html",
    "revision": "649e714bb5e64587127e6efb96a655bc"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201707.html",
    "revision": "348062bd37a85e1dd59aa87e50f01280"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201708.html",
    "revision": "0a2e2f95be909d5cb15a3c0145bfd065"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201709.html",
    "revision": "f4ac25c204d651ecd4f2536c5354fc55"
  },
  {
    "url": "savesoft_pwa/webalizer/usage_201710.html",
    "revision": "90f6f972969abec8e6e6af4dfd0f64a9"
  },
  {
    "url": "savesoft_pwa/webalizer/usage.png",
    "revision": "d173741a64a2e50f19aac3e6811f3f01"
  },
  {
    "url": "services.html",
    "revision": "bf82ed3875047d503bdc9850639a0705"
  },
  {
    "url": "training.html",
    "revision": "250fbbe4fae508115f6c77dc157a6278"
  }
].concat(self.__precacheManifest || []);
workbox.precaching.suppressWarnings();
workbox.precaching.precacheAndRoute(self.__precacheManifest, {});

workbox.routing.registerRoute(/\.(?:js)$/, workbox.strategies.networkFirst({ cacheName: "js cache", plugins: [] }), 'GET');
