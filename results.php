<?php
  # TODO update password and database_name
  mysql_connect("localhost", "root", "password") or die ("Error connecting to database: ".mysql_error());
  mysql_select_db("database_name") or die (mysql_error());
?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>Lump Sum</title>
  </head>
  <body>
    <h1>Lump Sum</h1>
    <?php
      #takes search result from index.html
      $search = htmlspecialchars($_GET["search"]);
      #apparently this protects against SQL injection attacks
      $search = mysql_real_escape_string($search);

      /* TODO update "articles," the title of MySQL
         Selects all data from the database that is applicable to the search term/query */
      $results = mysql_query("SELECT * FROM articles WHERE ('title' LIKE %.$search.%) OR ('text' LIKE %.$search.%)") or die(mysql_error());

      if(mysql_num_rows($results) > 0) {

        #database stored in array in loop
        while($return = mysql_fetch_array($results)) {

          # TODO display images in grid
          if(false !== ($data = file_get_contents($results['text']))){
            header('Content-type: image/jpeg');
            echo $data;
          }
        }
      } else {
        echo "No results found.";
      }
    ?>
  </body>
  </html>
