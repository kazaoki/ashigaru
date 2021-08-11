
import '../scss/manage/style.scss'


/**
 * onload
 */
window.addEventListener('DOMContentLoaded', function(event)
{
    // side menu changer
    window.addEventListener('resize', sidemenu_changer)
    sidemenu_changer()
});

/**
 * サイドメニュー部分を、PCの場合は通常表示、SPの場合はUIKitのOffCanvasを利用するように切り替える
 */
function sidemenu_changer()
{
    var $sideMenu    = document.querySelector('#side-menu');
    if(!$sideMenu) return;
    var $sideMenuDiv = document.querySelector('#side-menu>div.oc-wrap');
    if(960<document.body.clientWidth) {
        if(!$sideMenu.getAttribute('uk-offcanvas')) return;
        $sideMenu.removeAttribute('uk-offcanvas');
        $sideMenu.classList.remove('uk-offcanvas')
        $sideMenuDiv.classList.remove('uk-offcanvas-bar')
    } else {
        if($sideMenu.getAttribute('uk-offcanvas')) return;
        $sideMenu.setAttribute('uk-offcanvas', 'mode:push; flip:true; overlay:true');
        $sideMenuDiv.classList.add('uk-offcanvas-bar')
    }
}
