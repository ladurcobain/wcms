<script>
function speak() {
    //stops();
    document.getElementById("btn-play").classList.remove("d-block");
    document.getElementById("btn-stop").classList.remove("d-none");
    document.getElementById("btn-play").classList.add("d-none");
    document.getElementById("btn-stop").classList.add("d-block");

    <?php if(Session::get('flag') == 'uk') { ?>
        var voice = 144;
        var lang = "en";
        //responsiveVoice.setDefaultVoice("US English Female");
    <?php } else { ?>
        var voice = 151;
        var lang = "id";
        //responsiveVoice.setDefaultVoice("Indonesian Female");
    <?php } ?>
    
    // Get the text area and speak button elements
    let textArea = document.getElementById("text");
    //let speakButton = document.getElementById("speak-button");

    // Add an event listener to the speak button
    //speakButton.addEventListener("click", function() {
    // Get the text from the text area
    let text = textArea.value;

    // Create a new SpeechSynthesisUtterance object
    let utterance = new SpeechSynthesisUtterance();

    // Set Speech Language
    utterance.lang = lang;

    // Set the text and voice of the utterance
    utterance.text = text;
    utterance.rate = 0.9;
    //utterance.voice = window.speechSynthesis.getVoices()[voice];

    // Speak the utterance
    window.speechSynthesis.speak(utterance);
    
    // });
}

function stops() {
    document.getElementById("btn-stop").classList.remove("d-block");
    document.getElementById("btn-play").classList.remove("d-none");
    document.getElementById("btn-stop").classList.add("d-none");
    document.getElementById("btn-play").classList.add("d-block");

    window.speechSynthesis.cancel();
    var voice = 151;
}
</script>