    <section>
        <?php use App\Helper\FlashMessage;

        if (isset($_SESSION["flash-message"]["message"])) {
            echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
            FlashMessage::unset("message");
        } ;?>
        Benvingut a la pàgina<?= isset($_SESSION["loginToken"]) ? " " . $_SESSION["loginToken"]->getUsername() . "!" : "!"; ?>
    </section>