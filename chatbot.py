import torch
import torch.nn as nn
import random
import sys
import json

# Step 1: Define the dataset of predefined questions and answers
dataset = {
    "hello": "Hello, how can I help you?",
    "how are you": "I'm just a chatbot, but I'm doing fine. How can I assist you?",
    "what's your name": "I don't have a name, but you can call me Chatbot.",
    "bye": "Goodbye! Feel free to return if you have more questions.",
    
    "what is payment system": "We Accept Credit Card, Bkash Rocket Nagad",
    "which location you have flights": "Dhaka,Rajshahi,Chittagong,saiyadpur"
}

# Step 2: Text preprocessing (simple tokenization)
def tokenize(text):
    return text.lower().split()

# Step 3: Define a simple PyTorch model
class SimpleChatbot(nn.Module):
    def __init__(self, input_size, hidden_size, output_size):
        super(SimpleChatbot, self).__init__()
        self.fc1 = nn.Linear(input_size, hidden_size)
        self.fc2 = nn.Linear(hidden_size, output_size)
        self.activation = nn.ReLU()
    
    def forward(self, x):
        x = self.fc1(x)
        x = self.activation(x)
        x = self.fc2(x)
        return x

# Step 4: Train the model (not applicable for a rule-based chatbot)

# Step 5: Inference
def chat_with_bot(input_text, model):
    input_text = tokenize(input_text)
    input_vector = torch.tensor([len(input_text)], dtype=torch.float32)  # For simplicity, input length is used as a feature
    response = model(input_vector)
    response = torch.argmax(response).item()
    
    return list(dataset.values())[response]

# Step 6: User Interface (Optional)
print("Chatbot: Hello, how can I help you?")
while True:
    user_input = input("You: ")
    if user_input.lower() == 'bye':
        print("Chatbot: Goodbye!")
        break
    else:
        response = chat_with_bot(user_input, SimpleChatbot(1, 8, len(dataset)))
        print("Chatbot:", response)




if __name__ == "__main__":
    try:
        input_text = sys.argv[1]
        response = chat_with_bot(input_text, SimpleChatbot(1, 8, len(dataset)))
        result = {"response": response}
    except Exception as e:
        result = {"error": str(e)}

    print(json.dumps(result))  
    
          
