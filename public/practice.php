<!DOCTYPE html>
<html>
        <head>
            <title>Practice</title>
            <meta charset='utf-8'>
            <link rel="stylesheet" href="../public/stylesheets/main.css">
        </head>

    	<body>

    		<!-- Header -->

            <?php
                require('../public/templates/header.php');
            ?>

            <section class="row">
              <div class="grid">

                <!-- Question -->

                <section class="col-2-3">

                    <!-- script to fetch the question list -->

                    <?php

                        // show message for question

                        if(isset($_SESSION['successMsg']))
                        {
                            echo "<p class='reporting success' style='margin: 0% 5%; width: 90%;'>".$_SESSION['successMsg']."</p>";
                            unset($_SESSION['successMsg']);
                        }

                        if(isset($_SESSION['errorMsg']))
                        {
                            echo "<p class='reporting error' style='margin: 0% 5%; width: 90%;'>".$_SESSION['errorMsg']."</p>";
                            unset($_SESSION['errorMsg']);
                        }

                        $db = parse_url(getenv("DATABASE_URL"));

                        try
                        {
                            $con = new PDO("pgsql:" . sprintf(
                                            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                                            $db["host"],
                                            $db["port"],
                                            $db["user"],
                                            $db["pass"],
                                            ltrim($db["path"], "/")
                                        ));
                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // check for valid credentials and show error

                            $sql = "select * from questions";
                            $result = $con->query($sql);

                            echo "<table>";
                            echo    "<tr>";
                            echo       "<th>Name</th>";
                            echo       "<th>TBD</th>";
                            echo       "<th>TBD</th>";
                            echo    "</tr>";

                            while($row = $result->fetch())
                            {
                                echo "<tr>";
                                echo    "<td>";
                                echo        "<a href='../app/question.php?id=".$row["que_id"]."'>";
                                echo            $row["name"];
                                echo        "</a>";
                                echo    "</td>";
                                echo    "<td>TBD</td>";
                                echo    "<td>TBD</td>";
                                echo "</tr>";
                            }

                            echo "</table>";
                        }
                        catch(PDOException $e)
                        {
                            echo $sql . "<br>" . $e->getMessage();
                        }

                        $conn = null;
                    ?>

                </section><!--

                    Upload Question

                --><section class="col-1-3">

                    <div class="upload-question">
                        <a href="../public/upload_question.php"> Upload a question </a>
                    </div>

                </section>

              </div>
            </section>

            <!-- Footer -->

            <?php
                require('../public/templates/footer.php');
            ?>

        </body>
</html>
