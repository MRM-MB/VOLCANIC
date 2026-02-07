let isSendingMessage = false;

async function askGemini(prompt) {
  const response = await fetch("/api/gemini", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ prompt }),
  });

  if (!response.ok) {
    throw new Error("Failed to fetch AI response");
  }

  const data = await response.json();
  return data.candidates?.[0]?.content?.parts?.[0]?.text || "I couldn't generate a reply.";
}

function appendMessage(chatBox, type, text, isLoading = false) {
  const wrapper = document.createElement("div");
  wrapper.className = type + (isLoading ? " loading" : "");

  const paragraph = document.createElement("p");
  paragraph.textContent = text;
  wrapper.appendChild(paragraph);

  chatBox.appendChild(wrapper);
  chatBox.scrollTop = chatBox.scrollHeight;

  return wrapper;
}

async function sendMessage() {
  if (isSendingMessage) {
    return;
  }

  const input = document.querySelector(".chat-window input");
  const chatBox = document.querySelector(".chat-window .chat");
  const sendButton = document.querySelector(".chat-window .input-area button");
  const userMessage = input.value.trim();

  if (!userMessage.length) {
    return;
  }

  input.value = "";
  appendMessage(chatBox, "user", userMessage);

  isSendingMessage = true;
  input.disabled = true;
  if (sendButton) {
    sendButton.disabled = true;
  }

  const loadingElem = appendMessage(chatBox, "ai", "Thinking...", true);

  try {
    const aiReply = await askGemini(userMessage);

    if (loadingElem) {
      loadingElem.remove();
    }
    appendMessage(chatBox, "ai", aiReply);
  } catch (err) {
    if (loadingElem) {
      loadingElem.remove();
    }
    appendMessage(chatBox, "ai error", "Sorry, something went wrong.");
  } finally {
    isSendingMessage = false;
    input.disabled = false;
    if (sendButton) {
      sendButton.disabled = false;
    }
    input.focus();
  }
}

function openChatWithPrompt(prompt) {
    // Show chat window
    document.querySelector(".chat-window").classList.remove("ai-bot-hidden");
    document.getElementById("ai-bot-toggle").style.display = "none";
    
    // Set the input value
    const input = document.querySelector(".chat-window input");
    input.value = prompt;
  input.focus();
    
    // Automatically send the message
    sendMessage();
    
    // Scroll chat to bottom
    const chatBox = document.querySelector(".chat-window .chat");
    setTimeout(() => {
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 100);
}

// Make it globally accessible so volcano-modal.js can use it
window.openChatWithPrompt = openChatWithPrompt;

document.addEventListener("DOMContentLoaded", function() {
    // Show chat window
    document.getElementById("ai-bot-toggle").addEventListener("click", function() {
        document.querySelector(".chat-window").classList.remove("ai-bot-hidden");
        this.style.display = "none";
    });

    // Hide chat window
    document.getElementById("ai-bot-close").addEventListener("click", function() {
        document.querySelector(".chat-window").classList.add("ai-bot-hidden");
        document.getElementById("ai-bot-toggle").style.display = "block";
    });

    // Send message (if you have this)
    document.querySelector(".chat-window .input-area button").addEventListener("click", sendMessage);

    // Send message on Enter key press
    document.querySelector(".chat-window .input-area input").addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
        e.preventDefault();
            sendMessage();
        }
    });
});