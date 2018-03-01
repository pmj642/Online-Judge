<!DOCTYPE html>
<html>
        <head>
            <title></title>
            <meta charset='utf-8'>
            <link rel="stylesheet" href="assets/stylesheets/main.css">
        </head>
        <body>

            <!-- Header -->

            <header class="container group">

                <h1 class="logo">
                    <a href="index.html">Codify</a>
                </h1>

                <h3 class="tagline">Turn ideas into Code !</h3>

                <nav class="nav primary-nav">
                    <ul>
                        <li>    <a href="index.html">Home</a>   </li><!--
                        --><li>    <a href="practice.html">Practice</a>   </li><!--
                        --><li>    <a href="register.html">Register</a>   </li><!--
                        --><li>    <a href="rankings.html">Rankings</a>   </li>
                    </ul>
                </nav>

            </header>

            <section class="row">
              <div class="grid">

                <!-- Question -->

                <section class="col-2-3">

                        <?php
                            $con = new mysqli("localhost","root","","oj");
                            if($con->connect_error)
                            {
                                die("Failed to connect to database! ".$con->connect_error);
                            }

                            // echo "Connected to database successfully<br>";
                            // echo "Query successful";

                            $color = "color: #000;";
                            $div = "//background: #f8f9f9;
                                    //border: 1px solid #000;
                                    padding: 30px;
                                    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),
                                                0 6px 20px 0 rgba(0,0,0,0.2);
                                    ";

                            $con->set_charset("utf8");
                            $sql = "select * from questions";
                            $result = $con->query($sql);
                            // echo "Query successful<br>";

                            $row = $result->fetch_assoc();

                            echo "<div style = '$div'>";
                            echo "<h1 style = '$color'>".$row["name"]."</h1>";
                            echo "<p style = '$color'>".$row["description"]."</p>";

                            echo "<h2 style = '$color'>Input</h2>";
                            echo "<p style = '$color'>".$row["inputFormat"]."</p>";

                            echo "<h2 style = '$color'>Output</h2>";
                            echo "<p style = '$color'>".$row["outputFormat"]."</p>";

                            echo "<h2 style = '$color'>Constraints</h2>";
                            echo "<p style = '$color'>".nl2br($row["constraints"])."</p>";

                            echo "<h2 style = '$color'>Example</h2>";
                            echo "<h3 style = '$color'>Input</h3>";
                            echo "<p style = '$color'>".nl2br($row["exampleIn"])."</p>";
                            echo "<h3 style = '$color'>Output</h3>";
                            echo "<p style = '$color'>".nl2br($row["exampleOut"])."</p>";
                            echo "</div>";

                            $con->close();
                            // echo "Closing Connection!";
                        ?>
                    <!-- </div> -->
                </section><!--

                Submit

                --><section class="col-1-3">

                  <a href="practice.html">
                    <h2>Workout for your brain</h2>
                    <p>Everyone starts with a brute force solution.
                        But with practice you will get rise above arrays!</p>
                    <a class="btn btn-default" onclick="submit()">Submit</a>
                  </a>

                </section>
              </div>
            </section>

            <footer class="primary-footer container group">

                <small>&copy;Codify</small>

                <nav class="nav">
                    <ul>
                        <li>    <a href="index.html">Home</a>   </li>
                        <li>    <a href="practice.html">Practice</a>   </li>
                        <li>    <a href="register.html">Register</a>   </li>
                        <li>    <a href="rankings.html">Rankings</a>   </li>
                    </ul>
                </nav>

            </footer>

        </body>
</html>