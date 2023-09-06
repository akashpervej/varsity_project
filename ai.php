<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
</head>
<body>
<div id="chatbot-container">
  <div id="chat-messages"></div>
  <input type="text" id="user-input" placeholder="Type your message...">
</div>
<div id="chatbot-container">
  <div id="chat-messages"></div>
  <input type="text" id="user-input" placeholder="Type your message...">
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const chatMessages = document.getElementById("chat-messages");
  const userInput = document.getElementById("user-input");

  const botResponses = [
    "Welcome to Mavic Booking! How can I assist you?",
    "Sure, I can help you find flights and book them. Just let me know your preferences!",
    "Is there a specific destination or date you have in mind?",
    "Feel free to ask any questions you have about flights or the booking process.",
  ];

  function appendMessage(sender, message) {
    const messageElement = document.createElement("div");
    messageElement.classList.add("message", sender);
    messageElement.textContent = message;
    chatMessages.appendChild(messageElement);
  }

  function handleUserInput() {
    const userMessage = userInput.value;
    appendMessage("user", userMessage);
    userInput.value = "";
    setTimeout(() => {
      const botMessage = getRandomBotResponse();
      appendMessage("bot", botMessage);
    }, 500); // Simulate bot response delay
  }

  function getRandomBotResponse() {
    const randomIndex = Math.floor(Math.random() * botResponses.length);
    return botResponses[randomIndex];
  }

  userInput.addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
      handleUserInput();
    }
  });
});
</script>

</body>
</html>