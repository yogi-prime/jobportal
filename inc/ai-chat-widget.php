<?php
/**
 * AI Chat Widget
 * Contextual chat assistant that asks questions based on user type
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display AI Chat Widget
 */
function jobportal_ai_chat_widget() {
    // Get user type if logged in
    $user_type = 'guest';
    $user_name = '';

    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $user_type = get_user_meta($current_user->ID, '_user_type', true) ?: 'candidate';
        $user_name = $current_user->display_name;
    }
    ?>

    <div id="jobportal-chat-widget" class="jobportal-chat-widget">
        <!-- Chat Toggle Button -->
        <button class="jobportal-chat-toggle" id="jobportalChatToggle">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <span class="chat-badge">1</span>
        </button>

        <!-- Chat Window -->
        <div class="jobportal-chat-window" id="jobportalChatWindow">
            <!-- Chat Header -->
            <div class="jobportal-chat-header">
                <div class="chat-header-info">
                    <div class="chat-avatar">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 5a3 3 0 1 1-3 3 3 3 0 0 1 3-3zm0 13a7.93 7.93 0 0 1-5.29-2 1.5 1.5 0 0 1 .43-2.17 9.06 9.06 0 0 1 9.72 0 1.5 1.5 0 0 1 .43 2.17A7.93 7.93 0 0 1 12 20z"></path>
                        </svg>
                    </div>
                    <div class="chat-header-text">
                        <h4>JobPortal Assistant</h4>
                        <span class="chat-status">
                            <span class="status-dot"></span>
                            Online
                        </span>
                    </div>
                </div>
                <button class="chat-close-btn" id="jobportalChatClose">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Chat Messages -->
            <div class="jobportal-chat-messages" id="jobportalChatMessages">
                <div class="chat-message bot-message">
                    <div class="message-avatar">🤖</div>
                    <div class="message-bubble">
                        <p>Hi<?php echo $user_name ? ' ' . esc_html($user_name) : ''; ?>! 👋 I'm here to help you find the perfect job match.</p>
                    </div>
                </div>
            </div>

            <!-- Quick Replies -->
            <div class="jobportal-chat-quick-replies" id="jobportalChatQuickReplies">
                <?php if ($user_type === 'guest'): ?>
                    <button class="quick-reply-btn" data-question="I'm looking for a job">
                        🧑‍💼 I'm looking for a job
                    </button>
                    <button class="quick-reply-btn" data-question="I want to hire">
                        🏢 I want to hire
                    </button>
                <?php elseif ($user_type === 'candidate'): ?>
                    <button class="quick-reply-btn" data-question="Show me jobs">
                        🔍 Show me jobs
                    </button>
                    <button class="quick-reply-btn" data-question="Build my resume">
                        📄 Build my resume
                    </button>
                    <button class="quick-reply-btn" data-question="Update my profile">
                        👤 Update my profile
                    </button>
                <?php else: ?>
                    <button class="quick-reply-btn" data-question="Post a job">
                        ✍️ Post a job
                    </button>
                    <button class="quick-reply-btn" data-question="View applications">
                        📋 View applications
                    </button>
                    <button class="quick-reply-btn" data-question="Manage my jobs">
                        💼 Manage my jobs
                    </button>
                <?php endif; ?>
            </div>

            <!-- Chat Input -->
            <div class="jobportal-chat-input">
                <input
                    type="text"
                    id="jobportalChatMessageInput"
                    placeholder="Type your message..."
                    autocomplete="off"
                />
                <button class="chat-send-btn" id="jobportalChatSend">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Chat Widget Styles */
        .jobportal-chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Toggle Button */
        .jobportal-chat-toggle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
        }

        .jobportal-chat-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 32px rgba(102, 126, 234, 0.5);
        }

        .jobportal-chat-toggle svg {
            width: 28px;
            height: 28px;
        }

        .chat-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            border: 2px solid white;
            animation: pulse-badge 2s infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Chat Window */
        .jobportal-chat-window {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 380px;
            max-width: calc(100vw - 40px);
            height: 600px;
            max-height: calc(100vh - 120px);
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            display: none;
            flex-direction: column;
            overflow: hidden;
            animation: slideUp 0.3s ease;
        }

        .jobportal-chat-window.active {
            display: flex;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Chat Header */
        .jobportal-chat-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-header-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-avatar {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-header-text h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }

        .chat-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            opacity: 0.9;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .chat-close-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .chat-close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Chat Messages */
        .jobportal-chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .chat-message {
            display: flex;
            gap: 10px;
            animation: fadeInMessage 0.3s ease;
        }

        @keyframes fadeInMessage {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-message {
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .message-bubble {
            max-width: 75%;
            padding: 12px 16px;
            border-radius: 16px;
            font-size: 14px;
            line-height: 1.5;
        }

        .bot-message .message-bubble {
            background: white;
            border: 1px solid #e2e8f0;
            border-bottom-left-radius: 4px;
        }

        .user-message .message-bubble {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .message-bubble p {
            margin: 0;
        }

        .typing-indicator {
            display: flex;
            gap: 4px;
            padding: 16px;
        }

        .typing-dot {
            width: 8px;
            height: 8px;
            background: #94a3b8;
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-10px); }
        }

        /* Quick Replies */
        .jobportal-chat-quick-replies {
            padding: 12px 20px;
            background: white;
            border-top: 1px solid #e2e8f0;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .quick-reply-btn {
            background: white;
            border: 1.5px solid #667eea;
            color: #667eea;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .quick-reply-btn:hover {
            background: #667eea;
            color: white;
            transform: translateY(-1px);
        }

        /* Chat Input */
        .jobportal-chat-input {
            padding: 16px 20px;
            background: white;
            border-top: 1px solid #e2e8f0;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .jobportal-chat-input input {
            flex: 1;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 12px 16px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .jobportal-chat-input input:focus {
            border-color: #667eea;
        }

        .chat-send-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
        }

        .chat-send-btn:hover {
            transform: scale(1.1);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .jobportal-chat-window {
                width: calc(100vw - 20px);
                height: calc(100vh - 100px);
                bottom: 70px;
                right: 10px;
            }

            .jobportal-chat-toggle {
                width: 56px;
                height: 56px;
            }
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            const chatToggle = $('#jobportalChatToggle');
            const chatWindow = $('#jobportalChatWindow');
            const chatClose = $('#jobportalChatClose');
            const chatMessages = $('#jobportalChatMessages');
            const chatInput = $('#jobportalChatMessageInput');
            const chatSend = $('#jobportalChatSend');
            const quickReplies = $('.quick-reply-btn');
            const chatBadge = $('.chat-badge');

            // Toggle chat window
            chatToggle.on('click', function() {
                chatWindow.toggleClass('active');
                chatBadge.hide();
            });

            chatClose.on('click', function() {
                chatWindow.removeClass('active');
            });

            // Send message
            function sendMessage(message) {
                if (!message.trim()) return;

                // Add user message
                const userMessage = `
                    <div class="chat-message user-message">
                        <div class="message-avatar">👤</div>
                        <div class="message-bubble">
                            <p>${escapeHtml(message)}</p>
                        </div>
                    </div>
                `;
                chatMessages.append(userMessage);
                chatInput.val('');

                // Show typing indicator
                const typingIndicator = `
                    <div class="chat-message bot-message typing-message">
                        <div class="message-avatar">🤖</div>
                        <div class="message-bubble">
                            <div class="typing-indicator">
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                            </div>
                        </div>
                    </div>
                `;
                chatMessages.append(typingIndicator);

                // Scroll to bottom
                chatMessages.scrollTop(chatMessages[0].scrollHeight);

                // Process message
                setTimeout(function() {
                    $('.typing-message').remove();
                    const response = getBotResponse(message);
                    const botMessage = `
                        <div class="chat-message bot-message">
                            <div class="message-avatar">🤖</div>
                            <div class="message-bubble">
                                <p>${response}</p>
                            </div>
                        </div>
                    `;
                    chatMessages.append(botMessage);
                    chatMessages.scrollTop(chatMessages[0].scrollHeight);
                }, 1500);
            }

            // Get bot response
            function getBotResponse(message) {
                const msg = message.toLowerCase();

                // Job search responses
                if (msg.includes('job') || msg.includes('looking for')) {
                    return 'Great! I can help you find jobs. What type of position are you looking for? 🔍';
                }

                // Hiring responses
                if (msg.includes('hire') || msg.includes('post')) {
                    return 'Excellent! To post a job, please <a href="<?php echo esc_url(home_url('/post-job')); ?>" style="color: #667eea; text-decoration: underline;">click here</a>. You can create a free listing or choose a premium option. 💼';
                }

                // Resume responses
                if (msg.includes('resume') || msg.includes('cv')) {
                    return 'I can help with that! Use our <a href="<?php echo esc_url(home_url('/resume-builder')); ?>" style="color: #667eea; text-decoration: underline;">Resume Builder</a> to create a professional resume in minutes. 📄';
                }

                // Profile responses
                if (msg.includes('profile')) {
                    <?php if (is_user_logged_in()): ?>
                    return 'You can update your profile <a href="<?php echo esc_url(home_url('/my-profile')); ?>" style="color: #667eea; text-decoration: underline;">here</a>. Add your skills, experience, and education to attract employers! 👤';
                    <?php else: ?>
                    return 'Please <a href="#" onclick="jQuery(\'#jobportal-login-modal\').fadeIn(); return false;" style="color: #667eea; text-decoration: underline;">login</a> first to update your profile. 👤';
                    <?php endif; ?>
                }

                // Applications responses
                if (msg.includes('application')) {
                    return 'You can view all your job applications <a href="<?php echo esc_url(home_url('/my-applications')); ?>" style="color: #667eea; text-decoration: underline;">here</a>. Track their status and follow up with employers. 📋';
                }

                // Default response
                return 'I\'m here to help! You can ask me about finding jobs, posting jobs, building your resume, or updating your profile. What would you like to know? 😊';
            }

            // Escape HTML
            function escapeHtml(text) {
                const map = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                };
                return text.replace(/[&<>"']/g, function(m) { return map[m]; });
            }

            // Send on button click
            chatSend.on('click', function() {
                const message = chatInput.val();
                sendMessage(message);
            });

            // Send on Enter key
            chatInput.on('keypress', function(e) {
                if (e.which === 13) {
                    const message = chatInput.val();
                    sendMessage(message);
                }
            });

            // Quick reply buttons
            quickReplies.on('click', function() {
                const question = $(this).data('question');
                sendMessage(question);
            });
        });
    </script>

    <?php
}
add_action('wp_footer', 'jobportal_ai_chat_widget');
