<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <script src="jquery.min.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($){
          $('.button').on('click', function(e){
              e.preventDefault();
              var user_id = $(this).attr('user_id'); // Get the parameter user_id from the button
              var director_id = $(this).attr('director_id'); // Get the parameter director_id from the button
              var method = $(this).attr('method');  // Get the parameter method from the button
              if (method == "Like") {
                $(this).attr('method', 'Unlike') // Change the div method attribute to Unlike
                $('#' + director_id).replaceWith('<img class="favicon" id="' + director_id + '" src="favon.jpg">') // Replace the image with the liked button
              } else {
               $(this).attr('method', 'Like')
               $('#' + director_id).replaceWith('<img class="favicon" id="' + director_id + '" src="favoff.png">')
              }
              $.ajax({
                  url: 'favs.php', // Call favs.php to update the database
                  type: 'GET',
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
         echo "<div class = 'button' method = 'Like'  user_id = ".$user_id." director_id = ".$director_id."> <img id=".$director_id." src='favoff.png'> </div>";
        }
        else {
          echo  "<div class = 'button' method = 'Unlike'  user_id = ".$user_id." director_id = ".$director_id."> <img id=".$director_id." src='favon.jpg'> </div>";
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
