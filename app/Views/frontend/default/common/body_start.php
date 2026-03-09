<noscript>
<p><b>JavaScript Required</b></p>
<p>It appears that your browser does not support JavaScript or it is currently disabled. For the optimal experience and full functionality of our website, please enable JavaScript in your browser settings.</p>
<p>Thank you for your understanding and cooperation.</p>
</noscript><?php echo isset($structured_data)?$structured_data:'' ?>
<style>
#body_loader {
 position: fixed;
    top: 47%;
    left: 47%;
    transform: translate(-47%, -47%);
    z-index: 99999;
    display: inline;
  }
</style><img src="<?php echo $cc['img_url'].'public/images/frontend/'.$cc['frontend_theme'].'/body_loader.webp'; ?>" id="body_loader" alt="Please Wait..." /><script>
if (!window.nanobar) {
  window.nanobar = new Nanobar({ id: 'pageloaderbar' });
  window.nanobar.go(5);
}
const observer = new MutationObserver(() => {
  const bar = document.querySelector('#pageloaderbar .bar');
  if (bar) {
    bar.style.backgroundColor = '#f77171';
    bar.style.height = '2px';
    observer.disconnect();
  }
});
observer.observe(document.body, { childList: true, subtree: true });
 </script>
<div id="body_content" style="display:none">