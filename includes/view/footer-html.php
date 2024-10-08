</div>
</div>
</body>

</html>
<script>
  $(function () {
    var pgurl = window.location.href.substr(window.location.href
      .lastIndexOf("/") + 1);
    $(".left-panel ul li span").each(function () {
      if ($(this).attr("url") == pgurl || $(this).attr("url") == '')
        $(this).attr('class', 'left-panel-arrw absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg');
    })
  });

  $(function () {
    var pgurl = window.location.href.substr(window.location.href
      .lastIndexOf("/") + 1);
    $(".left-panel ul li a").each(function () {
      if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
        $(this).attr('class', 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 text-gray-800 dark:text-gray-100');
    })
  });

  $(function () {
    $.ajax({
      url: 'modules/profile/code/profile-code.php',
      type: 'post',
      dataType: 'json',
      data: { action: 'fetch-image' },
      success: function (res) {
        var defaultImage = './assets/img/adslogo.png'; 
        if (res.profile_pic) {
          $('.object-cover').attr('src', res.profile_pic);
        } else {
          $('.object-cover').attr('src', defaultImage); 
        }
      },
      error: function () {
        var defaultImage = './assets/img/adslogo.png'; 
        $('.object-cover').attr('src', defaultImage); 
      }
    });

  });
</script>



    