 <!--  logg inn form -->
 <main>
        <div class="login-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
            <!-- 
    Bruker htmlspecialchars for å sikre at eventuell HTML eller JavaScript-kode i $user_input blir konvertert til tilsvarende HTML-elementer.
    Dette beskytter mot potensielle dataangrep ved å forhindre uønsket utførelse av skadelig kode på nettsiden.
-->
                <!-- Overskrift for innloggingsformularet -->
                <h2 class ="h2-3">Logg Inn</h2>
                <!-- Inndatafelt for brukernavn -->
                <label for="brukernavn">Brukernavn:</label>
                <input type="text" id="brukernavn" name="brukernavn" placeholder="Brukernavn" required><br/>

                <!-- Inndatafelt for passord -->
                <label for="passord">Passord:</label>
                <input type="password" id="passord" name="passord" placeholder="Passord" required><br/>

                <!-- Knapp for å sende inn logindata -->
                <button type="submit">Logg Inn</button><br/>

                <a href="Registrer_deg.php"> Ikke en kunde? Registrer her</a>

                      <!-- Her slutter logg inn form-->  
                      


                <?php
                    // Starte økten for å lagre brukerdata
                    session_start();
                    // Inkludere koblingen til databasen
                    include "db.connect.php";
    
                    // Sjekke om skjemaet er sendt
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Funksjon for å validere skjemadata
                        function validate($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        // Hente og validere brukernavn og passord fra skjemaet
                        $brukernavn = validate($_POST['brukernavn']);
                        $passord = validate($_POST['passord']);

                        // Sjekke om brukernavn eller passord er tomme
                        if (empty($brukernavn) || empty($passord)) {
                            echo "<p class='error-message'>Både brukernavn og passord er påkrevd!</p>";
                        } else {
                            // Hashing av passordet
                            $hashed_password = md5($passord);

                            // SQL-spørring for å hente brukeren basert på brukernavn og passord
                            $sql = "SELECT * FROM users WHERE username='$brukernavn' AND password='$hashed_password'"; 
                             //echo $sql;
                            // Utfører spørringen
                            $result = mysqli_query($conn, $sql);

                            // Sjekker om brukeren ble funnet
                            if ($result && mysqli_num_rows($result) === 1) {
                                // Henter brukerdata
                                $row = mysqli_fetch_assoc($result);
                                // Lagrer brukernavn og ID i økten
                                $_SESSION['brukernavn'] = $row['username'];
                                $_SESSION['id'] = $row['id'];
                                // Utgive en suksessmelding

                                echo "<p class='success-message'>Du har nå logget inn. <a href='Kundekonto.php'>Trykk her for å se Min Profil</a></p>";
                            } else {
                                // Utgive en feilmelding hvis brukeren ikke ble funnet
                                echo "<p class='error-message'>Feil brukernavn eller passord!</p>";
                            } 
                        }
                    }
                ?>
            </form>
        </div>
    </main>