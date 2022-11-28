    <footer class="section-p1">
            <div class="col">
                <i class="bi bi-shop"></i>
                <h4>Contact</h4>
                <p><strong>Address: </strong> 640 Callas Street, Los Pierrefonds, Montreal</p>
                <p><strong>Phone: </strong> +1 (514) 538-4020</p>
                <div class="follow">
                    <h4>Follow us</h4>
                    <div class="icon">
                        <i class="bi bi-facebook"></i>
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-pinterest"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4>My Account</h4>
                <a href="signup page.html">Sign up</a>
                <a href="mycourses.html">View My Courses</a>
                <a href="teacher page.php">View Teachers page</a>
                <a href="#">User Guide</a>
            </div>


            <div style="color: black;" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">My Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <tr>
                        <?php
                        if (isset($_SESSION['StudentID'])) {
                            echo "<td id='myname' style=' color :black;'> " . $_SESSION['Name'] . "</td><br>";
                            echo "<td id='myemail'> " . $_SESSION['Email'] . "</td><br>";
                            echo "<td id='myid'> " . $_SESSION['StudentID'] . "</td><br>";   
                        } else {
                            echo '<td id="myname" style="color:black;"> ' . $_SESSION['Name'] . '</td><br>';
                            echo "<td id='myemail'> " . $_SESSION['Email'] . "</td><br>";
                            echo "<td id='myid'> " . $_SESSION['TeacherID'] . "</td><br>";
                        }
                        
                        ?>
                        

                    </tr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"> <a href="logout.php" style="color:white; text-decoration: none;">Logout</a> </button>
                </div>
                </div>
            </div>
        </div>
        </footer>