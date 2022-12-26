<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/css/app.min.css">
  <link rel="stylesheet" href="../assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">      
      <div class="container mt-5">
      <center>
        <a href="index.php"><h5><i class="fa fa-home"></i> Home</h5></a>
      </center>
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
                <?php if(isset($_GET['from'])?$_GET['from']=="signup":false){ ?>
                <div class="alert alert-success">
                  <div class="alert-title">Registration Successfully</div>
                  Please login to your account.
                </div>
                <?php } ?>

                <form method="POST" id="login" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="Email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <!-- <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a>
                      </div> -->
                    </div>
                    <input id="password" type="password" class="form-control" name="Password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="sign-up.php">Create One</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="../assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="../assets/js/custom.js"></script>

  <!-- on form submit js code here -->
  <!-- hidden input will be RoleId,TinNumber,CreatedAt,UpdatedAt -->
  <script>
    $( document ).ready(function() {
        if(sessionStorage.getItem("user_id")){
          window.location.href="dashboard.php";
        }
    });

    function getJson(url) {
        return JSON.parse($.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            global: false,
            async: false,
            success: function (data) {
                return data;
            }
        }).responseText);
    }

    // this is the id of the form
    $("#login").submit(function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var form = $(this);
      var form_data = form.serialize();
      var actionUrl = "https://localhost:44362/api/login";
      //console.log(form_data);
      $.ajax({
          type: "POST",
          url: actionUrl,
          data: form_data, // serializes the form's elements.
          success: function(data)
          {
            var users = getJson("https://localhost:44362/api/users");
            for(var i=0;i<users.length;i++){
              if(users[i].Email==data.Email){
                sessionStorage.setItem("user_id", users[i].Id);
                var roles = getJson("https://localhost:44362/api/roles/"+users[i].RoleId);
                sessionStorage.setItem("permission", roles.Permission);
                break;
              }
            }
            //console.log(data); // show response from the php script.
            window.location.href = 'dashboard.php';
          }
      });
    });
  </script>





</body>
</html>