<?php
include('header.php');
if($sec->checktoken(@$_COOKIE['token'], @$_COOKIE['user']) == false)
  die("<h1 class='text-center text-danger'>ACCESS DENIED</h1>");
?>
<script type="text/javascript">
  $(document).ready(function() {
    $(".initial").on("change",function (e)
    {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax(
        {
            type:'post',
            url:'controller.php',
            data:formData,
            success:function(result)
            {
              $("body").after(result);
            }
        });
    });
  });
</script>
<div class="container">
  <div class="row">
    <div class="col">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">User</th>
            <th scope="col">ON / OFF</th>
          </tr>
        <tbody>
        <?php echo $sec->whitelist(); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
include('footer.php');
?>