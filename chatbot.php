<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        /* Styling for the messenger icon */
        #messenger-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 24px;
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
        }

        /* Styling for chatbot container */
        #chatbot-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 350px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        #chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #chat-body {
            padding: 10px;
            max-height: 300px;
            overflow-y: auto;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .user-message {
            background-color: #f0f0f0;
            color: #000;
        }

        .bot-message {
            background-color: #007bff;
            color: #fff;
        }

        /* Styling for user and chatbot labels */
        .message-label {
            font-weight: bold;
            margin-right: 5px;
        }

        /* Styling for input field and send button */
        #user-input-container {
            display: flex;
            margin-top: 10px;
        }

        #user-input {
            flex: 1;
            padding: 10px;
            border: none;
            border-top: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
        }

        #send-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Messenger icon -->
    <div id="messenger-icon">
        <i class="fas fa-comments"></i>
    </div>

    <!-- Initially hidden chatbot container -->
    <div id="chatbot-container" style="display: none;">
        <div id="chat-header">
            <h3>Chatbot</h3>
        </div>
        <div id="chat-body">
            <div class="message bot-message">
                <span class="message-label">Chatbot:</span> Hello! How can I help you?
            </div>
        </div>
        <div id="user-input-container">
            <input type="text" id="user-input" placeholder="Type your message...">
            <button id="send-button"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>

    <script>
        const userInput = document.getElementById('user-input');
        const sendButton = document.getElementById('send-button');
        const chatBody = document.getElementById('chat-body');

        sendButton.addEventListener('click', sendMessage);
        userInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                sendMessage();
            }
        });

        function sendMessage() {
            const userMessage = userInput.value;
            if (userMessage.trim() === '') return;

            appendUserMessage(userMessage);

            const botResponse = processUserMessage(userMessage);

            appendBotMessage(botResponse);

            userInput.value = '';
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function appendUserMessage(message) {
            const messageContainer = document.createElement('div');
            messageContainer.classList.add('message', 'user-message');
            messageContainer.innerHTML = `<span class="message-label">You:</span> ${message}`;
            chatBody.appendChild(messageContainer);
        }

        function appendBotMessage(message) {
            const messageContainer = document.createElement('div');
            messageContainer.classList.add('message', 'bot-message');
            messageContainer.innerHTML = `<span class="message-label">Chatbot:</span> ${message}`;
            chatBody.appendChild(messageContainer);
        }

        function processUserMessage(userMessage) {
            const lowercaseMessage = userMessage.toLowerCase();

            if (lowercaseMessage === 'hello') {
                return "Hello! Are you looking for flights?";
            } else if (lowercaseMessage === 'yes') {
                return "Great! Where are you planning to fly to?";
            } else if (lowercaseMessage === 'no') {
                return "Alright, if you change your mind or have any other questions, feel free to ask!";
            } else if (lowercaseMessage === 'flight') {
                return "Sure, I can help you find flights. Where are you departing from?";
            } else if (lowercaseMessage.includes('to')) {
                const locations = lowercaseMessage.split('to');
                if (locations.length === 2) {
                    const fromLocation = locations[0].trim();
                    const toLocation = locations[1].trim();

                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `flight_search.php?fromLocation=${fromLocation}&toLocation=${toLocation}`, true);

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                const flights = JSON.parse(xhr.responseText);
                                if (flights.length > 0) {
                                    let response = "Here are the available flights:\n";
                                    flights.forEach((flight, index) => {
                                        response += `${index + 1}. Flight ${flight.number}, Departure Time: ${flight.d_time}, Arrival Time: ${flight.a_time}\n`;
                                    });
                                    appendBotMessage(response, true); // Use true to indicate it's flight info
                                } else {
                                    appendBotMessage("I'm sorry, there are no available flights for your selected route.");
                                }
                            } else {
                                appendBotMessage("I'm sorry, there was an error while fetching flight information.");
                            }
                        }
                    };

                    xhr.send();

                    return `Great! You want to fly from ${fromLocation} to ${toLocation}. Here's are available flights`;
                } else {
                    return "I'm sorry, I couldn't determine both departure and destination locations. Please specify your flight route.";
                }
            } else if (lowercaseMessage.includes('from') && lowercaseMessage.includes('to')) {
                const fromIndex = lowercaseMessage.indexOf('from');
                const toIndex = lowercaseMessage.indexOf('to');
                if (fromIndex < toIndex) {
                    const fromLocation = lowercaseMessage.substring(fromIndex + 4, toIndex).trim();
                    const toLocation = lowercaseMessage.substring(toIndex + 2).trim();

            

                    return `Great! You want to fly from ${fromLocation} to ${toLocation}. Here's are available flights.`;
                } else {
                    return "I'm sorry, I couldn't determine both departure and destination locations. Please specify your flight route more clearly.";
                }
            } else if (lowercaseMessage.startsWith('search for flights from')) {
                const startIndex = 'search for flights from'.length;
                const messageWithoutPrefix = lowercaseMessage.substring(startIndex).trim();
                const fromToIndex = messageWithoutPrefix.indexOf(' to ');
                

                if (fromToIndex !== -1) {
                    const fromLocation = messageWithoutPrefix.substring(0, fromToIndex).trim();
                    const toLocation = messageWithoutPrefix.substring(fromToIndex + 4).trim();

                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `flight_search.php?fromLocation=${fromLocation}&toLocation=${toLocation}`, true);

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                const flights = JSON.parse(xhr.responseText);
                                if (flights.length > 0) {
                                    let response = "Here are the available flights:\n";
                                    flights.forEach((flight, index) => {
                                        response += `${index + 1}. Flight ${flight.number}, Departure Time: ${flight.d_time}, Arrival Time: ${flight.a_time}\n`;
                                    });
                                    appendBotMessage(response, true); // Use true to indicate it's flight info
                                } else {
                                    appendBotMessage("I'm sorry, there are no available flights for your selected route.");
                                }
                            } else {
                                appendBotMessage("I'm sorry, there was an error while fetching flight information.");
                            }
                        }
                    };

                    xhr.send();


                    return `Great! You want to fly from ${fromLocation} to ${toLocation}. Here's are available flights.`;
                } else {
                    return "I'm sorry, I couldn't determine both departure and destination locations. Please specify your flight route more clearly.";
                }
            } else if (lowercaseMessage === 'no') {
                return "Alright, if you change your mind or have any other questions, feel free to ask!";
            }
            else {
                return "I'm sorry, I didn't understand that. How can I assist you with your flight search?";
            }

            return "I'm a demo chatbot, and I'm here to assist you.";
        }

        let chatbotVisible = false;

        document.getElementById('messenger-icon').addEventListener('click', () => {
            const chatbotContainer = document.getElementById('chatbot-container');
            chatbotVisible = !chatbotVisible;

            if (chatbotVisible) {
                chatbotContainer.style.display = 'block';
            } else {
                chatbotContainer.style.display = 'none';
            }
        });

    </script>
</body>
</html>
