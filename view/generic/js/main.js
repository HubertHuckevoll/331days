
document.addEventListener('DOMContentLoaded', (ev) =>
{
	// if not on mobile
  let sidebar = document.querySelector('#sidebar');

  if (sidebar.clientHeight > 0)
  {
    // Load sidebar
    let imgBox = document.querySelector('#sidebarImg');
    if (imgBox)
    {
      fetch('index.php?ajax=ajax&hook=teaserImages').then((response) => {return response.text()}).then((data) =>
      {
        imgBox.innerHTML = data;
      });
    }

    // JS Gallery
		let gallery = new cbGallery('.cbArticle p img');
    gallery.init();
  }

  comments = new cbComments('#commentsBox');
  comments.init();
});
