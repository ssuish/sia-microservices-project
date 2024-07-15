<?php 
                                $typeFilter = isset($_GET['type']) ? $_GET['type'] : '';
                                $query = "SELECT * FROM tblproducts";
                                if ($typeFilter) {
                                    $query .= " WHERE type='$typeFilter'";
                                }

                                if (isset($_POST['btnSearch'])) {
                                    // post from search form
                                    $search = $_POST['search'];
                            
                                    // query to search data from search form
                                    $query .= " WHERE productID LIKE '%$search%'
                                        OR name LIKE '%$search%'
                                        OR type LIKE '%$search%'
                                        OR price LIKE '%$search%'
                                        OR size LIKE '%$search%'
                                        OR color LIKE '%$search%'
                                        OR thickness LIKE '%$search%'
                                        OR warranty LIKE '%$search%'
                                        OR thumbnail LIKE '%$search%'
                                        OR currency LIKE '%$search%'
                                        OR quantity LIKE '%$search%'";
                                }

                                $result = mysqli_query($conn, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                            
                            ?>   <?php
                        }
                    } else {
                        echo "<tr><td colspan='12' class='text-center'>No data found</td></tr>";
                    }
                ?>