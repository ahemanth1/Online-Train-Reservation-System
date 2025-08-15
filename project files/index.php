<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Booking</title>
    <link rel="stylesheet" href="indexstyle.css" />
</head>
<body>
    <div id="header">
        <h2>Online Booking</h2>
        <a href="profile.php" id="profile">Profile</a>
        <a href="contact.html" id="contact">Contact</a>
</div>
    <div id="form-container">
        <form action="details.php" method="post">
            <h1>Enter Station Details</h1>
            <input list="stations" placeholder="From Station" name="from" class="button" id="from" required />
             <input list="stations" placeholder="To Station" name="to" class="button" id="to" required /><br><br>
            <datalist id="stations">
                <option value="Hyderabad">Hyd</option>
                <option value="Tenali">Ten</option>
                <option value="Vijayawada">Bez</option>
                <option value="Vishakhapatanam">Vizag</option>
                <option value="Tirupati">Tiru</option>
                <option value="Repalle">RPL</option>
            </datalist>
            <button type="submit" id="search">Search</button>
        </form>
    </div>
</body>
</html>
