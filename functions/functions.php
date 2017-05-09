<?php
function sec_session_start() {
    $session_name = 'sec_session_id';   // vergib einen Sessionnamen
    $secure = SECURE;
    // Damit wird verhindert, dass JavaScript auf die session id zugreifen kann.
    $httponly = true;
    // Zwingt die Sessions nur Cookies zu benutzen.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Holt Cookie-Parameter.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Setzt den Session-Name zu oben angegebenem.
    session_name($session_name);
    session_start();            // Startet die PHP-Sitzung 
    session_regenerate_id();    // Erneuert die Session, löscht die alte. 
}

function login($email, $password, $mysqli) {
    // Das Benutzen vorbereiteter Statements verhindert SQL-Injektion.
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Führe die vorbereitete Anfrage aus.
        $stmt->store_result();
 
        // hole Variablen von result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // hash das Passwort mit dem eindeutigen salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // Wenn es den Benutzer gibt, dann wird überprüft ob das Konto
            // blockiert ist durch zu viele Login-Versuche 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Konto ist blockiert 
                // Schicke E-Mail an Benutzer, dass Konto blockiert ist
                return false;
            } else {
                // Überprüfe, ob das Passwort in der Datenbank mit dem vom
                // Benutzer angegebenen übereinstimmt.
                if ($db_password == $password) {
                    // Passwort ist korrekt!
                    // Hole den user-agent string des Benutzers.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS-Schutz, denn eventuell wir der Wert gedruckt
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS-Schutz, denn eventuell wir der Wert gedruckt
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    // Login erfolgreich.
                    return true;
                } else {
                    // Passwort ist nicht korrekt
                    // Der Versuch wird in der Datenbank gespeichert
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            //Es gibt keinen Benutzer.
            return false;
        }
    }
}

function checkbrute($user_id, $mysqli) {
    // Hole den aktuellen Zeitstempel 
    $now = time();
 
    // Alle Login-Versuche der letzten zwei Stunden werden gezählt.
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts <code><pre>
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Führe die vorbereitet Abfrage aus. 
        $stmt->execute();
        $stmt->store_result();
 
        // Wenn es mehr als 5 fehlgeschlagene Versuche gab 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($mysqli) {
    // Überprüfe, ob alle Session-Variablen gesetzt sind 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Hole den user-agent string des Benutzers.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" zum Parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // Wenn es den Benutzer gibt, hole die Variablen von result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Eingeloggt!!!! 
                    return true;
                } else {
                    // Nicht eingeloggt
                    return false;
                }
            } else {
                // Nicht eingeloggt
                return false;
            }
        } else {
            // Nicht eingeloggt
            return false;
        }
    } else {
        // Nicht eingeloggt
        return false;
    }
}

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // Wir wollen nur relative Links von $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
function getProfile($mysqli)
{
	// Überprüfe, ob alle Session-Variablen gesetzt sind 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Hole den user-agent string des Benutzers.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT username, email, age 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" zum Parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) 
			{
				$stmt->bind_result($username,$email, $age);
                $stmt->fetch();
				return [ "username" => $username, 
						 "email" => $email,
						 "age" => $age];
			}
		}
	}	
}
function getInvites($mysqli)
{
	 if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
		$ret = array();
 
        // Hole den user-agent string des Benutzers.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT p.event as id, name, creator, bdate, edate, p.status as stat
                                      FROM events as e
									  JOIN participants as p
									  on p.event = e.id
                                      WHERE p.user = ?")) {
            // Bind "$user_id" zum Parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
				$stmt->bind_result($id,$name,$creator,$bdate,$edate, $stat);
                for ($i =0;$row = $stmt->fetch();$i++) 
					$ret[$i] = array($id,$name,$creator, $bdate, $edate, $stat);

				return $ret;
		}
	}	
}

function getPageData($string,$mysqli)
{
	switch($string)
		{ 
		case "profile":
			return getProfile($mysqli);
		case "events":
			return [];
		case "invites":
			return getInvites($mysqli);
		case "locations":
			return [];
		break;		
		default:
			return [];
	}
 
}
function getPageFunctions($string)
{
	switch($string)
		{ 
		case "profile":
			return "functions/profile.inc.php";
		case "events":
			return "functions/event.func.php";
		case "invites":
			return "functions/invite.inc.php";
		case "locations":
			return "functions/location.inc.php";
		break;		
		default:
			return "";
	}
}
function getTemplate($string)
{
	switch($string)
		{ 
		case "profile":
			return "templates/profile_template.php";
		case "events":
			return "templates/event_template.php";
		case "invites":
			return "templates/invite_template.php";
		case "locations":
			return "templates/location_template.php";
		break;		
		default:
			return "templates/kalender_template.php";
	}
}

function nextEvents($mysqli) {
	$todaydate = date("Y-m-d");
	if ($stmt = $mysqli->prepare("SELECT name, bdate, edate, min_age FROM events WHERE date >= ? LIMIT 5"))
	{
		 $stmt->bind_param('s', $todaydate);  // Bind "$todaydate" to parameter.
		 $stmt->execute();    // Führe die vorbereitete Anfrage aus.
		 $stmt->store_result();
		 
		 // hole Variablen von result.
		 $stmt->bind_result($name, $bdate, $edate, $min_age);
		echo "<table name=\"events\" id=\"events\">
		<tr>
		<th>Name</th>
		<th>Beginn</th>
		<th>Ende</th>
		<th>Mindestalter</th>
		</tr>";
			while ($row = $stmt->fetch()) 
			{
			echo "<tr>";
			echo "<td>" . $name . "</td>";
			echo "<td>" . $bdate. "</td>";
			echo "<td>" . $edate. "</td>";
			echo "<td>" . $min_age. "</td>";
			echo "</tr>";
			}
		echo "</table>";
		}
		else
		{
			echo $mysqli->error;
		}
}

?>