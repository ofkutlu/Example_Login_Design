<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="post" action="index.php">
        <div class="home">
            <div class="container">
                <div class="content-item">
                    <img src="/images/container-image.jpg" alt="Message">
                    <div class="container-input-layout">
                        <h2 style="font-weight: bold;">Get in touch</h2>
                        <input type="text" name="name" placeholder="Name" class="input">
                        <input type="email" name="email" placeholder="Email" class="input" required>
                        <input type="text" name="message" placeholder="Message" class="input input-message" required>
                        <input type="submit" name="send" class="btn-send" value="Send">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name_value = $_POST["name"];
        $email_value = $_POST["email"];
        $message_value = $_POST["message"];

        $values = array(
            'name' => $name_value,
            'email' => $email_value,
            'message' => $message_value
        );
        $values = array_filter($values, function ($item) {
            return !empty($item);
        });
        

        if (count($values) < 3) {
            $error = "Lütfen tüm alanları doldurunuz";
            
        } else {
            $data_results = file_get_contents('text.json');
            $tempArray = json_decode($data_results);

            $tempArray[] = $values;
            $jsonData = json_encode($tempArray);
            file_put_contents('text.json', $jsonData);
        }
    }

    if (isset($error)) {
        echo "<script>alert('". $error . "');</script>";
    }


    ?>
</body>

</html>