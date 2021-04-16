$(function () {

  $('form').on('submit', function (e) {

    e.preventDefault();

    $.ajax({
      type: 'post',
      url: 'post.php',
      data: $('form').serialize(),
      success: function(dataResult){
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode == 200){
          reloadSection(2)
          reloadSection(3)
        }
      }
    });

  });

  function reloadSection(id) {
    $("#section-" + id).load("sections/section" + id + ".php");

  }

});