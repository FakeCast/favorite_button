<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <script src="jquery.min.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($){
        $('.button').on('click', function(e){
            e.preventDefault();
            var user_id = $('.button').attr('user_id');
            var director_id = $('.button').attr('director_id');
            var method = $('.button').attr('method');
            if (method == "Like") {
              $('#icon').replaceWith('<img src="favon.jpg">')
            } else {
             $('#icon').replaceWith('<img src="favoff.png">')
            }
            $.ajax({
                url: 'favs.php',
                type: 'POST',
                data: {user_id: user_id, director_id: director_id, method: method},
                cache: false,
                success: function(data){
                }
            });
        });
    });
    </script>
  </head>

  <body>
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "lab";
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      function checkFavorite($user_id, $director_id, $conn) {
        $result = $conn->query("SELECT * FROM favs WHERE user_id = '". $user_id."' AND director_id = '". $director_id."'");
        $numrows =  $result->num_rows;
        if ($numrows == 0) {
         echo "<div class = 'button' method = 'Like'  user_id = ".$user_id." director_id = ".$director_id."> <img id = 'icon' src='favoff.png'> </div>";
        }
        else {
          echo  "<div class = 'button' method = 'Unlike'  user_id = ".$user_id." director_id = ".$director_id."> <img id = 'icon' src='favon.jpg'> </div>";
        }

      }
      // Query to get the user_id
      $result = $conn->query("SELECT * FROM user WHERE name = 'Henrique'");
      $row = $result->fetch_assoc();
      $user_id = $row['id'];

      // Query to Get the Director ID
      $result = $conn->query("SELECT * FROM director WHERE name = 'Donal'");
      $row = $result->fetch_assoc();
      $director_id = $row['id'];

      echo "<p>Director: ".$row['name']."</p> ";
      $fav_image = checkFavorite($user_id, $director_id, $conn);
      echo "Favorite? : ".$fav_image."";
    ?>
  </body>
</html>
