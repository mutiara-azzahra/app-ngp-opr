<!DOCTYPE html>
<html>

<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Login Example - Fomantic</title>
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/reset.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/site.css">

  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/container.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/grid.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/header.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/image.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/menu.css">

  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/divider.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/segment.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/form.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/input.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/button.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/list.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/message.css">
  <link rel="stylesheet" type="text/css" href="../assets/fomantic-ui/dist/components/icon.css">

  <script src="../example/assets/library/jquery.min.js"></script>
  <script src="../assets/fomantic-ui/dist/components/form.js"></script>
  <script src="../assets/fomantic-ui/dist/components/transition.js"></script>

  <style type="text/css">
    body {
      background-color: #dadada;
    }

    body>.grid {
      height: 100%;
    }

    .image {
      margin-top: -100px;
    }

    .column {
      max-width: 450px;
    }
  </style>
  <script>
    $(document)
      .ready(function() {
        $('.ui.form')
          .form({
            fields: {
              email: {
                identifier: 'email',
                rules: [{
                    type: 'empty',
                    prompt: 'Please enter your e-mail'
                  },
                  {
                    type: 'email',
                    prompt: 'Please enter a valid e-mail'
                  }
                ]
              },
              password: {
                identifier: 'password',
                rules: [{
                    type: 'empty',
                    prompt: 'Please enter your password'
                  },
                  {
                    type: 'length[6]',
                    prompt: 'Your password must be at least 6 characters'
                  }
                ]
              }
            }
          });
      });
  </script>
</head>

<body>
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <h2 class="ui teal image header">
        <img src="../img/nogo.png" class="image">
        <div class="content">
          Masuk APP NGP OPR
        </div>
      </h2>
      @if ($message = Session::get('danger'))
      <div class="ui error message">Test</div>
      @endif

      <form class="ui large form" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="ui stacked segment">
          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="username">
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password" placeholder="password">
            </div>
          </div>
          <button class="ui fluid large teal submit button" type="submit">Login</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Password toggle
    function myPassword() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
</body>

</html>