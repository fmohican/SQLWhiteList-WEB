<?php
include('header.php');
$already = @$_COOKIE['applyed'];
$status = @$_GET["status"];
if($status == "loggedout") {
echo "<div class='adminalert'><div class='alert alert-success alert-dismissible fade show text-center' role='alert'><strong><i class='material-icons align-middle'>check</i></strong> Logged out <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div></div>".'<script>window.setTimeout(function() {$(".adminalert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 4000);</script>';
}
if($status == "500") {
echo "<div class='adminalert'><div class='alert alert-danger alert-dismissible fade show text-center' role='alert'><strong><i class='material-icons align-middle'>close</i></strong> Login Rejected. You don't have permissions to do that.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div></div>".'<script>window.setTimeout(function() {$(".adminalert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 4000);</script>';
}

?>
<script type="text/javascript">
  $(document).ready(function() {
    $("#initial").on("submit",function (e)
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
              $("#main").html(result);
            }
        });
    });
  });
</script>
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class='text-center text-sky'><?php echo $title; ?></h1>
      <h3 class='text-center text-hot'>WhiteList Application</h3>
      <?php 
      if(isset($already) AND !empty($already)) {
        $site = new account();
        echo $site->checkbeta($already);
      }
      else {
        echo '
      <div class="mx-auto" id="main">
        <form id="initial" action="" method="POST">
          <div class="form-group">
            <label class="bmd-label-floating text-hot">IGN</label>
            <input type="text" class="form-control text-light" name="ign" required>
            <input type="hidden" class="form-control text-light" name="action" value="register">
            <span class="bmd-help">Your in game name, to be added in whitelist</span>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-hot btn-raised">Submit Application</button>
          </div>
        </form>
      </div>';
      }
?>
    </div>
  </div>
</div>
<?php
include('footer.php');
?>