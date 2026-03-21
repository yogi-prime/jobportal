/**
 * Skills Assessment System
 * Interactive quiz functionality
 *
 * @package JobPortal
 */

(function() {
    'use strict';

    let currentQuestion = 0;
    let userAnswers = [];
    let quizStartTime = 0;
    let timerInterval = null;
    let timeRemaining = 0;

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof window.quizData === 'undefined') {
            return; // Not on quiz page
        }

        initQuiz();
    });

    /**
     * Initialize Quiz
     */
    function initQuiz() {
        const startBtn = document.getElementById('start-quiz-btn');
        const nextBtn = document.getElementById('next-question-btn');
        const prevBtn = document.getElementById('prev-question-btn');
        const submitBtn = document.getElementById('submit-quiz-btn');

        if (startBtn) {
            startBtn.addEventListener('click', startQuiz);
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', nextQuestion);
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', previousQuestion);
        }

        if (submitBtn) {
            submitBtn.addEventListener('click', submitQuiz);
        }
    }

    /**
     * Start Quiz
     */
    function startQuiz() {
        document.getElementById('quiz-start-screen').style.display = 'none';
        document.getElementById('quiz-questions-container').style.display = 'block';

        currentQuestion = 0;
        userAnswers = new Array(window.quizData.questions.length).fill(-1);
        quizStartTime = Date.now();
        timeRemaining = window.quizData.duration * 60; // Convert to seconds

        displayQuestion();
        startTimer();
    }

    /**
     * Display Current Question
     */
    function displayQuestion() {
        const question = window.quizData.questions[currentQuestion];
        const questionCard = document.getElementById('question-card');
        const currentQuestionNum = document.getElementById('current-question');
        const progressBar = document.getElementById('progress-bar');
        const nextBtn = document.getElementById('next-question-btn');
        const prevBtn = document.getElementById('prev-question-btn');
        const submitBtn = document.getElementById('submit-quiz-btn');

        // Update question number
        currentQuestionNum.textContent = currentQuestion + 1;

        // Update progress bar
        const progress = ((currentQuestion + 1) / window.quizData.questions.length) * 100;
        progressBar.style.width = progress + '%';

        // Build question HTML
        let html = `
            <div class="quiz-question">
                <h3 style="font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 32px; line-height: 1.5;">
                    ${question.question}
                </h3>
                <div class="quiz-options" style="display: grid; gap: 16px;">
        `;

        question.options.forEach((option, index) => {
            const isSelected = userAnswers[currentQuestion] === index;
            html += `
                <label class="quiz-option ${isSelected ? 'selected' : ''}" style="
                    display: flex;
                    align-items: center;
                    padding: 20px 24px;
                    background: ${isSelected ? '#eff6ff' : '#f8fafc'};
                    border: 2px solid ${isSelected ? '#00B4D8' : '#e2e8f0'};
                    border-radius: 12px;
                    cursor: pointer;
                    transition: all 0.3s;
                    font-size: 16px;
                    color: #1e293b;
                ">
                    <input type="radio"
                           name="question_${currentQuestion}"
                           value="${index}"
                           ${isSelected ? 'checked' : ''}
                           style="margin-right: 16px; width: 20px; height: 20px; cursor: pointer;">
                    <span style="flex: 1;">${option}</span>
                </label>
            `;
        });

        html += `
                </div>
            </div>
        `;

        questionCard.innerHTML = html;

        // Add change listeners to options
        const radioInputs = questionCard.querySelectorAll('input[type="radio"]');
        radioInputs.forEach(input => {
            input.addEventListener('change', function() {
                userAnswers[currentQuestion] = parseInt(this.value);

                // Update visual selection
                questionCard.querySelectorAll('.quiz-option').forEach(label => {
                    label.classList.remove('selected');
                    label.style.background = '#f8fafc';
                    label.style.borderColor = '#e2e8f0';
                });

                this.closest('.quiz-option').classList.add('selected');
                this.closest('.quiz-option').style.background = '#eff6ff';
                this.closest('.quiz-option').style.borderColor = '#00B4D8';
            });
        });

        // Update buttons
        prevBtn.style.display = currentQuestion > 0 ? 'block' : 'none';

        if (currentQuestion === window.quizData.questions.length - 1) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'block';
        } else {
            nextBtn.style.display = 'block';
            submitBtn.style.display = 'none';
        }
    }

    /**
     * Next Question
     */
    function nextQuestion() {
        if (currentQuestion < window.quizData.questions.length - 1) {
            currentQuestion++;
            displayQuestion();
        }
    }

    /**
     * Previous Question
     */
    function previousQuestion() {
        if (currentQuestion > 0) {
            currentQuestion--;
            displayQuestion();
        }
    }

    /**
     * Start Timer
     */
    function startTimer() {
        const timerElement = document.getElementById('quiz-timer');

        timerInterval = setInterval(function() {
            timeRemaining--;

            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;

            timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

            // Warning at 5 minutes
            if (timeRemaining === 300) {
                timerElement.style.color = '#f59e0b';
                alert('⏰ 5 minutes remaining!');
            }

            // Critical at 1 minute
            if (timeRemaining === 60) {
                timerElement.style.color = '#ef4444';
                alert('⏰ 1 minute remaining!');
            }

            // Time's up
            if (timeRemaining <= 0) {
                clearInterval(timerInterval);
                alert('⏰ Time\'s up! Submitting your quiz...');
                submitQuiz();
            }
        }, 1000);
    }

    /**
     * Submit Quiz
     */
    function submitQuiz() {
        // Check if all questions answered
        const unanswered = userAnswers.filter(answer => answer === -1).length;

        if (unanswered > 0) {
            if (!confirm(`You have ${unanswered} unanswered question(s). Submit anyway?`)) {
                return;
            }
        }

        clearInterval(timerInterval);

        const timeTaken = Math.floor((Date.now() - quizStartTime) / 1000); // in seconds

        // Show loading
        document.getElementById('quiz-questions-container').innerHTML = `
            <div style="text-align: center; padding: 80px 20px;">
                <div class="jobportal-spinner" style="margin: 0 auto 24px;"></div>
                <p style="font-size: 18px; color: #64748b;">Calculating your score...</p>
            </div>
        `;

        // Submit via AJAX
        const formData = new FormData();
        formData.append('action', 'jobportal_submit_quiz');
        formData.append('nonce', jobportalAjax.nonce);
        formData.append('skill', window.quizSkill);
        formData.append('answers', JSON.stringify(userAnswers));
        formData.append('time_taken', timeTaken);

        fetch(jobportalAjax.ajaxurl, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayResults(data.data);
            } else {
                alert('Error: ' + data.data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the quiz.');
        });
    }

    /**
     * Display Results
     */
    function displayResults(results) {
        document.getElementById('quiz-questions-container').style.display = 'none';
        const resultsContainer = document.getElementById('quiz-results');
        resultsContainer.style.display = 'block';

        const passed = results.passed;
        const percentage = results.percentage;

        let html = `
            <div style="
                background: white;
                padding: 60px 40px;
                border-radius: 20px;
                text-align: center;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                margin-bottom: 32px;
            ">
                <div style="font-size: 100px; margin-bottom: 24px;">
                    ${passed ? '🎉' : '😔'}
                </div>
                <h2 style="font-size: 42px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">
                    ${passed ? 'Congratulations!' : 'Keep Trying!'}
                </h2>
                <p style="font-size: 18px; color: #64748b; margin-bottom: 32px;">
                    ${passed
                        ? 'You passed the assessment! Your certificate has been generated.'
                        : 'You didn\'t pass this time, but you can retake the test anytime.'}
                </p>

                <div style="
                    display: inline-block;
                    padding: 32px 48px;
                    background: ${passed ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)'};
                    border-radius: 16px;
                    color: white;
                    margin-bottom: 32px;
                ">
                    <div style="font-size: 72px; font-weight: 800; margin-bottom: 8px;">
                        ${percentage}%
                    </div>
                    <div style="font-size: 16px; opacity: 0.9;">
                        ${results.score} out of ${results.total} correct
                    </div>
                </div>

                ${passed && results.certificate_id ? `
                    <div style="margin-bottom: 24px;">
                        <a href="${window.location.origin}/certificate?id=${results.certificate_id}"
                           class="jobportal-btn jobportal-btn-primary"
                           style="padding: 16px 32px; font-size: 18px; text-decoration: none; display: inline-block;"
                           target="_blank">
                            📜 View Certificate
                        </a>
                    </div>
                ` : ''}

                <div style="display: flex; gap: 16px; justify-content: center; margin-top: 24px;">
                    <a href="${window.location.pathname}?skill=${window.quizSkill}"
                       class="jobportal-btn"
                       style="background: #f8fafc; color: #1e293b; border: 2px solid #e2e8f0; text-decoration: none;">
                        Retake Test
                    </a>
                    <a href="${window.location.origin}/skills-dashboard"
                       class="jobportal-btn jobportal-btn-primary"
                       style="text-decoration: none;">
                        View All Skills
                    </a>
                </div>
            </div>

            <!-- Detailed Results -->
            <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                <h3 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                    Detailed Results
                </h3>
        `;

        results.results.forEach((result, index) => {
            const isCorrect = result.is_correct;
            const question = window.quizData.questions[index];

            html += `
                <div style="
                    padding: 24px;
                    background: ${isCorrect ? '#ecfdf5' : '#fef2f2'};
                    border-left: 4px solid ${isCorrect ? '#10b981' : '#ef4444'};
                    border-radius: 8px;
                    margin-bottom: 20px;
                ">
                    <div style="display: flex; align-items: start; gap: 16px; margin-bottom: 12px;">
                        <span style="
                            font-size: 32px;
                            min-width: 32px;
                        ">${isCorrect ? '✅' : '❌'}</span>
                        <div style="flex: 1;">
                            <h4 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 12px;">
                                Question ${index + 1}: ${result.question}
                            </h4>
                            <div style="margin-bottom: 8px;">
                                <strong style="color: #64748b;">Your answer:</strong>
                                <span style="color: ${isCorrect ? '#10b981' : '#ef4444'}; font-weight: 600;">
                                    ${result.user_answer >= 0 ? question.options[result.user_answer] : 'Not answered'}
                                </span>
                            </div>
                            ${!isCorrect ? `
                                <div style="margin-bottom: 8px;">
                                    <strong style="color: #64748b;">Correct answer:</strong>
                                    <span style="color: #10b981; font-weight: 600;">
                                        ${question.options[result.correct_answer]}
                                    </span>
                                </div>
                            ` : ''}
                            <div style="
                                margin-top: 12px;
                                padding: 12px;
                                background: rgba(255, 255, 255, 0.5);
                                border-radius: 6px;
                                font-size: 14px;
                                color: #475569;
                            ">
                                <strong>💡 Explanation:</strong> ${result.explanation}
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        html += `</div>`;

        resultsContainer.innerHTML = html;

        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

})();
